<aside>
👀 비동기 처리 : 특정 코드가 종료되지 않았더라도 다음 코드를 실행(기본 특성)

</aside>

필요 이유 : 서버에 데이터를 요청했을 때 이전 응답이 종료되는 것을 마냥 기다릴 수 없음

필요하지 않은 경우 : 실행 순서가 중요한 경우에는 주로 콜백함수의 중첩을 통해 순차적으로 실행한다(ex. setTimeout)

<aside>
🔥 콜백지옥(Callback Hell) : 중첩이 증가할 수록 코드가 복잡해진다

</aside>

[콜백 지옥을 해결하는 방법](https://ryurim.tistory.com/137)

해결 방법 : Promise를 사용하자!

<aside>
💡 Promise : 비동기 연산이 종료된 후 결과를 알기 위한 객체(ES6+)

</aside>

Promise는 3가지의 상태 값을 가진다

- Pending(대기) : 완료도 실패도 아닌 초기상태
- Fulfilled(이행) : 작업 완료
- Rejected(거부) : 작업 실패

```jsx
const myPromise = new Promise((resolve, reject) => {
  // 비동기 작업 수행
  const success = true;

  if (success) {
    resolve("Success!"); // 작업이 성공하면 이행(resolve)
  } else {
    reject("Error!"); // 작업이 실패하면 거부(reject)
  }
});

myPromise
  .then((result) => {
    console.log(result); // 성공했을 때의 처리
  })
  .catch((error) => {
    console.error(error); // 실패했을 때의 처리
  });
```