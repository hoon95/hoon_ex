// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAuth } from "firebase/auth";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
const firebaseConfig = {
  // apiKey: process.env.REACT_APP_APIKEY,
  // authDomain: process.env.REACT_APP_AUTHDOMAIN,
  // projectId: process.env.REACT_APP_PROJECTID,
  // storageBucket: process.env.REACT_APP_STORAGEBUCKET,
  // messagingSenderId: process.env.REACT_APP_MESSAGINGSENDERID,
  // appId: process.env.REACT_APP_APPID
  apiKey: "AIzaSyC2FHfN6K9HbG1IyyxHur2Vnh-wN2a7dh4",
  authDomain: "react-bbs-a53c8.firebaseapp.com",
  projectId: "react-bbs-a53c8",
  storageBucket: "react-bbs-a53c8.appspot.com",
  messagingSenderId: "625471420892",
  appId: "1:625471420892:web:22ac7066fe2cbd4e3eb719"
};

// Initialize Firebase
// export const firebase = initializeApp(firebaseConfig);
// Initialize Firebase
export const app = initializeApp(firebaseConfig);


// Initialize Firebase Authentication and get a reference to the service
export const authService = getAuth(app);