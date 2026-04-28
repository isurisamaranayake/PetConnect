<?php
//start session
session_start();

include_once('main.php');

class staff extends Main{

    public function addstaff($full_name, $email, $phone, $userid, $password, $confirm_password, $role){

        $validatequery = "SELECT * FROM staff_tbl WHERE email ='$email' AND d_status = 0;";

        if($this->dbResult->error){
            echo($this->dbResult->error);
            exit;
        }  
        
        $sqlvalidateresult =$this->dbResult->query($validatequery);

        $nor = $sqlvalidateresult->num_rows;

        if($nor>0){
            return("Email address already exists");
        }else{
             $cDate = date('Y-m-d H:i:s');
        

            $insertquery ="INSERT INTO staff_tbl (full_name, email, phone, userid, role, cDate, d_status)
            VALUE ('$full_name','$email', '$phone', '$userid', '$role','$cDate', 0);";

            if($this->dbResult->error){
                echo($this->dbResult->error);
                exit;
            }

            $sqlresult =$this->dbResult->query($insertquery);
            
            $lastsavedid = $this->dbResult->insert_id;

            $encryptedpassword = md5($password);

            $insertquery2 ="INSERT INTO login_tbl VALUES ('$lastsavedid', '$email', '$encryptedpassword', '$role', 'Active', 0);";

            if($this->dbResult->error){
                echo($this->dbResult->error);
                exit;
            }

            $sqlresult2 =$this->dbResult->query($insertquery2);
            
            if($sqlresult > 0 && $sqlresult2 > 0){
                return("success");
            }else{
                return("error");
            }
        }

    }

    public function editstaff($petid, $type, $breed, $name, $gender, $pet_age, $pet_size, $pet_color, $pet_location, $otherdetails,
     $imageName="", $imageType = "", $imageLocation =""){

     $cDate = date('Y-m-d H:i:s');
     $cby = $_SESSION['user_id'];

     if(!empty($imageName) && !empty($imageLocation)){

     $imageObject = new ImageUpload;
     $imageurl = $imageObject->imgUpload($imageName, $imageType, 'pets', $imageLocation, $petid);
       
        $updatequery = "UPDATE pet_tbl SET 
            type = '$type',
            breed = '$breed',
            name = '$name',
            gender = '$gender',
            pet_age = '$pet_age',
            pet_size = '$pet_size',
            pet_color = '$pet_color',
            pet_location = '$pet_location',
            otherdetails = '$otherdetails',
            image = '$imageurl',
            status = 'updated'

         WHERE pet_id = '$petid';";

        if($this->dbResult->error){
                echo($this->dbResult->error);
                exit;
            }

            $sqlresult =$this->dbResult->query($updatequery);

            if($sqlresult > 0){
                return("success");
            }else{
                return("error");
            }

     }else{
        $updatequery = "UPDATE pet_tbl SET 
            type = '$type',
            breed = '$breed',
            name = '$name',
            gender = '$gender',
            pet_age = '$pet_age',
            pet_size = '$pet_size',
            pet_color = '$pet_color',
            pet_location = '$pet_location',
            otherdetails = '$otherdetails',
            status = 'updated'

         WHERE pet_id = '$petid';";

        if($this->dbResult->error){
                echo($this->dbResult->error);
                exit;
            }

            $sqlresult =$this->dbResult->query($updatequery);

            if($sqlresult > 0){
                return("success");
            }else{
                return("error");
            }


     }
    }

    public function mystafflist(){

        $cBy = $_SESSION['user_id'];
        $usertype = $_SESSION['user_Type'];

        $path ="";

        if($usertype == 'admin'){
            $path = "lib/";
        }else{
            $path = "../";

        }

            $getquery = "SELECT *, pet_tbl.cDate AS pcdate FROM pet_tbl JOIN user_tbl ON pet_tbl.cBy = user_tbl.id WHERE pet_tbl.d_status = 0 AND cBy = '$cBy' AND (status != 'mypet' AND status != 'adopted');";

            if($this->dbResult->error){
                    echo($this->dbResult->error);
                    exit;
                }
                
            $sqlresult = $this->dbResult->query($getquery);

            $nor = $sqlresult->num_rows;

            if($nor > 0){

            $number =1;

            while($rec = $sqlresult->fetch_assoc()){
                $date = date("Y-m-d",strtotime($rec['pcdate']));


                echo('<tr class="table-success">
                                <th scope="row">'.$number.'</th>
                                <td>'. $rec['type'] .'</td>
                                <td>'. $rec['breed'] .'</td>
                                <td>'. $rec['name'] .'</td>
                                <td><img style="height:100px;" src="'.$path. $rec['image'] .'"></td>
                                <td>'.$date.'<br>('. $rec['pet_location'] .')</td>
                                <td>'. $rec['status'] .'</td>
                                <td><button type="button" data-petid="'. $rec['pet_id'] .'" class="btn btn-warning editpetdata"><i class="bi bi-pencil-square"></i></button><button type="button" onclick="deletepet('. $rec['pet_id'] .');" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button><button type="button" onclick="viewintlist('. $rec['pet_id'] .');" class="btn btn-info"><i class="bi bi-chat-heart-fill"></i></button></td></tr>');
                            $number ++;
            }

            }else{
                echo('<tr class="table-success">
                                <th scope="row" colspan=9 style="text-align:center;">No My Pets Yet</th>
                            </tr>');
            }

    }
    
}
?>