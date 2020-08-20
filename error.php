<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="captiveportal-bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="captiveportal-style.css" rel="stylesheet">

    <link rel="icon" href="captiveportal-pngegg.png">

    <title>WALTER SINGKO WIFI</title>
    
</head>

<body>
    <form action="$PORTAL_ACTION$" method="post">
        <div class="container p-1">
            <div class="border border-warning rounded p-2">
                <!-- Custom couresel Start -->
                <!-- Note: Image size is 644 x 329 -->
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators" id="carousel_indicator">
                        <!-- captiveportal-customjs.js -->
                    </ol>
                    <div class="carousel-inner" id="carousel_image">
                        <!-- captiveportal-customjs.js -->
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <!-- Custom couresel End -->
                <div class="horizontal-clear"></div>
                <div class="btn-group special" aria-label="Basic example">
                    <button type="button" id="btn_voucher_form" class="btn btn-warning btn-sm">Voucher Login</button>
                    <button type="button" id="btn_member_form" class="btn btn-info btn-sm">Member Login</button>
                </div>
                <div class="horizontal-clear"></div>
                <div class="alert alert-danger" role="alert">
                    $PORTAL_MESSAGE$
                </div>
                <div class="horizontal-clear"></div>
                <div id="voucher_input">
                    <div class="form-group">
                        <label for="voucherCode" class="label-style">Voucher Code</label>
                        <input type="text" name="auth_voucher" class="form-control" id="voucherCode" placeholder="Enter Voucher Code">
                    </div>
                </div>

                <div id="member_input" class="d-none">
                    <div class="form-group">
                        <label for="username" class="label-style">Username</label>
                        <input type="text" name="auth_user" class="form-control" id="username" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                        <label for="password" class="label-style">Password</label>
                        <input type="password" name="auth_pass" class="form-control" id="password" placeholder="Password">
                    </div>
                </div>

                <input name="redirurl" type="hidden" value="$PORTAL_REDIRURL$">

                <input name="accept" class="btn btn-success btn-block" type="submit" value="Continue" />

                <div class="horizontal-clear"></div>
                <button class="btn btn-info btn-block" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    View Rates
                </button>
                <div class="horizontal-clear"></div>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body" id="rate">
                        <!-- captiveportal-customjs.js -->
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="captiveportal-jquery-3.2.1.slim.min.js"></script>
    <script src="captiveportal-popper-1.12.9.min.js"></script>
    <script src="captiveportal-bootstrap.min.js"></script>

    <!-- Custom JavaScript -->
    <script src="captiveportal-customjs.js"></script>

    <script>
        $('#btn_voucher_form').click(function(){
            $('#member_input').addClass('d-none');
            $('#voucher_input').removeClass('d-none');
        });

        $('#btn_member_form').click(function(){
            $('#voucher_input').addClass('d-none');
            $('#member_input').removeClass('d-none');
        });
    </script>

</body>

</html>
