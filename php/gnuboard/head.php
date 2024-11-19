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
            <!-- <ul class="clearfix">
                <li><a href="index.html">Home</a></li>
                <li><a href="portfolio.html">Portfolio</a></li>
                <li><a href="about.html">About us</a></li>
            </ul> -->
            <?php include_once('main_menu.php') ?>

        </nav>
    </div>
</header>

<div class="page_banner about">
    <h2 class="fancy-box gray main_tt">
        <?php 
            if($board['bo_subject']){
                echo $board['bo_subject'];
            } else{
                echo $g5['title'];
            }
        ?>
    </h2>
</div>

<div class="main_content subpage container">