<?php
//start sessions
session_start();

include_once('main.php');

include_once('img_upload.php');

class Tracking extends Main{

    public function saveTracker($pet_id, $trackers){

        //  Step 1: Delete existing records for this pet
        $deleteQuery = "DELETE FROM pet_tracker_tbl WHERE pet_id = '$pet_id'";
        $deleteResult = $this->dbResult->query($deleteQuery);

        if(!$deleteResult){
            return "error";
        }

        // Step 2: Insert new records
        foreach ($trackers as $row) {

            $date = $row['date'];
            $time = $row['time'];
            $description = $row['description'];

            $insertquery = "INSERT INTO pet_tracker_tbl 
            (pet_id, date, time, description) 
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
            $today = date('Y-m-d');

            while($row = $result->fetch_assoc()){

                $isPast = ($row['date'] < $today);

                // Row style (disabled look)
                $rowStyle = $isPast ? "style='background-color:#f5f5f5; opacity:0.6;'" : "";

                //  Hide delete button if past
                $deleteBtn = $isPast 
                    ? "" 
                    : "<button class='btn btn-danger btn-sm removeRow'>
                            <i class='bi bi-trash'></i>
                    </button>";

                $html .= "<tr $rowStyle>
                            <td>".$row['date']."</td>
                            <td>".substr($row['time'], 0, 5)."</td>
                            <td>".$row['description']."</td>
                            <td>$deleteBtn</td>
                        </tr>";
            }

            return $html;
    }

    public function getnotification(){

        $cby = $_SESSION['user_id'];
        $today = date('Y-m-d');

        //  Get user's pets
        $petQuery = "SELECT pet_id, name FROM pet_tbl 
                    WHERE d_status = 0 
                    AND cBy = '$cby' 
                    AND (status = 'mypet' OR status = 'adopted')";

        $petResult = $this->dbResult->query($petQuery);

        $html = "";

        if($petResult->num_rows > 0){

            while($pet = $petResult->fetch_assoc()){

                $pet_id = $pet['pet_id'];
                $pet_name = $pet['name'];

                //  Get today's tracker records for this pet
                $trackQuery = "SELECT * FROM pet_tracker_tbl 
                            WHERE pet_id = '$pet_id' 
                            AND date = '$today'";

                $trackResult = $this->dbResult->query($trackQuery);

                if($trackResult->num_rows > 0){

                    while($row = $trackResult->fetch_assoc()){

                        $time = date("H:i", strtotime($row['time']));
                        $desc = $row['description'];

                        //  Notification item
                        $html .= "
                            <div class='dropdown-item'>
                                <strong>Pet Name - $pet_name</strong><br>
                                <small>description - $desc at - $time</small>
                            </div>
                            <div class='dropdown-divider'></div>
                        ";
                    }
                }
            }

            if($html == ""){
                $html = "No notifications today";
            }

        }else{
            $html = "No pets found";
        }

        return $html;
    }

}

?>