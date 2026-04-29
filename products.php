<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Product - Pet Products</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        .hover-card {
            transition: all 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
        }

        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .hover-card img {
            transition: transform 0.3s ease;
            border-radius: 10px;
        }

        .hover-card:hover img {
            transform: scale(1.03);
        }

        #floatingCart {
    position: fixed;
    bottom: 25px;
    right: 25px;
    background-color: #0d6efd;
    color: #fff;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    cursor: pointer;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    z-index: 999;
    transition: all 0.3s ease;
}

#floatingCart:hover {
    transform: scale(1.1);
    background-color: #0b5ed7;
}

/* Cart count badge */
#cartCount {
    position: absolute;
    top: 5px;
    right: 5px;
    background: red;
    color: white;
    font-size: 12px;
    padding: 3px 6px;
    border-radius: 50%;
}
    </style>
</head>

<body>
    <?php
    include_once('common.php');
    ?>
    <div class="d-flex justify-content-end my-1 mx-1">
    <button class="btn btn-primary" onclick="openOrderModal()">
        <i class="bi bi-bag"></i> My Order History
    </button>
</div>
    <div class="container">
        <div class="row justify-content-center">
            <div id="productview" class="row mt-3">

            </div>
        </div>
    </div>

    <div id="floatingCart" onclick="openCart()">
    <i class="bi bi-cart-fill"></i>
    <span id="cartCount">0</span>
</div>

<div class="modal fade" id="cartModal" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Your Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="row">

          <!-- LEFT SIDE (Products) -->
          <div class="col-md-8">
            <div id="cartItems"></div>
          </div>

          <!-- RIGHT SIDE (Summary) -->
          <div class="col-md-4 border-start">
            <h5>Total</h5>
            <h3 id="cartTotal">LKR. 0.00</h3>

            <hr>

            <h6>Payment Method</h6>
            <div>
            <input type="radio" name="payment" value="bank" checked> Bank Transfer<br>
            <input type="radio" name="payment" value="cod"> Cash on Delivery
            </div>

            <!-- BANK DETAILS (hidden/visible based on selection) -->
            <div id="bankDetails" class="mt-3 p-2 border rounded bg-light">
                <h6>Bank Details</h6>
                <p class="mb-1"><strong>Bank:</strong> ABC Bank</p>
                <p class="mb-1"><strong>Account Name:</strong> Pet Connect Store</p>
                <p class="mb-1"><strong>Account No:</strong> 1234567890</p>
                <p class="mb-0"><strong>Branch:</strong> Colombo</p>
            </div>
            <hr>

            <h6>Delivery Information</h6>

            <input type="text" id="custName" class="form-control mb-2" placeholder="Full Name">

            <input type="text" id="custPhone" class="form-control mb-2" placeholder="Phone Number">

            <textarea id="custAddress" class="form-control mb-2" placeholder="Delivery Address"></textarea>

            <select id="district" class="form-control mb-2">
                <option value="">Select District</option>
                <option>Colombo</option>
                <option>Gampaha</option>
                <option>Kalutara</option>
            </select>

            <button class="btn btn-success mt-3 w-100" id="chechoutbtn">
              Checkout
            </button>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="orderModal">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header">
                <h5>My Orders</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div id="orderList"></div>
            </div>

        </div>
    </div>
</div>

</body>


<script>
    $(document).ready(function(){

        $.get("lib/routes/product/loadallproducts.php", function (res) {
                $('#productview').html(res);

        })

        loadcount();

         // run on page load (default checked = bank)
        toggleBankDetails();

        // listen to change
        $('input[name="payment"]').on('change', function () {
            toggleBankDetails();
        });

        $('#chechoutbtn').on("click", function () {

            if ($('#loguserid').val() == "") {
                window.location.href = "login.php";
                return;
            }

             // 🔹 Get cart
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            // ✅ 1. Cart empty check
            if (cart.length === 0) {
                Swal.fire({
                    icon: "error",
                    title: "Cart Empty",
                    text: "Please add items to cart before checkout"
                });
                return;
            }

            let name = $('#custName').val().trim();
            let phone = $('#custPhone').val().trim();
            let address = $('#custAddress').val().trim();
            let district = $('#district').val();
            let payment = $('input[name="payment"]:checked').val();

            let isValid = true;

            // reset previous errors
            $('.form-control').removeClass('is-invalid');

            // Name validation
            if (name === "") {
                $('#custName').addClass('is-invalid');
                isValid = false;
            }

            // Phone validation (simple)
            let phonePattern = /^[0-9]{10}$/;
            if (!phonePattern.test(phone)) {
                $('#custPhone').addClass('is-invalid');
                isValid = false;
            }

            // Address validation
            if (address === "") {
                $('#custAddress').addClass('is-invalid');
                isValid = false;
            }

            // District validation
            if (district === "") {
                $('#district').addClass('is-invalid');
                isValid = false;
            }

            // Payment validation (extra safe)
            if (!payment) {
                alert("Please select a payment method");
                isValid = false;
            }

            // Final check
            if (!isValid) {
                Swal.fire({
                    icon: "error",
                    title: "Invalid Input",
                    text: "Please fill all required fields correctly"
                });
                return;
            }

            placeOrder();
        });

        
    })

    function openOrderModal(){

        console.log("clicked"); // debug

        // 1️⃣ Open modal manually
        var myModal = new bootstrap.Modal(document.getElementById('orderModal'));
        myModal.show();

        // 2️⃣ Show loading (optional but nice)
        $("#orderList").html("<div class='text-center'>Loading...</div>");

        // 3️⃣ Load data
        $.get("lib/routes/order/loadMyOrders.php", function(res){

            console.log(res); // debug response

            $("#orderList").html(res);

        }).fail(function(){
            $("#orderList").html("<div class='text-danger'>Failed to load orders</div>");
        });

    }

    // UPLOAD PAYMENT SLIP
    function uploadSlip(orderId){

        let file = $("#slip_"+orderId)[0].files[0];

        if(!file){
            Swal.fire("Error","Please select file","warning");
            return;
        }

        let formData = new FormData();
        formData.append("order_id", orderId);
        formData.append("slip", file);

        $.ajax({
            url: "lib/routes/order/uploadSlip.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,

            success: function(res){
                if(res.trim()=="success"){
                    Swal.fire("Success","Slip uploaded","success");
                    loadOrders();
                }else{
                    Swal.fire("Error","Upload failed","error");
                }
            }
        });
    }

    function placeOrder() {

        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        let data = {
            customer_name: $('#custName').val().trim(),
            customer_phone: $('#custPhone').val().trim(),
            customer_address: $('#custAddress').val().trim(),
            district: $('#district').val(),
            payment_method: $('input[name="payment"]:checked').val(),
            bank_ref: $('#bankRef').val() || "",
            cart: cart
        };

        $.ajax({
            url: "lib/routes/order/makeorder.php",
            type: "POST",
            data: { order: JSON.stringify(data) },

            success: function (res) {
                let response = JSON.parse(res);

                if (response.status === "success") {

                    Swal.fire({
                        icon: "success",
                        title: "Order Placed",
                        text: "Order ID: " + response.order_id
                    });

                    // clear cart
                    localStorage.removeItem('cart');
                    loadCart();
                    loadcount();

                    $('#cartModal').modal('hide');

                } else if (response.status === "stock_error") {

                    // convert array to list
                    let items = response.items.join(", ");

                    Swal.fire({
                        icon: "warning",
                        title: "Stock Issue",
                        html: "Please remove these items:<br><b>" + items + "</b>"
                    });

                } else {

                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response.message || "Something went wrong"
                    });

                }
            }
        });
    }

    function toggleBankDetails() {
        let payment = $('input[name="payment"]:checked').val();

        if (payment === "bank") {
            $('#bankDetails').show();
        } else {
            $('#bankDetails').hide();
        }
    }

    function openCart() {
        $('#cartModal').modal('show');

        loadCart()
    }

    function loadCart() {
        var cart = JSON.parse(localStorage.getItem('cart')) || [];
        var html = "";
        var total = 0;

        for (var i = 0; i < cart.length; i++) {

            total += cart[i].productprice * cart[i].productcount;

           html += `
                <div class="row align-items-center border p-2 mb-2">

                    <!-- IMAGE -->
                    <div class="col-2">
                        <img src="lib/${cart[i].productimage}" class="img-fluid rounded">
                    </div>

                    <!-- NAME + PRICE -->
                    <div class="col-4">
                        <h6 class="mb-1">${cart[i].productname}</h6>
                        <small class="text-muted">Rs. ${cart[i].productprice}</small>
                    </div>

                    <!-- QTY CONTROL -->
                    <div class="col-4 d-flex align-items-center justify-content-center">
                        <button class="btn btn-sm btn-outline-secondary" onclick="changeQty(${i}, -1)">-</button>

                        <span class="mx-2">${cart[i].productcount}</span>

                        <button class="btn btn-sm btn-outline-secondary" onclick="changeQty(${i}, 1)">+</button>
                    </div>

                    <!-- DELETE BUTTON -->
                    <div class="col-2 text-end">
                        <button onclick="removeItem(${i})" class="btn btn-sm btn-danger">
                            <i class="bi bi-trash"></i> X
                        </button>
                    </div>

                </div>
                `;
        }

        $('#cartItems').html(html);
        $('#cartTotal').text("LKR. " + total.toFixed(2));
    }

    function addcart(id, name, price, image){
        var item = {productid:id,
            productname:name,
            productprice:price,
            productimage:image,
            productcount:1,
        }
        if(localStorage.getItem('cart') === null){
            var cart=[];

            cart.push(item);

            localStorage.setItem('cart', JSON.stringify(cart));

            Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Product Added to cart",
                        showConfirmButton: false,
                        timer: 1000
                });
        }else{
            var cart = JSON.parse(localStorage.getItem('cart'));

            let exsist =false;

            for(var i = 0; i < cart.length; i++){
                var productid_cart = cart[i].productid;

                if(productid_cart == item.productid){
                       exsist = true;
                }
            }

            if(exsist){
                 Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "Product alredy added to cart",
                        showConfirmButton: false,
                        timer: 1000
                });
            }else{
                cart.push(item);

                localStorage.setItem('cart', JSON.stringify(cart));

                Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Product Added to cart",
                        showConfirmButton: false,
                        timer: 1000
                });
            }
        }

        loadcount();
       
    }

    function changeQty(index, change) {
        var cart = JSON.parse(localStorage.getItem('cart')) || [];

        cart[index].productcount += change;

        // remove if qty becomes 0
        if (cart[index].productcount <= 0) {
            cart.splice(index, 1);
        }

        localStorage.setItem('cart', JSON.stringify(cart));
        loadCart(); // reload UI
    }

    function removeItem(index) {
        var cart = JSON.parse(localStorage.getItem('cart')) || [];

        cart.splice(index, 1);

        localStorage.setItem('cart', JSON.stringify(cart));
        loadCart();
    }

    function loadcount(){
        var cart = JSON.parse(localStorage.getItem('cart'));

        if(cart.length > 0){
            $('#cartCount').html(cart.length);
        }else{
            $('#cartCount').html("0");
        }
    }
   
</script>

</html>