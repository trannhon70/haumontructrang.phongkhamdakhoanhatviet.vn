<?php

include 'inc/header.php';
include '../classes/tin_tuc.php';

$tin_tuc = new news()
?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$message = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $message = $tin_tuc->insert_tintuc($_POST, $_FILES);
    if ($message['status'] == 'success') {
        $_SESSION['message'] = $message;
    }
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>


<?php

?>




<form action="tin-tuc-create.php" method="post" enctype="multipart/form-data">

    <fieldset>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Tin tức</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tạo tin tức</li>
            </ol>
        </nav>
        <div class="row">
            <div class="mb-3 col-sm-6">
                <label for="titleInput" class="form-label">Tiêu đề tin tức</label>
                <input name="tieu_de" type="text" id="titleInput" class="form-control" placeholder="Nhập tiêu đề tin tức">
            </div>
            <div class="mb-3 col-sm-6">
                <label for="slugInput" class="form-label">slug</label>
                <input type="hidden" name="slug" id="slugHiddenInput">
                <input disabled type="text" id="slugInput" class="form-control">
            </div>
        </div>

        <div class="row">

            <div class="mb-3 col-sm-12">
                <label for="image" class="form-label">Hình ảnh:</label>
                <input accept="image/*" type="file" id="image" name="image" class="form-control" placeholder="">
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-sm-12">
                <label for="disabledSelect" class="form-label">Nội dung tin tức:</label>
                <textarea id="content" name="content" class="tinymce"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-sm-12">
                <label for="title" class="form-label">Title: </label>
                <input name="title" type="text" id="title" class="form-control" placeholder="Nhập title">
            </div>
            <div class="mb-3 col-sm-12">
                <label for="keyword" class="form-label">keyword :</label>
                <input name="keyword" type="text" id="keyword" class="form-control" placeholder="Nhập keyword">
            </div>
            <div class="mb-3 col-sm-12">
                <label for="description" class="form-label">Description :</label>
                <input name="description" type="text" id="description" class="form-control" placeholder="Nhập description">

            </div>
        </div>

        <button name="submit" type="submit" class="btn btn-primary">Tạo tin tức</button>
    </fieldset>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const titleInput = document.getElementById("titleInput");
        const slugInput = document.getElementById("slugInput");

        function removeVietnameseTones(str) {
            str = str.normalize('NFD').replace(/[\u0300-\u036f]/g, '');
            str = str.replace(/đ/g, 'd').replace(/Đ/g, 'D');

            str = str.replace(/[^a-zA-Z0-9\s]/g, '');

            return str;
        }

        function generateSlug(title) {
            let slug = removeVietnameseTones(title.trim())
                .toLowerCase() // Chuyển thành chữ thường
                .replace(/\s+/g, '-') // Thay thế khoảng trắng bằng dấu gạch ngang
                .replace(/-+/g, '-'); // Loại bỏ các dấu gạch ngang thừa
            return slug;
        }

        titleInput.addEventListener("input", function() {
            let slug = generateSlug(titleInput.value);
            slugInput.value = slug;
            document.getElementById("slugHiddenInput").value = slug;
        });

        <?php if ($message) : ?>
            toastr.<?php echo $message['status']; ?>('<?php echo $message['message']; ?>');
        <?php endif; ?>
    });
</script>

﻿<?php include 'inc/footer.php'; ?>