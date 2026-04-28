<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Pet Events</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">

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
    </style>
</head>

<body>

    <?php include_once('common.php'); ?>

    <div class="container">
        <div class="row justify-content-center">

            <!-- EVENT LIST -->
            <div id="eventview" style="width:70%" class="row mt-3"></div>

        </div>
    </div>


    <script>
        $(document).ready(function () {
            loadEvents();

            $(document).on('click', '.like-btn', function () {

                let id = $(this).data('id');

                if (localStorage.getItem('liked_' + id)) {
                    return;
                }

                localStorage.setItem('liked_' + id, true);

                $(this).addClass('liked');
                $(this).html('<i class="bi bi-hand-thumbs-up-fill"></i> Liked');
                $(this).css({
                    'color': 'blue',
                    'font-weight': 'bold'
                });
            });
        });

        $('#eventdetails').hide();

        function loadEvents() {
            $.get("lib/routes/events/loadallpetevents.php", function (res) {
                $('#eventview').html(res);
            });
        }


    </script>

</body>

</html>