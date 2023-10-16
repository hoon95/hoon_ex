import LetterGrid from "./LetterGrid";
import ButtonGrid from "./ButtonGrid";
import { useState } from "react";

const GameBoard = ({secretWord, maxError})=>{
  const [guessedLetters, setGuessedLetters] = useState([]);
  const [errorCount, setErrorCount] = useState(0);

  const letterGuessedHandler = (letter)=>{
    let val = letter.toLowerCase();
    setGuessedLetters(prev=> [...prev,val]);

    /* 만약 secretWord에 val가 없다면  errorCount를 1더한다. */
    if(secretWord.toLowerCase().indexOf(val) === -1){
      setErrorCount(errorCount+1);
    }
  }



  return(
    <div>
      <p>남은 횟수: {maxError - errorCount}</p>
      <LetterGrid secretWord={secretWord} guessedLetters={guessedLetters}/>
      <ButtonGrid letterGuessed={letterGuessedHandler} isShown={errorCount<maxError}/>
    </div>
  )
  //props.secretWord

}

export default GameBoard