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