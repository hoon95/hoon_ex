import React, { Component } from 'react';
import Button from 'react-bootstrap/Button';
import Form from 'react-bootstrap/Form';
import Axios from "axios";

class Write extends Component {
  state = {
    isModifyMode: false,
    // boardId: 0,
    title: '',
    content: ''
  }

  write = () => {
    Axios.post('http://localhost:8000/insert', {
      title: this.state.title,
      content: this.state.content
    })
      .then(() => {
        this.setState({
          title: '',
          content: ''
        });
        this.props.handleCancel();
      })
      .catch((error) => {
        console.log(error);
      });
  }
  update = () => {
    Axios.post('http://localhost:8000/update', {
      title: this.state.title,
      content: this.state.content,
      id: this.props.boardId
    })
      .then(() => {
        this.setState({
          title: '',
          content: ''
        });
        this.props.handleCancel();
      })
      .catch((error) => {
        console.log(error);
      });
  }

  handleChange = (e) => {
    this.setState({
      [e.target.name]: e.target.value
    })
  }
  componentDidUpdate = (prevProps) => {
    if (this.props.isModifyMode && this.props.boardId != prevProps.boardId) {
      this.detail();    // 수정모드이고 새 번호가 있다면 새 번호의 글 조회
    }
  }


  detail = () => {
    Axios.get(`http://localhost:8000/detail?id=${this.props.boardId}`)
      .then((result) => {
        console.log(result);
        if (result.data.length > 0) {
          this.setState({
            title: result.data[0].BOARD_TITLE,
            content: result.data[0].BOARD_CONTENT
          });
        }
      })
      .catch((error) => {
        console.log(error);
      });
  }

  render() {
    return (
      <>
        <Form>
          <Form.Group className="mb-3" controlId="exampleForm.ControlInput1">
            <Form.Label>제목</Form.Label>
            <Form.Control
              type="text"
              placeholder="글 제목을 입력하세요"
              name="title"
              onChange={this.handleChange}
              value={this.state.title}
            />
          </Form.Group>
          <Form.Group className="mb-3" controlId="exampleForm.ControlTextarea1">
            <Form.Label>내용</Form.Label>
            <Form.Control
              as="textarea"
              rows={3}
              name="content"
              onChange={this.handleChange}
              value={this.state.content}
            />
          </Form.Group>
        </Form>
        <div className='d-flex gap-3'>
          <Button variant="info" onClick={this.state.isModifyMode ? this.update : this.write}>작성완료</Button>
          <Button variant="secondary">취소</Button>
        </div>
      </>
    )
  }
}
export default Write;