import React, { useState } from 'react';
import { getAuth, createUserWithEmailAndPassword, signInWithEmailAndPassword, signInWithPopup, GoogleAuthProvider } from "firebase/auth";

const Auth = () => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [newAccount, setNewAccount] = useState(true);
  const [error, setError] = useState('');
  const auth = getAuth();

  const onSubmit = (e) => {
    e.preventDefault();
    if (newAccount) {
      //Create Account 회원가입
      createUserWithEmailAndPassword(auth, email, password)
        .then((userCredential) => {
          // Signed in 
          const user = userCredential.user;
          console.log(user);
        })
        .catch((error) => {
          const errorCode = error.code;
          const errorMessage = error.message;
          console.log(errorCode, errorMessage);
          setError(errorMessage);
        });

    } else {
      //로그인
      signInWithEmailAndPassword(auth, email, password)
        .then((userCredential) => {
          // Signed in 
          const user = userCredential.user;
          console.log(user);
        })
        .catch((error) => {
          const errorCode = error.code;
          const errorMessage = error.message;
          console.log(errorCode, errorMessage);
        });

    }
  }

  const onChange = (e) => {
    // let name = e.target.value;
    const { target: { name, value } } = e;
    if (name === "email") {
      setEmail(value);
    } else {
      setPassword(value);
    }
  }
  const toggleAccount = () => setNewAccount((prev) => !prev);

  const onSocialClick = () => {
    const provider = new GoogleAuthProvider();
    signInWithPopup(auth, provider)
      .then((result) => {
        // This gives you a Google Access Token. You can use it to access the Google API.
        const credential = GoogleAuthProvider.credentialFromResult(result);
        const token = credential.accessToken;
        // The signed-in user info.
        const user = result.user;
        // IdP data available using getAdditionalUserInfo(result)
        console.log(token, user);

      }).catch((error) => {
        // Handle Errors here.
        const errorCode = error.code;
        const errorMessage = error.message;
        // The email of the user's account used.
        const email = error.customData.email;
        // The AuthCredential type that was used.
        const credential = GoogleAuthProvider.credentialFromError(error);

        console.log(errorCode, errorMessage, email, credential);

      });
  };

  return (
    <div>
      <form onSubmit={onSubmit}>
        <input name="email" type="email" placeholder='email' value={email} onChange={onChange} />
        <input name="password" type="password" placeholder='password' value={password} onChange={onChange} />
        <button type="submit">{newAccount ? "create Account" : "Login"}</button>
        <button type="button" onClick={onSocialClick}>{newAccount ? "Login" : "Create Account"}</button>
      </form>
      <hr />
      <button type="button" onClick={toggleAccount}>{newAccount ? "Google 회원가입" : "Google 로그인"}</button>
      {error}
    </div>
  )
}

export default Auth;