<h2>게시판 <?php echo isset($view->subject)? '글수정':'글쓰기'; ?></h2>

<form action="<?= site_url('/writesave')?><?php echo isset($view->bid)? '/?bid='.$view->bid:''; ?>" method="POST" enctype="multipart/form-data">
    
    <input type="hidden" name="file_table_id" id="file_table_id" value="">

    <div class="mb-3">
      <label for="username" class="form-label">이름</label>
      <input type="text" class="form-control" id="username" name="username" placeholder="제목을 입력하세요" readonly value="<?= $_SESSION['username']; ?>">
    </div>
    <div class="mb-3">
      <label for="subject" class="form-label">제목</label>
      <input type="text" class="form-control" id="subject" name="subject" placeholder="제목을 입력하세요" value="<?php echo isset($view->subject)? $view->subject:''; ?>">
    </div>
    <div class="mb-3">
      <label for="content" class="form-label">내용</label>
      <textarea class="form-control" id="content" name="content" rows="3" ><?php echo isset($view->content)? $view->content:''; ?></textarea>
    </div>
    <div class="mb-3">
      <label for="file" class="form-label">첨부파일</label>
      <input type="file" class="form-control" id="file" name="upfile[]" multiple >
    </div>
    <div class="d-flex" id="imageArea">

    </div>
    <?php
    $btntitle = isset($view->subject)? '수정':'등록';
    ?>
    <button class="btn btn-primary"><?= $btntitle; ?></button>
</form>



<hr>
<a href="/board">목록</a> / <a href="/">홈</a>
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
      url: '/save_image',
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