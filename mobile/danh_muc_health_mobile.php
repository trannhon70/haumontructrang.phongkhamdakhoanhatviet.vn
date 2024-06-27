<?php


// Số bài viết trên mỗi trang
$limit = 5;
// Trang hiện tại
$page = Session::get('page') ? Session::get('page') : 1;

// Tính toán offset
$offset = ($page - 1) * $limit;

// Lấy danh sách bài viết theo phân trang
$list_BV_pagination = $bai_viet->getById_benh($sessionBenh, $limit, $offset);

// Lấy tổng số bài viết
$total_articles = $bai_viet->getTotalCountById($sessionBenh);
// Tính toán tổng số trang
$total_pages = ceil($total_articles / $limit);
?>

<!-- heath mobile -->
<section id="health_mobile">
    <?php if(isset($get_post_detail)){
        include('inc/bai-viet.php');
    } else {
        include('mobile/card_mobile.php');
    }
   
    ?>
    
    <div class="form-chat-mobile">
        <form action="">
            <div class="form-chat-mobile-title">Đặt lịch khám</div>
            <div class="form-chat-mobile-input">
                <input type="text" placeholder="Họ tên">
            </div>
            <div class="form-chat-mobile-input">
                <input type="text" placeholder="Ngày tháng năm sinh">
            </div>
            <div class="form-chat-mobile-input">
                <input type="text" placeholder="Số điện thoại">
            </div>
            <div class="form-chat-mobile-input">
                <input type="text" placeholder="Mô tả triệu chứng">
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group form-chat-mobile-input">
                        <div class="datepicker date input-group">
                            <input type="text" placeholder="Ngày khám" class="form-control" id="fecha1">
                            <div style="height: 35px; margin-top: 0px; " class="input-group-append">
                                <span style="border-bottom: 2px;" class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-chat-mobile-input">
                        <input type="text" placeholder="Giờ khám">
                    </div>
                </div>
            </div>
            <div style="display: flex; align-items: center;justify-content: center; ">
                <button class="form-chat-mobile-input-button">gửi</button>

            </div>
        </form>
    </div>
   
</section>