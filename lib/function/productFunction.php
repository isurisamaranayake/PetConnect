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

            $cBy = $_SESSION['user_id'];

        $getquery = "SELECT * FROM product_tbl WHERE stock_quantity > 0";

        if($this->dbResult->error){
                echo($this->dbResult->error);
                exit;
            }
        $sqlresult = $this->dbResult->query($getquery);

        $nor = $sqlresult->num_rows;

        if($nor > 0){

        $number =1;

        while($rec = $sqlresult->fetch_assoc()){
            
            echo('<div class="col-4" onclick="loadproduct('. $rec['product_id'] .');">
                    <div class="card bg-light mb-3 hover-card">
                        <div class="card-body" style ="text-align: center;">
                            <img style="height:270px" src="lib/'. $rec['product_image'] .'"alt="">
                            <h4 class="card-title">'. $rec['product_name'] .'</h4>
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
    


    }
?>