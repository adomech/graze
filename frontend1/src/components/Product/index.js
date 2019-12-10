import React, { Component } from 'react';
import Rating from '../../components/Rating';

class Product extends Component {

  render(){
    return (
      <li key={this.props.product.index}>
        <p>Name:<br/> {this.props.product.name}</p>
        <p>Category:<br/> {this.props.product.category}</p>
        <p><img alt={this.props.product.name} src={this.props.product.image_url} /></p>
        <p>Rating:</p>
        <Rating rating={this.props.product} />
      </li>
    )
  }
}

Product.defaultProps = {
  product: []
};

export default Product;
