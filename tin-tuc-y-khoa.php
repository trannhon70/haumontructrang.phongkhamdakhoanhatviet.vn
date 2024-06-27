<?php
include 'inc/header.php';
$getAllLimit = $tin_tuc->getAllLimitTinTuc();
$getOneLimit = $tin_tuc->getOneLimitTinTuc();

// Lấy URL hiện tại
$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// $current_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


$url_parts = parse_url($current_url);

$path = $url_parts['path'];

$path_parts = explode('/', trim($path, '/'));

if (isset($path_parts[1]) && $path_parts[1] !== 'tin-tuc-y-khoa') {
    $file_name = $path_parts[1];
    $slugTinTuc = explode('.', basename($file_name))[0];
    // Kiểm tra nếu $file_name không phải là 'tin-tuc-y-khoa.html'
    if ($file_name !== 'tin-tuc-y-khoa.html') {
        $getByIdTT = $tin_tuc->getByslug_tintuc($slugTinTuc);
    }
}

// if (isset($path_parts[0]) && $path_parts[0] !== 'tin-tuc-y-khoa') {
//     $file_name = $path_parts[0];
//     $slugTinTuc = explode('.', basename($file_name))[0];
//     // Kiểm tra nếu $file_name không phải là 'tin-tuc-y-khoa.html'
//     if ($file_name !== 'tin-tuc-y-khoa.html') {
//         $getByIdTT = $tin_tuc->getByslug_tintuc($slugTinTuc);
//     }
// }

?>

<style>
    .no-tintuc {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        height: 500px;
    }

    .health_row_col_card {
        display: flex !important;
        margin-top: 15px;
    }

    .health_row_col_card_left {
        height: 200px;
        width: 200px;

        border: 2px solid transparent;
        border-color: #067579;
        border-image-slice: 1;
        border-radius: 20px;
    }

    .health_row_col_card_right {
        margin-left: 15px;

    }

    .health_row_col_card_right_title {
        font-size: 20px;
        font-weight: 700;
        line-height: 35px;
        color: rgba(0, 96, 167, 1);
        text-transform: uppercase;
    }

    .health_row_col_card_right_text {
        font-size: 18px;
        font-weight: 400;
        line-height: 30px;
        height: 80px;
        color: black;
    }

    .health_row_col_card_right_footer {}

    .health_row_col_card_right_footer_botton {
        cursor: pointer;
        font-size: 21px;
        font-weight: 700;
        text-transform: uppercase;
        line-height: 53px;
        background-color: #01969A;
        background-image: linear-gradient(to right, #01969A, #50e2e7);
        width: 190px;
        color: white;
        border: none;
        border-radius: 30px;
    }

    .health_row_col_card_right_footer_botton:hover {
        background-image: linear-gradient(to right, #01969A, #3dafb3);
        transition: all 0.5s;
    }

    .health_row_col_card_right_footer_botton1 {
        cursor: pointer;
        font-size: 21px;
        font-weight: 700;
        text-transform: uppercase;
        line-height: 53px;
        background-color: white;
        width: 190px;
        color: #01969A;
        border: 2px solid #01969A;
        border-radius: 30px;
        margin-left: 10%;
    }

    .health_row_col_pagi {}

    .health_row_col_footer_pagi {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 30px;
        gap: 15px;
    }


    .health_row_col_footer_pagi_next {
        width: 35px;
        height: 35px;
        background-color: #00D8D8;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        cursor: pointer;
    }

    /* .health_row_col_footer_pagi_next:hover, */
    .health_row_col_footer_pagi_next:focus,
    .health_row_col_footer_pagi_next:active {
        background-color: #1c6f71;
        transition: all 0.2s;
    }

    .health_row_col_footer_pagi_prev {
        width: 35px;
        height: 35px;
        background-color: #00D8D8;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        cursor: pointer;
    }

    .health_row_col_footer_pagi_prev:focus,
    .health_row_col_footer_pagi_prev:active {
        background-color: #1c6f71;
        transition: all 0.2s;
    }

    .health_row_col_footer_pagi_number {
        font-size: 20px;
        font-weight: 600;
        width: 35px;
        height: 35px;
        background-color: #00D8D8;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        cursor: pointer;
        color: white;
    }

    .health_row_col_footer_pagi_number:focus,
    .health_row_col_footer_pagi_number:active {
        background-color: #1c6f71;
        transition: all 0.2s;
    }

    .health_row_col_footer_pagi_number_active {
        background-color: #1c6f71;
    }

    .health_row_col_footer_share {
        margin-top: 30px;
    }

    .health_row_col_footer_share_text {
        color: #01969A;
        font-size: 24px;
        font-weight: 700;
        line-height: 36px;
        text-align: center;
        text-transform: uppercase;
    }

    .health_row_col_footer_share_icon {
        margin-top: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 100px;
    }

    .active_menu_tab {
        color: #008DBA;
        transition: 0.5s;
        background-color: #23dee448;
    }

    .chinh-sua {
        background-color: #e1b564;
        color: white;
        font-size: 18px;
        font-weight: 500;
        padding: 2px 10px;
        border-radius: 7px;
    }

    .chinh-sua:hover {
        background-color: #d79f39;
        transition: 1s;
    }

    .health_row_col_title_tin_tuc {
        margin-top: 20px;
        color: white;
        font-size: 23px;
        font-weight: 700;
        text-transform: uppercase;
        background-color: #008DBA;
        padding: 10px 15px;
    }
    .view {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 10px 20px;
        background-color: #666;
        color: white;
        border: none;
        cursor: pointer;
        width: 600px;
        height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .view_button {
        position: absolute;
        top: 63%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 10px 20px;
        background-color: white;
        color: #999;
        border: none;
        cursor: pointer;
        z-index: 1000;
        border-radius: 10px;
        border: none;
    }

    .hidden {
        display: none;
    }

    .image-container {
        position: relative;
        display: inline-block;
    }

    .hiden_img {
        /* margin-bottom: 10px; */
        position: relative;
    }
</style>

<section class="container" id="health">
    <div class=" health_row row">
        <div class="health_row_col col-sm-4">
            <span>tin tức</span>
            <?php if ($getAllLimit) {
                while ($result = $getAllLimit->fetch_assoc()) {
                    $slug = $result['slug'];
                    $activeClass = ($slugTinTuc === $slug) ? 'active_menu_tab' : '';
            ?>
                    <a href="<?php echo $local ?>/<?php echo $result['slug'] ?>.html">
                        <div class="health_row_col_div <?php echo $activeClass ?>"><?php echo  $result['tieu_de'] ?></div>
                    </a>
            <?php }
            } ?>

            <div action="" method="post" class="health_row_col_box">
                <form action="" method="post">
                    <div class="health_row_col_box_title">Tư vấn trực tuyến</div>
                    <div class="health_row_col_box_input">
                        <input type="text" placeholder="Họ tên">
                    </div>

                    <!-- <div class="form-group health_row_col_box_input">
                        <div class="datepicker date input-group">
                            <input type="text" placeholder="Ngày sinh" class="form-control" id="fecha1">
                            <div style="height: 40px;" class="input-group-append">
                                <span style="border-bottom: 2px solid transparent;" class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div> -->
                    <div class="health_row_col_box_input">
                        <input type="number" placeholder="Ngày tháng năm sinh">
                    </div>
                    <div class="health_row_col_box_input">
                        <input type="number" placeholder="Số điện thoại">
                    </div>
                    <div class="health_row_col_box_input">
                        <input type="text" placeholder="Mô tả triệu chứng của bạn">
                    </div>

                    <div style="display: flex; align-items: center;justify-content: center; ">
                        <button class="health_row_col_box_button">gửi</button>

                    </div>
                </form>
            </div>
            <a href="" class="w-100 mt-3">
                <img class="w-100 mt-3" style="border-radius: 10px;" src="<?php echo $local ?>/images/banner/banner_khuyen_mai.webp " alt="...">
            </a>
        </div>
        <div class="health_row_col col-sm-8">
            <?php if (Session::get('role') === 'admin') {

            ?>
                <a class="chinh-sua" href="<?php echo $local ?>/admin/tin-tuc-edit.php?edit=<?php echo $getByIdTT['id'] ?>"><i style="font-size: 19px;" class='bx bxs-pencil'></i> chỉnh sửa</a>
            <?php } ?>
            <?php if (isset($getByIdTT)) { ?>
                <h1 class="health_row_col_title_tin_tuc">
                    <span><?php echo $getByIdTT['tieu_de'] ?></span>
                </h1>
                <hr>
                <div id="bai-viet" class="">

                    <?php echo htmlspecialchars_decode($getByIdTT['content']); ?>

                </div>
            <?php } else { ?>

                <h1 class="health_row_col_title_tin_tuc">
                    <span><?php echo $getOneLimit['tieu_de'] ?></span>
                </h1>
                <hr>
                <div id="bai-viet" class="">

                    <?php echo htmlspecialchars_decode($getOneLimit['content']); ?>

                </div>
            <?php } ?>
            <div class="bai-viet-footer">
                Nội dung bài viết cung cấp nhằm mục đích tham khảo thêm kiến thức y tế, một số nội dung có thể không thuộc nghiệp vụ của phòng khám chúng tôi, Hiệu quả của việc hỗ trợ điều trị phụ thuộc vào cơ địa của mỗi người. Cần biết thông tin liên hệ để được tư vấn trực tuyến miễn phí. <a href="#">[TƯ VẤN TRỰC TUYẾN]</a>
            </div>
        </div>
    </div>
</section>
<!-- // Đặt lại con trỏ dữ liệu về đầu -->
<?php $getAllLimit->data_seek(0); ?>
<!-- mobile tin tuc -->
<section id="health_tintuc_mobile">
    <div style="padding: 10px 10px;">
        <span style="font-size: 16px; font-weight: 700; color: #166B85; border-bottom: 2px solid #166B85; text-transform: uppercase; ">tin tức</span>
        <?php if ($getAllLimit) {
            while ($result = $getAllLimit->fetch_assoc()) {
                $slug = $result['slug'];
                $activeClass = ($slugTinTuc === $slug) ? 'active_menu_tab' : '';
        ?>
                <a href="<?php echo $local ?>/<?php echo $result['slug'] ?>.html">
                    <div style="font-size: 12px; line-height: 21px; text-transform: capitalize; " class="health_row_col_div <?php echo $activeClass ?>"><?php echo  $result['tieu_de'] ?></div>
                </a>
        <?php }
        } ?>
    </div>
    <div class="health_row_col mt-2 ">
        <?php if (Session::get('role') === 'admin') {

        ?>
            <a style="margin-left: 10px;" class="chinh-sua" href="<?php echo $local ?>/admin/tin-tuc-edit.php?edit=<?php echo $getByIdTT['id'] ?>"><i style="font-size: 19px;" class='bx bxs-pencil'></i> chỉnh sửa</a>
        <?php } ?>
        <?php if (isset($getByIdTT)) { ?>
            <h1 class="health_row_col_title_tin_tuc">
                <span><?php echo $getByIdTT['tieu_de'] ?></span>
            </h1>
            <div id="banner_km_mobile" style="width: 100%;">
                <img width="100%" src="<?php echo $local ?>/images/logo_mobile/bg_mobile_km.gif" alt="">
            </div>
            <hr>
            <div id="bai-viet" class="">

                <?php echo htmlspecialchars_decode($getByIdTT['content']); ?>

            </div>
        <?php } else { ?>

            <h1 class="health_row_col_title_tin_tuc">
                <span><?php echo $getOneLimit['tieu_de'] ?></span>
            </h1>
            <div id="banner_km_mobile" style="width: 100%;">
                <img width="100%" src="<?php echo $local ?>/images/logo_mobile/bg_mobile_km.gif" alt="">
            </div>
            <hr>
            <div id="bai-viet" class="">

                <?php echo htmlspecialchars_decode($getOneLimit['content']); ?>

            </div>
        <?php } ?>
        <div class="bai-viet-footer">
            Nội dung bài viết cung cấp nhằm mục đích tham khảo thêm kiến thức y tế, một số nội dung có thể không thuộc nghiệp vụ của phòng khám chúng tôi, Hiệu quả của việc hỗ trợ điều trị phụ thuộc vào cơ địa của mỗi người. Cần biết thông tin liên hệ để được tư vấn trực tuyến miễn phí. <a href="#">[TƯ VẤN TRỰC TUYẾN]</a>
        </div>
    </div>

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
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const shockElements = document.querySelectorAll('.shock_img');
        shockElements.forEach(shockElement => {

            shockElement.classList = 'hiden_img'
            const viewdiv = document.createElement('div');
            viewdiv.id = 'viewdiv';
            viewdiv.className = 'view';
            viewdiv.textContent = 'Hình ảnh có nội dung gây shock !! cân nhất trước khi xem';

            const viewbutton = document.createElement('button');
            viewbutton.id = 'viewbutton';
            viewbutton.className = 'view_button';
            viewbutton.textContent = 'click vào xem';
            // Append the button to the parent of the shockElement (image-container)
            shockElement.appendChild(viewdiv);
            shockElement.appendChild(viewbutton);

            // Add click event listener to the button
            viewbutton.addEventListener('click', () => {
                // Remove the blur effect
                shockElement.classList.remove('blurred');
                shockElement.classList.remove('hiden_img');
                // Hide the button
                viewdiv.classList.add('hidden');
                viewbutton.classList.add('hidden');
            });
        })
    });
</script>
<script>
    // Lấy phần tử có id là 'bai-viet'
    let baiVietElement = document.getElementById('bai-viet');
    if (baiVietElement) {
        let pElements = baiVietElement.getElementsByTagName('p');
        for (let i = 0; i < pElements.length; i++) {
            pElements[i].style.color = '#000000'; // Ghi đè CSS trước đó
            pElements[i].style.fontWeight = 400;
            pElements[i].style.fontSize = '13px';
            pElements[i].style.lineHeight = '27px';
            // pElements[i].style.textAlign = 'justify';
        }

        let imgElements = baiVietElement.getElementsByTagName('img');
        if (imgElements) {
            for (let i = 0; i < imgElements.length; i++) {
                // convert link img
                if (imgElements[i].src.startsWith('<?php echo $local ?>/ckeditor/uploads/') == true) {
                    let urlParts = imgElements[i].src.split('/');
                    let fileName = urlParts[urlParts.length - 1];
                    imgElements[i].src = '<?php echo $local ?>/admin/ckeditor/uploads/' + fileName;
                }
                //hiển thị css img chatbox
                if (imgElements[i].src.startsWith('https://benhxahoi.phongkhamdakhoanhatviet.vn/ckfinder/userfiles/images/Chat/Chat-Dakhoa.gif') == true) {
                    imgElements[i].style.borderRadius = '8px';
                    let divWrapper = document.createElement('p');
                    divWrapper.className = 'glow-on-hover';
                    imgElements[i].parentNode.insertBefore(divWrapper, imgElements[i]);
                    divWrapper.appendChild(imgElements[i])
                }
            }

        }
    }
</script>
<script>
    // Lấy phần tử có id là 'bai-viet'
    let baiVietElement1 = document.getElementById('bai-viet');
    if (baiVietElement) {
        let h2Elements = baiVietElement.getElementsByTagName('h2');
        for (let i = 0; i < h2Elements?.length; i++) {
            h2Elements[i].style.color = '#0060A7';
            h2Elements[i].style.fontWeight = '700';
            h2Elements[i].style.fontSize = '25px';
            h2Elements[i].style.textTransform = 'capitalize';
            // h2Elements[i].style.marginLeft = '10px';
            h2Elements[i].style.background = 'url("<?php echo $local ?>/images/icons/icon_cong.webp") no-repeat left center';
            h2Elements[i].style.backgroundSize = '30px 30px';
            h2Elements[i].style.paddingLeft = '35px';

        }

        let h3Element = baiVietElement.getElementsByTagName('h3');

        for (let i = 0; i < h3Element.length; i++) {
            h3Element[i].style.color = '#00D8D8';
            h3Element[i].style.fontWeight = '700';
            h3Element[i].style.fontSize = '21px';
            h3Element[i].style.textTransform = 'capitalize';
            // h3Element[i].style.marginLeft = '10px';
            h3Element[i].style.background = 'url("<?php echo $local ?>/images/icons/icon_mui.gif") no-repeat left center';
            h3Element[i].style.backgroundSize = '23px 23px';
            h3Element[i].style.paddingLeft = '35px';
        }
    }
</script>
<?php include 'inc/footer.php'; ?>