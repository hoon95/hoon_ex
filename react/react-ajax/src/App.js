import React, {Component, useState, useEffect} from 'react';
import './App.css';

class Nav extends Component{
  render(){
    let listHTML = this.props.list.map(list=>{
      return(
        <li key={list.id}>
          <a href={list.id} data-id={list.id} onClick={e=>{
            e.preventDefault();
            this.props.onclick(e.target.dataset.id)
          }}>{list.name}</a>
        </li>
      )
    });
    return(
      <nav>
        <ul>
          {listHTML}
        </ul>
      </nav>
    )
  }
}

function Article(props){
    return(
      <article>
        <h2>{props.name}</h2>
        <p>{props.email}</p>
      </article>
    )
}

function App(){
  const [article, setArticle] = useState({
    name: 'Select Your Name',
    email: 'email'
  });
  const [list, setList] = useState([]);

  useEffect(()=>{
    fetch('https://jsonplaceholder.typicode.com/users')
      .then(result=>{
        return result.json();
      })
      .then(data=>{
        setList(data)
      })
  }, [])

  return (
    <div className="App">
      <h1>Web</h1>
      <Nav list={list} onclick={id=>{
        fetch(`https://jsonplaceholder.typicode.com/users/${id}`)
        .then(result=>{
          return result.json();
        })
        .then(data=>{
          setArticle({
            name: data.name,
            email: data.email
          })
        })
      }}/>
      <Article
        name={article.name}
        email={article.email}
      />
    </div>
  );
}

// class App extends Component{
//   state = {
//     article: {
//       name: 'Select Your Name',
//       email: 'This is email'
//     },
//     list: []
//   }

//   componentDidMount(){
//     fetch('https://jsonplaceholder.typicode.com/users')
//       .then(result=>{
//         return result.json();
//       })
//       .then(data=>{
//         this.setState({
//           list: data
//         })
//       })
//   }

//   render(){
//     return (
//       <div className="App">
//         <h1>Web</h1>
//         <Nav list={this.state.list} onclick={id=>{
//           fetch(`https://jsonplaceholder.typicode.com/users/${id}`)
//           .then(result=>{
//             return result.json();
//           })
//           .then(data=>{
//             this.setState({
//               article: {
//                 name: data.name,
//                 email: data.email
//               }
//             })
//           })
//         }}/>
//         <Article
//           name={this.state.article.name}
//           email={this.state.article.email}
//         />
//       </div>
//     );
//   }
// }

export default App;