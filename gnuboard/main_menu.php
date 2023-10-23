<ul>                
  <?php
  $menu_datas = get_menu_db(0, true);
  $gnb_zindex = 999; // gnb_1dli z-index 값 설정용
  $i = 0;
  foreach( $menu_datas as $row ){
    if( empty($row) ) continue;
    $add_class = (isset($row['sub']) && $row['sub']) ? 'gnb_al_li_plus' : '';
  ?>
  <li>
    <a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>"><?php echo $row['me_name'] ?></a>                   
  </li>
  <?php
  $i++;
  }   //end foreach $row

  if ($i == 0) {  ?>
    <li class="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
  <?php } ?>
</ul>   
<ul>        
    <?php if ($is_member) {  ?>
    <li><a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php">정보수정</a></li>
    <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
    <?php if ($is_admin) {  ?>
    <li class="tnb_admin"><a href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>">관리자</a></li>
    <?php }  ?>
    <?php } else {  ?>
    <li><a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a></li>
    <li><a href="<?php echo G5_BBS_URL ?>/login.php">로그인</a></li>
    <?php }  ?>

</ul>