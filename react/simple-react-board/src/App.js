import React, { Component } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import './App.css';
import BoardList from './BoardList';
import Write from './Write';

class App extends Component {
  state = {
    isModifyMode: false,
    isCompleted: false,
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

  }
  renderComplete = () => {

  }

  render() {
    return (
      <div className="container">
        <BoardList handleModify={this.handleModify}
          renderComplete={this.renderComplete}
          isComplete={this.isComplete}
        />
        <Write isModifyMode={this.state.isModifyMode}
          boardId={this.state.boardId}
          handleCancel={this.handleCancel}
        />
      </div>
    )
  }
}

export default App;
