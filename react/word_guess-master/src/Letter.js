const Letter = ({value,isShown})=>{
  let output = '';
  if(isShown){
    output = value;
  }
  return(
    <span>{output}</span>
  )
}
export default Letter;