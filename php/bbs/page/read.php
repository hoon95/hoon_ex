<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/bbs/inc/db.php');
    $pno = $_GET['idx'];
    
    $sql = "SELECT * FROM board WHERE idx='{$pno}';";
    $result = $conn->query($sql);
    $sqlarr = $result -> fetch_assoc();
    $hit = $sqlarr['hit'] + 1;      // 조회수 증가시키기
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글읽기 - BBS</title>
    <link rel="stylesheet" href="../css/bbs_style.css">
</head>
<body>
    <div class="container">
        <h1>자유게시판</h1>
        <h2>글읽기</h2>
        <div class="write_form">
            <table>
                <colgroup>
                    <col class="label">
                    <col class="content">
                </colgroup>
                <tr>
                    <td>제목</td>
                    <td><?=$sqlarr['title']?></td>
                </tr>
                <tr>
                    <td>글쓴이</td>
                    <td><?=$sqlarr['name']?></td>
                </tr>
                <tr>
                    <td>날짜</td>
                    <td><?=$sqlarr['date']?></td>
                </tr>
                <tr>
                    <td>조회수</td>
                    <td><?=$hit?></td>
                </tr>
                <tr>
                    <td>추천수</td>
                    <td><?=$sqlarr['thumbsup']?></td>
                </tr>
                <tr>
                    <td>내용</td>
                    <td><?=$sqlarr['content']?></td>
                </tr>
            </table>
        </div>
        <hr>
        <div class="footer">
            <div class="list">
                <a href="../index.php">목록</a>
            </div>
            <p class="btns">
                <a href="modify.php?idx=<?= $pno ?>">수정</a>
                <a href="thumbsup.php?idx=<?= $pno ?>">추천</a>
                <a href="#" id="delete">삭제</a>
            </p>
        </div>

        <div class="reply">
            <h3>댓글목록</h3>
            <?php
                $reply_sql = "SELECT * FROM reply WHERE con_num='{$pno}' ORDER BY idx desc;";
                $reply_result = $conn->query($reply_sql);
                
                while($reply_row = $reply_result->fetch_assoc()){
            ?>
            
            <div class="reply_list">
                <h4>글쓴이: <?= $reply_row['name'] ?></h4>
                <div class="reply_content">
                    내용: <?= $reply_row['content']?>
                </div>
                <span><?= $reply_row['date']?></span>
                <a href="" class="reply_mod">수정</a>
                <a href="" class="reply_del">삭제</a>

                <dialog class="reply_edit">
                    <form action="reply_edit_ok.php">
                        <input type="hidden" name="idx" value="<?= $reply_row['idx'] ?>">
                        <input type="hidden" name="pno" value="<?= $pno ?>">

                        <textarea name="content" cols="15" rows="10"><?= $reply_row['content']?></textarea>
                        <input type="password" name="password" placeholder="비밀번호">
                        <input type="submit" value="수정">
                        <a href="#">취소</a>
                    </form>
                </dialog>

                <dialog class="reply_del">
                    <form action="reply_del_ok.php">
                        <input type="hidden" name="idx" value="<?= $reply_row['idx'] ?>">
                        <input type="hidden" name="pno" value="<?= $pno ?>">

                        <input type="password" name="password" placeholder="비밀번호">
                        <input type="submit" value="삭제">
                        <a href="#">취소</a>
                    </form>
                </dialog>
            </div>
            <?php
                };
            ?>
            <hr>
            <div class="reply_form">
                <form action="reply_ok.php?idx=<?= $pno?>" METHOD="POST">
                    <input type="text" name="name" placeholder="이름" required>
                    <input type="password" name="password" placeholder="password" required>
                    <textarea name="content" cols="20" rows="10" required></textarea>
                    <button>글쓰기</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        let btn = document.querySelector('#delete');
        btn.addEventListener('click', e=>{
            e.preventDefault();
            if(confirm('삭제하시겠습니까?')){
                window.location = 'delete.php?idx=<?= $pno ?>';
            }else{
                alert('취소되었습니다.')
            }
        })
    </script>
</body>
</html>