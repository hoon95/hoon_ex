import {useState} from 'react';
import AddNumber from './/AddNumber';

function AddNumberRoot(props){
    return(
      <div>
        <h2>Add Number Root</h2>
        <AddNumber changeNum={(num)=>{
          props.changeNumber(num);
        }} />
      </div>
    )
  }

export default AddNumberRoot;