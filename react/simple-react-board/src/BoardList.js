import React, { Component } from 'react';
import Table from 'react-bootstrap/Table';
import Button from 'react-bootstrap/Button';
import Axios from "axios";
import { Link } from 'react-router-dom';


class Board extends Component {
  render() {
    return (

      <tr>
        <td>
          <input type="checkbox" value={this.props.id} onChange={(e) => {
            this.props.onCheckboxChange(e.target.checked, e.target.value)
          }
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
        this.props.renderComplete();//App.js에 목록 출력 완료 알려준다.

      })
      .catch((error) => {
        // 에러 핸들링
        console.log(error);
      });
  }
  handleDelete = () => {
    if (this.state.checkList.length === 0) {
      alert('삭세할 게시글을 선택하세요');
      return;
    }
    let boardIdList = '';
    this.state.checkList.forEach(item => {
      boardIdList += `'${item}',`;
    });
    console.log(boardIdList);
    boardIdList = boardIdList.substring(0, boardIdList.length - 1);
    console.log(boardIdList);

    Axios.post('http://localhost:8000/delete', {
      boardIdList: boardIdList
    })
      .then(() => {
        this.getList();
      })
      .catch((error) => {
        console.log(error);
      });
  }
  componentDidMount() {
    this.getList();

  }

  componentDidUpdate() {
    if (!this.props.isCompleted) {
      this.getList();
    }
  }
  onCheckboxChange = (checked, id) => {
    const list = this.state.checkList.filter(v => {
      return v != id;
    })
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
          <Link to='/write'>
            <Button variant="info">글쓰기</Button>
          </Link>
          <Button
            variant="secondary"
            onClick={() => {
              this.props.handleModify(this.state.checkList);
            }}

          >수정</Button>
          <Button variant="danger" onClick={this.handleDelete}>삭제</Button>
        </div>
      </>
    )
  }
}
export default BoardList;