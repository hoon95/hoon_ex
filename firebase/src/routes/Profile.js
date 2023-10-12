import React from 'react';
import { getAuth, signOut } from 'firebase/auth';
import { useNavigate } from 'react-router-dom';

const Profile = () => {
  const navigate = useNavigate();
  const auth = getAuth();
  const onLogoutClick = () => {
    signOut(auth).then(() => {
      navigate("/");
    }).catch((error) => {
      // An error happened.
    });
  }
  return (
    <>
      <button onClick={onLogoutClick}>LOG OUT</button>
    </>
  )
}

export default Profile;