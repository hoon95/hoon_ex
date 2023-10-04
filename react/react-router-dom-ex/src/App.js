import './App.css';
import { Routes, Route, Link, NavLink } from "react-router-dom";

function Home(){
  return(
    <div>
      <h2>Home</h2>
      <p>Home is...</p>
      <nav>
        <Link to="/">Home</Link>
        <Link to="/Contact">Contact</Link>
      </nav>
    </div>
  )
}
function Topics(){
  return(
    <div>
      <h2>Topics</h2>
      <p>Topic is...</p>
      <nav>
        <ul className="main-menu">
          <li><NavLink to="/topics/1">HTML</NavLink></li>
          <li><NavLink to="/topics/2">CSS</NavLink></li>
          <li><NavLink to="/topics/3">JavaScript</NavLink></li>
        </ul>
      </nav>
      <Routes>
        <Route path="1" element={<Topic />}/>
        <Route path="2" element={<Topic />}/>
        <Route path="3" element={<Topic />}/>
      </Routes>
    </div>
  )
}
let contents = [
  {id:1, title:'HTML', description:'HTML is..'},
  {id:2, title:'JS', description:'JS is..'},
  {id:3, title:'React', description:'React is..'} 
]
function Topic(){
  let list = [];
  return(
    <div>
      <h3>Topic</h3>
      <p>Topic is...?</p>
      <nav>
        <ul className='main-menu'>
          {/* <li><NavLink to="/topics/1">HTML</NavLink></li> */}
          {list}
        </ul>
      </nav>
    </div>
  )
}
function Contact(){
  return(
    <div>
      <h2>Contact</h2>
      <p>Contact is...</p>
      <nav>
        <Link to="/">Home</Link>
        <Link to="/topics">Topics</Link>
      </nav>
    </div>
  )
}

function App() {
  return (
    <div className="App">
      <h1>React Ruter Dom</h1>
      <nav>
        <ul className='main-menu'>
          <li><NavLink to="/">Home</NavLink></li>
          <li><NavLink to="/topics">Topics</NavLink></li>
          <li><NavLink to="/contact">Contact</NavLink></li>
        </ul>
      </nav>
      <Routes>
        <Route path="/" element={<Home />}/>
        <Route path="/topics" element={<Topics />}/>
        <Route path="/contact" element={<Contact />}/>
      </Routes>
    </div>
  );
}

export default App;
