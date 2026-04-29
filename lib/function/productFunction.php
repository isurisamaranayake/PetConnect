<?php
//start session
session_start();

include_once('main.php');

include_once('img_upload.php');

class product extends Main{

    public function addproduct($product_name, $description, $price, $cost_price, $stock_quantity, $imageName, $imageType, $imageLocation){

     $query = "SELECT MAX(product_id) AS last_id FROM product_tbl";
     $qresult = $this->dbResult->query($query);
     $row = $qresult->fetch_assoc();
     $lastid = $row['last_id'];
     $newid = $lastid+1;

     $imageObject = new ImageUpload;
     $imageurl = $imageObject->imgUpload($imageName, $imageType, 'products', $imageLocation, $newid);
        

            $insertquery = "INSERT INTO product_tbl (product_name, description, price, cost_price, stock_quantity, product_image)
            VALUE ('$product_name', '$description', '$price', '$cost_price', '$stock_quantity','$imageurl');";

            if($this->dbResult->error){
                echo($this->dbResult->error);
                exit;
            }

            $sqlresult =$this->dbResult->query($insertquery);
            
            if($sqlresult > 0){
                return("success");
            }else{
                return("error");
            }
    }

    public function petproducts(){


        $getquery = "SELECT * FROM product_tbl WHERE stock_quantity > 0 AND d_status = 0";

        if($this->dbResult->error){
                echo($this->dbResult->error);
                exit;
            }
        $sqlresult = $this->dbResult->query($getquery);

        $nor = $sqlresult->num_rows;

        if($nor > 0){

        $number =1;

        while($rec = $sqlresult->fetch_assoc()){
            
            echo('<div class="col-4">
                    <div class="card bg-light mb-3 hover-card">
                        <div class="card-body" style ="text-align: center;">
                            <img style="height:270px" src="lib/'. $rec['product_image'] .'"alt="">
                            <h4 class="card-title">'. $rec['product_name'] .'</h4>
                            <h4 style="color:green;" class="card-title">LKR '. $rec['price'] .'</h4>
                            <button type="button" onclick="addcart('. $rec['product_id'] .',\''. $rec['product_name'] .'\','. $rec['price'] .',\''. $rec['product_image'] .'\');" class="btn btn-primary"><i class="bi bi-cart-plus"></i></button>
                        </div>
                    </div>
                </div>');
                        $number ++;
        }
        }else{
            echo('<div class="alert alert-dismissible alert-warning">
                <button type="button" class="btn-close" data-bs-dismiss="alert" fdprocessedid="h1fap"></button>
                <h4 class="alert-heading">No products Yet</h4>
                </div>');
        }
    }
    

    public function makeOrder($data) {

        $cBy = $_SESSION['user_id']; // logged user

            $customer_name   = $data['customer_name'];
            $phone           = $data['customer_phone'];
            $address         = $data['customer_address'];
            $district        = $data['district'];
            $payment_method  = $data['payment_method'];
            $bank_ref        = $data['bank_ref'];
            $cart            = $data['cart'];


            foreach ($cart as $item) {

                $product_id = $item['productid'];
                $qtyNeeded  = $item['productcount'];

                $q = "SELECT product_name, stock_quantity 
                    FROM product_tbl 
                    WHERE product_id='$product_id' AND d_status=0";

                $res = $this->dbResult->query($q);
                $row = $res->fetch_assoc();

                if(!$row || $row['stock_quantity'] < $qtyNeeded){
                    $outOfStockItems[] = $row ? $row['product_name'] : "Unknown Product";
                }
            }

            // ❌ IF ANY STOCK ISSUE → STOP
            if(!empty($outOfStockItems)){
                return json_encode([
                    "status" => "stock_error",
                    "items" => $outOfStockItems
                ]);
            }


            // 🔹 calculate total
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['productprice'] * $item['productcount'];
            }

            // 🔹 get new order id (like your product method)
            $query = "SELECT MAX(id) AS last_id FROM orders";
            $qresult = $this->dbResult->query($query);
            $row = $qresult->fetch_assoc();
            $lastid = $row['last_id'];
            $newid = $lastid + 1;

            // 🔹 insert order
            $insertquery = "INSERT INTO orders 
            (id, customer_name, phone, address, district, payment_method, bank_ref, total_amount, status, cBy) 
            VALUES 
            ('$newid', '$customer_name', '$phone', '$address', '$district', '$payment_method', '$bank_ref', '$total', 'pending', '$cBy')";

            $sqlresult = $this->dbResult->query($insertquery);

            if ($sqlresult <= 0) {
                return json_encode([
                    "status" => "error",
                    "message" => "Order insert failed"
                ]);
            }

            // 🔹 insert order items
            foreach ($cart as $item) {

                $product_id   = $item['productid'];
                $product_name = $item['productname'];
                $price        = $item['productprice'];
                $qty          = $item['productcount'];

                $itemquery = "INSERT INTO order_items 
                (order_id, product_id, product_name, price, qty) 
                VALUES 
                ('$newid', '$product_id', '$product_name', '$price', '$qty')";

                $this->dbResult->query($itemquery);

                 // 🔹 Reduce stock
                $updateStock = "UPDATE product_tbl 
                                SET stock_quantity = stock_quantity - $qty 
                                WHERE product_id = '$product_id'";

                $this->dbResult->query($updateStock);
            }

            return json_encode([
                "status" => "success",
                "order_id" => $newid
            ]);
    }


    public function loadProducts(){

        $query = "SELECT * FROM product_tbl WHERE d_status = 0 ORDER BY product_id DESC";
        $res = $this->dbResult->query($query);

        while($row = $res->fetch_assoc()){

            echo '
            <tr>
                <td><img src="../'.$row['product_image'].'" width="60"></td>
                <td>'.$row['product_name'].'</td>
                <td>'.$row['price'].'</td>
                <td>'.$row['stock_quantity'].'</td>

                <td>
                    <button class="btn btn-warning btn-sm editBtn"
                        data-id="'.$row['product_id'].'"
                        data-name="'.$row['product_name'].'"
                        data-description="'.$row['description'].'"
                        data-price="'.$row['price'].'"
                        data-cost="'.$row['cost_price'].'"
                        data-stock="'.$row['stock_quantity'].'"
                        data-image="'.$row['product_image'].'">
                        Edit
                    </button>

                    <button class="btn btn-danger btn-sm"
                        onclick="deleteProduct('.$row['product_id'].')">
                        Delete
                    </button>
                </td>
            </tr>';
        }
    }

    public function updateProduct($id,$name,$desc,$price,$cost,$stock,$imgName="",$imgType="",$imgLoc=""){

        if(!empty($imgName)){
            $img = new ImageUpload();
            $url = $img->imgUpload($imgName,$imgType,'products',$imgLoc,$id);

            $q = "UPDATE product_tbl SET 
                product_name='$name',
                description='$desc',
                price='$price',
                cost_price='$cost',
                stock_quantity='$stock',
                image='$url'
            WHERE product_id='$id'";
        }else{
            $q = "UPDATE product_tbl SET 
                product_name='$name',
                description='$desc',
                price='$price',
                cost_price='$cost',
                stock_quantity='$stock'
            WHERE product_id='$id'";
        }

        return ($this->dbResult->query($q)) ? "success" : "error";
    }

    public function deleteProduct($id){

        $q = "UPDATE product_tbl 
            SET d_status = 1 
            WHERE product_id = '$id'";

        return ($this->dbResult->query($q)) ? "success" : "error";
    }

    public function loadMyOrders($userId){

        $q = "SELECT * FROM orders WHERE Cby='$userId' ORDER BY id DESC";
        $res = $this->dbResult->query($q);

        while($r = $res->fetch_assoc()){

            // 🎨 COLOR LOGIC
            $bg = "#e7f1ff"; // default blue

            if($r['status'] == "Delivered"){
                $bg = "#d4edda"; // green
            }

            if($r['payment_method'] == "Bank" && empty($r['bank_ref'])){
                $bg = "#fff3cd"; // orange
            }

            // 🧾 LOAD ITEMS
            $itemsQ = "SELECT product_name, qty FROM order_items WHERE order_id='".$r['id']."'";
            $itemsRes = $this->dbResult->query($itemsQ);

            $itemsHTML = "";
            while($i = $itemsRes->fetch_assoc()){
                $itemsHTML .= "<li>".$i['product_name']." (x".$i['qty'].")</li>";
            }

            echo '
            <div class="card mb-3" style="background:'.$bg.'">
                <div class="card-body">

                    <h6>Order #'.$r['id'].'</h6>

                    <p><b>Date:</b> '.$r['created_at'].'</p>
                    <p><b>Total:</b> Rs. '.$r['total_amount'].'</p>
                    <p><b>Payment:</b> '.$r['payment_method'].'</p>
                    <p><b>Status:</b> '.$r['status'].'</p>

                    <b>Items:</b>
                    <ul>'.$itemsHTML.'</ul>';

            // 🔥 SHOW FILE UPLOAD IF BANK & EMPTY
            if($r['payment_method']=="bank" && empty($r['bank_ref'])){
                echo '
                <input type="file" id="slip_'.$r['id'].'" class="form-control mb-2">
                <button class="btn btn-success btn-sm"
                    onclick="uploadSlip('.$r['id'].')">
                    Upload Slip
                </button>';
            }

            echo '
                </div>
            </div>';
        }
    }

    public function uploadSlip($orderId, $imageName, $imageType, $tmp){

         $imageObject = new ImageUpload;
            $imageurl = $imageObject->imgUpload($imageName, $imageType, 'slips', $tmp, $orderId);
        
            // 🔹 save path to DB
            $q = "UPDATE orders 
                SET bank_ref = '$imageurl' 
                WHERE id = '$orderId'";

            if($this->dbResult->query($q)){
                return "success";
            }else{
                return "db_error";
            }

       
    }
}
?>