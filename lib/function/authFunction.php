<?php
//start session
session_start();

include_once('main.php');

class Auth extends Main{

    public function registration($email, $name, $phone, $password, $usertype){

        $validatequery = "SELECT * FROM user_tbl WHERE email ='$email' AND d_status = 0;";

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
        

            $insertquery ="INSERT INTO user_tbl (email, userName, phone, userType, cDate, d_status)
            VALUE ('$email', '$name', '$phone', '$usertype', '$cDate', 0);";

            if($this->dbResult->error){
                echo($this->dbResult->error);
                exit;
            }

            $sqlresult =$this->dbResult->query($insertquery);
            
            $lastsavedid = $this->dbResult->insert_id;

            $encryptedpassword = md5($password);

            $insertquery2 ="INSERT INTO login_tbl VALUES ('$lastsavedid', '$email', '$encryptedpassword', '$usertype', 'Active', 0);";

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
    public function authentication($username, $password){

            $selectquery ="SELECT *, login_tbl.id AS lid FROM login_tbl JOIN user_tbl ON login_tbl.id = user_tbl.id WHERE login_email = '$username' AND login_tbl.d_status = 0;";

            if($this->dbResult->error){
            echo($this->dbResult->error);
            exit;
        }  
        
            $sqlvalidateresult =$this->dbResult->query($selectquery);

            $nor = $sqlvalidateresult->num_rows;

            if($nor> 0){
                $row = $sqlvalidateresult->fetch_assoc();

                $dbpassword = $row['login_password'];
                $loginstatus = $row['login_status'];
                $usertype = $row['login_type'];
                $userid = $row['lid'];
                $name = $row['userName'];

                $userpassword = md5($password);

                if($dbpassword == $userpassword){
                    if($loginstatus == "Active"){
                        switch($usertype){
                            case"Admin":

                            $_SESSION['user_id']=$userid;
                            $_SESSION['user_Type']='admin';
                            $_SESSION['user_Name']=$name;
                                return json_encode([
                                    'status'=>True,
                                    'message'=>'Login Successfully!',
                                    'path'=>'lib/view/admin.php'
                    ]);
                            case"Vet":
                            $_SESSION['user_id']=$userid;
                            $_SESSION['user_Type']='vet';
                            $_SESSION['user_Name']=$name;
                                return json_encode([
                                    'status'=>True,
                                    'message'=>'Login Successfully!',
                                    'path'=>'lib/view/vet.php'
                    ]);
                            case"Adopter":
                            $_SESSION['user_id']=$userid;
                            $_SESSION['user_Type']='adopter';
                            $_SESSION['user_Name']=$name;
                                return json_encode([
                                    'status'=>True,
                                    'message'=>'Login Successfully!',
                                    'path'=>'index.php'
                    ]);
                        }                
                    }else{
                        return json_encode([
                            'status'=>false,
                            'message'=>'Your Account is Deactivated!'
                    ]);
                    }

                }else{
                    return json_encode([
                    'status'=>false,
                    'message'=>'Wrong Password'
                ]);
                }

            }else{
                return json_encode([
                    'status'=>false,
                    'message'=>'Wrong Email Address'
                ]);
            }
    }      
}
?>