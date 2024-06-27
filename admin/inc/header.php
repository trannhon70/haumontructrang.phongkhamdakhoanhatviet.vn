
<?php
include '../lib/session.php';
Session::checkSession();
// clearstatcache()
?>

<?php
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    Session::destroy();
}

$local = 'http://localhost/benhxahoi.phongkhamdakhoanhatviet.vn';
// $local = 'https://benhxahoi.phongkhamdakhoanhatviet.vn/';
?>

<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phòng khám Việt Nhật</title>
    <link rel="icon" href="<?php echo $local ?>/images/icons/icon_logo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="../css/toastr.min.css" />
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- gắn ckeditor -->
    <script src="<?php echo $local ?>/admin/ckeditor/ckeditor.js" charset="utf-8"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>

<style>
    .btn-icon {
        font-size: 25px;
        cursor: pointer;
        color: #3866ad;
    }

    .btn-icon:hover {
        color: #204a8b;
        transition: 0.5s;
    }
</style>

<body>

    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex mt-3" style="margin-left: 24px;">
                <div class="sidebar-logo">
                    <a href="<?php echo $local ?>/admin">PK Đa Khoa</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <!-- <li class="sidebar-item">
                    <a href="" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>profile</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>Task</span>
                    </a>
                </li> -->
                <li class="sidebar-item">
                    <a href="" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="fa-solid fa-bars"></i>
                        <span>QL bài viết</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li style="padding-left: 10%;" class="sidebar-item">

                            <a href="bai-viet-create.php" class="sidebar-link"> <i class="fa-solid fa-plus"></i>Tạo bài viết</a>
                        </li>
                        <li style="padding-left: 10%;" class="sidebar-item">
                            <a href="bai-viet-list.php" class="sidebar-link"> <i class="fa-solid fa-bars"></i>Danh sách bài viết</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#tin-tuc" aria-expanded="false" aria-controls="tin-tuc">
                        <i class="fa-solid fa-bars"></i>
                        <span>QL tin tức</span>
                    </a>
                    <ul id="tin-tuc" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li style="padding-left: 10%;" class="sidebar-item">

                            <a href="tin-tuc-create.php" class="sidebar-link"> <i class="fa-solid fa-plus"></i>Tạo tin tức</a>
                        </li>
                        <li style="padding-left: 10%;" class="sidebar-item">
                            <a href="tin-tuc-list.php" class="sidebar-link"> <i class="fa-solid fa-bars"></i>Danh sách tin tức</a>
                        </li>
                    </ul>
                </li>
                <!-- <li class="sidebar-item">
                    <a href="" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#multi" aria-expanded="false" aria-controls="multi">
                        <i class="lni lni-display"></i>
                        <span>Multi level</span>
                    </a>
                    <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#multi-two" aria-expanded="false" aria-controls="multi-two">two link</a>
                            <ul id="multi-two" class="sidebar-dropdown list-unstyled collapse">
                                <li class="sidebar-item">
                                    <a href="" class="sidebar-link">link </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="" class="sidebar-link">link 1 </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>Notication</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>setting</span>
                    </a>
                </li> -->
            </ul>
            <div class="sidebar-footer">

                <a href="?action=logout" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>logout</span>
                </a>
            </div>
        </aside>

        <div class="main p-3">
            <div class="btn-button " id="toggle-btn ">
                <i class="fa-solid fa-bars btn-icon"></i>
            </div>