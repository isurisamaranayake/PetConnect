<?php

include_once('main.php');

class Report extends Main{

    // HEADERS
    public function getHeaders($type){

        if($type == "users"){
            echo "<tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                  </tr>";
        }

        if($type == "pets"){
            echo "<tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Breed</th>
                    <th>Location</th>
                  </tr>";
        }

        if($type == "orders"){
            echo "<tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Status</th>
                  </tr>";
        }

        if($type == "adoption"){
           echo "<tr>
                <th>ID</th>
                <th>Pet</th>
                <th>From User</th>
                <th>To User</th>
                <th>Note</th>
            </tr>";
        }
    }

    // DATA
    public function getData($type){

            if($type == "users"){

                    $res = $this->dbResult->query("SELECT * FROM user_tbl WHERE d_status=0");

                    while($r = $res->fetch_assoc()){
                        echo "<tr>
                                <td>{$r['id']}</td>
                                <td>{$r['userName']}</td>
                                <td>{$r['email']}</td>
                                <td>{$r['phone']}</td>
                                <td>{$r['userType']}</td>
                            </tr>";
                    }
                }

                if($type == "pets"){

                    $res = $this->dbResult->query("SELECT * FROM pet_tbl WHERE d_status=0");

                    while($r = $res->fetch_assoc()){
                        echo "<tr>
                                <td>{$r['pet_id']}</td>
                                <td>{$r['name']}</td>
                                <td>{$r['type']}</td>
                                <td>{$r['breed']}</td>
                                <td>{$r['pet_location']}</td>
                            </tr>";
                    }
                }

                if($type == "orders"){

                    $res = $this->dbResult->query("SELECT * FROM orders");

                    while($r = $res->fetch_assoc()){
                        echo "<tr>
                                <td>{$r['id']}</td>
                                <td>{$r['created_at']}</td>
                                <td>{$r['customer_name']}</td>
                                <td>{$r['total_amount']}</td>
                                <td>{$r['status']}</td>
                            </tr>";
                    }
                }

            if($type == "adoption"){

            $res = $this->dbResult->query("
                SELECT 
                    t.id,

                    p.name AS pet_name,
                    p.type AS pet_type,

                    u1.userName AS from_name,
                    u1.phone AS from_phone,

                    u2.userName AS to_name,
                    u2.phone AS to_phone,

                    t.transfer_note

                FROM transfer_tbl t

                LEFT JOIN pet_tbl p 
                    ON t.t_pet_id = p.pet_id

                LEFT JOIN user_tbl u1 
                    ON t.pet_from = u1.id

                LEFT JOIN user_tbl u2 
                    ON t.pet_to = u2.id
            ");

            while($r = $res->fetch_assoc()){

                echo "<tr>
                        <td>{$r['id']}</td>

                        <td>
                            {$r['pet_name']} <br>
                            <small>{$r['pet_type']}</small>
                        </td>

                        <td>
                            {$r['from_name']} <br>
                            <small>{$r['from_phone']}</small>
                        </td>

                        <td>
                            {$r['to_name']} <br>
                            <small>{$r['to_phone']}</small>
                        </td>

                        <td>{$r['transfer_note']}</td>
                    </tr>";
            }
        }
    }

    public function getCounts(){

        // 👤 USERS (exclude deleted)
        $u = $this->dbResult->query("SELECT COUNT(*) AS total FROM user_tbl WHERE d_status=0");
        $users = $u->fetch_assoc()['total'];

        // 🐾 PETS
        $p = $this->dbResult->query("SELECT COUNT(*) AS total FROM pet_tbl WHERE d_status=0");
        $pets = $p->fetch_assoc()['total'];

        // 🔄 ADOPTIONS (transfer)
        $a = $this->dbResult->query("SELECT COUNT(*) AS total FROM transfer_tbl");
        $adoptions = $a->fetch_assoc()['total'];

        // 🛒 ORDERS
        $o = $this->dbResult->query("SELECT COUNT(*) AS total FROM orders");
        $orders = $o->fetch_assoc()['total'];

        return json_encode([
            "users" => $users,
            "pets" => $pets,
            "adoptions" => $adoptions,
            "orders" => $orders
        ]);
    }

    public function getCounts2(){

        // 👤 USERS (exclude deleted)
        $u = $this->dbResult->query("SELECT COUNT(*) AS total FROM user_tbl WHERE d_status=0");
        $users = $u->fetch_assoc()['total'];

        // 🐾 PETS
        $p = $this->dbResult->query("SELECT COUNT(*) AS total FROM pet_tbl WHERE d_status=0");
        $pets = $p->fetch_assoc()['total'];

        // 🔄 ADOPTIONS (transfer)
        $a = $this->dbResult->query("SELECT COUNT(*) AS total FROM transfer_tbl");
        $adoptions = $a->fetch_assoc()['total'];

        // 🛒 ORDERS
        $o = $this->dbResult->query("SELECT COUNT(*) AS description FROM consultation_tbl");
        $orders = $o->fetch_assoc()['description'];

        return json_encode([
            "users" => $users,
            "pets" => $pets,
            "adoptions" => $adoptions,
            "orders" => $orders
        ]);
    }
}
  
?>