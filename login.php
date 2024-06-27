<?php
include 'inc/header.php';
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)) {
    $userName = $_POST['user_name'];
    $password = md5($_POST['password']);
    $login_check = $user->login_user($userName, $password);
}
?>
<?php

// $login_check = Session::get('admin_login');
// if ($login_check == false) {
//     header('Location:login.php');
// }
?> 

<form action="" method="POST">
    <span><?php
            if (isset($login_check)) {
                echo $login_check;
            }
            ?></span>
    <div class="row mb-2">
        <div class="col-12 col-lg-6">
            <input id="user_name" class="form-control col-12 " type="text" name="user_name" placeholder="tên">
            <input type="password" id="password" class="form-control col-12 " type="text" name="password" placeholder="password">
        </div>
    </div>

    <div class="button_register">
        <button type="submit" class="bg-success " name="login">login</button>

    </div>
</form>

<?php include 'inc/footer.php'; ?>