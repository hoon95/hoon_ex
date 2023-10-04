import { Component } from 'react';
import { useState, useEffect } from 'react';
import './App.css';

function App() {
  const [funcShow, setFuncShow] = useState(true);
  const [classShow, setClassShow] = useState(true);
  return (
    <div className="container">
      <h1>컴포넌트 비교(함수형 vs 클래스형)</h1>
      <button onClick={()=>{setFuncShow(false)}}>함수형 삭제</button>
      <button onClick={()=>{setClassShow(false)}}>클래스형 삭제</button>
      {funcShow ? <FuncComp initNumber={2} /> : null}
      {classShow ? <ClassComp initNumber={2} /> : null}
    </div>
  );
}

function FuncComp({initNumber}){    // 비구조화(destructuring)
  const [number, setNumber] = useState(initNumber);
  const [date, setDate] = useState(new Date().toLocaleString());

  useEffect(()=>{
    console.log('useEffect 실행');
    return function(){
      document.title = number + ':' + date;
      console.log('타이틀 변경');
    }
  },[number, date]);
  // 상세 풀이
  // let numberState = useState(initNumber);
  // let number = numberState[0];
  // let setNumber = numberState[1];

  return (
    <div className="container">
      <h2>1. 함수형</h2>
      <p>number: {number}</p>
      <p>date: {date}</p>
      <button type='button' onClick={
        ()=>{
          setNumber(Math.random());
        }
      }>
        난수 생성
      </button>
      <button type='button' onClick={
        ()=>{
          setDate(new Date().toLocaleString());
        }
      }>
        날짜 업데이트
      </button>
    </div>
  );
}

class ClassComp extends Component{
  state = {
    number: this.props.initNumber,
    date: new Date().toLocaleString()
  }
  componentDidMount(){
    console.log('componentDidMount 실행');
  }
  shouldComponentUpdate(nextProps, nextState){
    console.log('1 shouldComponentUpdate 실행');
    return true;
  }
  componentDidUpdate(nextProps, nextState){
    console.log('componentDidUpdate 실행');
  }

  render(){
    console.log('class')
    return(
      <div className="container">
        <h2>2. 클래스형</h2>
        {/* <p>number: {this.props.initNumber}</p> */}
        <p>number: {this.state.number}</p>
        <p>date: {this.state.date}</p>
        <button type='button' onClick={()=>{
          this.setState({
            number: Math.random()
          })
        }}>난수 생성</button>
        <button type='button' onClick={()=>{
          this.setState({
            date: new Date().toLocaleString()
          })
        }}>날짜 업데이트</button>
      </div>
    )
  }
}

export default App;
