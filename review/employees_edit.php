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

<div class="container">
    <form action="employees_edit_insert.php" method="POST">
        <h1>사원정보 수정하기</h1>
        <p>
            <label for="emp_no">사원번호 NO : <?php echo $emp_no ?></label>
            <input type="hidden" name="emp_no" id="emp_no" value="<?php echo $emp_no ?>">
        </p>

        <p>
            <label for="name">사원명: </label>
            <input type="" name="name" id="name" placeholder=" 이름을 입력하세요." value="<?php echo $name ?>">
        </p>
        <p>
            <label for="hire_date">입사일: </label>
            <input type="date" id="hire_date" name="hire_date" value="<?php echo $hire_date ?>">
        </p>
        <button>EDIT</button>
    </form>
</div>