
<h1><?= isset($view->subject)? '글수정':'글쓰기'; ?></h1>
<form action="<?= site_url('/writesave') ?><?= isset($view->bid)? '/?bid='.$view->bid:'';?>" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="username" class="form-label">작성자</label>
      <input type="text" class="form-control" name="username" id="username" readonly value="<?= $_SESSION['username'] ?>">
    </div>
    <div class="mb-3">
      <label for="subject" class="form-label">제목</label>
      <input type="text" class="form-control" name="subject" id="subject" placeholder="제목을 입력하세요" value="<?= isset($view->subject)? $view->subject:''; ?>">
    </div>
    <div class="mb-3">
      <label for="content" class="form-label">내용</label>
      <textarea class="form-control" name="content" id="content" rows="3"><?= isset($view->content)? $view->content:''; ?></textarea>
    </div>
    <div class="mb-3">
      <label for="file" class="form-label">첨부파일</label>
      <input type="file" class="form-control" name="upfile[]" id="file" multiple>
    </div>
    <?php
    $btntitle = isset($view->subject)? '수정':'등록';
    
    ?>
    <button class="btn btn-primary"><?= $btntitle; ?></button>
</form>
<hr>