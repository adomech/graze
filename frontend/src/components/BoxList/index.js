import React, { Component } from 'react';
import BoxItem from '../../components/BoxItem';
import Paper from '@material-ui/core/Paper';

class BoxList extends Component {

  render(){
    var rows = [];
    this.props.boxes.map((box,index) => rows.push(<BoxItem key={index} box={box} />))
    return (
      <Paper>
         {rows}
      </Paper>
    )
  }
}

BoxList.defaultProps = {
  boxes: []
};

export default BoxList;
