<?php

session_start(); 
  // var_dump($_SESSION['AUID']);

  if(isset($_SESSION['AUID'])){
    if(!$_SESSION['AUID'] == 'admin'){
      echo "<script>
        alert('권한이 없습니다.');
        location.href = '/abcmall/admin/login.php';
      </script>";
    }
  } else{
    echo "<script>
        alert('권한이 없습니다.');
        location.href = '/abcmall/admin/login.php';
      </script>";
  }
  
?>