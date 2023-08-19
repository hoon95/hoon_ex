<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/review/db.php';

?>

<div class="container">
    <form action="employees_insert.php" method="POST">
        <h1>데이터 입력하기</h1>
        
        <p>
            <label for="name">사원명: </label>
            <input type="" name="name" id="name" placeholder=" 이름을 입력하세요.">
        </p>
        <p>
            <label for="hire_date">입사일: </label>
            <input type="date" id="hire_date" name="hire_date">
        </p>
        <button>ADD</button>
    </form>
</div>