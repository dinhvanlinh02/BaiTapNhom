<?php
require_once("clsDatabase.php");

class clsOrder{
    public $clsDatabase=null;
    public $id;
    public $user_id;
   
    public $fullname;
    public $email;
    public $phone_number;
    public $address;
    public $note;
    public $total_money;
    public $status;//0 la moi; 1 là đã duyệt; 2 tạm huỷ; 3 đã thanh toán
    function clsOrder(){
         $clsDatabase= new clsDatabase();      
    }
    function getLastId(){
        $clsDatabase= new clsDatabase();
        $sql="SELECT MAX(id) FROM `order`;";
         $clsDatabase->executeQuery($sql);
        $row=$clsDatabase->pdo_stm->fetch();
        $id=$row[0];
        
        return $id;
    }
    function addOrder($user_id, $fullname,$email,$phone_number,$address,$note,$total_money,$status){
        $clsDatabase= new clsDatabase(); 
        $sql="INSERT INTO `order` (`id`, `user_id`, `fullname`, `email`, `phone_number`, `address`, `note`,`total_money`, `order_date`, `status`) 
        VALUES (NULL, ?, ?, ?, ?, ?, ?,?, CURRENT_TIME(), ?);";
         $data=[$user_id, $fullname,$email,$phone_number,$address,$note,$total_money,$status];
        $kq= $clsDatabase->executeQuery($sql,$data);
        if($kq==true){ // neu thanh cong thi gan cac gia tri do cho doi tuong clsOrder de de dang truy xuat;
            $this->id=$this->getLastId();
            $this->user_id=$user_id;
            $this->fullname=$fullname;
            $this->email=$email;
            $this->phone_number=$phone_number;
            $this->address=$address;
            $this->note=$note;
            $this->total_money=$total_money;
            $this->status=$status;
        }
          return $kq;
    }
    function getAllOrder(){
        $clsDatabase= new clsDatabase();
        $sql="SELECT * FROM `order` ORDER BY order_date DESC; ";
       $clsDatabase->executeQuery($sql);
        $rows=$clsDatabase->pdo_stm->fetchAll(PDO::FETCH_ASSOC);
        return $rows; 
    }
    function getOrder($user_id){// them dieu kien data
     $clsDatabase= new clsDatabase();
     $sql="SELECT * FROM `order` WHERE user_id=$user_id AND status!=1  ORDER BY order_date DESC;";
    $clsDatabase->executeQuery($sql);
     $rows=$clsDatabase->pdo_stm->fetchAll(PDO::FETCH_ASSOC);
     return $rows;

    }
    function getOrderById($order_id){
        $clsDatabase= new clsDatabase();
        $sql="SELECT * FROM `order` WHERE id=$order_id;";
        $clsDatabase->executeQuery($sql);
        $row=$clsDatabase->pdo_stm->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    public function deleteOrderById($order_id) {
        $clsDatabase= new clsDatabase();
        $sql = "DELETE FROM `order` WHERE id = $order_id";
        $clsDatabase->executeQuery($sql);
        $row=$clsDatabase->pdo_stm->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    public function updateOrderStatus($order_id, $status) {
        try {
            $clsDatabase = new clsDatabase();  // Tạo đối tượng clsDatabase mới, sẽ tự động kết nối.
            if (!$clsDatabase->conn) {
                throw new Exception("Database connection not established.");
            }
    
            $sql = "UPDATE `order` SET status = :status WHERE id = :order_id";
            $stmt = $clsDatabase->conn->prepare($sql);
            $stmt->bindParam(':status', $status, PDO::PARAM_INT);
            $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
            $result = $stmt->execute();
            
            // Kiểm tra xem có bản ghi nào bị ảnh hưởng không
            if ($result && $stmt->rowCount() > 0) {
                return true;
            } else {
                return false; // Trường hợp không có bản ghi nào bị ảnh hưởng
            }
        } catch (PDOException $e) {
            echo "Error updating order status: " . $e->getMessage();
            return false;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
    
    function getOrderCancel($user_id){
        $clsDatabase= new clsDatabase();
        $sql="SELECT * FROM `order` WHERE user_id=$user_id AND status=1  ORDER BY order_date DESC;";
       $clsDatabase->executeQuery($sql);
        $rows=$clsDatabase->pdo_stm->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
}
?>