<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}

if(G5_COMMUNITY_USE === false) {
    include_once(G5_THEME_SHOP_PATH.'/shop.tail.php');
    return;
}
?>

</div><!--//main_content-->
	
<footer>
    <span class="envelope_icon fancy-box orange">
        <i class="fa fa-envelope" aria-hidden="true"></i>
    </span>
    <div class="subscribe">
        <p>
        Wanna see my latest photos? Enter your email below and I'll send you one email a month with the latest updates.
        </p>
        <form action="#" method="post">
            <input type="email" name="email" placeholder="Your email address"/>
            
            <input type="submit" value="Subscribe" class="green_btn"/>
        </form>
    </div>
    <p class="share">
        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
    </p>
    <p class="copy">
        &copy; 2018 portfolio theme.
    </p>
</footer>


<?php
if(G5_DEVICE_BUTTON_DISPLAY && !G5_IS_MOBILE) { ?>
<?php
}

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<!-- } 하단 끝 -->

<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_THEME_PATH."/tail.sub.php");