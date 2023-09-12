<?php
  // var_dump($data); echo '<hr>';
  // var_dump($view); echo '<hr>';
  // var_dump($file_view); echo '<hr>';
?>
<h1>글 보기</h1>
    <div class="mb-3">
      제목 : <?= $view->subject ?>
      <p>
        작성일 : <?= $view->regdate ?> / 작성자 : <?= $view->userid ?>
      </p>
    </div>
    <div class="mb-3">
      내용 : <?= $view->content ?>
    </div>
    <?php
    if(isset($view->filename)){
    ?>
      <img src="<?= base_url('/uploads/'.$view->filename) ?>" class="img-fluid" alt="">
    <?php
    }
    ?>
    <a href="/modify/<?=$view->bid;?>" class="btn btn-primary">수정</a>
    <a href="/delete/<?=$view->bid;?>" class="btn btn-danger">삭제</a>
    <hr>