<?php

namespace App\Repository;

use App\Entity\Account;
use App\Entity\Box;
use App\Entity\BoxToProduct;
use App\Entity\Product;
use App\Entity\Rating;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\AST\Join;

/**
 * @method Account|null findProductsByAccountId($id)
 * @method Account|null findBoxesByAccountId($id)
 */
class AccountsRepository extends ServiceEntityRepository
{
    private $manager;
    private $conn;

    public function __construct
    (
        ManagerRegistry $registry,
        EntityManagerInterface $manager
    )
    {
        parent::__construct($registry, Account::class);
        $this->manager = $manager;
        $this->conn = $this->getEntityManager()->getConnection();
    }

    /**
    * @return Array[] Returns an array of products
    */

    public function findProductsByAccountId($accountId) : array
    {

      foreach ($this->findBoxesByAccountId($accountId) as $key => $value) {
        $sql = 'select *
                    from box_to_product,product
                    where
                    product.id = box_to_product.product_id and
                    box_to_product.box_id = :boxId';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array('boxId' => $value['id']));
        $content_boxes = $stmt->fetchAll();
        $content_ratings = [];

        foreach ($content_boxes as $content) {
          $sql = 'select *
                      from rating
                      where
                      rating.product_id = :productId and
                      rating.account_id = :accountId
                      ';
          $stmt = $this->conn->prepare($sql);
          $stmt->execute(array('productId' => $content['product_id'],'accountId' => $accountId));

          $rating = $stmt->fetchAll();
          $content_ratings [] = [
            'product_id' => $content['product_id'],
            'box_id' => $content['box_id'],
            'id' => $content['id'],
            'name' => $content['name'],
            'category' => $content['category'],
            'image_url' => $content['image_url'],
            'rating' => !empty($rating) ? $rating[0]['rating'] : 1,
            'account_id' => $accountId,
          ];
        }

        $list_boxes []= [
            'content' => $content_ratings,
            'delivery_date' => $value['delivery_date'],
            'id' => $value['id']
          ];
       }

      return $list_boxes;
    }

    /**
    * @return Array[] Returns an array of boxes
    */
    public function findBoxesByAccountId($accountId) : array
    {
        $list_boxes = [];
        $sql = 'select *
                 from box
                 where
                 box.account_id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array('id' => $accountId ));
        return $stmt->fetchAll();
    }


}
