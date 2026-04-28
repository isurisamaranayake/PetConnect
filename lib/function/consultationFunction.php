<?php
//start sessions
session_start();

include_once('main.php');

include_once('img_upload.php');

class Con extends Main{

   public function askquestion($petid, $description, $priority, $imageName="", $imageType="", $imageLocation=""){

    $cBy = $_SESSION['user_id']; // logged user

    if(!empty($imageName) && !empty($imageLocation)){
        $query = "SELECT MAX(id) AS last_id FROM consultation_tbl";
        $qresult = $this->dbResult->query($query);
        $row = $qresult->fetch_assoc();
        $lastid = $row['last_id'];
        $newid = $lastid + 1;

        $imageObject = new ImageUpload;
        $imageurl = $imageObject->imgUpload($imageName, $imageType, 'question_documents', $imageLocation, $newid);
    } else {
        $imageurl = "";
    }

    $insertquery = "INSERT INTO consultation_tbl 
    (c_pet_id, description, document, status, cBy, priority) 
    VALUES 
    ('$petid', '$description', '$imageurl', 'pending', '$cBy', '$priority');";

    if($this->dbResult->error){
        echo($this->dbResult->error);
        exit;
    }

    $sqlresult = $this->dbResult->query($insertquery);

    if($sqlresult){
        return "success";
    } else {
        return "error";
    }
}

public function loadPendingQuestions(){

    $query = "SELECT c.*, p.name, p.type 
              FROM consultation_tbl c
              LEFT JOIN pet_tbl p ON c.c_pet_id = p.pet_id
              WHERE c.status = 'pending'
              ORDER BY c.c_date DESC";

    if($this->dbResult->error){
        echo($this->dbResult->error);
        exit;
    }

    $result = $this->dbResult->query($query);

    if($result->num_rows > 0){

        while($row = $result->fetch_assoc()){

            // Priority color
            $color = "";
            if($row['priority'] == 'low') $color = "success";
            elseif($row['priority'] == 'medium') $color = "warning";
            elseif($row['priority'] == 'high') $color = "info";
            elseif($row['priority'] == 'urgent') $color = "danger";

            echo('
            <tr>
                <td>'.$row['c_date'].'</td>

                <td>
                    <span class="badge bg-'.$color.' text-uppercase">
                        '.$row['priority'].'
                    </span>
                </td>

                <td>'.$row['description'].'</td>

                <td>
                    '.$row['name'].' <br>
                    <small>'.$row['type'].'</small>
                </td>

                    <td>
                        <button class="btn btn-sm btn-success answerBtn"
                            data-id="'.$row['id'].'"
                            data-status="'.$row['status'].'">
                            Answer
                        </button>
                    </td>
            </tr>
            ');
        }

    } else {
        echo('
        <tr>
            <td colspan="5" class="text-center text-muted">
                No pending questions
            </td>
        </tr>
        ');
    }
}

public function updateStatus($id, $status){

    // check current status
    $check = "SELECT status FROM consultation_tbl WHERE id='$id'";
    $res = $this->dbResult->query($check);
    $row = $res->fetch_assoc();

    if($row['status'] != 'pending'){
        return "invalid";
    }

    $query = "UPDATE consultation_tbl SET status='$status' WHERE id='$id'";
    $result = $this->dbResult->query($query);

    return $result ? "success" : "error";
}

public function submitAnswer($id, $answer){

    $answerBy = $_SESSION['user_id'];

    $query = "UPDATE consultation_tbl 
              SET answer='$answer',
                  status='answered',
                  answerBy='$answerBy'
              WHERE id='$id'";

    $result = $this->dbResult->query($query);

    return $result ? "success" : "error";
}
    

}

?>