
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php 
  class Benh 
  {
      private $db;
      private $fm;
      public function __construct()
      {
          $this->db = new Database();
          $this->fm = new Format();
      }

      //thêm danh mục 
      public function getByIdKhoa(){
        $query = "SELECT * FROM admin_benh WHERE id_khoa = 4";
        $result = $this->db->select($query);
        return $result;
        
      }
      public function getAllDanhSachBenh(){
        $query = "SELECT * FROM admin_benh WHERE 1";
        $result = $this->db->select($query);
        return $result;
        
      }

      function getDanhSachBenhByIdKhoa($idKhoa){
        $query = "SELECT * FROM `admin_benh` WHERE id_khoa = '$idKhoa' AND hidden = '0' ";
        $result = $this->db->select($query);
        
        $data = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
      }
      
  }
  
?>