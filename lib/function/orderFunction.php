<?php
//start session
session_start();

include_once('main.php');

include_once('img_upload.php');

class Order extends Main{

   public function loadAllOrders(){

    $q = "SELECT * FROM orders 
          ORDER BY 
          CASE WHEN status='Delivered' THEN 1 ELSE 0 END,
          id DESC";

    $res = $this->dbResult->query($q);

    while($r = $res->fetch_assoc()){

        // 🔹 Load items
        $itemsQ = "SELECT product_name, qty FROM order_items WHERE order_id='".$r['id']."'";
        $itemsRes = $this->dbResult->query($itemsQ);

        $itemsHTML = "";
        while($i = $itemsRes->fetch_assoc()){
            $itemsHTML .= $i['product_name']." (x".$i['qty'].")<br>";
        }

        // 🔹 Slip
        $slip = "-";
        if(!empty($r['bank_ref'])){
            $slip = "<a href='../".$r['bank_ref']."' target='_blank'>View Slip</a>";
        }

        // 🔹 Status color
        $statusBadge = ($r['status']=="Delivered")
            ? "<span class='badge bg-success'>Delivered</span>"
            : "<span class='badge bg-warning'>Pending</span>";

        // 🔹 Action button condition
        $action = "";

        if($r['status'] != "Delivered"){

            // COD → always show
            if($r['payment_method']=="cod"){
                $action = "<button class='btn btn-success btn-sm'
                            onclick='markDelivered(".$r['id'].")'>
                            Deliver
                           </button>";
            }

            // Bank → only if slip uploaded
            if($r['payment_method']=="bank" && !empty($r['bank_ref'])){
                $action = "<button class='btn btn-success btn-sm'
                            onclick='markDelivered(".$r['id'].")'>
                            Deliver
                           </button>";
            }
        }

        echo "
        <tr>
            <td>".$r['id']."</td>
            <td>".$r['created_at']."</td>

            <td>
                ".$r['customer_name']."<br>
                ".$r['phone']."<br>
                ".$r['address']."<br>
                ".$r['district']."
            </td>

            <td>".$itemsHTML."</td>

            <td>Rs. ".$r['total_amount']."</td>

            <td>".$r['payment_method']."</td>

            <td>".$slip."</td>

            <td>".$statusBadge."</td>

            <td>".$action."</td>
        </tr>
        ";
    }
}

public function markDelivered($id){

    $q = "UPDATE orders 
          SET status='Delivered' 
          WHERE id='$id'";

    return ($this->dbResult->query($q)) ? "success" : "error";
}
}
?>