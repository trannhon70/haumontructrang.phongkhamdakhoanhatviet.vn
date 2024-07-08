<?php


// Số bài viết trên mỗi trang
$limit = 5;
// Trang hiện tại
$page = Session::get('page') ? Session::get('page') : 1;

// Tính toán offset
$offset = ($page - 1) * $limit;

if (!isset($get_post_detail)) {
    // Lấy danh sách bài viết theo phân trang
    $list_BV_pagination = $bai_viet->getById_benh($sessionBenh !== false ? $sessionBenh : $id_slug, $limit, $offset);

    // Lấy tổng số bài viết
    $total_articles = $bai_viet->getTotalCountById($sessionBenh !== false ? $sessionBenh : $id_slug);
    // Tính toán tổng số trang
    $total_pages = ceil($total_articles / $limit);
}
?>

<!-- heath mobile -->
<section id="health_mobile">
    <?php if(isset($get_post_detail)){
        include('inc/bai-viet.php');
    } else {
        include('mobile/card_mobile.php');
    }
   
    ?>
    
    <?php include("mobile/form_dat_lich_kham.php") ?>
   
</section>