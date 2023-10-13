import React, { useState } from "react";
import { db } from "../firebase";
import { doc, updateDoc, deleteDoc } from "firebase/firestore";
import { getStorage, ref, deleteObject } from "firebase/storage";

const Post = ({ postObj, userConfirm }) => {
  const [edit, setEdit] = useState(false);
  const [newPost, setNewPost] = useState(postObj.post);

  // edit 버튼 클릭 시 write mode, 취소 버튼 클릭 시 Read mode
  const toggleEditMode = () => setEdit((prev) => !prev);

  // 변경 된 value값을 change이벤트를 통해 업데이트
  const onChange = (e) => {
    // setNewPost(e.target.value);
    const { target: { value } } = e;
    setNewPost(value);
  }

  const onSubmit = async (e) => {
    e.preventDefault();
    await updateDoc(doc(db, "posts", postObj.id), {
      post: newPost
    });
    setEdit(false);
  }

  const deletePost = async () => {
    if (window.confirm('정말 삭제하시겠습니까?')) {
      await deleteDoc(doc(db, "posts", postObj.id));
      const storage = getStorage();
      const storageRef = ref(storage, postObj.attachURL);
      deleteObject(storageRef);
    }
  }

  return (
    <li>
      {edit ? (
        <>
          <form onSubmit={onSubmit}>
            <input value={newPost} onChange={onChange} required></input>
            <button>Update</button>
          </form>
          <button onClick={toggleEditMode}>cancel</button>
        </>
      )
        : (
          <>
            <h4>{postObj.post}</h4>
            {postObj.attachmentUrl && <img src={postObj.attachmentUrl} alt="" width="200"></img>}
            {
              userConfirm && (
                <>
                  <button onClick={toggleEditMode}>Edit</button>
                  <button onClick={deletePost}>Delete</button>
                </>
              )
            }
          </>
        )
      }
    </li>
  )
}
export default Post;