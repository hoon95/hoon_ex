// import { useState } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { increment, decrement } from '../counterSlice';

function AddNumber(props){
  // const [num, setNum] = useState(0);
  const num = useSelector(state => state.counter.value);
  const dispatch = useDispatch();
    return(
      <div>
        <h2>AddNumber</h2>
        {/* <input type="number" value={num} onChange={e=>{
          setNum(e.target.value);
        }}/> */}
        {/* <button type="button" onClick={()=>{  
          props.changeNum(num);
        }}>더하기</button> */}
        <input type="text" readOnly min="0" value={num}/>
        <button type="button" onClick={()=>{
          dispatch(increment());
        }}>+</button>
        <button type="button" onClick={()=>{
          dispatch(decrement());
        }}>-</button>
      </div>
    )
  }

export default AddNumber;