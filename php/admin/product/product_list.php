<?php

  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/admin_check.php';
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/header.php';
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/category_func.php';

  $pageNumber = $_GET['pageNumber'] ?? 1;
  $pageCount = $_GET['pageCount'] ?? 10;
  $statLimit = ($pageNumber-1) * $pageCount;  // pageNumber:1->0~10 / 2->10~20
  $endLimit = $statLimit + $pageCount;
  $firstPageNumber = $_GET['firstPageNumber'] ?? 0;

  $cates1 = $_GET['cate1'] ?? '';
  $cate2 = $_GET['cate2'] ?? '';
  $cate3 = $_GET['cate3'] ?? '';
  $ismain = $_GET['ismain'] ?? '';
  $isnew = $_GET['isnew'] ?? '';
  $isbest = $_GET['isbest'] ?? '';
  $isrecom = $_GET['isrecom'] ?? '';
  $sale_end_date = $_GET['sale_end_date'] ?? '';
  $search_keyword = $_GET['search_keyword'] ?? '';

  $search_where = '';
  $cates = $cates1.$cate2.$cate3;    // A00001B00001C00001
  if($cates){
    $search_where .= " AND cate LIKE '{$cates}%'";
  }
  if($ismain){
    $search_where .= " AND ismain=1";
  }
  if($isnew){
    $search_where .= " AND isnew=1";
  }
  if($isbest){
    $search_where .= " AND isbest=1";
  }
  if($isrecom){
    $search_where .= " AND isrecom=1";
  }
  if($sale_end_date){
    $search_where .= " AND sale_end_date >= '$sale_end_date'";
    // 판매 종료일이 지나지 않은 상품 조회
  }
  if($search_keyword){
    $search_where .= " AND (name LIKE '%{$search_keyword}%' OR content LIKE '%{$search_keyword}%')";
    // 제목과 내용에 키워드가 포함된 상품 조회
  }
  
  $sql = "SELECT * FROM products WHERE 1=1";    // AND 컬럼=값 AND 컬럼=값 ... 뒤에 계속 붙히기 위해 WHERE 1=1
  $order =" ORDER BY pid DESC";
  $limit = " LIMIT $statLimit, $endLimit";
  $sql .= $search_where;

  
  

  $query = $sql.$order.$limit;    // 전체 쿼리문 조합
  // var_dump($query);
  $result = $mysqli -> query($query);

  while($rs = $result -> fetch_object()){
    $rsc[] = $rs;       // 빈 배열(rsc)에 담아놓고 foreach로 불러온다
  }

  // var_dump($rsc);       // rsc 값을 foreach로 테이블에 넣어준다
?>

<div class="container">
  <h1 class="h3 mt-5">제품 목록</h1>
  
  <form action="" class="mt-5" id="search_form">
    <div class="row">
      <div class="col-md-4">
        <select class="form-select" aria-label="Default select example" id="cate1" name="cate1">
          <option selected disabled>대분류</option>
          <?php
          foreach($cate1 as $c){            
        ?>
          <option value="<?php echo $c->code ?>"><?php echo $c->name ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="col-md-4">
        <select class="form-select" aria-label="Default select example" id="cate2" name="cate2">
          <option selected disabled>중분류</option>
         
        </select>
      </div>
      <div class="col-md-4">
        <select class="form-select" aria-label="Default select example" id="cate3" name="cate3">
          <option selected disabled>소분류</option>
          
        </select>
      </div>
    </div>

    <div class="input-group mt-3">
      <span>
        <input class="form-check-input" type="checkbox" value="1" name="ismain" id="ismain">
        <label class="form-check-label" for="ismain">메인</label>
      </span>
  
      <span>
        <input class="form-check-input" type="checkbox" value="2" name="isnew" id="isnew">
        <label class="form-check-label" for="isnew">신제품</label>
      </span>
  
      <span>
        <input class="form-check-input" type="checkbox" value="3" name="isbest" id="isbest">
        <label class="form-check-label" for="isbest">베스트</label>
      </span>
  
      <span>
        <input class="form-check-input" type="checkbox" value="4" name="isrecom" id="isrecom">
        <label class="form-check-label" for="isrecom">추천</label>
      </span>
  
      <span class="d-flex">
        <label for="end_date">판매종료일</label>
        <input type="text" class="form-control" name="sale_end_date" id="end_date">
      </span>
  
      <input type="text" class="form-control flex-fill" name="search_keryword" id="search_keyword" placeholder="제목 및 내용 검색">
      <button class="btn btn-primary">검색</button>
    </div>

  </form>


<form action="plist_update.php">
  
   <table class="table product_list">
    <thead>
      <tr>
        <th scope="col">사진</th>
        <th scope="col">제품명</th>
        <th scope="col">가격</th>
        <th scope="col">재고</th>
        <th scope="col">메인</th>
        <th scope="col">신제품</th>
        <th scope="col">베스트</th>
        <th scope="col">추천</th>
        <th scope="col">상태</th>
        <th scope="col">보기</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <!-- 반복문으로 내용 넣기 -->
        <?php if(isset($rsc)){
          foreach($rsc as $item){ ?>
          <td>
            <input type="hidden" name="pid[]" value="<?php echo $item->pid ?>">
            <img src="<?php echo $item->thumbnail ?>">
          </td>
          <td><?php echo $item->name ?></td>
          <td><?php echo $item->price ?></td>
          <td><?php echo $item->cnt ?></td>
  
          <td>
            <input class="form-check-input" type="checkbox" 
            value="<?php echo $item->ismain ?>" 
            name="ismain[<?php echo $item->pid ?>]" 
            id="ismain[<?php echo $item->pid ?>]" 
            <?php if($item->ismain){
              echo 'checked';
            }?>
          </td>
          <td>
            <input class="form-check-input" type="checkbox" 
            value="<?php echo $item->isnew ?>" 
            name="isnew[<?php echo $item->pid ?>]" 
            id="isnew[<?php echo $item->pid ?>]" 
            <?php if($item->isnew){
              echo 'checked';
            }?>
          </td>
          <td>
            <input class="form-check-input" type="checkbox" 
            value="<?php echo $item->isbest ?>" 
            name="isbest[<?php echo $item->pid ?>]" 
            id="isbest[<?php echo $item->pid ?>]" 
            <?php if($item->isbest){
              echo 'checked';
            }?>
          </td>
          <td>
            <input class="form-check-input" type="checkbox" 
            value="<?php echo $item->isrecom ?>" 
            name="isrecom[<?php echo $item->pid ?>]" 
            id="isrecom[<?php echo $item->pid ?>]" 
            <?php if($item->isrecom){
              echo 'checked';
            }?>
          </td>
          <td>
            <select name="stat[<?php echo $item->pid ?>]" id="stat[<?php echo $item->pid ?>]" class="form-select" aria-label="대기설정 변경">
              <option value="-1" 
              <?php if($item->status==-1){
                echo 'selected';
              }
              ?>>판매중지</option>
              <option value="0" 
              <?php if($item->status==0){
                echo 'selected';
              }
              ?>>대기</option>
              <option value="1" 
              <?php if($item->status==1){
                echo 'selected';
              }
              ?>>판매중</option>
              
            </select>
          </td>
          <td>
            <a href="product_view.php?pid=<?php echo $item->pid ?>" class="btn btn-primary">보기</a>
          </td>
      </tr>
        <?php }
        } else {?>
      <tr>
        <td colspan="10">검색 결과 없음</td>    
      </tr>
      <?php
        }
      ?>
    </tbody>
  </table>
  <div class="d-flex justify-content-end">
    <button class="btn btn-primary">일괄 수정</button>
  </div>
</form>
<hr>
  <a href="product_up.php" class="btn btn-primary">제품 등록</a>
</div>

<script src="../../js/makeoption.js"></script>
<script>
    $( "#end_date" ).datepicker({
    dateFormat:'yy-mm-dd'
  });
</script>
<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/footer.php';
?>