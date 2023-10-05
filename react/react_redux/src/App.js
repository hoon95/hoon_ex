import './App.css';
import AddNumber from './component/AddNumber';
import DisplayNumber from './component/DisplayNumber';
// import {useState} from 'react';

function App() {
  // const [number, setNumber] = useState(0);
  return (
    <div className="App">
      <h1>Root</h1>
      {/* <AddNumberRoot changeNumber={num=>{
        setNumber(num)
      }} />
      <DisplayNumberRoot number={number} /> */}
      {/* Redux 사용 */}
      <AddNumber />
      <DisplayNumber />
    </div>
  );
}

export default App;
