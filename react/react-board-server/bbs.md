1. **모듈 및 패키지 임포트**
- `cors`: Cross-Origin Resource Sharing을 활성화하기 위한 미들웨어
- `express`: 웹 애플리케이션을 위한 Node.js 프레임워크
- `mysql`: MySQL 데이터베이스와 상호작용을 위한 모듈

```jsx
const cors = require('cors');
const express = require('express');
const app = express();
const port = process.env.port || 8000;
const mysql = require('mysql');
```

1. **Express 앱 설정**
- JSON 및 URL-encoded 형식의 데이터 파싱을 위한 미들웨어 설정
- CORS를 활성화하여 서버가 다른 도메인에서 오는 요청을 수락하도록 함

```jsx
app.use(express.json());
app.use(express.urlencoded({ extended: false }));

let corsOptions = {
  origin: '*',
  credentials: true
};
app.use(cors(corsOptions));
```

1. **MySQL 연결 설정**

```jsx
const db = mysql.createConnection({
  host: 'localhost',
  user: 'react_bbs',
  password: '12345',
  database: 'react_bbs'
});

db.connect();
```

1. **라우팅 및 데이터베이스 쿼리**
- 루트 엔드포인트(`/`)에 대한 GET 요청을 처리하고, 데이터베이스에 새로운 레코드를 삽입
- `/list` 엔드포인트에 대한 GET 요청을 처리하고, `board` 테이블에서 데이터를 가져옴
- `/insert` 엔드포인트에 대한 POST 요청을 처리하고, 클라이언트에서 전달된 데이터를 `board` 테이블에 삽입

```jsx
app.get('/', (req, res) => {
  const sqlQuery = "INSERT INTO requested (rowno) values (1)";
  db.query(sqlQuery, function (err, result) {
    if (err) throw err;
    res.send('success');
  });
});

app.get('/list', (req, res) => {
  const sqlQuery = "SELECT BOARD_ID, BOARD_TITLE, REGISTER_ID, DATE_FORMAT(REGISTER_DATE, '%Y-%m-%d') AS REGISTER_DATE FROM board";
  db.query(sqlQuery, function (err, result) {
    if (err) throw err;
    res.send(result);
  });
});

app.post('/insert', (req, res) => {
  const { title, content } = req.body;
  const sqlQuery = "INSERT INTO board (BOARD_TITLE, BOARD_CONTENT, REGISTER_ID) values (?, ?,'admin')";
  db.query(sqlQuery, [title, content], function (err, result) {
    if (err) throw err;
    res.send(result);
  });
});

```

1. **서버 시작:**
- Express 애플리케이션을 지정된 포트에서 시작

```jsx
app.listen(port, () => {
  console.log(`Example app listening on port ${port}`)
})

```

### db.query

```jsx
db.query(sqlQuery, values, callback);
```

- `sqlQuery`: 실행할 SQL 쿼리 문자열
- `values`: SQL 쿼리의 placeholder에 들어갈 값들을 배열로 나타낸다. 이 값들은 `?`에 순서대로 대체됨
→ SQL Injection 방어에 효과적
- `callback`: 쿼리가 실행된 후 호출될 콜백 함수. 이 콜백 함수는 에러(`err`)와 쿼리 결과(`result`)를 처리하는데 사용됨

```jsx
const sqlQuery = "INSERT INTO board (BOARD_TITLE, BOARD_CONTENT, REGISTER_ID) VALUES (?, ?, 'admin')";
db.query(sqlQuery, [title, content], function(err, result) {
  if (err) throw err;
  res.send(result);
});
```

### req.body

클라이언트가 POST 요청을 통해 서버로 보낸 데이터를 담고있는 객체
→ HTML 폼을 통해 전송된 데이터나 JSON 형태의 데이터를 포함
→ 데이터 형식에 따라 JSON일 수도, URL-encoded일 수도 있음
→ 미들웨어인 `express.json()` 및 `express.urlencoded()`를 사용
→ 이 두 미들웨어는 요청이 들어올 때 HTTP POST 요청의 본문을 파싱하여 `req.body` 객체에 담아준다

```jsx
// Express 애플리케이션에서 JSON 파싱을 위한 미들웨어 등록
const express = require('express');
const app = express();

app.use(express.json());
app.use(express.urlencoded({extended: false}));

let corsOptions = {
  origin: '*',
  credentials:true //사용자 인증에 필요한 리소스 허용
}
app.use(cors(corsOptions));

// POST 요청 처리
app.post('/example', (req, res) => {
  // req.body에는 클라이언트가 전송한 JSON 데이터가 들어있다.
  const jsonData = req.body;

  // 여기에서 jsonData를 이용한 다양한 작업 수행
});
```

클라이언트가 POST 요청을 통해 서버로 보낸 데이터를 담고 있는 객체이며, 데이터의 형식에 따라 JSON 형태일 수도 있고, URL-encoded 형태일 수도 있음