<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/head.php');
    return;
}

if(G5_COMMUNITY_USE === false) {
    define('G5_IS_COMMUNITY_PAGE', true);
    include_once(G5_THEME_SHOP_PATH.'/shop.head.php');
    return;
}
include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
?>

<!-- 상단 시작  -->
<header>
    <div class="container clearfix">
        <h1 class="logo">
            <a href="<?php echo G5_URL ?>">Logo</a>
        </h1>
        <nav>
            <?php include_once('main_menu.php') ?>
        </nav>
    </div>
</header>

<div class="banner">
    <ul class="banner_list cycle-slideshow"
		data-cycle-fx="scrollHorz" 
		data-cycle-timeout="0"
		data-cycle-slides=".slide"
		data-cycle-prev=".banner .prev"
        data-cycle-next=".banner .next"
		data-cycle-pager=".banner .pager"		
		>		

        <?php
            echo latest('theme/banner', 'banner', 3, 10);		
        ?>


				
    </ul>
    <p class="controls">
        <a href="#" class="prev">
            <i class="fa fa-chevron-left" aria-hidden="true"></i>
        </a>
        <a href="#" class="next">
            <i class="fa fa-chevron-right" aria-hidden="true"></i>
        </a>
    </p>
    <p class="pager">
    </p>
</div>

<div class="main_content container">