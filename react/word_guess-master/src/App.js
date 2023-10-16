import { useState } from 'react';
import './App.css';
import GameBoard from './GameBoard';
import WordSelect from './wordSelect';


function App() {  
  const [secretWord, setSecretWord] = useState('');
  const [isShown, setIsShwon] = useState(false);
  return (
    <div className="App">
      <h1>Welcome to Hangman!</h1>
      <p>Do you want to play game?</p>
      <div>
        {isShown ? (
          <GameBoard secretWord={secretWord} maxError={6} />        
          ) : (
              <WordSelect wordSelected={val => {
                setSecretWord(val);
                setIsShwon(true);
              }
              }/>
          )
        }       

      </div>
    </div> 
  );  
}

export default App;
