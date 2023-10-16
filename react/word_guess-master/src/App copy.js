
import './App.css';

const name = "test";
const user = {
  firstName :'홍',
  lastName :'길동'
}
const hello = (user) =>{
  return `반갑습니다 ${user.firstName}${user.lastName}님`;
}
const islogin = true;

const langs = ['html','css','javascript'];

function App() {  
  return (
    <div className="App">
     <h1>Hangman</h1>
    <p>{name}</p>
    <p>{hello(user)}</p>
    {islogin ? <span>로그인 완료</span> : <span>로그인 해주세요</span>}
    <ul>
      {langs.map((lang) => <li>{lang}</li>)}
    </ul>
    </div>
  );
}

export default App;
