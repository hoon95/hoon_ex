<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/review/db.php';

    $sql = "SELECT * FROM employees ORDER BY emp_no DESC LIMIT 0,5";
    $result = $mysqli -> query($sql);
    
    while($rs = $result -> fetch_object()){
        $rsc[] = $rs;
    }?>


    <h1>사원명부</h1>
    <tr>
        <th>사원번호</th>
        <th>사원명</th>
        <th>입사일</th><br>
    </tr>
    <?php
    if(isset($rsc)){
        foreach($rsc as $item){ ?>
            <td><?php echo $item->emp_no ?></td>
            <td>
                <a href="employees_view.php?emp_no=<?php echo $item->emp_no ?>">
                    <?php echo $item->name ?>
                </a>
            </td>
            <td><?php echo $item->hire_date ?></td><br>
        <?php }
    }
?>
<hr>
<a href="employees_add.php">사원 추가</a>