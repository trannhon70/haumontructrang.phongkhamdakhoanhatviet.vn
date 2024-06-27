
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
include_once($filepath . '/../lib/session.php');


?>

<?php
class post
{
  private $db;
  private $fm;
  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }

  //thêm danh mục 
  public function insert_post($data, $files)
  {
    $tieu_de = mysqli_real_escape_string($this->db->link, $data['tieu_de']);
    $id_benh = mysqli_real_escape_string($this->db->link, $data['id_benh']);
    $id_khoa = mysqli_real_escape_string($this->db->link, $data['id_khoa']);
    $content = mysqli_real_escape_string($this->db->link, $data['content']);
    $title = mysqli_real_escape_string($this->db->link, $data['title']);
    $keyword = mysqli_real_escape_string($this->db->link, $data['keyword']);
    $description = mysqli_real_escape_string($this->db->link, $data['description']);
    $slug = mysqli_real_escape_string($this->db->link, $data['slug']);
    $created_at =  $this->fm->created_at();
    
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
    $latest_baiviet_query = "SELECT id FROM `admin_baiviet` ORDER BY id DESC LIMIT 1";
    $result_latest_baiviet = $this->db->select($latest_baiviet_query);

    $latest_id = 0;
    if ($result_latest_baiviet) {
      $latest_baiviet = $result_latest_baiviet->fetch_assoc();
      $latest_id = $latest_baiviet['id'];
    }
    $user_id = Session::get('id');
    // Hiển thị ID bài viết mới nhất
    // echo "ID của bài viết mới nhất là: " . $latest_id;

    $slug = $slug . '-' . ($latest_id);

    if ($tieu_de !== '' && $id_benh !== '' && $content !== '') {
      move_uploaded_file($file_temp, $uploaded_image);
      $query = "INSERT INTO admin_baiviet (title,slug,content,id_benh,id_khoa,created_at,tieu_de,keyword,descriptions,user_id,img) VALUE('$title','$slug','$content','$id_benh','$id_khoa','$created_at','$tieu_de','$keyword','$description','$user_id','$unique_image') ";
      $result = $this->db->insert($query);

      if ($result) {
        return array('status' => 'success', 'message' => 'Thêm bài viết thành công!');
      } else {
        return array('status' => 'error', 'message' => 'Thêm bài viết thất bại!');
      }
    } else {
      return array('status' => 'error', 'message' => 'Các trường tiêu đề, chọn bênh, nội dung không được bổ trống!');
    }
  }

  public function getAll()
  {
    $query = "SELECT baiviet.*, user.user_name, user.email , user.full_name, benh.name AS ten_benh
        FROM admin_baiviet baiviet 
        JOIN admin_user user ON baiviet.user_id = user.id
        JOIN admin_benh benh ON baiviet.id_benh = benh.id
        ORDER BY baiviet.created_at DESC";
    $result = $this->db->select($query);
    return $result;
  }

  public function delete_baiviet($id)
  {
    $query = "DELETE FROM admin_baiviet WHERE id = $id ";
    $result = $this->db->delete($query);
    if ($result) {
      return array('status' => 'success', 'message' => 'Xóa bài viết thành công!');
    } else {
      return array('status' => 'error', 'message' => 'Xóa bài viết thất bại!');
    }
  }

  public function getById_baiviet($id)
  {
    $id = mysqli_real_escape_string($this->db->link, $id);
    $query = "SELECT * FROM admin_baiviet WHERE id = '$id' LIMIT 1";
    $result = $this->db->select($query);
    return $result->fetch_assoc();
  }

  public function getById_benh($id, $limit, $offset)
  {
    $id = mysqli_real_escape_string($this->db->link, $id);
    $query = "SELECT * FROM admin_benh WHERE slug = '$id' LIMIT 1 ";
    $result = $this->db->select($query);

    if ($result) {
      $row = $result->fetch_assoc();
      $benh_id = $row['id'];

      $query_baiviet = "SELECT * FROM admin_baiviet WHERE id_benh = $benh_id ORDER BY id DESC LIMIT $limit OFFSET $offset";
      $result_baiviet = $this->db->select($query_baiviet);
      return $result_baiviet;
    } else {
      // Xử lý khi không tìm thấy bệnh với slug tương ứng
      echo "Không tìm thấy bệnh với slug '$id'";
      return false;
    }
  }

  public function getTotalCount()
  {
    $query = "SELECT COUNT(*) AS total FROM admin_baiviet ";
    $result = $this->db->select($query);
    $row = $result->fetch_assoc();
    return $row['total'];
  }

  public function getTotalCountById($id)
  {
    $queryBenh = "SELECT * FROM admin_benh WHERE slug = '$id' LIMIT 1";
    $resultBenh = $this->db->select($queryBenh);
    $rowBenh = $resultBenh->fetch_assoc();
    $id_benh = $rowBenh['id'];
    if($resultBenh){
$query = "SELECT COUNT(*) AS total FROM admin_baiviet WHERE id_benh = ' $id_benh' ";
    $result = $this->db->select($query);
    $row = $result->fetch_assoc();
    return $row['total'];
    }

    
  }

  public function update_baiviet($data, $files, $id)
  {
    $tieu_de = mysqli_real_escape_string($this->db->link, $data['tieu_de']);
    $id_benh = mysqli_real_escape_string($this->db->link, $data['id_benh']);
    $id_khoa = mysqli_real_escape_string($this->db->link, $data['id_khoa']);
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

    if ($tieu_de !== '' && $id_benh !== '' && $content !== '') {


      if (empty($file_name)) {
        $query = "UPDATE admin_baiviet SET 
             tieu_de = '$tieu_de' ,
             id_benh = '$id_benh' ,
             id_khoa = '$id_khoa' ,
             content = '$content' ,
             title = '$title' ,
             keyword = '$keyword' ,
             descriptions = '$description' 
           WHERE id = '$id'";
      } else {
        move_uploaded_file($file_temp, $uploaded_image);
        $query = "UPDATE admin_baiviet SET 
        tieu_de = '$tieu_de' ,
        id_benh = '$id_benh' ,
        id_khoa = '$id_khoa' ,
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

  public function getBaiViet_bySlug($id)
  {
    $id = mysqli_real_escape_string($this->db->link, $id);
    $query = "SELECT * FROM admin_baiviet WHERE slug = '$id' LIMIT 1";
    $result = $this->db->select($query);
    if ($result) {
      return $result->fetch_assoc();
    } else {
      return null;
    }
  }
  public function getAllDanhSachBaiVietNew($khoa)
  {
    $query = "SELECT baiviet.*, 
    benh.slug AS slug_benh, 
    benh.id AS id_benh, 
    benh.id_khoa AS id_benh_khoa, 
    khoa.slug AS slug_khoa 
    FROM admin_baiviet baiviet 
    JOIN admin_benh benh ON baiviet.id_benh = benh.id
    JOIN admin_khoa khoa ON benh.id_khoa = khoa.id
     WHERE khoa.slug = '$khoa'
    ORDER BY baiviet.id DESC LIMIT 5";

    $result = $this->db->select($query);
    if ($result && $result->num_rows > 0) {
      $baivietArr = [];
      while ($row = $result->fetch_assoc()) {
        // Lấy id_khoa từ bảng admin_benh
        $id_benh_khoa = $row['id_benh_khoa'];


        $query_khoa = "SELECT * FROM admin_khoa WHERE id = $id_benh_khoa";
        $result_khoa = $this->db->select($query_khoa);

        if ($result_khoa && $result_khoa->num_rows > 0) {
          $khoa_info = $result_khoa->fetch_assoc();
          // Thêm thông tin từ bảng admin_khoa vào mảng baivietArr
          $row['name'] = $khoa_info['name'];
          $row['slug_khoa'] = $khoa_info['slug'];
        }

        // Thêm bài viết vào mảng kết quả
        $baivietArr[] = $row;
      }

      return $baivietArr;
    } else {
      return [];
    }
  }

  public function getDanhSachBaiVietNew()
  {
    $query = "SELECT baiviet.*, 
    benh.slug AS slug_benh, 
    benh.id AS id_benh, 
    benh.id_khoa AS id_benh_khoa, 
    khoa.slug AS slug_khoa 
    FROM admin_baiviet baiviet 
    JOIN admin_benh benh ON baiviet.id_benh = benh.id
    JOIN admin_khoa khoa ON benh.id_khoa = khoa.id
    ORDER BY baiviet.id DESC 
    LIMIT 5";

    $result = $this->db->select($query);
    if ($result && $result->num_rows > 0) {
      $baivietArr = [];
      while ($row = $result->fetch_assoc()) {
        // Lấy id_khoa từ bảng admin_benh
        $id_benh_khoa = $row['id_benh_khoa'];


        $query_khoa = "SELECT * FROM admin_khoa WHERE id = $id_benh_khoa";
        $result_khoa = $this->db->select($query_khoa);

        if ($result_khoa && $result_khoa->num_rows > 0) {
          $khoa_info = $result_khoa->fetch_assoc();
          // Thêm thông tin từ bảng admin_khoa vào mảng baivietArr
          $row['name'] = $khoa_info['name'];
          $row['slug_khoa'] = $khoa_info['slug'];
        }

        // Thêm bài viết vào mảng kết quả
        $baivietArr[] = $row;
      }

      return $baivietArr;
    } else {
      return [];
    }
  }

  public function getPaginationTinTuc($limit, $offset)
  {
      $query = "SELECT baiviet.*, user.user_name, user.email , 
      user.full_name,
      benh.name AS ten_benh,
        benh.id_khoa AS id_benh_khoa, 
        khoa.slug AS slug_khoa 
        FROM admin_baiviet baiviet 
        JOIN admin_user user ON baiviet.user_id = user.id
        JOIN admin_benh benh ON baiviet.id_benh = benh.id
       JOIN admin_khoa khoa ON benh.id_khoa = khoa.id
        ORDER BY baiviet.id DESC LIMIT $limit OFFSET $offset";
      $result = $this->db->select($query);
      return $result;
  }
}

?>