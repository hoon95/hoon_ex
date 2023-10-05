import React, {Component} from 'react';
import './App.css';

class Nav extends Component{
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
  render(){
    console.log('Nav 컴포넌트 실행');
    let listHTML = this.state.list.map(list=>{
      return(
        <li key={list.id}>
          <a href={list.id} data-id={list.id} onClick={e=>{
            e.preventDefault();
            this.props.onclick(e.target.dataset.id)
          }}>{list.title}</a>
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
        <h2>{this.props.title}</h2>
        <p>{this.props.desc}</p>
      </article>
    )
  }
}

class App extends Component{
  state = {
    article: {
      title: 'welcome',
      desc: 'Hello, React & Ajax'
    }
  }
  render(){
    return (
      <div className="App">
        <h1>Web</h1>
        <Nav onclick={id=>{
          console.log(id)
          fetch(`./data/${id}.json`)
          .then(result=>{
            return result.json();
          })
          .then(data=>{
            this.setState({
              article: {
                title: data.title,
                desc: data.desc
              }
            })
          })
        }}/>
        <Article
          title={this.state.article.title}
          desc={this.state.article.desc}
        />
      </div>
    );
  }
}

export default App;