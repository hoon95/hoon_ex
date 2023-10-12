import React, { useState, useEffect } from 'react';
import { db } from '../firebase';
import { collection, addDoc, doc, serverTimestamp, onSnapshot, query, orderBy } from "firebase/firestore";
import Post from '../components/Post';

const Home = (userObj) => {
  const [post, setPost] = useState('');
  const [posts, setPosts] = useState([]);


  const onChange = (e) => {
    // const val = e.target.value;    // ES2012
    const { target: { value } } = e;  // ES2016
    setPost(value);
  }
  const onSubmit = async (e) => {
    e.preventDefault();
    try {
      const docRef = await addDoc(collection(db, "posts"), {
        date: serverTimestamp(),
        post: post,
        uid: userObj.userObj
      });
      console.log("Document written with ID: ", docRef.id);
    }
    catch (error) {
      console.log(error);
    }

  }
  // 1. 데이터 한 번 가져오기
  // const getPosts = async () => {
  //   const querySnapshot = await getDocs(collection(db, "posts"));
  //   querySnapshot.forEach((doc) => {
  //     const postObj = {
  //       ...doc.data(),
  //       id: doc.id
  //     }
  //     // console.log(doc.id, " => ", doc.data());
  //     // console.log(postObj);
  //     setPosts((prev) => [postObj, ...prev]);
  //   });
  // }

  // const test = { title: 'title 1', content: 'content 1' };
  // const testcopy = { ...test, title: 'title 2' };
  // console.log(testcopy);

  useEffect(() => {
    // getPosts();
    // 2. 컬렉션의 여러 문서에 리슨(실시간 업데이트)
    const q = query(collection(db, "posts"), orderBy('date'));
    onSnapshot(q, (querySnapshot) => {

      const postArr = querySnapshot.docs.map((doc) => ({
        id: doc.id,
        ...doc.data()
      }));
      setPosts(postArr);
      console.log(postArr);
    });
  }, [])

  return (
    <div>
      <form onSubmit={onSubmit}>
        <input type='text' value={post} placeholder='제목을 입력하세요' onChange={onChange}></input>
        <input type='submit' value='작성완료'></input>
      </form>
      <ul>
        {
          posts.map(item =>
            // <li key={item.id}>{item.post}</li>
            <Post key={item.id} postObj={item}></Post>
          )
        }
      </ul>
    </div>
  )
}

export default Home;