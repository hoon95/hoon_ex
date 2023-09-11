
<h1>글쓰기</h1>
<form action="<?= site_url('/writesave') ?>" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="username" class="form-label">작성자</label>
      <input type="text" class="form-control" name="username" id="username" readonly value="<?= $_SESSION['username'] ?>">
    </div>
    <div class="mb-3">
      <label for="subject" class="form-label">제목</label>
      <input type="text" class="form-control" name="subject" id="subject" placeholder="제목을 입력하세요">
    </div>
    <div class="mb-3">
      <label for="content" class="form-label">내용</label>
      <textarea class="form-control" name="content" id="content" rows="3"></textarea>
    </div>
    <button class="btn btn-primary">등록</button>
</form>
<hr>