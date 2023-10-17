import { useState } from "react";

const WordSelect = ({wordSelected})=>{
  const [secretWord, setSecretWord] = useState('');
  
  const onSubmit = (e) =>{
      e.preventDefault();
      wordSelected(secretWord);
  }
  return(

    <form onSubmit={onSubmit}>
      <input type="text" onChange={e=>{
        setSecretWord(e.target.value);
      }} />
      <button>Set Word</button>
    </form>
  )
}
export default WordSelect;