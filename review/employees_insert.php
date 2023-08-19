<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/review/db.php';

    $name = $_POST['name'];
    $hire_date = $_POST['hire_date'];

    $query = "INSERT INTO employees (name, hire_date) VALUES ('{$name}', '{$hire_date}')";
    $rs = $mysqli -> query($query);

    if($rs){
        echo "<script>
        alert('저장되었습니다.')
        location.href = 'employees_list.php'
        </script>";
    }
?>