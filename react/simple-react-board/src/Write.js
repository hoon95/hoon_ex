import React, { useEffect, useState } from 'react';
import Button from 'react-bootstrap/Button';
import Form from 'react-bootstrap/Form';
import Axios  from "axios";
import { Link } from 'react-router-dom';
import { useNavigate } from "react-router-dom"; //useNavigate 함수형 컴포넌트에서만 작동

function Write(props){
 
  const [isModifyMode, setIsModifyMode] = useState(false);

  const [title, setTitle] = useState('');
  const [content, setContent] = useState('');
  const navigate = useNavigate();

  let write = ()=>{
    Axios.post('http://localhost:8000/insert',{
      title:title,
      content:content
    })
    .then(() => {      
      setTitle('');
      setContent('');
      navigate("/");
      props.handleCancel();
    })
    .catch((error) => {     
      console.log(error);
    });
  }
  let update = ()=>{
    Axios.post('http://localhost:8000/update',{
      title:title,
      content:content,
      id:props.boardId
    })
    .then(() => {      
      setTitle('');
      setContent('');
      props.handleCancel();
      navigate("/");
    })
    .catch((error) => {     
      console.log(error);
    });
  }
  let detail = ()=>{
    Axios.get(`http://localhost:8000/detail?id=${props.boardId}`)
    .then((result) => {

      if(result.data.length>0){
        setTitle(result.data[0].BOARD_TITLE);
        setContent(result.data[0].BOARD_CONTENT);
        setIsModifyMode(true);   
      }    
    
    })
    .catch((error) => {     
      console.log(error);
    });
  }
  let  handleChange = (e) => {
    if(e.target.name === 'title'){
        setTitle(e.target.value);
    }else{
      setContent(e.target.value);
    }    
  }

  useEffect(()=>{
    if(props.isModifyMode && props.boardId){
      detail();
    }
  });
  return(
    <>
      <Form>
        <Form.Group className="mb-3" controlId="exampleForm.ControlInput1">
          <Form.Label>제목</Form.Label>
          <Form.Control 
            type="text" 
            placeholder="글 제목을 입력하세요" 
            name="title"
            onChange={handleChange}
            value={title}
          />
        </Form.Group>
        <Form.Group className="mb-3" controlId="exampleForm.ControlTextarea1">
          <Form.Label>내용</Form.Label>
          <Form.Control 
            as="textarea" 
            rows={3} 
            name="content"
            onChange={handleChange}              
            value={content}
          />
        </Form.Group>
      </Form>
      <div className='d-flex gap-3'>
        <Button variant="info" onClick={isModifyMode ? update:write}>            
          작성완료
          </Button>
        <Link to="/">
          <Button variant="secondary">취소</Button>
        </Link>
      </div>
    </>
  )
}

export default Write;