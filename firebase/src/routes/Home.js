import React, { useState } from 'react';
import { db } from '../firebase';
import { collection, addDoc, serverTimestamp } from "firebase/firestore";

const Home = () => {
  const [post, setPost] = useState('');
  const onChange = (e) => {
    // const val = e.target.value;    // ES2012
    const { target: { value } } = e;  // ES2016
    setPost(value);
  }
  const onSubmit = async (e) => {
    e.preventDefault();
    // Add a new document with a generated id.
    const docRef = await addDoc(collection(db, "posts"), {
      date: serverTimestamp(),
      post: post
    });
    console.log("Document written with ID: ", docRef.id);

  }
  console.log(post);
  return (
    <div>
      <form onSubmit={onSubmit}>
        <input type='text' value={post} placeholder='제목을 입력하세요' onChange={onChange}></input>
        <input type='submit' value='작성완료'></input>
      </form>
    </div>
  )
}

export default Home;