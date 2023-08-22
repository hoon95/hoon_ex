<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/admin_check.php';
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/header.php';
  
  $pid = $_GET['pid'];

  $query ="SELECT * FROM products WHERE pid={$pid}";
  $result = $mysqli -> query($query);
  $rs = $result -> fetch_object();
//   var_dump($rs);


  // products_options 테이블에서 pid가 $pid와 일치하는 데이터를 조회
  $query2 = "SELECT * FROM product_options WHERE pid={$pid}";
  $result2 = $mysqli -> query($query2);
  while($rs2 = $result2 -> fetch_object()){
    $rsc2[] = $rs2;
  }

  $query3 = "SELECT filename FROM product_image_table WHERE pid={$pid}";
  $result3 = $mysqli -> query($query3);
  while($rs3 = $result3 -> fetch_object()){
    $rsc3[] = $rs3;
  }
//   var_dump($rs2);


?>

<div class="container">
    <table class="table">
        <tbody>
            <tr>
                <th>분류: </th>
                <td><?php echo $rs->cate ?></td>
            </tr>
            <tr>
                <th>제품명: </th>
                <td><?php echo $rs->name ?></td>
            </tr>
            <tr>
                <th>가격: </th>
                <td><?php echo $rs->price ?></td>
            </tr>
            <tr>
                <th>전시옵션: </th>
                <td><?php 
                if($rs->ismain){echo '메인 ';}
                if($rs->isnew){echo '신제품 ';}
                if($rs->isbest){echo '베스트 ';}
                if($rs->isrecom){echo '추천 ';}
                ?></td>
            </tr>
            <tr>
                <th>위치: </th>
                <td><?php echo $rs->locate ?>번 위치</td>
            </tr>
            <tr>
                <th>판매종료일: </th>
                <td><?php echo $rs->sale_end_date ?></td>
            </tr>
            <tr>
                <th>옵션: </th>
                <td>
                    <?php foreach($rsc2 as $r2){?>
                        <div class="product_options">
                            <span><?php echo $r2->option_name ?></span>
                            <span><?php echo $r2->option_cnt ?>개</span>
                            <span><?php echo $r2->option_price ?>원</span>
                            <img src="<?php echo $r2->image_url ?>" alt="">
                        </div>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <th>상세설명: </th>
                <td><?php echo $rs->content ?></td>

                </tr>
            <tr>
                <th>썸네일: </th>
                <td><td><img src="<?php echo $rs->thumbnail ?>" alt=""></td></td>
            </tr>
            <tr>
                <th>추가이미지: </th>
                <td>
                    <?php 
                    if($rsc3){
                        foreach($rsc3 as $r3){?>
                        <img src="/abcmall/pdata/<?php echo $r3->filename ?>" alt="">
                        <?php }
                    } ?>
                </td>
            </tr>
        </tbody>
    </table>
    <hr>
    <a href="product_modify.php?pid=" class="btn btn-primary">수정</a>
    <button type="button" class="btn btn-danger">삭제</button>
    <a href="product_list.php" class="btn btn-secondary">목록</a>
</div>


<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/footer.php';
?>