import React, { Component } from 'react';
import logo from './logo.svg';
import './App.css';
import BoxList from './components/BoxList';
import SearchBox from './components/SearchBox';

class App extends Component{

  constructor(props){
    super(props);
    this.state = {
      boxes: []
    };
  }

  handleSearch = (accountId) => {
    let url = 'http://localhost:8080/boxes/'+accountId;
    fetch(url).
    then(response => response.json()).then((boxes) => {
      this.setState({
        boxes: boxes
      });
    });
  };

  render(){
    return (
      <div className="App">
        <header className="App-header">
          <h1>Graze</h1>
          <SearchBox handleSubmit={this.handleSearch} />
          <BoxList boxes={this.state.boxes}/>
        </header>
      </div>
    )
  }
}

export default App;
