<?php

namespace App\Repository;

use App\Entity\Rating;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Rating|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rating|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rating[]    findAll()
 * @method Rating[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RatingsRepository extends ServiceEntityRepository
{
    public function __construct
    (
        ManagerRegistry $registry,
        EntityManagerInterface $manager
    )
    {
        parent::__construct($registry, Rating::class);
        $this->manager = $manager;
        $this->conn = $this->getEntityManager()->getConnection();
    }

    public function updateRating($rating)
    {

      //check if the rating exists on the table, if not exist the added.
      $sql = 'select *
               from rating
               where
               rating.product_id = :productId and
               rating.account_id = :accoundId';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(array('productId' => $rating['productId'],
                            'accoundId' => $rating['accountId']
                          ));

      if ($stmt->fetchAll()){
        $sql = 'update rating
                set rating.rating = :ratingNum
                where
                rating.product_id = :productId and
                rating.account_id = :accoundId';

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array('ratingNum' => $rating['rating'],
                              'productId' => $rating['productId'],
                              'accoundId' => $rating['accountId']
                            ));

      }else{

        $rating_element = new Rating();
        $rating_element->setProductId($rating['productId']);
        $rating_element->setAccountId($rating['accountId']);
        $rating_element->setRating($rating['rating']);
        $this->manager->persist($rating_element);

      }

      $this->manager->flush();
    }

}
