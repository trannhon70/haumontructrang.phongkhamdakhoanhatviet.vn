<?php
include 'inc/header.php';


// Lấy URL hiện tại
// $current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$current_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$url_parts = parse_url($current_url);

$path = $url_parts['path'];

$path_parts = explode('/', trim($path, '/'));
$id_slug = '';

if (isset($path_parts[1])) {
    $file_name = $path_parts[1];
    $id_page = explode('.', basename($file_name))[0];
} else {
    $id_page = 1;
}

// if (isset($path_parts[2])) {
//     $file_slug = $path_parts[2];
//     $id_slug = explode('.', basename($file_slug))[0];

//     $get_post_detail = $bai_viet->getBaiViet_bySlug($id_slug);

// }

if(isset($path_parts[1])){
     $file_slug = $path_parts[1];   

    $id_slug = explode('.', basename($file_slug))[0];
    $get_post_detail = $bai_viet->getBaiViet_bySlug($id_slug);
}

?>
<style>
    .health_row_col_card {
        display: flex !important;
        margin-top: 15px;
    }

    .health_row_col_card_left {
        height: 200px;
        width: 200px;

        border: 2px solid transparent;
        border-color: #0077C8;
        border-image-slice: 1;
        border-radius: 20px;
    }

    .health_row_col_card_right {
        margin-left: 15px;

    }

    .health_row_col_card_right_title {
        font-size: 20px;
        font-weight: 700;
        line-height: 27px;
        color: rgba(0, 96, 167, 1);
        text-transform: uppercase;

        overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2; 
    -webkit-box-orient: vertical;
    text-overflow: ellipsis;
    white-space: normal; 
    max-height: 70px; 
    }

    .health_row_col_card_right_text {
        font-size: 18px;
        font-weight: 400;
        line-height: 30px;
       
        color: black;
        overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2; 
    -webkit-box-orient: vertical;
    text-overflow: ellipsis;
    white-space: normal; 
    max-height: 60px; 
    }

    .health_row_col_card_right_footer {
        margin-top: 5px;
    }

    .health_row_col_card_right_footer_botton {
        cursor: pointer;
        font-size: 18px;
        font-weight: 700;
        text-transform: uppercase;
        line-height: 53px;
        background-color: #28BBEA;
        background: linear-gradient(270deg, #5EBEFF 0%, #0077C8 100%);

        width: 190px;
        color: white;
        border: none;
        border-radius: 30px;
        justify-content: center;
        display: flex;
        height: 40px;
        align-items: center;
    }

    .health_row_col_card_right_footer_botton:hover {
        background-image: linear-gradient(to right, #01969A, #3dafb3);
        transition: all 0.5s;
    }

    .health_row_col_card_right_footer_botton1 {
        cursor: pointer;
        font-size: 18px;
        font-weight: 700;
        text-transform: uppercase;
        line-height: 53px;
        background-color: white;
        width: 190px;
        color: #0077C8;
        border: 2px solid #0077C8;
        border-radius: 30px;
        margin-left: 10%;
        justify-content: center;
        display: flex;
        height: 40px;
        align-items: center;
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
        background-color: #28BBEA;
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
        background-color: #28BBEA;
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
        background-color: #28BBEA;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        cursor: pointer;
        color: white;
    }

    .health_row_col_footer_pagi_number:focus,
    .health_row_col_footer_pagi_number:active {
        background-color: #008DBA;
        transition: all 0.2s;
    }

    .health_row_col_footer_pagi_number_active {
        background-color: #008DBA;
    }

    .health_row_col_footer_share {
        margin-top: 30px;
    }

    .health_row_col_footer_share_text {
        color: #0390BD;
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

    .health_row_col_title {
        border-image-slice: 0 !important;
    }
</style>

<section class="container" id="health">
    <div class=" health_row row">
        <div class="health_row_col col-sm-3">
            <span> <?php
                    if ($sessionkhoa === 'nam-khoa') {
                        echo 'nam khoa';
                    } elseif ($sessionkhoa == 'da-lieu') {
                        echo 'da liễu';
                    } elseif ($sessionkhoa == 'benh-xa-hoi') {
                        echo 'bệnh xã hội';
                    } elseif ($sessionkhoa == 'hau-mon-truc-trang') {
                        echo 'hậu môn - trực tràng';
                    }
                    ?> </span>
            <?php
            if ($sessionkhoa === 'nam-khoa') {
                foreach ($MenuNamkhoa as $item) {
                    $activeClass = $item['id'] === $sessionBenh ? 'active_menu_tab' : '';
                    echo '<a onclick="saveBenhToSession(\'' . $item['id'] . '\'); return true;" href="' . $local . $item['link'] . '">';
                    echo '<div class="health_row_col_div ' . $activeClass . '">' . $item['title'] . '</div>';
                    echo '</a>';
                }
            } elseif ($sessionkhoa == 'da-lieu') {
                foreach ($MenuDaLieu as $item) {
                    $activeClass = $item['id'] === $sessionBenh ? 'active_menu_tab' : '';
                    echo '<a onclick="saveBenhToSession(\'' . $item['id'] . '\'); return true;" href="' . $local . $item['link'] . '">';
                    echo '<div class="health_row_col_div ' . $activeClass . '">' . $item['title'] . '</div>';
                    echo '</a>';
                }
            } elseif ($sessionkhoa == 'benh-xa-hoi') {
                foreach ($MenuBXH as $item) {
                    $activeClass = $item['id'] === $sessionBenh ? 'active_menu_tab' : '';
                    echo '<a onclick="saveBenhToSession(\'' . $item['id'] . '\'); return true;" href="' . $local . $item['link'] . '">';
                    echo '<div class="health_row_col_div ' . $activeClass . '">' . $item['title'] . '</div>';
                    echo '</a>';
                }
            } elseif ($sessionkhoa == 'hau-mon-truc-trang') {
                foreach ($MenuHM as $item) {
                    $activeClass = $item['slug'] === $sessionBenh ? 'active_menu_tab' : '';
                    echo '<a onclick="saveBenhToSession(\'' . $item['slug'] . '\'); return true;" href="' . $local . $item['link'] . '">';
                    echo '<div class="health_row_col_div ' . $activeClass . '">' . $item['name'] . '</div>';
                    echo '</a>';
                }
            }

            ?>
            <?php include('inc/form-tu-van.php');  ?>
            <a href="" class="w-100 mt-3">
                <img class="w-100 mt-3" style="border-radius: 10px;" src="<?php echo $local ?>/images/banner/banner_khuyen_mai.webp " alt="...">
            </a>
        </div>
        <div class="health_row_col col-sm-9">
            <?php
            if (isset($get_post_detail)) {
                include('inc/bai-viet.php');
            } else  {

                include('inc/card.php');
            }
            ?>
        </div>
    </div>
</section>

<?php include('mobile/danh_muc_health_mobile.php'); ?>
<?php include 'inc/footer.php'; ?>