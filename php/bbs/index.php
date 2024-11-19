<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/bbs/inc/db.php');
    /*
    echo strlen('가나다'); // 바이트 기준
    echo mb_strlen('가나다'); //문자셋 기준
    echo iconv_strlen('가나다');

    $txt = 'php web 개발';
    $txt2 = str_replace('web','app',$txt);
    echo $txt2;

     $txt3 = substr('abcdef',3,2);
     echo $txt3;

     $txt4 = iconv_substr('가나다라마바사',0,5,'utf-8');
     echo $txt4;
     */
    
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판</title>
    <link rel="stylesheet" href="css/bbs_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <h1>자유게시판</h1>
        <table>
            <colgroup>
                <col class="col1">
                <col class="col2">
                <col class="col3">
                <col class="col3">
                <col class="col4">
                <col class="col4">
            </colgroup>
            <thead>
                <tr>
                    <th>번호</th>
                    <th>제목</th>
                    <th>글쓴이</th>
                    <th>작성일</th>
                    <th>조회수</th>
                    <th>추천수</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM board ORDER BY idx DESC LIMIT 0, 10";
                    $result = $conn->query($sql);

                    while($row = $result->fetch_array(MYSQLI_ASSOC)){
                        $title = $row['title'];

                        // 댓글 수 확인하기
                        $con_idx = $row['idx'];
                        $rc_sql = "SELECT COUNT(*) AS cnt FROM reply WHERE con_num = $con_idx";
                        $rc_result = $conn->query($rc_sql);

                        $rc_row = $rc_result->fetch_array(MYSQLI_ASSOC);

                        if($rc_row['cnt'] > 0){
                            $rc = "[".$rc_row['cnt']."]";
                        }else{
                            $rc = '';
                        }

                        if(iconv_strlen($title) > 10){
                            $title = str_replace($title,iconv_substr($title,0,10, 'utf-8')."...",$title);
                        }
                ?>
                <tr>
                    <td><?= $row['idx']; ?></td>
                    <td>
                        <?php if($row['lock_post'] == '1'){ ?>
                            <a href="page/lock_read.php?idx=<?= $row['idx']; ?>"><?= $title.$rc; ?><i class="fa-solid fa-lock"></i></a>
                        <?php } else { ?>
                            <a href="page/read.php?idx=<?= $row['idx']; ?>"><?= $title.$rc; ?></a>    
                        <?php } ?>
                    </td>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['date']; ?></td>
                    <td><?= $row['hit']; ?></td>
                    <td><?= $row['thumbsup']; ?></td>
                </tr>
                <?php
                    };
                ?>
            </tbody>
        </table>
        <div class="btns">
            <a href="page/write.php">글쓰기</a>
        </div>

        <button id="submit">예매뚫기</button>
        <script>
            document.querySelector("#submit").disabled = 'true';
        </script>
    </div>
</body>
</html>