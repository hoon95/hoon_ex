<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/review/db.php';

    $emp_no = $_GET['emp_no'];
    $sql = "SELECT * FROM employees WHERE emp_no='{$emp_no}'";
    $result = $mysqli -> query($sql);

    while($rs = $result -> fetch_object()){
        $rsc[] = $rs;
    }

    foreach($rsc as $item){
        $name = $item->name;
        $hire_date = $item->hire_date;
    }
?>
<h1>사원정보</h1>
<h2>사원번호: <?php echo $emp_no ?></h2>
<h2>사원명: <?php echo $name ?></h2>
<h2>입사일: <?php echo $hire_date ?></h2>
<hr>
<a href="employees_list.php">목록</a>
<a href="employees_edit.php?emp_no=<?php echo $item->emp_no ?>">수정</a>
<a href="employees_del.php?emp_no=<?php echo $item->emp_no ?>">삭제</a>