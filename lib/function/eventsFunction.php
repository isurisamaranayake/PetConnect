<?php
//start session
session_start();

include_once('main.php');

include_once('img_upload.php');

class Event extends Main{

    public function addevent($title, $description, $event_date, $event_time, $location, $imageName, $imageType, $imageLocation){

     $query = "SELECT MAX(event_id) AS last_id FROM events_tbl";
     $qresult = $this->dbResult->query($query);
     $row = $qresult->fetch_assoc();
     $lastid = $row['last_id'];
     $newid = $lastid+1;

     $imageObject = new ImageUpload;
     $imageurl = $imageObject->imgUpload($imageName, $imageType, 'events', $imageLocation, $newid);
        

            $insertquery = "INSERT INTO events_tbl (title, description, event_date, event_time, location, image,event_status)
            VALUE ('$title', '$description', '$event_date', '$event_time', '$location','$imageurl','ongoing');";

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

    public function loadallpetevents(){

    $today = date('Y-m-d');

    $getquery = "SELECT * FROM events_tbl 
                 WHERE event_date >= '$today' 
                 ORDER BY event_date ASC";

    if($this->dbResult->error){
        echo($this->dbResult->error);
        exit;
    }

    $sqlresult = $this->dbResult->query($getquery);

    if($sqlresult->num_rows > 0){

        while($rec = $sqlresult->fetch_assoc()){

            echo('
<div class="col-12 mb-4">
    <div class="card shadow-sm">

        <!-- Header -->
        <div class="card-header d-flex justify-content-between">
            <strong>'.$rec['title'].'</strong>
            <small>'.$rec['event_date'].' '.$rec['event_time'].'</small>
        </div>

        <!-- Image -->
        <img src="lib/'.$rec['image'].'" class="card-img-top" style="max-height:400px; object-fit:cover;">

        <!-- Body -->
        <div class="card-body">
            <p class="card-text">'.$rec['description'].'</p>
            <p><strong>📍 '.$rec['location'].'</strong></p>
        </div>

        <!-- Footer (Like button) -->
        <div class="card-footer d-flex justify-content-between align-items-center">

            <button class="btn btn-light like-btn" data-id="'.$rec['event_id'].'">
                <i class="bi bi-hand-thumbs-up"></i> Like
            </button>

            <span class="text-muted">'.$rec['event_status'].'</span>

        </div>

    </div>
</div>
');
        }

    } else {
        echo('
        <div class="alert alert-warning">
            No upcoming events available
        </div>
        ');
    }
}
    


    }
?>