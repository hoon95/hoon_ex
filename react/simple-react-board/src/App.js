import React, { Component } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import './App.css';
import BoardList from './BoardList';
import Write from './Write';

class App extends Component{
  state = {
    isModifyMode : false,
    isCompleted:true,
    boardId:0
  }
  handleModify = (checkList)=>{
    if(checkList.length === 0){
      alert('수정할 게시물을 선택하세요');
    } else if(checkList.length > 1){
      alert('하나의 게시물만 선택하세요');
    }
    this.setState({
      isModifyMode: checkList.length === 1
    })
    this.setState({
      boardId:checkList.length[0]
    })
  }

  render(){
    return(
      <div className="container">
        <BoardList handleModify={this.handleModify} />
        <Write/>
      </div>
    )
  }
}

export default App;
