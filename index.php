<?php
include 'inc/header.php';

$danhSachBaiViet = $bai_viet->getDanhSachBaiVietNew();
$danhSachBaiVietTheoKhoa = $bai_viet->getAllDanhSachBaiVietNew('benh-xa-hoi');
$tin_tuc_all_news = $tin_tuc->getAllLimitTinTuc();
?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])) {
    $insertCustomers = $brand->insert_brand($_POST);
}


?>

<?php

if (isset($insertCustomers)) {
    echo $insertCustomers;
}

$dataFake = array(
    array(
        'title' => 'PHƯƠNG CHÂM PHÒNG KHÁM', 
        // 'image' => '/images/icons/icon_nam_khoa2.webp', 
        'text' => 'Phòng khám bệnh xã hội JV Nhật Việt chuyên khám và hỗ trợ điều trị các bệnh thường gặp như sùi mào gà, bệnh lậu, giang mai, mụn rộp sinh dục,… Hiện nay ngày càng nhiều người mắc các bệnh xã hội, nguyên nhân chủ yếu là do lối sống tình dục không an toàn. Chính vì vậy bệnh nhân cần chủ động đi khám tại các phòng khám bệnh xã hội uy tín để nhanh chóng phát hiện và hỗ trợ điều trị sớm.'),
    // array('title' => 'DA LIỄU', 'image' => '/images/icons/icon_da_lieu2.webp', 'text' => 'Chuyên khoa Da liễu Phòng khám Đa khoa Nhật Việt là đơn vị đảm nhận chẩn đoán và điều trị các bệnh lý thuộc chuyên ngành Da liễu.'),
    // array('title' => 'BỆNH XÃ HỘI', 'image' => '/images/icons/icon_benh_xh2.webp', 'text' => 'Đa khoa Nhật Việt là một trong những địa chỉ thăm khám, xét nghiệm và điều trị bệnh xã hội uy tín tại TPHCM được người dân thành phố và khu vực tin chọn.'),
    // array('title' => 'HẬU MÔN - TRỰC TRÀNG', 'image' => '/images/icons/icon_hm_tt2.webp', 'text' => 'Khoa Hậu môn – Trực tràng Phòng khám Đa khoa Nhật Việt chuyên cung cấp dịch vụ khám chữa toàn diện các bệnh lý hậu môn – trực tràng uy tín.'),
);
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

<section class="container" id="we_bring">
    <div class=" we_bring_body">
        <div class="we_bring_body_top row">
            <?php foreach ($dataFake as  $value) : ?>
                <div class="we_bring_body_top_col col-12 ">
                    <!-- <img class="we_bring_body_top_col_img" src="<?php echo $local . $value['image']; ?>" alt="..."> -->
                    <div class="we_bring_body_top_col_div">
                        <h5 class="we_bring_body_top_col_div_title color_success f_weight_700 "><?php echo $value['title']; ?></h5>
                        <span  >
                            <?php echo $value['text']; ?>
                        </span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <hr class="hr">
        </hr>
        <div class="row we_bring_body_botom">
            <div class="col-sm-6">
                <img width="100%" src="<?php echo $local ?>/images/users/user_group.webp" alt="...">
            </div>
            <div class="we_bring_body_botom_col col-sm-6">
                <div class="we_bring_body_botom_col_title">
                    Chúng tôi mang đến
                </div>
                <div class="we_bring_body_botom_col_text">
                    Đa Khoa Nhật Việt luôn nỗ lực để xây dựng một thương hiệu chăm sóc sức khỏe với hàm lượng tri thức, khoa học và công nghệ ở mức cao. Mỗi dịch vụ y tế đều hướng tới tính tiện ích, hiệu quả, có ý nghĩa với cuộc sống và sức khỏe con người.
                </div>
                <button class="we_bring_body_botom_col_button">Xem tất cả các dịch vụ của chúng tôi</button>
            </div>
        </div>
    </div>
</section>

<section id="experienced">
    <div class="container">
        <div class="experienced_body row">
            <div class="experienced_body_left col-sm-8">
                <div class="experienced_body_left_title color_white f_weight_700 ">về chúng tôi</div>
                <div class="experienced_body_left_title1">Đội ngũ bác sĩ chuyên khoa</div>
                <div class="experienced_body_left_text">Y, Bác sĩ của phòng khám đều là những nhân tố giỏi. Họ đã từng công tác tại nhiều bệnh viện lớn trong cả nước. Mỗi chuyên gia đảm nhận một chuyên khoa riêng biệt. Chính điều này sẽ giúp quá trình khám chữa bệnh đạt kết quả tối ưu.</div>
                <div class="experienced_body_left_center">
                    <button class="experienced_body_left_center_button">Chuyên nghiệp</button>
                    <button class="experienced_body_left_center_button">Tận tâm</button>
                    <button class="experienced_body_left_center_button">kinh nghiệm</button>
                </div>
                <div class="experienced_body_left_center_mobile mt-3">
                    <img src="<?php echo $local ?>/images/logo/vong-tron.webp" alt="">
                </div>
                <div class="experienced_body_left_footer row">
                    <div class="experienced_body_left_footer_col col-sm-6">
                        <img class="experienced_body_left_footer_col_icon" src="<?php echo $local ?>/images/icons/icon_check.webp" alt="">
                        <span>
                            Y khoa tiên tiến, dịch vụ tận tâm
                        </span>
                    </div>
                    <div class="experienced_body_left_footer_col col-sm-6">
                        <img class="experienced_body_left_footer_col_icon" src="<?php echo $local ?>/images/icons/icon_check.webp" alt="">
                        <span>
                            Chuyên môn cao, tâm huyết lớn
                        </span>
                    </div>
                    <div class="experienced_body_left_footer_col col-sm-6">
                        <img class="experienced_body_left_footer_col_icon" src="<?php echo $local ?>/images/icons/icon_check.webp" alt="">
                        <span>
                            Nơi sức khỏe được ưu tiên
                        </span>
                    </div>
                    <div class="experienced_body_left_footer_col col-sm-6">
                        <img class="experienced_body_left_footer_col_icon" src="<?php echo $local ?>/images/icons/icon_check.webp" alt="">
                        <span>
                            Sức khỏe là hạnh phúc, chúng tôi là người bảo vệ
                        </span>
                    </div>
                </div>
            </div>
            <div class="experienced_body_right col-sm-4">
                <img class="experienced_body_right_img" src="<?php echo $local ?>/images/users/user-group1.webp" alt="" />
            </div>
        </div>
        <div style="margin-top: 85px;" class="experienced_footer row">
            <div class="experienced_footer_col col-sm-3">
                <img class="experienced_footer_col_img" src="<?php echo $local ?>/images/users/user_1.webp" alt="">
                <div class="experienced_footer_col_title">Lê bản bình</div>
                <span class="experienced_footer_col_text">CK: Ngoại khoa</span>
            </div>
            <div class="experienced_footer_col col-sm-3">
                <img class="experienced_footer_col_img" src="<?php echo $local ?>/images/users/user_2.webp" alt="">
                <div class="experienced_footer_col_title">nguyễn minh đức </div>
                <span class="experienced_footer_col_text">CK: Siêu âm</span>
            </div>
            <div class="experienced_footer_col col-sm-3">
                <img class="experienced_footer_col_img" src="<?php echo $local ?>/images/users/user_3.webp" alt="">
                <div class="experienced_footer_col_title">trần minh đức</div>
                <span class="experienced_footer_col_text">CK: Xét nghiệm</span>
            </div>
            <div class="experienced_footer_col col-sm-3">
                <img class="experienced_footer_col_img" src="<?php echo $local ?>/images/users/user_4.webp" alt="">
                <div class="experienced_footer_col_title">trần minh đức</div>
                <span class="experienced_footer_col_text">CK: Hồi phục chức năng</span>
            </div>
        </div>
        <!-- //mobile -->
        <div class="experienced_footer_mobile row">
            <div class="experienced_footer_mobile_div" >
                <span>đội ngũ y bác sĩ giỏi</span>
            </div>
            <swiper-container style="height: 319px;" slides-per-view="1" class="mySwiper" space-between="30" pagination="true" pagination-clickable="true">
                <swiper-slide>
                    <div style="text-align: center; " class="experienced_footer_col col-sm-3">
                        <img class="experienced_footer_col_img" src="<?php echo $local ?>/images/users/user_1.webp" alt="">
                        <div class="experienced_footer_col_title">Lê bản bình</div>
                        <span class="experienced_footer_col_text">CK: Ngoại khoa</span>
                    </div>
                </swiper-slide>
                <swiper-slide>
                    <div style="text-align: center; " class="experienced_footer_col col-sm-3">
                        <img class="experienced_footer_col_img" src="<?php echo $local ?>/images/users/user_2.webp" alt="">
                        <div class="experienced_footer_col_title">nguyễn minh đức </div>
                        <span class="experienced_footer_col_text">CK: Siêu âm</span>
                    </div>
                </swiper-slide>
                <swiper-slide>
                <div style="text-align: center; " class="experienced_footer_col col-sm-3">
                <img class="experienced_footer_col_img" src="<?php echo $local ?>/images/users/user_3.webp" alt="">
                <div class="experienced_footer_col_title">trần minh đức</div>
                <span class="experienced_footer_col_text">CK: Xét nghiệm</span>
            </div>
                </swiper-slide>
                <swiper-slide>
                <div style="text-align: center; " class="experienced_footer_col col-sm-3">
                <img class="experienced_footer_col_img" src="<?php echo $local ?>/images/users/user_4.webp" alt="">
                <div class="experienced_footer_col_title">trần minh đức</div>
                <span class="experienced_footer_col_text">CK: Hồi phục chức năng</span>
            </div>
                </swiper-slide>
            </swiper-container>

        </div>
    </div>
</section>

<section class="container" id="advise">
    <img style=" width:100%" src="<?php echo $local ?>/images/banner/bg-03.webp" alt="">
    <div class="advise_row row">
        <div class="advise_row_left col-5 col-sm-5">nhận tư vấn sức khỏe từ
            các chuyên gia của chúng tôi</div>
        <div class="advise_row_left_right col-7 col-sm-7">
            <input class="advise_row_left_right_input" type="text" placeholder="Nhập số điện thoại">
            <button class="advise_row_left_right_bottom">gửi</button>
        </div>
    </div>
</section>

<section class="container" id="feedback">
    <div class="feedback_row row">
        <div class="feedback_col col-sm-8">
            <swiper-container class="mySwiper" space-between="30" pagination="true" pagination-clickable="true">
                <swiper-slide>
                    <div class="row">
                        <div class="col-sm-6">
                            <img width="100%" height="400px" src="<?php echo $local ?>/images/users/user_6.webp" alt="">
                        </div>
                        <div class="feedback_row_right col-sm-6">
                            <div class="feedback_row_right_title">
                                Phản hồi từ khách hàng

                            </div>
                            <hr>
                            </hr>
                            <div class="feedback_row_right_text">
                                “Mình bị viêm da cũng khá nặng, đã chữa trị nhiều nơi nhưng không khỏi. Mình biết đến Phòng khám Đa khoa Nhật Việt qua một người bạn.
                                Khi mình đến khám, bác sĩ và nhân viên phòng khám hướng dẫn mình rất chi tiết trong từng hạng mục.
                                Từ chẩn đoán, xét nghiệm đến điều trị bệnh đều được thực hiện nhanh chóng và hiệu quả. Nhờ đó, đến nay mình đã khỏi hẳn và không phải lo lắng bệnh tái phát.”
                            </div>
                            <hr>
                            </hr>
                            <div class="feedback_row_right_name">Chị Kim Oanh
                            </div>
                            <span class="feedback_row_right_nv">Tân Phú (Nhân viên văn phòng).</span>
                        </div>
                    </div>
                </swiper-slide>
                <swiper-slide>
                    <div class="row">
                        <div class="col-sm-6">
                            <img width="100%" height="400px" src="<?php echo $local ?>/images/users/user_hieu.webp" alt="">
                        </div>
                        <div class="feedback_row_right col-sm-6">
                            <div class="feedback_row_right_title">
                                Phản hồi từ khách hàng

                            </div>
                            <hr>
                            </hr>
                            <div class="feedback_row_right_text">
                                “Công việc của Hiếu khá bận nên thời gian rảnh rất ít. Do đó Hiếu đã chọn thăm khám nam khoa tại Đa Khoa Nhật Việt qua Đặt hẹn Online.
                                Đội ngũ nhân viên phòng khám rất dễ thương, thân thiện và nhẹ nhàng trong tiếp đón. Các Y – Bác ai cũng nhiệt tình, chu đáo và tận tâm.
                                Hiếu cảm thấy rất may mắn và hài lòng khi mình đã tin chọn phòng khám Đa khoa Nhật Việt.”
                            </div>
                            <hr>
                            </hr>
                            <div class="feedback_row_right_name">Anh Trung Hiếu

                            </div>
                            <span class="feedback_row_right_nv">Bình Dương (Hướng dẫn viên Du lịch).</span>
                        </div>
                    </div>
                </swiper-slide>
                <swiper-slide>
                    <div class="row">
                        <div class="col-sm-6">
                            <img width="100%" height="400px" src="<?php echo $local ?>/images/users/user_khai.webp" alt="">
                        </div>
                        <div class="feedback_row_right col-sm-6">
                            <div class="feedback_row_right_title">
                                Phản hồi từ khách hàng

                            </div>
                            <hr>
                            </hr style="">
                            <div class="feedback_row_right_text">
                                “Hải mới có chuyến công tác ở Sài Gòn nên tranh thủ cùng bạn đi làm xét nghiệm Bệnh xã hội tại Phòng khám Đa khoa Nhật Việt.
                                Theo Hải thì chất lượng phòng khám là khỏi chê, đội ngũ nhân viên y, bác sĩ rất thân thiện và nhiệt tình. Thời gian trả kết quả cũng rất nhanh, cái chính là an toàn và bảo mật.
                                Đây là điều mà Hải cảm thấy hài lòng nhất, xin cám ơn Đa khoa Nhật Việt!”
                            </div>
                            <hr>
                            </hr>
                            <div class="feedback_row_right_name">Anh Minh Hải

                            </div>
                            <span class="feedback_row_right_nv"> Bà Rĩa Vũng Tàu (Kiến trúc sư công trình).</span>
                        </div>
                    </div>
                </swiper-slide>
            </swiper-container>
        </div>
        <div class="feedback_row_col col-sm-4">
            <div class="feedback_row_right_title">
                bài viết gần đây

            </div>
            <hr style="width: 100%;" class="feedback_hr">
            <?php
            if ($danhSachBaiVietTheoKhoa) {
                for ($i = 0; $i < count($danhSachBaiVietTheoKhoa); $i++) {
                    $result = $danhSachBaiVietTheoKhoa[$i];
                    $text = $result['descriptions'];
                    $tieu_de = $result['tieu_de'];
            ?>
                    <a onclick="setkhoaBenhSession('<?php echo addslashes($result['slug_khoa']); ?>', '<?php echo addslashes($result['slug_benh']); ?>');" style="text-decoration: none; color: black;" href="<?php echo $local ?>/<?php echo $result['slug_khoa'] ?>/<?php echo $result['slug'] ?>.html">
                        <div class="feedback_row_col_card">
                            <img style="min-width: 70px;" src="<?php echo $local ?>/admin/uploads/<?php echo $result['img'] ?>" alt="">
                            <div class="feedback_row_col_card_text">
                                <?php echo htmlspecialchars($tieu_de); ?>
                            </div>
                        </div>
                    </a>
            <?php
                }
            }
            ?>
        </div>
    </div>
</section>
<img id="bg-ngang" width="100%" height="200px" src="<?php echo $local ?>/images/banner/bg_4.webp" alt="">

<!-- tin tuc pc -->
<section class="container tintuc_pc" id="tintuc">
    <div class="tintuc">tin tức mới nhất</div>
    <swiper-container style="height: 390px;" class="mySwiper" pagination="true" pagination-clickable="true" space-between="30" slides-per-view="3">
        <?php if ($tin_tuc_all_news) {
            while ($result = $tin_tuc_all_news->fetch_assoc()) {
                $text = $result['descriptions'];
                if (strlen($text) > 100) {
                    $text = substr($text, 0, 100) . '...';
                }
        ?>
                <swiper-slide>
                    <a style="text-decoration: none;" href="<?php echo $local ?>/<?php echo $result['slug'] ?>.html">
                        <div style="border: 3px solid #01969A; border-radius: 50px ">
                            <img style="border-radius: 46px; object-fit: fill; " width="100%" height="240px" src="<?php echo $local ?>/admin/uploads/<?php echo $result['img'] ?>" alt="">
                        </div>
                        <div class="mySwiper_title">
                            <?php echo $result['title'] ?>
                        </div>
                        <div class="mySwiper_text"><?php echo htmlspecialchars($text); ?></div>
                    </a>
                </swiper-slide>
        <?php }
        } ?>
    </swiper-container>
</section>

<?php
// Đặt lại con trỏ kết quả về đầu tiên
if ($tin_tuc_all_news) {
    $tin_tuc_all_news->data_seek(0);
}
?>

<!-- tin tuc mobile -->
<section class="container tintuc_mobile" id="tintuc">
    <div class="tintuc">tin tức mới nhất</div>
    <swiper-container style="height: 390px;" class="mySwiper" pagination="true" pagination-clickable="true" space-between="30" slides-per-view="1">
        <?php if ($tin_tuc_all_news) {
            while ($result = $tin_tuc_all_news->fetch_assoc()) {
                $text = $result['descriptions'];
                if (strlen($text) > 100) {
                    $text = substr($text, 0, 100) . '...';
                }
        ?>
                <swiper-slide>
                    <a style="text-decoration: none;" href="<?php echo $local ?>/<?php echo $result['slug'] ?>.html">
                        <div style="border: 3px solid #01969A; border-radius: 50px ">
                            <img style="border-radius: 46px; object-fit: fill; " width="100%" height="240px" src="<?php echo $local ?>/admin/uploads/<?php echo $result['img'] ?>" alt="">
                        </div>
                        <div class="mySwiper_title">
                            <?php echo $result['title'] ?>
                        </div>
                        <div class="mySwiper_text"><?php echo htmlspecialchars($text); ?></div>
                    </a>
                </swiper-slide>
        <?php }
        } ?>
    </swiper-container>
</section>

<!-- <form action="" method="POST">
    <div class="row mb-2">
        <div class="col-12 col-lg-6">
            <input id="name" class="form-control col-12 " type="text" name="name" placeholder="tên">
        </div>
    </div>

    <div class="button_register">
        <button  type="submit" class="bg-success " name="submit">Create</button>
       
    </div>
</form>
<button onclick="onClickToast()" id="button" name="submit" class="bg-success " >Save AJAX</button> -->

<?php include 'inc/footer.php'; ?>