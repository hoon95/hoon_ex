import React, {Component} from 'react';
import './App.css';

class Nav extends Component{
  /*
  state = {
    list: []
  }
  componentDidMount(){
    console.log('componentDidMount 실행')
    fetch('./data/list.json')
      .then(result=>{
        console.log(result);
        return result.json();
      })
      .then(data=>{
        console.log(data);
        this.setState({
          list: data
        })
      })
  }
  */
  render(){
    console.log('Nav 컴포넌트 실행');
    // let listHTML = this.state.list.map(list=>{
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

class Article extends Component{
  render(){
    return(
      <article>
        <h2>{this.props.name}</h2>
        <p>{this.props.email}</p>
      </article>
    )
  }
}

class App extends Component{
  state = {
    article: {
      name: 'Select Your Name',
      email: 'This is email'
    },
    list: []
  }

  componentDidMount(){
    fetch('https://jsonplaceholder.typicode.com/users')
      .then(result=>{
        return result.json();
      })
      .then(data=>{
        this.setState({
          list: data
        })
      })
  }

  render(){
    return (
      <div className="App">
        <h1>Web</h1>
        <Nav list={this.state.list} onclick={id=>{
          fetch(`https://jsonplaceholder.typicode.com/users/${id}`)
          .then(result=>{
            return result.json();
          })
          .then(data=>{
            this.setState({
              article: {
                name: data.name,
                email: data.email
              }
            })
          })
        }}/>
        <Article
          name={this.state.article.name}
          email={this.state.article.email}
        />
      </div>
    );
  }
}

export default App;