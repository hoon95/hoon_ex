<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/bbs/inc/db.php');
    $pno = $_GET['idx'];
    
    $sql = "SELECT thumbsup FROM board WHERE idx='{$pno}';";
    $result = $conn->query($sql);
    $sqlarr = $result -> fetch_assoc();
    $thumbsup = $sqlarr['thumbsup'] + 1;      // 추천수 증가시키기
    
    $sql2 = "UPDATE board SET thumbsup='{$thumbsup}' WHERE idx='{$pno}';";
    $result2 = $conn -> query($sql2);

    if ($result2 === TRUE) {
        echo "<script>
        alert(' 추천이 완료되었습니다.');
        location.href='../index.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>