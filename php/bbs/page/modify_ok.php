<?php
    require_once ($_SERVER['DOCUMENT_ROOT'].'/bbs/inc/db.php');

    var_dump($_POST);
    $pno = $_GET['idx'];
    $username = $_POST['name'];
    // $userpw = $_POST['pw'];
    $userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
    $title = $_POST['title'];
    $content = $_POST['content'];

    // echo($_POST['pw']); // 1234
    // echo($userpw);      // 1234$2y$10$o2i8sl...

    $sql = "UPDATE board SET name ='{$username}', pw = '{$userpw}', title = '{$title}', content = '{$content}' WHERE idx = '{$pno}'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert(' 수정이 완료되었습니다.');
        location.href='../index.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

?>  