<?php
//start session
session_start();

include_once('main.php');

class staff extends Main{

    // ADD
    public function addstaff($name,$email,$phone,$nic,$password,$role){

        $check = $this->dbResult->query("SELECT * FROM user_tbl WHERE email='$email' AND d_status=0");

        if($check->num_rows > 0){
            return "Email already exists";
        }

        $date = date('Y-m-d H:i:s');

        $this->dbResult->query("INSERT INTO user_tbl 
        (email,userName,phone,userType,cDate,d_status)
        VALUES('$email','$name','$phone','$role','$date',0)");

        $id = $this->dbResult->insert_id;

        $pass = md5($password);

        $this->dbResult->query("INSERT INTO login_tbl 
        VALUES('$id','$email','$pass','$role','Active',0)");

        return "success";
    }

    // LOAD
   public function loadStaff(){

    $res = $this->dbResult->query("
        SELECT u.*, l.login_status 
        FROM user_tbl u
        JOIN login_tbl l ON u.id = l.id
        WHERE l.login_status = 0 
        AND u.userType != 'Adopter'
    ");

    while($r = $res->fetch_assoc()){

        // ✅ Dynamic button text & color
        if($r['login_status'] == "Active"){
            $btnText = "Deactivate";
            $btnClass = "btn-danger";
        }else{
            $btnText = "Activate";
            $btnClass = "btn-success";
        }

        echo '
        <tr>
            <td>'.$r['userName'].'</td>
            <td>'.$r['email'].'</td>
            <td>'.$r['userType'].'</td>
            <td>'.$r['login_status'].'</td>

            <td>
                <button class="btn btn-warning btn-sm editBtn"
                    data-id="'.$r['id'].'"
                    data-name="'.$r['userName'].'"
                    data-email="'.$r['email'].'"
                    data-phone="'.$r['phone'].'"
                    data-nic="'.$r['email'].'"
                    data-role="'.$r['userType'].'">
                    Edit
                </button>

                <button class="btn '.$btnClass.' btn-sm"
                    onclick="toggleStatus('.$r['id'].','.$_SESSION['user_id'].')">
                    '.$btnText.'
                </button>

                <button class="btn btn-info btn-sm"
                    onclick="resetPassword('.$r['id'].','.$_SESSION['user_id'].')">
                    Reset Password
                </button>
            </td>
        </tr>';
    }
}

    // UPDATE
    public function updateStaff($id,$name,$email,$phone,$nic,$role){

       $q1 = "UPDATE user_tbl SET 
        userName='$name',
        email='$email',
        phone='$phone',
        userType='$role'
      WHERE id='$id'";

$q2 = "UPDATE login_tbl SET 
        login_email='$email',
        login_type='$role'
      WHERE id='$id'";

$this->dbResult->query($q1);
$this->dbResult->query($q2);

return "success";
    }

    // TOGGLE STATUS
    public function toggleStatus($id){

        $q = "UPDATE login_tbl 
              SET login_status = IF(login_status='Active','Deactive','Active')
              WHERE id='$id'";

        $this->dbResult->query($q);

        return "success";
    }

    // RESET PASSWORD
    public function resetPassword($id){

        $pass = md5("123456");

        $q = "UPDATE login_tbl 
              SET password='$pass'
              WHERE id='$id'";

        $this->dbResult->query($q);

        return "success";
    }
}
    
?>