import { useSelector, useDispatch } from 'react-redux';

function DisplayNumber(){
  const num = useSelector(state => state.counter.value);
    return(
      <div>
        <h2>DisplayNumber</h2>
        <p>number : {num}</p>
      </div>
    )
  }

export default DisplayNumber;