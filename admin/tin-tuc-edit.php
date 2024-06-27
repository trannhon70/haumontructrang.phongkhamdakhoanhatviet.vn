<?php
ob_start(); 
include 'inc/header.php';
include '../classes/tin_tuc.php';

$tin_tuc = new news();
?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$message = null;
$id = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $getById = $tin_tuc->getById_tintuc($id);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']) && $id !== null) {
    $message = $tin_tuc->update_tintuc($_POST, $_FILES, $id);
    if ($message['status'] == 'success') {
        $_SESSION['message'] = $message;
        header('Location: tin-tuc-list.php');
        exit();
    }
}
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<form action="" method="post" enctype="multipart/form-data">

    <fieldset>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Tin tức</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa tin tức</li>
            </ol>
        </nav>
        <div class="row">
            <div class="mb-3 col-sm-6">
                <label for="titleInput" class="form-label">Tiêu đề tin tức</label>
                <input value="<?php echo $getById['tieu_de'] ?>" name="tieu_de" type="text" id="titleInput" class="form-control" placeholder="Nhập tiêu đề tin tức">
            </div>
            <div class="mb-3 col-sm-6">
                <label for="slugInput" class="form-label">slug</label>
                <input type="text" value="<?php echo $getById['slug'] ?>" id="slugInput1" class="form-control" placeholder="slug" disabled>
                <input value="<?php echo $getById['slug'] ?>" name="slug" type="hidden" id="slugInput" class="form-control">
            </div>
        </div>

      
        <div class="row">

            <div class="mb-3 col-sm-6">
                <label for="image" class="form-label">Hình ảnh:</label>
                <input accept="image/*" type="file" id="image" name="image" class="form-control" placeholder="">
            </div>
            <div class="mb-3 col-sm-6">
                <label for="image" class="form-label">Hình ảnh review:</label>
                <div style="    width: 400px !important;" height="300px" class="card">
                    <img style="object-fit: fill;" width="400px" height="300px" src="uploads/<?php echo $getById['img'] ?>" alt="">
                </div>
            </div>

        </div>
        <div class="row">
            <div class="mb-3 col-sm-12">
                <label for="disabledSelect" class="form-label">Nội dung tin tức:</label>
                <textarea id="content" name="content" class="tinymce"><?php echo $getById['content'] ?></textarea>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-sm-12">
                <label for="title" class="form-label">Title: </label>
                <input value="<?php echo $getById['title'] ?>" name="title" type="text" id="title" class="form-control" placeholder="Nhập title">
            </div>
            <div class="mb-3 col-sm-12">
                <label for="keyword" class="form-label">keyword :</label>
                <input value="<?php echo $getById['keyword'] ?>" name="keyword" type="text" id="keyword" class="form-control" placeholder="Nhập keyword">
            </div>
            <div class="mb-3 col-sm-12">
                <label for="description" class="form-label">Description :</label>
                <input value="<?php echo $getById['descriptions'] ?>" name="description" type="text" id="description" class="form-control" placeholder="Nhập description">

            </div>
        </div>

       <div style="display: flex; gap:30px " >
       <button style="width: 100px;" name="submit" type="submit" class="btn btn-success">Lưu</button>
       <a style="width: 100px;" class="btn btn-danger" href="bai-viet-list.php">Hủy</a>
       </div>
    </fieldset>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const titleInput = document.getElementById("titleInput");
        const slugInput = document.getElementById("slugInput");
        const slugInput1 = document.getElementById("slugInput1");

        function removeVietnameseTones(str) {
            str = str.normalize('NFD').replace(/[\u0300-\u036f]/g, '');
            str = str.replace(/đ/g, 'd').replace(/Đ/g, 'D');
            return str;
        }

        titleInput.addEventListener("input", function() {
            let slug = removeVietnameseTones(titleInput.value.trim()).toLowerCase().replace(/\s+/g, '-');
            slugInput.value = slug;
            slugInput1.value = slug;
        });

        <?php if ($message) : ?>
            toastr.<?php echo $message['status']; ?>('<?php echo $message['message']; ?>');
        <?php endif; ?>
    });
</script>
<?php include 'inc/footer.php'; ?>