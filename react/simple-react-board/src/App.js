import React, { Component } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import './App.css';
import BoardList from './BoardList';
import Write from './Write';

class App extends Component {
  state = {
    isModifyMode: false,
    isCompleted: true,
    boardId: 0
  }
  handleModify = (checkList) => {
    if (checkList.length === 0) {
      alert('수정할 게시물을 선택하세요');
    } else if (checkList.length > 1) {
      alert('하나의 게시물만 선택하세요');
    }
    this.setState({
      isModifyMode: checkList.length === 1,
      boardId: checkList[0]
    })

  }
  handleCancel = () => {
    this.setState({
      isModifyMode: false,
      isCompleted: false,
      boardId: 0
    })
  }
  renderComplete = () => {
    //목록 출력 완료하면
    this.setState({
      isCompleted: true
    })
  }

  render() {

    console.log('boardid' + this.state.boardId);
    console.log(this.state.isModifyMode);
    console.log(this.state.isCompleted);
    return (
      <div className="container">
        <BoardList
          handleModify={this.handleModify}
          renderComplete={this.renderComplete}
          isCompleted={this.state.isCompleted}
        />
        <Write
          isModifyMode={this.state.isModifyMode}
          boardId={this.state.boardId}
          handleCancel={this.handleCancel}
        />
      </div>
    )
  }
}

export default App;
