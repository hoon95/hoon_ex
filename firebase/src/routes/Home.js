import React, { useState, useEffect } from 'react';
import { db } from '../firebase';
import { collection, addDoc, serverTimestamp, onSnapshot, query, orderBy } from "firebase/firestore";
import Post from '../components/Post';
import { getStorage, ref, uploadString, getDownloadURL } from 'firebase/storage';
import { v4 as uuidv4 } from 'uuid';

const Home = (userObj) => {
  const [post, setPost] = useState('');
  const [posts, setPosts] = useState([]);
  let attachmentUrl = '';

  // 첨부파일 관리
  const [attachment, setAttachment] = useState();

  const onChange = (e) => {
    // const val = e.target.value;    // ES2012
    const { target: { value } } = e;  // ES2016
    setPost(value);
  }
  const onSubmit = async (e) => {
    e.preventDefault();
    const storage = getStorage();
    const storageRef = ref(storage, `${userObj.userObj}/${uuidv4()}`);

    const makePost = async (url) => {
      try {
        await addDoc(collection(db, "posts"), {
          date: serverTimestamp(),
          post: post,
          uid: userObj.userObj,
          attachmentUrl: url
        });
        attachmentUrl = '';
      }
      catch (error) {
        console.log(error);
      }
    }
    if (attachment) {
      uploadString(storageRef, attachment, 'data_url')
        .then(async (snapshot) => {
          attachmentUrl = await getDownloadURL(storageRef);
          makePost(attachmentUrl);
        })
    } else {
      makePost(attachmentUrl);
    }
  }

  useEffect(() => {
    // getPosts();
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

  // 파일 첨부 시 할 일
  const onFileChange = (e) => {
    // console.log(e.target.files[0]);
    const { target: { files } } = e;
    const fileInfo = files[0];

    const reader = new FileReader();
    reader.onloadend = (e) => {
      setAttachment(e.target.result);
    }
    reader.readAsDataURL(fileInfo);
  }
  // console.log(attachment)

  // 첨부파일 지우기
  const onFileClear = () => {
    setAttachment(null);
    document.querySelector('#attachment').value = null;
  }

  return (
    <div>
      <form onSubmit={onSubmit}>
        <p>
          <label htmlFor="content"></label>
          <input type='text' id="content" name="post" value={post} placeholder='제목을 입력하세요' onChange={onChange}></input>
        </p>
        <p>
          <label htmlFor="attachment">첨부이미지</label>
          <input type="file" onChange={onFileChange} id="attachment" accept="images/*" />
          {attachment &&
            <div>
              <img src={attachment} alt="" width="200" height="200" />
              <button type="button" onClick={onFileClear}>X</button>
            </div>
          }
        </p>
        <input type='submit' value='작성완료'></input>
      </form>
      <ul>
        {
          posts.map(item =>
            // <li key={item.id}>{item.post}</li>
            <Post key={item.id} postObj={item} userConfirm={item.uid === userObj.userObj}></Post>
          )
        }
      </ul>
    </div>
  )
}

export default Home;