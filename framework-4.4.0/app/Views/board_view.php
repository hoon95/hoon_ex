
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
    <a href="/modify/<?=$view->bid;?>" class="btn btn-primary">수정</a>
    <a href="/delete/<?=$view->bid;?>" class="btn btn-danger">삭제</a>
    <hr>