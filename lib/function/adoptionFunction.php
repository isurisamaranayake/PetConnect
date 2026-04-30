<?php
//start session
session_start();

include_once('main.php');

include_once('img_upload.php');

class Adoption extends Main{

    public function interested($petid){

     $cDate = date('Y-m-d H:i:s');
     $cby = $_SESSION['user_id'];
        
            $insertquery = "INSERT INTO interest_tbl (i_pet_id,i_status, cBy)
            VALUES ('$petid', 'interested','$cby');";

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

    public function interestlist($petid){

        
            $getquery = "SELECT *, interest_tbl.id AS iid FROM interest_tbl JOIN user_tbl ON user_tbl.id = interest_tbl.cBy WHERE i_pet_id = '$petid';";

            if($this->dbResult->error){
                    echo($this->dbResult->error);
                    exit;
                }
                
            $sqlresult = $this->dbResult->query($getquery);

            $nor = $sqlresult->num_rows;

            if($nor > 0){

            $number =1;

            while($rec = $sqlresult->fetch_assoc()){
                
                echo('<tr class="table-info">
                    <th scope="row">'. $rec['userName'] .'</th>
                    <td>'. $rec['phone'] .'</td>
                    <td>'. $rec['email'] .'</td>
                    <td><button type="button" onclick="transfer('. $rec['iid'] .','. $rec['i_pet_id'] .','. $rec['cBy'] .');" class="btn btn-warning">Transfer Pet</button></td>
                        </tr>');
                            //ipetid = pets id , cBy = person who put the interest request
                    $number ++;
            }

            }else{
                echo('<tr class="table-success">
                                <th scope="row" colspan=4 style="text-align:center;">No interested list</th>
                            </tr>');
            }
    }

    public function transferpet($interestid, $ipetid, $icby, $transfernotes,  $imageName="", $imageType="", $imageLocation=""){

        //get on cBy to variable
        $getquery = "SELECT cBy FROM pet_tbl WHERE pet_id = '$ipetid';";

        if($this->dbResult->error){
                        echo($this->dbResult->error);
                        exit;
                    } 
        $getresult = $this->dbResult->query($getquery);

        if($getresult->num_rows > 0){
            $row = $getresult->fetch_assoc();
            $oldCby = $row['cBy'];
        }
        //update pet tbl cby column to new interest user id 
        $updatequery = "UPDATE pet_tbl SET cBy = '$icby', status='adopted' WHERE pet_id = '$ipetid';";

            if($this->dbResult->error){
                        echo($this->dbResult->error);
                        exit;
                    }

            $sqlresult = $this->dbResult->query($updatequery);

            if($sqlresult > 0){
            //when its done delete all interest records for that pet
            $deletequery = "DELETE FROM interest_tbl WHERE i_pet_id = '$ipetid';";

            if($this->dbResult->error){
                        echo($this->dbResult->error);
                        exit;
                    }
            $sqlresult2 = $this->dbResult->query($deletequery);

            if($sqlresult2 > 0){

            if(!empty($imageName) && !empty($imageLocation)){

                $query = "SELECT MAX(id) AS last_id FROM transfer_tbl";
                $qresult = $this->dbResult->query($query);
                $row = $qresult->fetch_assoc();
                $lastid = $row['last_id'];
                $newid = $lastid+1;

                $imageObject = new ImageUpload;
                $imageurl = $imageObject->imgUpload($imageName, $imageType, 'documents', $imageLocation, $newid);
            }else{
                $imageurl ="";
            }
            //add transfer data to transfer_tbl
            $insertquery = "INSERT INTO transfer_tbl (t_pet_id, pet_from, pet_to, transfer_note, document)
            VALUE ('$ipetid', '$oldCby', '$icby','$transfernotes', '$imageurl');";

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
                }else{
                    return("error");
                }
                
                }else{
                    return("error");
             }
        }
    }
?>