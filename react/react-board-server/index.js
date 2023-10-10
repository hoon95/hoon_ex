const cors = require('cors');
const express = require('express');
const app = express();
const port = process.env.port || 8000;
const mysql = require('mysql');

app.use(express.json()); //json은 말 그대로 JSON 형태의 데이터 전달을 의미하고, 
app.use(express.urlencoded({ extended: false }));

let corsOptions = {
  origin: '*',
  credentials: true //사용자 인증에 필요한 리소스 허용
}
app.use(cors(corsOptions));


const db = mysql.createConnection({
  host: 'localhost',
  user: 'react_bbs',
  password: '12345',
  database: 'react_bbs'
});

db.connect();

app.get('/', (req, res) => {
  //res.send('Hello World!');
  const sqlQuery = "INSERT INTO requested (rowno) values (1)";
  db.query(sqlQuery, function (err, result) {
    if (err) throw err;
    res.send('success');
  });
});
app.get('/list', (req, res) => {
  //res.send('Hello World!');
  const sqlQuery = "SELECT BOARD_ID, BOARD_TITLE, REGISTER_ID, DATE_FORMAT(REGISTER_DATE, '%Y-%m-%d') AS REGISTER_DATE  FROM board";
  db.query(sqlQuery, function (err, result) {
    if (err) throw err;
    res.send(result);
  });
});
app.get('/detail', (req, res) => {
  const id = req.query.id;
  const sqlQuery = "SELECT BOARD_ID, BOARD_TITLE, BOARD_CONTENT, REGISTER_ID, DATE_FORMAT(REGISTER_DATE, '%Y-%m-%d') AS REGISTER_DATE  FROM board WHERE BOARD_ID=?";
  db.query(sqlQuery, [id], function (err, result) {
    if (err) throw err;
    res.send(result);
    console.log(result);
  });
})


app.post('/insert', (req, res) => {
  // const title = req.body.title;
  // const content = req.body.content;
  const { title, content } = req.body;
  console.log(title, content);

  const sqlQuery = "INSERT INTO board (BOARD_TITLE, BOARD_CONTENT, REGISTER_ID) values (?, ?,'admin')";

  db.query(sqlQuery, [title, content], (err, result) => {
    if (err) throw err;
    res.send(result);
  });
});

app.listen(port, () => {
  console.log(`Example app listening on port ${port}`)
})

// app.post('/update', (req, res) => {
//   const { title, content, id } = req.body;

//   const sqlQuery = `UPDATE board SET BOARD_TITLE=?, BOARD_CONTENT=? WHERE BOARD_ID=${id}`;

//   db.query(sqlQuery, [title, content], (err, result) => {
//     if (err) throw err;
//     res.send(result);
//   });
// });

// db.end();