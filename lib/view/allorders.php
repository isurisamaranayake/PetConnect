<?php
//session start
session_start();

if(isset($_SESSION['user_id'])){
    $usertype = $_SESSION['user_Type'];

    if($usertype == 'adopter' || $usertype == 'vet'){
        header('location:../../login.php');    
    }

}else{
    header('location:../../login.php');
};

include_once('sidebar.php');

?>

<!--begin::App Main-->
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">All Orders</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Orders</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->

            <!--end::Row-->
            <!--begin::Row-->
            <div class="row">
                <!-- Start col -->
                   <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Customer Details</th>
                                <th>Products</th>
                                <th>Total</th>
                                <th>Payment</th>
                                <th>Slip</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="orderTable"></tbody>
                    </table>
                <!-- /.Start col -->
            </div>
            <!-- /.row (main row) -->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>
<!--end::App Main-->

<script>
   $(document).ready(function () {
    loadOrders();
});

// LOAD ALL ORDERS
function loadOrders(){
    $.get("../routes/order/loadAllOrders.php", function(res){
        $("#orderTable").html(res);
    });
}

// MARK AS DELIVERED
function markDelivered(id){

    Swal.fire({
        title: "Mark as Delivered?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Yes"
    }).then((result)=>{

        if(result.isConfirmed){

            $.post("../routes/order/markDelivered.php",{id:id},function(res){

                if(res.trim()=="success"){
                    Swal.fire("Success","Order marked as delivered","success");
                    loadOrders();
                }else{
                    Swal.fire("Error","Failed","error");
                }

            });

        }

    });
}
</script>

<?php
      include_once('footer.php')
      ?>