import React, { Component } from 'react';
import Table from 'react-bootstrap/Table';
import Button from 'react-bootstrap/Button';
import Axios from "axios";


class Board extends Component {
  render() {
    return (

      <tr>
        <td>
          <input type="checkbox" value={this.props.id} onChange={e =>
            this.props.onCheckboxChange(e.target.checked, e.target.value)
          } />
        </td>
        <td>{this.props.id}</td>
        <td>{this.props.title}</td>
        <td>{this.props.REGISTER_ID}</td>
        <td>{this.props.REGISTER_DATE}</td>
      </tr>
    )
  }
}


class BoardList extends Component {
  state = {
    boardList: [],
    checkList: []
  }

  getList = () => {
    Axios.get('http://localhost:8000/list')
      .then((result) => {
        const { data } = result;
        this.setState({
          boardList: data
        })
        this.props.renderComplete();    // App.js에 목록 출력 완료를 알려준다
      })
      .catch((error) => {
        // 에러 핸들링
        console.log(error);
      });
  }
  componentDidMount() {
    this.getList();
  }
  componentDidUpdate() {
    if (!this.props.isComplete) {
      this.getList();
    }
  }

  onCheckboxChange = (checked, id) => {
    const list = this.state.checkList.filter(v => {
      return v != id;   // id와 일치하지 않는 값만 return
    });
    if (checked) {
      list.push(id);
    }
    this.setState({
      checkList: list
    })
  }

  render() {
    console.log(this.state.checkList);
    return (
      <>
        <Table striped bordered hover>
          <thead>
            <tr>
              <th>선택</th>
              <th>#</th>
              <th>Title</th>
              <th>Wirter Id</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            {
              this.state.boardList.map((item) => {
                return (
                  <Board
                    key={item.BOARD_ID}
                    id={item.BOARD_ID}
                    title={item.BOARD_TITLE}
                    REGISTER_ID={item.REGISTER_ID}
                    REGISTER_DATE={item.REGISTER_DATE}
                    onCheckboxChange={this.onCheckboxChange}
                  />
                )
              })
            }


          </tbody>
        </Table>
        <div className='d-flex gap-3'>
          <Button variant="info">글쓰기</Button>
          <Button
            variant="secondary"
            onClick={() => {
              this.props.handleModify(this.state.checkList);
            }}

          >수정</Button>
          <Button variant="danger">삭제</Button>
        </div>
      </>
    )
  }
}
export default BoardList;