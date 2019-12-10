import React, { Component } from 'react';

class Rating extends Component {

  constructor(props) {
      super();
      this.state = {
        value: props.rating.rating,
        productId: props.rating.product_id,
        accountId: props.rating.account_id
      };
  }

  handleChange = (e) => {
    const val = e.target.value;
    this.setState({value: val});
    let url = 'http://localhost:8080/rating';
    fetch(url, {
        method: 'PUT',
        body: JSON.stringify({
  				'productId': this.state.productId,
  				'accountId': this.state.accountId,
  				'rating': val
  			}),
        headers: {
            'Content-Type': 'application/json'
        }
    }).
    then(response => response.json()).then((rating) => {
      console.log(rating);
    }).catch(err => err);
  }

  render(){
    return (
        <input
          type="number"
          min="0" max="3"
          onChange = {this.handleChange}
          value = {this.state.value}
        />
    )
  }
}

Rating.defaultProps = {
  rating: 1
};

export default Rating;
