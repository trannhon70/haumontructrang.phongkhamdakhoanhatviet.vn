<?php
ob_start(); 
include 'inc/header.php';
include '../classes/khoa.php';
include '../classes/benh.php';
include '../classes/bai_viet.php';

if (Session::get('role') === '1' || Session::get('role') === '2') {

$khoa = new khoa();
$benh = new Benh();
$bai_viet = new post();
?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$message = null;
$id = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $getById = $bai_viet->getById_baiviet($id);
}
$list_benh = $benh->getByIdKhoa();
$list_khoa = $khoa->getAllKhoa();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']) && $id !== null) {
    $message = $bai_viet->update_baiviet($_POST, $_FILES, $id);
    if ($message['status'] == 'success') {
        $_SESSION['message'] = $message;
        header('Location: bai-viet-list.php');
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
                <li class="breadcrumb-item"><a href="#">Bài viết</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa bài viết</li>
            </ol>
        </nav>
        <div class="row">
            <div class="mb-3 col-sm-6">
                <label for="titleInput" class="form-label">Tiêu đề bài viết</label>
                <input value="<?php echo $getById['tieu_de'] ?>" name="tieu_de" type="text" id="titleInput" class="form-control" placeholder="Nhập tiêu đề bài viết">
            </div>
            <div class="mb-3 col-sm-6">
                <label for="slugInput" class="form-label">slug</label>
                <input type="text" value="<?php echo $getById['slug'] ?>" id="slugInput1" class="form-control" placeholder="slug" disabled>
                <input value="<?php echo $getById['slug'] ?>" name="slug" type="hidden" id="slugInput" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-sm-6">
                <label for="idKhoa" class="form-label">Chọn khoa:</label>
                <select id="idKhoa" class="form-select" name="id_khoa">
                    <option value="">--- Chọn khoa ---</option>
                    <?php if ($list_khoa) {
                        while ($result = $list_khoa->fetch_assoc()) {

                    ?>
                            <option <?php
                                    if ($result['id'] == $getById['id_khoa']) {
                                        echo 'selected';
                                    }
                                    ?> value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
            <div class="mb-3 col-sm-6">
                <label for="disabledSelect" class="form-label">Chọn bệnh:</label>
                <select id="disabledSelect" class="form-select" name="id_benh">
                    <option value="">--- Chọn bệnh ---</option>
                    <?php if ($list_benh) {
                        while ($result = $list_benh->fetch_assoc()) {
                    ?>
                            <option <?php
                                    if ($result['id'] == $getById['id_benh']) {
                                        echo 'selected';
                                    }
                                    ?> value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
                    <?php }
                    } ?>
                </select>

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
                <label for="disabledSelect" class="form-label">Nội dung bài viết:</label>
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

<?php } else { ?>
    <div style="display: flex; align-items: center; justify-content: center; font-size: 30px; text-transform: uppercase; font-weight: 600; height: 90vh; color: red; ">Trang này không tồn tại</div>
<?php } ?>