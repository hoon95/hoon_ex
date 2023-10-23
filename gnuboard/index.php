<?php
if (!defined('_INDEX_')) define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

if(G5_COMMUNITY_USE === false) {
    include_once(G5_THEME_SHOP_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/index_head.php');
?>

    

    <h3 class="content_tt">Recent Projects</h3>
    <p class="project_link"><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=portfolio">See all projects</a></p>
    <ul class="project_list clearfix">

        <?php
        echo latest('theme/portfolio', 'portfolio', 4, 23);		
        ?>
        		
    </ul>

<?php
include_once(G5_THEME_PATH.'/tail.php');