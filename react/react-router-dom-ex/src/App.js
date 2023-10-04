import './App.css';
import { Routes, Route, Link, NavLink, useParams } from "react-router-dom";

let contents = [
  {id:1, title:'HTML', desc:'HTML is..'},
  {id:2, title:'JS', desc:'JS is..'},
  {id:3, title:'React', desc:'React is..'} 
]

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
  let list = [];
  list = contents.map(content=>{
    return <li key={content.id}><NavLink to={"/topics/"+content.id}>{content.title}</NavLink></li>
  })
  return(
    <div>
      <h2>Topics</h2>
      <p>Topic is...</p>
      <nav>
        <ul className="main-menu">
          {list}
          {/* <li><NavLink to="/topics/1">HTML</NavLink></li> */}
        </ul>
      </nav>
      <Routes>
        <Route path=":topic_id" element={<Topic />}/>
      </Routes>
    </div>
  )
}

function Topic(){
  let params = useParams();
  let topic_id = params.topic_id;
  let selected_topic = {
    title: 'Title is none',
    desc: '404 Not Found'
  }

  // for문 활용
  // for(let i=0; i<contents.length; i++){
  //   if(contents[i].id === Number(params.topic_id)){
  //     selected_topic = contents[i];
  //     break;
  //   }
  // }

  // find 활용
  // function getContent(topic_id){
  //   return contents.find(content=>    // return 값이 하나인 경우 괄호 및 return 생략
  //     content.id === Number(topic_id)
  //   )
  // }

  selected_topic = contents.find(content=>
    content.id === Number(topic_id)
  )


  return(
    <div>
      <h3>{selected_topic.title}</h3>
      <p>{selected_topic.desc}</p>
      <nav>
        <ul className='main-menu'>
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
        <Route path="/topics/*" element={<Topics />}/>
        <Route path="/contact" element={<Contact />}/>
      </Routes>
    </div>
  );
}

export default App;
