
<?php
    $filepath = realpath(dirname(__FILE__));

    include_once ($filepath . '/../lib/session.php');
    include_once($filepath . '/../lib/database.php');
    include_once($filepath . '/../helpers/format.php');

?>
<?php 
    class users 
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function login_user($user_name,$password){
            $user_name = $this->fm->validation($user_name);
            $password = $this->fm->validation($password);

            $user_name = mysqli_real_escape_string($this->db->link,$user_name);
            $password = mysqli_real_escape_string($this->db->link, md5($password) );

            if(empty($user_name) || empty($password)){
                $alert = "Tài khoản và mật khẩu không được bỏ trống !";
                return $alert;
            }
            else{
                
                $query = "SELECT * FROM admin_user WHERE user_name = '$user_name' AND password = '$password' LiMIT 1";
                $result = $this->db->select($query);
               
                if($result != false){
                    $value = $result->fetch_assoc();

                    Session::set('admin_login',true);
                    Session::set('id', $value['id']);
                    Session::set('user_name', $value['user_name']);
                    Session::set('full_name', $value['full_name']);
                    Session::set('email', $value['email']);
                    Session::set('role', $value['role_id']);

                    
                    header('Location:index.php');
                    exit();
                }else{
                    $alert = "Tài khoản và mật khẩu không đúng !";
                    return $alert;
                }
                // exit();
            }
        }
        
    }
    
?>