### **상태(State) 정의**

- `isModifyMode`: 게시물 수정 모드 여부
- `boardId`: 현재 선택된 게시물의 ID

```jsx
state = {
  isModifyMode: false,
  boardId: 0
}
```

### **`handleModify` 메소드**

- `handleModify` 메소드는 게시물 수정 버튼을 클릭할 때 호출됨
- 선택한 게시물의 개수에 따라 알림 메시지를 표시하고, `isModifyMode` 상태와 `boardId` 상태를 업데이트

```jsx
handleModify = (checkList) => {
  if (checkList.length === 0) {
    alert('수정할 게시물을 선택하세요');
  } else if (checkList.length > 1) {
    alert('하나의 게시물만 선택하세요');
  }

  this.setState({
    isModifyMode: checkList.length === 1,
    boardId: checkList.length[0] // 버그: checkList.length 대신 checkList[0]로 수정
  });
}

```

### 렌더링(render)

- `BoardList` 컴포넌트와 `Write` 컴포넌트를 렌더링
- `handleModify` 메소드를 `BoardList` 컴포넌트에 전달

```jsx
render() {
  return (
    <div className="container">
      <BoardList handleModify={this.handleModify} />
      <Write />
    </div>
  )
}

```


### `BoardList.js`

게시물 목록을 가져오는 Axios 요청과 게시물 목록 렌더링 구현

- 게시물 목록을 서버에서 가져와 테이블로 표시하며, 각 게시물의 체크박스를 통해 선택 상태를 추적

### `Board` 컴포넌트

각각의 게시물을 표시하기 위한 하위 컴포넌트

- `input` 요소를 사용하여 체크박스를 만들고, 해당 체크박스의 값(`this.props.id`)이 변경될 때 `onCheckboxChange` 함수를 호출

```jsx
class Board extends Component {
  render() {
    return (
      <tr>
        <td>
          <input
            type="checkbox"
            value={this.props.id}
            onChange={this.props.onCheckboxChange}
          />
        </td>
        <td>{this.props.id}</td>
        <td>{this.props.title}</td>
        <td>{this.props.REGISTER_ID}</td>
        <td>{this.props.REGISTER_DATE}</td>
      </tr>
    );
  }
}
```

### `BoardList` 컴포넌트

게시물 목록을 가져오고 보여주는 역할

- `componentDidMount` 함수에서 Axios를 사용하여 서버에서 게시물 목록을 가져와 `boardList` 상태를 업데이트
- 각 게시물을 `Board` 컴포넌트로 매핑하여 출력
- 체크박스의 선택 여부를 추적하기 위해 `checkList` 상태를 사용하고, 해당 상태를 `onCheckboxChange` 함수를 통해 업데이트

```jsx
class BoardList extends Component {
  state = {
    boardList: [],
    checkList: [],
  };

  getList = () => {
    Axios.get('<http://localhost:8000/list>')
      .then((result) => {
        const { data } = result;
        this.setState({
          boardList: data,
        });
        console.log(result);
      })
      .catch((error) => {
        // 에러 핸들링
        console.log(error);
      });
  };

  componentDidMount() {
    this.getList();
  }

  onCheckboxChange = (e) => {
    const list = this.state.checkList;
    list.push(e.target.value);
    this.setState({
      checkList: list,
    });
  };

  render() {
    console.log(this.state.checkList);
    return (
      <>
        <Table striped bordered hover>
          {/* 테이블 헤더 */}
          {/* ... */}
          <tbody>
            {/* 게시물 목록을 Board 컴포넌트로 매핑하여 출력 */}
            {this.state.boardList.map((item) => {
              return (
                <Board
                  key={item.BOARD_ID}
                  id={item.BOARD_ID}
                  title={item.BOARD_TITLE}
                  REGISTER_ID={item.REGISTER_ID}
                  REGISTER_DATE={item.REGISTER_DATE}
                  onCheckboxChange={this.onCheckboxChange}
                />
              );
            })}
          </tbody>
        </Table>
        {/* 버튼 영역 */}
        <div className='d-flex gap-3'>
          <Button variant="info">글쓰기</Button>
          <Button
            variant="secondary"
            onClick={() => {
              this.props.handleModify(this.state.checkList);
            }}
          
            수정
          </Button>
          <Button variant="danger">삭제</Button>
        </div>
      </>
    );
  }
}

export default BoardList;
```


### `Write.js`

### 상태(State) 정의

- `isModifyMode`: 글 작성 모드와 글 수정 모드를 구분하기 위한 상태
- `title`: 글 제목을 저장하는 상태
- `content`: 글 내용을 저장하는 상태

```jsx
state = {
  isModifyMode: false,
  title: '',
  content: ''
}
```

### `write` 메소드

- 글을 작성하는 메소드로, Axios를 사용하여 서버에 POST 요청
- 서버에 `title`과 `content`를 전송

```jsx
write = () => {
  Axios.post('<http://localhost:8000/insert>', {
    title: this.state.title,
    content: this.state.content
  })
  .then((result) => {
    console.log(result);
  })
  .catch((error) => {
    console.log(error);
  });
}
```

### `update` 메소드

- 글을 수정하는 메소드로, Axios를 사용하여 서버에 POST 요청
- 서버에 `title`, `content`, 그리고 현재 선택된 게시물의 `id`를 전송

```jsx
update = () => {
  Axios.post('<http://localhost:8000/update>', {
    title: this.state.title,
    content: this.state.content,
    id: this.props.boardId // props로 전달받은 boardId를 사용
  })
  .then((result) => {
    console.log(result);
  })
  .catch((error) => {
    console.log(error);
  });
}
```

### `handleChange` 메소드

- 입력 폼 값이 변경될 때 호출되는 메소드로, 해당 입력 필드의 이름에 따라 상태를 업데이트

```jsx
handleChange = (e) => {
  this.setState({
    [e.target.name]: e.target.value
  });
}
```

### 렌더링

- 글 제목과 내용을 입력받는 Form 컴포넌트를 렌더링
- `isModifyMode`에 따라 버튼의 동작이 다르게 설정됨

```jsx
<Button variant="info" onClick={this.state.isModifyMode ? this.update : this.write}>작성완료</Button>
<Button variant="secondary">취소</Button>
```