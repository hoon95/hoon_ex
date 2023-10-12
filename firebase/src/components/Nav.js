import React from "react";
import { Link } from 'react-router-dom';

// ES6+ 표현방식 변천과정
/*
function Nav(){
  return(
    <nav>Navigation</nav>                                                                                                                                                                                                                                                                                               
  )
}

const Nav = () => {
  return(
    <nav>Navigation</nav>
  )
}
*/
const Nav = () => (
  <nav>
    <ul>
      <li><Link to="/">Home</Link></li>
      <li><Link to="/profile">Profile</Link></li>
    </ul>
  </nav>
)

export default Nav;