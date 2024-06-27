<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/../lib/database.php');
include_once ($filepath . '/../helpers/format.php');
include_once ($filepath . '/../lib/session.php');


?>

<?php
class news
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    //thêm danh mục 
    public function insert_tintuc($data, $files)
    {
        $tieu_de = mysqli_real_escape_string($this->db->link, $data['tieu_de']);
        $content = mysqli_real_escape_string($this->db->link, $data['content']);
        $title = mysqli_real_escape_string($this->db->link, $data['title']);
        $keyword = mysqli_real_escape_string($this->db->link, $data['keyword']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);
        $slug = mysqli_real_escape_string($this->db->link, $data['slug']);
        $created_at = $this->fm->created_at();

        //kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;


        //đếm số lượng bài viét
        $latest_baiviet_query = "SELECT id FROM `admin_tintuc` ORDER BY id DESC LIMIT 1";
        $result_latest_baiviet = $this->db->select($latest_baiviet_query);

        $latest_id = 0;
        if ($result_latest_baiviet) {
            $latest_baiviet = $result_latest_baiviet->fetch_assoc();
            $latest_id = $latest_baiviet['id'];
        }
        $user_id = Session::get('id');

        $slug = $slug . '-' . ($latest_id);

        if ($tieu_de !== '' && $content !== '') {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO admin_tintuc (title,slug,content,tieu_de,keyword,descriptions,user_id,img,created_at) VALUE('$title','$slug','$content','$tieu_de','$keyword','$description','$user_id','$unique_image','$created_at') ";
            $result = $this->db->insert($query);

            if ($result) {
                return array('status' => 'success', 'message' => 'Thêm tin tức thành công!');
            } else {
                return array('status' => 'error', 'message' => 'Thêm tin tức thất bại!');
            }
        } else {
            return array('status' => 'error', 'message' => 'Các trường tiêu đề, nội dung không được bổ trống!');
        }
    }


    public function update_tintuc($data, $files, $id)
    {
        $tieu_de = mysqli_real_escape_string($this->db->link, $data['tieu_de']);

        $content = mysqli_real_escape_string($this->db->link, $data['content']);
        $title = mysqli_real_escape_string($this->db->link, $data['title']);
        $keyword = mysqli_real_escape_string($this->db->link, $data['keyword']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);
        $slug = mysqli_real_escape_string($this->db->link, $data['slug']);

        //kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if ($tieu_de !== '' && $content !== '') {


            if (empty($file_name)) {
                $query = "UPDATE admin_tintuc SET 
                tieu_de = '$tieu_de' ,
            
                content = '$content' ,
                title = '$title' ,
                keyword = '$keyword' ,
                descriptions = '$description' 
                WHERE id = '$id'";
            } else {
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "UPDATE admin_tintuc SET 
                tieu_de = '$tieu_de' ,
            
                content = '$content' ,
                title = '$title' ,
                keyword = '$keyword' ,
                descriptions = '$description' ,
                img = '$unique_image'
                WHERE id = '$id'";
            }
            $result = $this->db->update($query);


            if ($result) {
                return array('status' => 'success', 'message' => 'Cập nhật bài viết thành công!');
            } else {
                return array('status' => 'error', 'message' => 'Cập nhật bài viết thất bại!');
            }
        } else {
            return array('status' => 'error', 'message' => 'Các trường tiêu đề, chọn bênh, nội dung không được bổ trống!');
        }
    }

    public function getPaginationTinTuc($limit, $offset)
    {
        $query = "SELECT tintuc.*, user.user_name, user.email , user.full_name
          FROM admin_tintuc tintuc 
          JOIN admin_user user ON tintuc.user_id = user.id
          ORDER BY tintuc.id DESC LIMIT $limit OFFSET $offset";
        $result = $this->db->select($query);
        return $result;
    }

    public function getTotalCountTinTuc()
    {
      $query = "SELECT COUNT(*) AS total FROM admin_tintuc ";
      $result = $this->db->select($query);
      $row = $result->fetch_assoc();
      return $row['total'];
    }

    public function delete_tituc($id)
    {
        $query = "DELETE FROM admin_tintuc WHERE id = $id ";
        $result = $this->db->delete($query);
        if ($result) {
            return array('status' => 'success', 'message' => 'Xóa bài viết thành công!');
        } else {
            return array('status' => 'error', 'message' => 'Xóa bài viết thất bại!');
        }
    }

    public function getById_tintuc($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "SELECT * FROM admin_tintuc WHERE id = '$id' LIMIT 1";
        $result = $this->db->select($query);
        return $result->fetch_assoc();
    }

    public function getAllLimitTinTuc()
    {
        $query = "SELECT * FROM `admin_tintuc` WHERE 1
          ORDER BY id DESC LIMIT 10";
        $result = $this->db->select($query);
        return $result;
    }

    public function getOneLimitTinTuc()
    {
        $query = "SELECT * FROM `admin_tintuc` WHERE 1
          ORDER BY id DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result->fetch_assoc();
    }
    
    public function getByslug_tintuc($slug)
    {
        $slug = mysqli_real_escape_string($this->db->link, $slug);
        $query = "SELECT * FROM admin_tintuc WHERE slug = '$slug' LIMIT 1";
        $result = $this->db->select($query);
        return $result->fetch_assoc();
    }
}

?>