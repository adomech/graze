import React, { Component } from 'react';
import Product from '../../components/Product';

class BoxItem extends Component {

  render(){
    var rows = [];
    this.props.box.content.map((product,index) => rows.push(<Product key={index} product={product} />))
    return (
      <div>
        <p>
        Date: {this.props.box.delivery_date}
        </p>
        <p>
        Number: {this.props.box.id}
        </p>
        <ul>
          {rows}
        </ul>
      </div>
    )
  }
}

BoxItem.defaultProps = {
  box: []
};

export default BoxItem;
