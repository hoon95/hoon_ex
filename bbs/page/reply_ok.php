<?php
   require_once ($_SERVER['DOCUMENT_ROOT'].'/bbs/inc/db.php');
    
   $num = $_GET['idx'];
   $username = $_POST['name'];
   $userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);

   $content = $_POST['content'];
   $date = date('Y-m-d');

    // echo($_POST['pw']); // 1234
    // echo($userpw);      // 1234$2y$10$o2i8sl...

    $sql = "INSERT INTO reply
    (con_num, name, password, content, date) VALUES ('${num}', '{$username}', '{$userpw}', '{$content}', '{$date}')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('글쓰기 완료되었습니다.');
        location.href='../index.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

?>  