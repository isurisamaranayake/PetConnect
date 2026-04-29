<?php
//start session
session_start();

include_once('main.php');

include_once('img_upload.php');

class pet extends Main{

    public function addpet($type, $breed, $name, $gender, $pet_age, $pet_size, $pet_color,$pet_location, $otherdetails, $imageName, $imageType, $imageLocation, $petfor){

            $cDate = date('Y-m-d H:i:s');
            $cby = $_SESSION['user_id'];

            $query = "SELECT MAX(pet_id) AS last_id FROM pet_tbl";
            $qresult = $this->dbResult->query($query);
            $row = $qresult->fetch_assoc();
            $lastid = $row['last_id'];
            $newid = $lastid+1;

            $imageObject = new ImageUpload;
            $imageurl = $imageObject->imgUpload($imageName, $imageType, 'pets', $imageLocation, $newid);

            $status="";
            
            if($petfor == "my own pet"){
                $status="mypet";

            }else{
                $status="pending";

            }
                

            $insertquery = "INSERT INTO pet_tbl (type, breed, name, gender, pet_age, pet_size, pet_color, pet_location, otherdetails, image, status, cDate, cBy, d_status)
            VALUE ('$type', '$breed', '$name','$gender', '$pet_age', '$pet_size','$pet_color','$pet_location', '$otherdetails', '$imageurl','$status', '$cDate', '$cby', 0);";

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
    
    public function editpet($petid, $type, $breed, $name, $gender, $pet_age, $pet_size, $pet_color, $pet_location, $otherdetails,
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

    public function approvepetlist(){

        $getquery = "SELECT *, pet_tbl.cDate AS pcdate FROM pet_tbl JOIN user_tbl ON pet_tbl.cBy = user_tbl.id WHERE pet_tbl.d_status = 0 AND (status = 'pending' OR status = 'updated');";

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
            $badge = "";
            if($rec['status'] == 'pending'){
                $badge = '<span class="badge bg-info">New</span>';
            }else{
                $badge = '<span class="badge bg-warning">Updated</span>';
            }

            echo('<tr class="table-success">
                            <th scope="row">'.$number.'</th>
                            <td>'. $rec['type'] .'</td>
                            <td>'. $rec['breed'] .'</td>
                            <td>'. $rec['name'] .'</td>
                            <td><img style="height:100px;" src="../'. $rec['image'] .'"></td>
                            <td>'. $rec['email'].'<br>'. $rec['phone'].'</td>
                            <td>'.$date.'</td>
                            <td>'.$badge.'</td>
                            <td><button type="button" onclick="approvepet('. $rec['pet_id'] .');" class="btn btn-success">Approve</button><button type="button" onclick="rejectpet('. $rec['pet_id'] .');" class="btn btn-danger">Reject</button></td>
                        </tr>');
                        $number ++;
        }

        }else{
            echo('<tr class="table-success">
                            <th scope="row" colspan=8 style="text-align:center;">No Records to Approve</th>
                        </tr>');
        }

    }

    public function approvepet($petid){

        $updatequery = "UPDATE pet_tbl SET status = 'approved' WHERE pet_id = '$petid';";

            if($this->dbResult->error){
                        echo($this->dbResult->error);
                        exit;
                    }

        $sqlresult = $this->dbResult->query($updatequery);

        if($sqlresult > 0){
                return("success");
            }else{
                return("error");
            }
    }

    public function rejectpet($petid){

        $updatequery = "UPDATE pet_tbl SET status = 'rejected' WHERE pet_id = '$petid';";

            if($this->dbResult->error){
                        echo($this->dbResult->error);
                        exit;
                    }

        $sqlresult = $this->dbResult->query($updatequery);

        if($sqlresult > 0){
                return("success");
            }else{
                return("error");
            }
    }
    
    public function mypetlist(){

        $cBy = $_SESSION['user_id'];
        $usertype = $_SESSION['user_Type'];

        $path ="";

        if($usertype == 'adopter'){
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

    public function myownpetlist(){

        $cBy = $_SESSION['user_id'];
        $usertype = $_SESSION['user_Type'];

        $path ="";

        if($usertype == 'adopter'){
            $path = "lib/";
        }else{
            $path = "../";

        }

            $getquery = "SELECT *, pet_tbl.cDate AS pcdate FROM pet_tbl JOIN user_tbl ON pet_tbl.cBy = user_tbl.id WHERE pet_tbl.d_status = 0 AND cBy = '$cBy' AND (status = 'mypet' OR status = 'adopted');";

            if($this->dbResult->error){
                    echo($this->dbResult->error);
                    exit;
                }
                
           $sqlresult = $this->dbResult->query($getquery);

        $nor = $sqlresult->num_rows;

        if($nor > 0){

        $number =1;
        while($rec =$sqlresult->fetch_assoc()){
            $date = date("Y-m-d", strtotime($rec['pcdate']));

            $petid = $rec['pet_id'];

            $getquery = "SELECT * FROM transfer_tbl WHERE t_pet_id = '$petid';";

                    if($this->dbResult->error){
                        echo($this->dbResult->error);
                        exit;
                    }

                $sqlresult2 = $this->dbResult->query($getquery);

                $nor = $sqlresult2->num_rows;

                $comment = "";

                if($nor > 0){

                    $number =1;

                    while($rec2 =$sqlresult2->fetch_assoc()){

                        $link = "" ;

                        if($rec2['document'] != ""){
                            $doc = $rec2['document'];
                            $link = "<a href='lib/$doc' target='_blank'>view documnt</a>";
                        }
                        
                        $comment = $comment . $number . " - " .$rec2['transfer_note'] . "<br>" . $link . "<br><br>";
                        
                        $number ++;
                    }

                }

                    echo('<tr class="table-success">
                                <th scope="row">'.$number.'</th>
                                <td>'. $rec['type'].'</td>
                                <td>'. $rec['breed'].'</td>
                                <td>'. $rec['name'].'</td>
                                <td><img style="height:100px;" src="'.$path. $rec['image'].'"></td>
                                <td>'. $date.'<br> ('. $rec['pet_location'].')</td>
                                <td>'. $rec['status'].'</td>
                                <td>'. $comment.'</td>
                                <td style="text-align:center;"> 
                                <button type="button" onclick="pettracker('. $rec['pet_id'].');" class="btn btn-info">Pet Tracker</button><br>
                                <button type="button" onclick="petcon('. $rec['pet_id'].');" class="btn btn-warning">Consultation</button><br>
                                <button type="button" onclick="deletepet('. $rec['pet_id'].');" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                </td>
                                </tr>');
                    $number ++;
            }

        }else{
            echo('<tr class="table-success">
                        <th scope="row" colspan=9 style="text-align:center;" >No My Pets Yet</th>
                    </tr>');
        }

    }

    public function petlistforadoption(){

            $cBy = $_SESSION['user_id'];

        $getquery = "SELECT * FROM pet_tbl WHERE pet_tbl.d_status = 0 AND status = 'approved' AND cBy != ' $cBy';";

        if($this->dbResult->error){
                echo($this->dbResult->error);
                exit;
            }
        $sqlresult = $this->dbResult->query($getquery);

        $nor = $sqlresult->num_rows;

        if($nor > 0){

        $number =1;

        while($rec = $sqlresult->fetch_assoc()){
            
            echo('<div class="col-4" onclick="loadpet('. $rec['pet_id'] .');">
                    <div class="card bg-light mb-3 hover-card">
                        <div class="card-body" style ="text-align: center;">
                            <img style="height:270px" src="lib/'. $rec['image'] .'"alt="">
                            <h4 class="card-title">'. $rec['name'] .'</h4>
                        </div>
                    </div>
                </div>');
                        $number ++;
        }
        }else{
            echo('<div class="alert alert-dismissible alert-warning">
                <button type="button" class="btn-close" data-bs-dismiss="alert" fdprocessedid="h1fap"></button>
                <h4 class="alert-heading">No Pets Found For Adoption</h4>
                </div>');
        }
    }

    public function filteredpetlistforadoption($category,$age,$size,$location){

            $cBy = $_SESSION['user_id'];

        $getquery = "SELECT * FROM pet_tbl WHERE d_status = 0 AND status = 'approved' AND ('$category' = '--' OR pet_tbl.type = '$category') 
        AND ('$age' = '--' OR pet_age = '$age') AND ('$size' = '--' OR pet_size = '$size') AND ('$location' = '--' OR pet_location = '$location') AND cBy != '$cBy';";

        if($this->dbResult->error){
                echo($this->dbResult->error);
                exit;
            }
        $sqlresult = $this->dbResult->query($getquery);

        $nor = $sqlresult->num_rows;

        if($nor > 0){

        $number =1;

        while($rec = $sqlresult->fetch_assoc()){
            
            echo('<div class="col-4" onclick="loadpet('. $rec['pet_id'] .');">
                    <div class="card bg-light mb-3 hover-card">
                        <div class="card-body" style ="text-align: center;">
                            <img style="height:270px" src="lib/'. $rec['image'] .'"alt="">
                            <h4 class="card-title">'. $rec['name'] .'</h4>
                        </div>
                    </div>
                </div>');
                        $number ++;
        }
        }else{
            echo('<div class="alert alert-dismissible alert-warning">
                <button type="button" class="btn-close" data-bs-dismiss="alert" fdprocessedid="h1fap"></button>
                <h4 class="alert-heading">No Pets Found For Adoption</h4>
                </div>');
        }
    }

    public function petdatabyid($petid){

        $cby = $_SESSION['user_id'];

        $selectquery = "SELECT * FROM pet_tbl JOIN user_tbl on pet_tbl.cBy = user_tbl.id 
        LEFT JOIN interest_tbl ON interest_tbl.i_pet_id = pet_tbl.pet_id AND interest_tbl.cBy = '$cby' WHERE pet_tbl.pet_id = '$petid';";

        if($this->dbResult->error){
                echo($this->dbResult->error);
                exit;
            }
        $sqlresult = $this->dbResult->query($selectquery);

        $nor = $sqlresult->num_rows;

        if($nor > 0 ){
            $rec = $sqlresult->fetch_assoc();

            return json_encode($rec);

        }else{

        }
    }

    public function deletepet($petid){

        $updatequery = "UPDATE pet_tbl SET d_status = 1 WHERE pet_id = '$petid';";

            if($this->dbResult->error){
                        echo($this->dbResult->error);
                        exit;
                    }

        $sqlresult = $this->dbResult->query($updatequery);

        if($sqlresult > 0){
                return("success");
            }else{
                return("error");
            }
    }

    public function saveTracker($pet_id, $trackers){

        foreach ($trackers as $row) {

            $date = $row['date'];
            $time = $row['time'];
            $description = $row['description'];

            $insertquery = "INSERT INTO pet_tracker_tbl
            (pet_id, date, time, discription)
            VALUES
            ('$pet_id', '$date', '$time', '$description')";

            $result = $this->dbResult->query($insertquery);

            if(!$result){
                return "error";
            }
        }

        return "success";
    }

    public function getTracker($pet_id){
        $query = "SELECT * FROM pet_tracker_tbl
                WHERE pet_id = '$pet_id'
                ORDER BY date DESC, time DESC";
        
        $result = $this->dbResult->query($query);
        $html = "";

        while($row = $result->fetch_assoc()){
            $html .= "<tr>
                        <td>".$row['date']."</td>
                        <td>".substr($row['time'],0,5)."</td>
                        <td>".$row['discription']."</td>
                        <td>
                            <button class='btn btn-danger btn-sm removeRow'>
                                <i class='bi bi-trash'></i>
                            </button>
                        </td>
                    </tr>";
        }
        
        return $html;
    }



    }
?>