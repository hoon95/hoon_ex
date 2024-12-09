// const fetch = require('node-fetch');
import fetch from 'node-fetch';
import axios from 'axios';

async function nodeFetch() {
    try {
        const response = await fetch('https://jsonplaceholder.typicode.com/posts/1');
        const data = await response.json();
        console.log(data);
    } catch (err) {
        console.log(err);
    }
}

async function axiosFetch() {
    try {
        const response = await axios.get('https://jsonplaceholder.typicode.com/posts/1');
        console.log(response.data);
    } catch (err) {
        console.log(err);
    }
}

async function axiosGetUserPost() {
    const userId = 1;
    const postUrl = `https://jsonplaceholder.typicode.com/posts?userId=${userId}`;
    const response = await axios.get(postUrl);
    
    console.log(response.data);
}

async function getPostComments(postId) {
    const commentUrl = `https://jsonplaceholder.typicode.com/posts/${postId}/comments`;
    const response =  await axios.get(commentUrl);
    console.log(response.data);
}

import dotenv from 'dotenv'
dotenv.config();
async function weather() {
    const key = process.env.API_KEY;
    const url = `https://api.openweathermap.org/data/2.5/weather?q=Seoul&units=metric&lang=kr&appid=${key}`
    const response = await axios.get(url);
    console.log(response.data);
}

async function github() {
    const id = 'hoon95';
    const url = `https://api.github.com/users/${id}/repos`;
    
    try {
        const response = await axios.get(url, {
            headers: {
                Authorization: `token ${process.env.GITHUB_TOKEN}` // 'token' 키워드 필요
            }
        });

        const oneMonthAgo = new Date();
        oneMonthAgo.setMonth(oneMonthAgo.getMonth() - 1);

        response.data.forEach((item) => {
            const updatedDate = new Date(item.updated_at); // updated_at을 Date 객체로 변환

            if (updatedDate >= oneMonthAgo) {
                console.log(`Repository: ${item.name}, Last Updated: ${item.updated_at}`);
            }
        });
    } catch (error) {
        console.error('Error fetching data from GitHub API:', error.message);
    }
}

(async() => {
    // await nodeFetch();
    // await axiosFetch();
    // await axiosGetUserPost();
    // getPostComments(1);
    // weather();
    github();
})();
