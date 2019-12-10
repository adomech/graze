import React, { Component } from 'react';

class SearchBox extends Component {
  constructor(props) {
    super(props);
  }

  handleSubmit = (event) => {
    event.preventDefault();
    const text = event.target.text.value;
    this.props.handleSubmit(text);
  };

  render() {
    return (
      <form onSubmit={this.handleSubmit}>
        <input
          name="text"
          type="text"
          placeholder="Type Account ID"
        />
         <input type="submit" value="Sent" />
      </form>
    );
  }
}

export default SearchBox;
