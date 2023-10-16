//맵 기본 문법
let arr =['a','b','c'];

let list = arr.map(function(item,idx,all){
  let title = item+'항목';
  return `<li>${title}</li>`;
});

let list2 = arr.map((item)=>{
  return `<li>${item}</li>`;
});

let list3 = arr.map((item)=> `<li>${item}</li>`);


let list4 = arr.map(item=> `<li>${item}</li>`);


console.log(list);


let arr1 = [1,2];
arr1.push(3);

let arr1es6 = [...arr1, 3];

let arr2 = [4,5];

let arrnew = [arr1[0],arr1[1],arr2[0],arr2[1]];

let arrnewEs6 = [...arr1, ...arr2];

let arrnew1 = arr1.concat(arr2);

let arrnew2 = [].concat(arr1,arr2);
