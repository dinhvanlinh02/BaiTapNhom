<?php
        require_once("clsDatabase.php");
class clsSanpham{
 
    public $clsDatabase= null;
    function clsSanpham(){

       $this->clsDatabase= new clsDatabase();
          
    }
    function getImageById($id){
        $this->clsDatabase= new clsDatabase();
        $sql="SELECT thumbnail from galery WHERE galery.product_id=?";
        $data[]=$id;
        $ketqua =$this->clsDatabase->executeQuery($sql,$data);
        if($ketqua==FALSE)
            return NULL;
        else
        {
            $rows =$this->clsDatabase->pdo_stm->fetchAll(PDO::FETCH_ASSOC);
            $imgs=[];
            foreach ($rows as $row) {
            $imgs[]= $row["thumbnail"];
            }
            return $imgs;
        }
    }
    function getProductById($id){
        $this->clsDatabase= new clsDatabase();
        $sql="SELECT * FROM `product` WHERE id=$id;";
        $ketqua =$this->clsDatabase->executeQuery($sql);
        if($ketqua==true){
            $product=$this->clsDatabase->pdo_stm->fetch(PDO::FETCH_ASSOC);
            return $product;
        }
       else return 0;

    }
    function addImage($image_1,$image_2,$image_3)
    {
        $this->clsDatabase= new clsDatabase();
        $imgs[3] = [$image_1,$image_2,$image_3];
        $sql_product_id = "SELECT Max(id) FROM product";
        $ketqua = $this->clsDatabase->executeQuery($sql_product_id);
        if($ketqua == false)
        {
            echo "False is here";
        }
        else
        {
            $final_ids = $this->clsDatabase->pdo_stm->fetchAll(PDO::FETCH_BOTH);
            echo json_encode($final_ids);
        }
        foreach($final_ids as $final_id)
        {
            //image_1
            $data_1[] = (int)$final_id["Max(id)"];
            $data_1[] = (string)$image_1;
            $sql_thumbnail = "INSERT INTO galery VALUES(NULL,?,?)";
            $result_1 = $this->clsDatabase->executeQuery($sql_thumbnail,$data_1);

            //image_2
            $data_2[] = (int)$final_id["Max(id)"];
            $data_2[] = (string)$image_2;
            $sql_thumbnail = "INSERT INTO galery VALUES(NULL,?,?)";
            $result_2 = $this->clsDatabase->executeQuery($sql_thumbnail,$data_2);

            //image_3
            $data_3[] = (int)$final_id["Max(id)"];
            $data_3[] = (string)$image_3;
            $sql_thumbnail = "INSERT INTO galery VALUES(NULL,?,?)";
            $result_3 = $this->clsDatabase->executeQuery($sql_thumbnail,$data_3);
        }

        if($result_1 == true && $result_2 == true && $result_3 == true)
        {
            echo "Correct";
            return true;
        }
        else
        {
            echo "Next false is now";
            return false;
        }
    }
    function addProduct($category_id,$title,$price_old,$price,$description,$closed,$bought,$created_at,$updated_at)
    {
        $this->clsDatabase= new clsDatabase();
        $sql = "INSERT INTO product VALUES (NULL, ?, ?, ?, ?, ?, 0, 0, ?, ?, ?, 0)";
        $data[] = $category_id;
        $data[] = $title;
        $data[] = $price_old;
        $data[] = $price;
        $data[] = $description;
        $data[] = $closed;
        $data[] = $bought;
        $data[] = $created_at;
        $data[] = $updated_at;

        $ketqua = $this->clsDatabase->executeQuery($sql,$data);
        return $ketqua;
    }

    function fixProduct($id,$category_id,$title,$price_old,$price,$description,$closed,$bought,$created_at,$updated_at)
    {
        $this->clsDatabase= new clsDatabase();
        $sql = "UPDATE product SET category_id=?, title=?, price_old=?, price=?, description=?, closed=?, bought=?, created_at=?, updated_at=? WHERE id=$id";
        $data[] = $category_id;
		$data[] = $title;
		$data[] = $price_old;
        $data[] = $price;
        $data[] = $description;
        $data[] = $closed;
        $data[] = $bought;
        $data[] = $created_at;
        $data[] = $updated_at;

 		$ketqua = $this->clsDatabase->executeQuery($sql,$data);
		return $ketqua;
    }
    function getListProduct($bonus_data = null)
    {
        $this->clsDatabase = new clsDatabase();
        $sql = "SELECT product.id, product.category_id, product.title, product.price_old, product.price, product.description, galery.thumbnail
                FROM product 
                INNER JOIN galery ON galery.product_id = product.id";
    
        if (!empty($bonus_data)) {
            $sql .= " " . $bonus_data; // Thêm điều kiện bổ sung nếu có
        }
    
        $ketqua = $this->clsDatabase->executeQuery($sql);
        if ($ketqua === FALSE) {
            error_log("SQL Error: " . $this->clsDatabase->pdo_stm->errorInfo());
            return NULL;
        }
    
        $rows = $this->clsDatabase->pdo_stm->fetchAll(PDO::FETCH_ASSOC);
    
        // Xử lý ảnh thumbnail
        foreach ($rows as $i => $row) {
            $rows[$i]["thumbnail"] = $this->getImageById($row["id"]);
        }
    
        // Lọc các sản phẩm trùng lặp
        $unique_rows = [];
        $ids = [];
        foreach ($rows as $row) {
            if (!in_array($row["id"], $ids)) {
                $unique_rows[] = $row;
                $ids[] = $row["id"];
            }
        }
    
        return $unique_rows;
    }
    
    function countProduct(){
        $this->clsDatabase= new clsDatabase();
        $sql="SELECT COUNT(*) FROM `product`;";
        $ketqua =$this->clsDatabase->executeQuery($sql);
        if($ketqua==true){
            $qty=$this->clsDatabase->pdo_stm->fetch();
            return $qty[0];
        }
       else return 0; 
    }
    function getClosedProduct($id){
        $this->clsDatabase= new clsDatabase();
        $sql="SELECT product.closed FROM product WHERE id=$id;";
        $ketqua =$this->clsDatabase->executeQuery($sql);
        if($ketqua==true){
            $qty=$this->clsDatabase->pdo_stm->fetch();
            return $qty[0];
        }
       else return 0;
    }
    function getBoughtProduct($id){
        $this->clsDatabase= new clsDatabase();
        $sql="SELECT product.bought FROM product WHERE id=$id;";
        $ketqua =$this->clsDatabase->executeQuery($sql);
        if($ketqua==true){
            $qty=$this->clsDatabase->pdo_stm->fetch();
            return $qty[0];
        }
       else return 0; 
    }
    function updateCloseProduct($id,$qty){
        $this->clsDatabase= new clsDatabase();
        $numOld=$this->getClosedProduct($id);
        $numNew=$numOld-$qty;
        $sql="UPDATE product SET closed=? WHERE id=?;";
        $data=[$numNew,$id];
        $ketqua =$this->clsDatabase->executeQuery($sql,$data);
        return $ketqua;

    }
    function updateBoughtProduct($id,$qty){
        $this->clsDatabase= new clsDatabase();
        $numOld=$this->getBoughtProduct($id);
        $numNew=$numOld+$qty;
        $sql="UPDATE product SET bought=? WHERE id=?;";
        $data=[$numNew,$id];
        $ketqua =$this->clsDatabase->executeQuery($sql,$data);
        return $ketqua;
    }
}

?>