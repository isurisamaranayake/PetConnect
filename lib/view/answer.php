<?php
//start session
session_start();

if(isset($_SESSION['user_id'])){
    $usertype = $_SESSION['user_Type'];

    if($usertype != 'vet'){
        header('location:../../login.php'); 
    }

}else{
    header('location:../../login.php');
}

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
          <h3 class="mb-0">Answer Question</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Answer Question</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="app-content">
    <div class="container-fluid">
      <table class="table table-hover">
        <thead>
          <tr class="table-dark">
            <th>Question Date</th>
            <th>Priority</th>
            <th>Question</th>
            <th>Pet Details</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="pettrackers"></tbody>
      </table>
      <!--end::Row-->
      <!--begin::Row-->
      <div class="row">
        <!-- Start col -->

        <!-- /.Start col -->
      </div>
      <!-- /.row (main row) -->
    </div>
    <!--end::Container-->
  </div>
  <!--end::App Content-->


  <div class="modal fade" id="answerModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Answer Question</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <input type="hidden" id="qid">

          <textarea class="form-control" id="answerText" placeholder="Type your answer..." rows="4"></textarea>
        </div>

        <div class="modal-footer">
          <button class="btn btn-primary" id="submitAnswer">Submit</button>
        </div>

      </div>
    </div>
  </div>

  <script>
    $(document).ready(function () {
      loadQuestions();

      // CLICK ANSWER BUTTON
      $(document).on('click', '.answerBtn', function () {

        let id = $(this).data('id');
        let status = $(this).data('status');

        if (status !== 'pending') {
          alert("Already taken or answered!");
          return;
        }

        //  Step 1: Change status to GET
        $.ajax({
          url: "../routes/consultation/updateStatus.php",
          type: "POST",
          data: {
            id: id,
            status: 'get'
          },
          success: function () {

            $("#qid").val(id);
            $("#answerModal").modal('show');

          }
        });

      });


      // SUBMIT ANSWER


      $("#submitAnswer").click(function () {

        let id = $("#qid").val();
        let answer = $("#answerText").val();

        if (answer == "") {
          Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Please enter answer'
          });
          return;
        }

        $.ajax({
          url: "../routes/consultation/submitAnswer.php",
          type: "POST",
          data: {
            id: id,
            answer: answer
          },
          success: function (res) {

            if (res.trim() == "success") {

              Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Answered successfully',
                timer: 1500,
                showConfirmButton: false
              });

              $("#answerModal").modal('hide');
              $("#answerText").val("");

              loadQuestions();

            } else {
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Something went wrong!'
              });
            }
          },
          error: function () {
            Swal.fire({
              icon: 'error',
              title: 'Server Error',
              text: 'Please try again later'
            });
          }
        });

      });

    });

    function loadQuestions() {

      $.ajax({
        url: "../routes/consultation/loadQuestions.php",
        type: "GET",
        success: function (res) {
          $("#pettrackers").html(res);
        }
      });

    }
  </script>

  <?php
        include_once('footer.php')
        ?>