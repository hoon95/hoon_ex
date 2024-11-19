<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/bbs/inc/db.php');

  if(isset($_POST['lock_post'])){
    $lock_post = 1;
  }else{
    $lock_post = 0;
  }

  $username = $_POST["name"];
  $userpw = password_hash($_POST["pw"], PASSWORD_DEFAULT);
  $title = $_POST["title"];
  $content = $_POST["content"];
  $date = date('Y-m-d');

  $sql = "INSERT INTO board (name, pw, title, content, date, lock_post) VALUES ('{$username }' ,'{$userpw }','{$title }','{$content }','{$date }','{$lock_post}')";

  if ($conn->query($sql) === TRUE) {
    echo "<script>
    alert('글쓰기 완료되었습니다.');
    location.href='../index.php';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>