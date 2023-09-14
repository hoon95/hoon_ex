
<h1><?= isset($view->subject)? '글수정':'글쓰기'; ?></h1>
<form action="<?= site_url('/writesave') ?><?= isset($view->bid)? '/?bid='.$view->bid:'';?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="file_table_id" id="file_table_id" value="">
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
    <div class="d-flex" id="imageArea">

    </div>
    <?php
    $btntitle = isset($view->subject)? '수정':'등록';
    
    ?>
    <button class="btn btn-primary"><?= $btntitle; ?></button>
</form>
<hr>

<script>
  $("#file").change(function () {
    var files = $('#file').prop('files');
    for (var i = 0; i < files.length; i++) {
      attachFile(files[i]);
    }
    $('#file').val('');
  });


  function attachFile(file) {
    var formData = new FormData();  //페이지 전환 없이 파일 전송
    formData.append("savefile", file); //<input name="savefile" value="파일명">
    $.ajax({
        url: '/save_image.php',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        type: 'POST',
        success: function (return_data) {
          fid = $("#file_table_id").val() + return_data.fid + ",";
          $("#file_table_id").val(fid);
          var html = "<div class='col' id='f_" + return_data.fid +
              "'><div class='card h-100'><img src='/uploads/" + return_data.savename +
              "' class='card-img-top'><div class='card-body'><button type='button' class='btn btn-warning' onclick='file_del(" +
              return_data.fid + ")'>삭제</button></div></div></div>";
          $("#imageArea").append(html);
        }
    });
  }


  function file_del(fid) {
    if (!confirm('삭제하시겠습니까?')) {
        return false;
    }
    var data = {
        fid: fid
    };
    $.ajax({
      async: false,
      type: 'post',
      url: '/file_delete',
      data: data,
      dataType: 'json',
      error: function () {},
      success: function (return_data) {
        $("#f_" + fid).hide();
      }
    });
  }

</script>