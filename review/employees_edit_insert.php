<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/review/db.php';

    $emp_no = $_POST['emp_no'];
    $name = $_POST['name'];
    $hire_date = $_POST['hire_date'];

    $query = "UPDATE employees SET name='{$name}', hire_date='{$hire_date}' WHERE emp_no='{$emp_no}'";

    $rs = $mysqli -> query($query);

    if($rs){
        echo "<script>
        alert('수정되었습니다.')
        location.href = 'employees_list.php'
        </script>";
    }
?>