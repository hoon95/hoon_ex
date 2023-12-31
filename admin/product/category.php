<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/header.php';
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/category_func.php';


?>
<div class="container mt-5">
  <form action="">
    <div class="row">
      <div class="col-md-4">
        <select class="form-select" aria-label="Default select example" id="cate1">
          <option selected disabled>대분류</option>
          <?php
          foreach($cate1 as $c){            
        ?>
          <option value="<?php echo $c->code ?>"><?php echo $c->name ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="col-md-4">
        <select class="form-select" aria-label="Default select example" id="cate2">
          <option selected disabled>중분류</option>
         
        </select>
      </div>
      <div class="col-md-4">
        <select class="form-select" aria-label="Default select example" id="cate3">
          <option selected disabled>소분류</option>
          
        </select>
      </div>
    </div>
  </form>
  <div class="btns mt-5">
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cate1Modal">대분류 등록</button>
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cate2Modal">중분류 등록</button>
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cate3Modal">소분류 등록</button>
  </div><!-- //btns -->
</div><!-- //container -->

<!-- Modal 1 -->
<div class="modal fade" id="cate1Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5">대분류 등록</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <input type="text" class="form-control" name="code1" id="code1" placeholder="코드명">
          </div>
          <div class="col-md-6">
          <input type="text" class="form-control" name="name1" id="name1" placeholder="대분류명">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
        <button type="submit" class="btn btn-primary" data-step="1">등록</button>
      </div>
    </div>
  </div>
</div> <!-- //Modal 1 -->

<!-- Modal 2 -->
<div class="modal fade" id="cate2Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5">중분류 등록</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <?php

                $query = "select * from category where step=1";
                //$mysqli->함수명,   쿼리실행 $mysqli -> query(sql지시문);
                $result = $mysqli -> query($query); //쿼리실행결과를 $result 할당

                while($rs = $result -> fetch_object()){
                    $cate2[] = $rs;
                }
          ?>
          <div class="col-md-12">
            <select class="form-select" aria-label="Default select example" id="pcode2">
              <option selected disabled>대분류를 선택해주세요.</option>
              <?php
              foreach($cate2 as $p){            
            ?>
              <option value="<?php echo $p->code ?>"><?php echo $p->name ?></option>
              <?php } ?>
            </select>
          </div>          
        </div>
        <div class="row mt-3">
          <div class="col-md-6">
            <input type="text" class="form-control" name="code2" id="code2" placeholder="코드명">
          </div>
          <div class="col-md-6">
          <input type="text" class="form-control" name="name2" id="name2" placeholder="중분류명">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
        <button type="submit" class="btn btn-primary" data-step="2">등록</button>
      </div>
    </div>
  </div>
</div> <!-- //Modal 2 -->

<!-- Modal 3 -->
<div class="modal fade" id="cate3Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5">소분류 등록</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <select class="form-select" aria-label="Default select example" id="pcode2_1">
            <option selected disabled>대분류</option>
            <?php
              foreach($cate1 as $c){            
            ?>
              <option value="<?php echo $c->code ?>"><?php echo $c->name ?></option>
            <?php } ?>
            </select>
          </div>
          <div class="col-md-6">
            <select class="form-select" aria-label="Default select example" id="pcode3">
              <option selected disabled>대분류를 먼저 선택해주세요</option>
            
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <input type="text" class="form-control" name="code3" id="code3" placeholder="코드명">
          </div>
          <div class="col-md-6">
          <input type="text" class="form-control" name="name3" id="name3" placeholder="소분류명">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
        <button type="submit" class="btn btn-primary" data-step="3">등록</button>
      </div>
    </div>
  </div>
</div> <!-- //Modal 3 -->

<script src="../../js/makeoption.js"></script>
<script>

  let categorySubmitBtn = $('.modal button[type="submit"]');

  categorySubmitBtn.click(function(){
    let step = $(this).attr('data-step');
    save_category(step);
  });

  function save_category(step){
    let code = $(`#code${step}`).val(); //$('#code1').val()
    let name = $(`#name${step}`).val();
    let pcode = $(`#pcode${step} option:selected`).val();

    if(step > 1 && !pcode){
      alert('대분류를 먼저 선택하세요');
      return; //아무것도 반환하지 않고 종료
    }    
    if(!code){
      alert('코드명을 입력하세요');
      return; 
    }
    if(!name){
      alert('분류명을 입력하세요');
      return; 
    }
    let data = {
      name:name,
      code:code,
      pcode:pcode,
      step:step
    }
    console.log(data);
   
    $.ajax({
      async : false, 
      type: 'post',     
      data: data, 
      url: "save_category.php", 
      dataType: 'json', //결과 json 객체형식
      error: function(error){
        console.log('Error:', error);
      },
      success: function(return_data){
        console.log(return_data.result);

        if(return_data.result == 1){
          alert('등록성공');
        } else if(return_data.result == -1){
          alert('코드나 분류명이 이미 사용중입니다.');
          location.reload();//새로고침
        } else{
          alert('등록실패');
        }
      }
    });//ajax


  }


</script>
<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/footer.php';
?>