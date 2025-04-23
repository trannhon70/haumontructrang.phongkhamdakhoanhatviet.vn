<?php
session_start();
include 'lib/session.php';

Session::init();


?>

<?php
include_once 'lib/database.php';
include_once 'helpers/format.php';
include_once 'classes/brand.php';
include_once 'classes/user.php';
include_once 'classes/bai_viet.php';
include_once 'classes/tin_tuc.php';
include_once 'classes/benh.php';

spl_autoload_register(function ($className) {
    include_once "classes/" . $className . ".php";
});

$db = new Database();
$fm = new Format();
$brand = new brand();
$user = new users();
$bai_viet = new post();
$tin_tuc = new news();
$benhs = new Benh();

?>
<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");

// $local = '/haumontructrang.phongkhamdakhoanhatviet.vn';
$local ='https://haumontructrang.phongkhamdakhoanhatviet.vn'


?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Phòng khám Nhật việt chuyên điều trị bệnh nam khoa, bệnh xã hội, da liễu, hậu môn - trực tràng uy tính tại thành phố Hồ Chí Minh">
    <title>Phòng khám Nhật Việt</title>
    <link rel="icon" href="<?php echo $local ?>/images/icons/icon_logo.png" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo $local ?>/css/toastr.min.css" />
    <link rel="stylesheet" href="<?php echo $local ?>/css/slide.min.css" />
    <link rel="stylesheet" href="<?php echo $local ?>/css/header.min.css" />
    <link rel="stylesheet" href="<?php echo $local ?>/css/footer.min.css" />
    <link rel="stylesheet" href="<?php echo $local ?>/css/config.min.css" />
    <link rel="stylesheet" href="<?php echo $local ?>/css/trang-chu.min.css" />
    <link rel="stylesheet" href="<?php echo $local ?>/css/mobile.min.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- font-awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- datepicker styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">


    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>



    <style>
        *{
            scroll-behavior: smooth;
        }
        html,
        body {
            min-height: 100vh;
            width: 100%;
            overflow-x: hidden;

        }

        .header_bottom_dm {
            position: relative;
        }



        .dropdown_menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0%;
            z-index: 1000;
            height: auto;
            width: 216%;

        }

        .header_bottom_dm:hover .dropdown_menu {
            display: block;
        }

        .dropdown_menu_body {
            border-top: 4px solid #edefef;
            background-color: #0077C8;
            color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            display: flex;
            gap: 30px;
        }

        .dropdown_menu_body_ul {
            list-style: none;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .dropdown_menu_body_ul_li {
            border-bottom: 1px solid white;
            align-items: center;
            padding: 2px 0px;
            width: 49.3%;
            display: inline-block;
        }

        .dropdown_menu_body_ul_li:hover {
            background-color: #004F85;
            transition: 0.5s;
            color: white;
        }

        .dropdown_menu_body_ul_li_h5 {
            font-size: 16px;
            font-weight: 700;
            line-height: 34px;
            color: white;
            text-transform: uppercase;
            border-bottom: 2px solid rgba(0, 216, 216, 1);
        }

        .dropdown_menu_body_ul_li_a {
            text-decoration: none !important;
            font-size: 14px;
            font-weight: 700;
            line-height: 32px;
            text-transform: capitalize;
            color: white;
            width: 100%;
        }

        .dropdown_menu_body_ul_li_a:hover {
            color: white !important;
        }

        .active_menu_tab {
            color: #0077C8;
            transition: 0.5s;
            background: #0077C833;

        }
    </style>
</head>

<?php
$MenuNamkhoa = array(
    array('id' => 'benh-bao-quy-dau', 'title' => 'bệnh bao quy đầu', 'link' => '/nam-khoa/benh-bao-quy-dau.html', 'session' => '/nam-khoa/benh-bao-quy-dau'),
    array('id' => 'roi-loan-xuat-tinh', 'title' => 'rối loạn xuất tinh', 'link' => '/nam-khoa/roi-loan-xuat-tinh.html', 'session' => '/nam-khoa/roi-loan-xuat-tinh'),
    array('id' => 'benh-tinh-hoan', 'title' => 'bệnh tinh hoàn', 'link' => '/nam-khoa/benh-tinh-hoan.html', 'session' => '/nam-khoa/benh-tinh-hoan'),
    array('id' => 'benh-tuyen-tien-liet', 'title' => 'bệnh tuyến tiền liệt', 'link' => '/nam-khoa/benh-tuyen-tien-liet.html', 'session' => '/nam-khoa/benh-tuyen-tien-liet'),
    array('id' => 'benh-duong-tiet-nieu', 'title' => 'bệnh đường tiết niệu', 'link' => '/nam-khoa/benh-duong-tiet-nieu.html', 'session' => '/nam-khoa/benh-duong-tiet-nieu'),
    array('id' => 'chinh-hinh-duong-vat', 'title' => 'chỉnh hình dương vật', 'link' => '/nam-khoa/chinh-hinh-duong-vat.html', 'session' => '/nam-khoa/chinh-hinh-duong-vat'),
    array('id' => 'vo-sinh-hien-muon', 'title' => 'vô sinh hiến muộn', 'link' => '/nam-khoa/vo-sinh-hien-muon.html', 'session' => '/nam-khoa/vo-sinh-hien-muon'),
    array('id' => 'roi-loan-chuc-nang-sinh-duc', 'title' => 'rối loạn chức năng sinh dục', 'link' => '/nam-khoa/roi-loan-chuc-nang-sinh-duc.html', 'session' => '/nam-khoa/roi-loan-chuc-nang-sinh-duc'),

);



$MenuDaLieu = array(
    array('id' => 'nam-da', 'title' => 'Nấm da', 'link' => '/da-lieu/nam-da.html', 'session' => '/da-lieu/nam-da'),
    array('id' => 'viem-da', 'title' => 'viêm da', 'link' => '/da-lieu/viem-da.html', 'session' => '/da-lieu/viem-da'),
    array('id' => 'vay-nen', 'title' => 'vảy nến', 'link' => '/da-lieu/vay-nen.html', 'session' => '/da-lieu/vay-nen'),
    array('id' => 'nam-mong', 'title' => 'nấm móng', 'link' => '/da-lieu/nam-mong.html', 'session' => '/da-lieu/nam-mong'),
    array('id' => 'mun-nhot', 'title' => 'mụn nhọt', 'link' => '/da-lieu/mun-nhot.html', 'session' => '/da-lieu/mun-nhot'),
    array('id' => 'mun-coc', 'title' => 'mụn cóc', 'link' => '/da-lieu/mun-coc.html', 'session' => '/da-lieu/mun-coc'),
    array('id' => 'benh-zona', 'title' => 'bệnh zona', 'link' => '/da-lieu/benh-zona.html', 'session' => '/da-lieu/benh-zona'),
    array('id' => 'benh-cham', 'title' => 'bệnh chàm', 'link' => '/da-lieu/benh-cham.html', 'session' => '/da-lieu/benh-cham'),
    array('id' => 'san-ngua', 'title' => 'sẩn ngứa', 'link' => '/da-lieu/san-ngua.html', 'session' => '/da-lieu/san-ngua'),
    array('id' => 'benh-ghe', 'title' => 'bệnh ghẻ', 'link' => '/da-lieu/benh-ghe.html', 'session' => '/da-lieu/benh-ghe'),
);

$MenuBXH = array(
    array('id' => 'sui-mau-ga', 'title' => 'sùi màu gà', 'link' => '/benh-xa-hoi/sui-mau-ga.html', 'session' => '/benh-xa-hoi/sui-mau-ga'),
    array('id' => 'benh-lau', 'title' => 'bệnh lậu', 'link' => '/benh-xa-hoi/benh-lau.html', 'session' => '/benh-xa-hoi/benh-lau'),
    array('id' => 'giang-mai', 'title' => 'giang mai', 'link' => '/benh-xa-hoi/giang-mai.html', 'session' => '/benh-xa-hoi/giang-mai'),
    array('id' => 'mun-sinh-duc', 'title' => 'mụn sinh dục', 'link' => '/benh-xa-hoi/mun-sinh-duc.html', 'session' => '/benh-xa-hoi/mun-sinh-duc'),
    array('id' => 'ran-mu', 'title' => 'rận mu', 'link' => '/benh-xa-hoi/ran-mu.html', 'session' => '/benh-xa-hoi/ran-mu'),
);
$MenuHM = $benhs->getDanhSachBenhByIdKhoa(4);


?>
<?php
$khoa = isset($_GET['khoa']) ? $_GET['khoa'] : null;
$benh = isset($_GET['benh']) ? $_GET['benh'] : null;
$baiViet = isset($_GET['bai-viet']) ? $_GET['bai-viet'] : null;
$sessionBenh = Session::get('benh');
$sessionkhoa = Session::get('khoa');
// echo $baiViet;
?>



<body>
    <!-- header PC -->
    <div id="header" class="container-fluid">
        <div class="container">

            <div class=" header_top row">
                <div class="header_top_left col-sm-4">
                    <img class="header_top_left_img" src="<?php echo $local ?>/images/logo/logo2.webp" alt="">
                </div>
                <div class="header_top_right col-sm-8">
                    <div class="header_top_right_row row">
                        <div class="header_top_right_row_col col-sm-4">
                            <div class="row">
                                <div class="header_top_right_row_col_icon col-sm-3 ">
                                    <img width="40px" style="height: 40px;" sty src="<?php echo $local ?>/images/icons/icon_phone.webp" alt="">
                                </div>
                                <div class="header_top_right_row_col_text col-sm-9">
                                    <div>
                                        Đường dây nóng
                                    </div>
                                    <span>028-7776-7777</span>
                                </div>
                            </div>
                        </div>
                        <div style="padding-left: 0px; transform: translate(-20px , 0px); " class="col-sm-4">
                            <div class="row">
                                <div class="header_top_right_row_col_icon col-sm-3 ">
                                    <img width="40px" style="height: 40px;" sty src="<?php echo $local ?>/images/icons/icon_user.webp" alt="">
                                </div>
                                <div class="header_top_right_row_col_text col-sm-9">
                                    <div>
                                        Giờ làm việc <br> 8:00 - 20:00
                                    </div>
                                    <h5>
                                        Tất cả các ngày trong
                                        tuần, kể cả ngày lễ</h5>
                                </div>
                            </div>
                        </div>
                        <div style="padding-left: 0px; transform: translate(-20px , 0px); " class="col-sm-4">
                            <div class="row">
                                <div class="header_top_right_row_col_icon col-sm-3 ">
                                    <img width="40px" style="height: 40px;" sty src="<?php echo $local ?>/images/icons/icon_location.webp" alt="">
                                </div>
                                <div class="header_top_right_row_col_text col-sm-9">
                                    <div>
                                        Địa chỉ

                                    </div>
                                    <h5>
                                        73 Kinh Dương Vương,
                                        <br>
                                        P.12, Q.6, TP.HCM
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="background-color: #0077C8;">

            <div style="background-color: #0077C8;" class="container header_bottom">
                <a href="<?php echo $local ?>/index.html" class="header_bottom_icon">
                    <img height="auto" width="35px" src="<?php echo $local ?>/images/icons/icon_home.webp" alt="...">
                </a>
                <div class="header_bottom_gt"> <a class="header_bottom_gt_a" target="_blank" href="https://haumontructrang.phongkhamdakhoanhatviet.vn/phong-kham-da-nhat-viet-phong-kham-da-khoa-uy-tin-tphcm-7.html">Giới thiệu</a></div>
                <div class="header_bottom_dm">

                    <a class="header_bottom_gt_a" href="#">hậu môn - trực tràng</a>
                    <!-- <div class="dropdown_menu">
                        <div style="height: 10px;"></div>
                        <div class="dropdown_menu_body">
                                <ul class="dropdown_menu_body_ul">
                                <?php foreach ($MenuHM as $value) : $activeClass = ($value['slug'] === $sessionBenh) ? 'active_menu_tab' : ''; ?>
                                    <li onclick="saveLinkToSession('<?php echo $value['session']; ?>'); return true;" class="dropdown_menu_body_ul_li <?php echo $activeClass; ?>"><a class="dropdown_menu_body_ul_li_a" href="<?php echo $local . $value['link'] ?>"><?php echo $value['name'] ?></a></li>
                                <?php endforeach; ?>
                            </ul> 
                        </div>
                    </div> -->

                </div>
                <div style="position: relative;" class="header_bottom_gk"><a class="header_bottom_gt_a" href="<?php echo $local ?>/tin-tuc-y-khoa.html">tin tức y khoa</a>
                    <img style="top: -10px; right:0; width: 40px; position:absolute" class="header_bottom_gk_img absolute" src="<?php echo $local ?>/images/icons/icon_new.webp" alt="...">
                </div>
                <div class="header_bottom_item"><a class="header_bottom_gt_a" href="#">Tư vấn trực tuyến</a></div>
            </div>
        </div>


    </div>

    <!-- header mobile -->
    <?php include 'mobile/header_moblie.php';
    ?>


    <?php include 'inc/slider.php';
    ?>