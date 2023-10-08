<aside>
👀 Redux 작동 원리

</aside>

!https://ko.redux.js.org/assets/images/ReduxDataFlowDiagram-49fa8c3968371d9ef6f2a1486bd40a26.gif

1. Event : 이벤트가 발생한다
2. useDispatch : 액션(action)을 생성하고, 스토어(store)에 액션(action)을 디스패치(Dispatch)한다
3. Reducer : 상태(state)를 업데이트하는 함수들의 모음이다(store.js). 디스패치(Dispatch) 된 액션(action)이 리듀서(Reducer)에게 전달되어, 상태(state)와 액션(action)을 이용하여 새로운 상태(state)를 계산하고 반환한다(ex. counterSlice의 덧셈,뺄셈)
→ 상태(state)를 어떻게 업데이트 할 것인지 정의 → 유지보수에 용이
4. state : 반환 된 새로운 상태(state)가 스토어(store)에 업데이트 된다.
5. useSelector : 현재 스토어(store)의 상태 값(state) 중 필요한 부분을 불러온다
6. UI : 불러온 상태 값(state)이 사용되어 화면에 보여진다

- react props 전달방식과 비교