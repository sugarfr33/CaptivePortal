<?php
// Start the session
session_start();
?>
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
    <?php
        $cpdb = captiveportal_read_db();
    
        
        function print_details($cpent) {
            global $config, $cpzone, $cpzoneid;
        
        
            /* print the time left before session timeout or session terminate time or the closer of the two if both are set */
            if (!empty($cpent[7]) && !empty($cpent[9])) {
                $session_time_left = min($cpent[0] + $cpent[7] - time(),$cpent[9] - time());
                printf(gettext("Session time left: %s"), convert_seconds_to_dhms($session_time_left));
            } elseif (!empty($cpent[7]) && empty($cpent[9])) {
                $session_time_left = $cpent[0] + $cpent[7] - time();
                printf(gettext("Session time left: %s"), convert_seconds_to_dhms($session_time_left));
            } elseif (empty($cpent[7]) && !empty($cpent[9])) {
                $session_time_left = $cpent[9] - time();
                printf(gettext("Session time left: %s"), convert_seconds_to_dhms($session_time_left));
            }

            printf(gettext("Session time left: %s"), $session_time_left);
        }

        function get_TimeRemaining($cpent) {
            /* print the time left before session timeout or session terminate time or the closer of the two if both are set */
            if (!empty($cpent[7]) && !empty($cpent[9])) {
                $session_time_left = min($cpent[0] + $cpent[7] - time(),$cpent[9] - time());
            } elseif (!empty($cpent[7]) && empty($cpent[9])) {
                $session_time_left = $cpent[0] + $cpent[7] - time();
            } elseif (empty($cpent[7]) && !empty($cpent[9])) {
                $session_time_left = $cpent[9] - time();
            }
            return $session_time_left;
        }

        foreach ($cpdb as $cpent) { 
            if (htmlspecialchars($cpent[2]) == $clientip) {
                $remaining_time = get_TimeRemaining($cpent);
                break;
            }
        }

        //$remaining_time = 324935;
        if (isset($remaining_time)) {
            $_SESSION["remaining_time"] = $remaining_time;
            date_default_timezone_set('Asia/Manila');
            $date = date('m/d/Y h:i:s a', time());
            $_SESSION["year"] = date('Y', time());
            $_SESSION["month"] = date('m', time()) - 1;
            $_SESSION["day"] = date('d', time());
            $_SESSION["hour"] = date('H', time());
            $_SESSION["minute"] = date('i', time()) - 2;
            $_SESSION["second"] = date('s', time()) - 10;
        }
    ?>

    <form action="<?=$logouturl;?>" method="post">
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
                <div class="alert alert-success" role="alert">
                    <p class="text-center"><strong>Login successful!</strong></p>
                </div>
                <h3><p class="text-sm-left text-center label-style">Time Remaining <br> <span class="badge badge-success" id="timer"></span></p></h3>

                <input name="logout_id" type="hidden" value="<?=$sessionid;?>" />
                <input name="zone" type="hidden" value="<?=$cpzone;?>" />
                <!-- <input name="logout" class="btn btn-danger btn-block" type="submit" value="Logout" /> -->
                <div id="btn_start">
                    
                    <div class="btn-group special" aria-label="Basic example">
                        <a class="btn btn-primary btn-sm" href="https://facebook.com" target="_blank" role="button">Go to Facebook</a>
                        <a class="btn btn-danger btn-sm" href="https://youtube.com" target="_blank" role="button">Go to YouTube</a>
                    </div>
                </div>

                <div class="horizontal-clear"></div>
                <table class="table table-borderless table-sm">
                    <tr>
                        <td>
                            <h6><strong style="color: #fff">Voucher Code: </strong></h6>
                        </td>
                        <td>
                            <h6><span class="badge badge-success">
                                <?php foreach ($cpdb as $cpent) { 
                                    if (htmlspecialchars($cpent[2]) == $clientip) {
                                        printf("%s", htmlspecialchars($cpent[4])); 
                                        break;
                                    }
                                }?>
                            </span></h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h6><strong style="color: #fff">IP Address: </strong></h6>
                        </td>
                        <td>
                            <h6><span class="badge badge-primary"><?=$clientip;?></span></h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h6>
                                <strong style="color: #fff">MAC: </strong>
                            </h6>
                        </td>
                        <td>
                            <h6>
                                <span class="badge badge-warning">
                                    <?php foreach ($cpdb as $cpent) { 
                                        if (htmlspecialchars($cpent[2]) == $clientip) {
                                            $mac=trim($cpent[3]);
                                            if (!empty($mac)) {
                                                $mac_hi = strtoupper($mac[0] . $mac[1] . $mac[3] . $mac[4] . $mac[6] . $mac[7]);
                                                print htmlentities($mac);
                                                break;
                                            }
                                        }
                                    }?>
                                </span>
                            </h6>
                        </td>
                    </tr>
                </table>
                <div class="horizontal-clear"></div>

                <a class="btn btn-success btn-block d-none" id="btn_relogin" href="http://10.0.0.1" role="button">Re-Login</a>

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
        <audio id="disconnected" loop>
            <source src="captiveportal-disconnected.mp3" type="audio/mpeg">
        </audio>
    </form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="captiveportal-jquery-3.2.1.slim.min.js"></script>
    <script src="captiveportal-popper-1.12.9.min.js"></script>
    <script src="captiveportal-bootstrap.min.js"></script>

    <!-- Custom JavaScript -->
    <script src="captiveportal-customjs.js"></script>

    <script>
  
        document.addEventListener('DOMContentLoaded', function (event) {
            
            var d = new Date(<?=$_SESSION["year"];?>, <?=$_SESSION["month"];?>, <?=$_SESSION["day"];?>, <?=$_SESSION["hour"];?>, <?=$_SESSION["minute"];?>, <?=$_SESSION["second"];?>, 0);
            var remaining_time = <?=$_SESSION["remaining_time"]; ?>;
            /*if (remaining_time) {
                localStorage.setItem('remaining_time', remaining_time);
                localStorage.setItem('year', <?=$_SESSION["year"];?>);
                localStorage.setItem('month', <?=$_SESSION["month"];?>);
                localStorage.setItem('day', <?=$_SESSION["day"];?>);
                localStorage.setItem('hour', <?=$_SESSION["hour"];?>);
                localStorage.setItem('minute', <?=$_SESSION["minute"];?>);
                localStorage.setItem('second', <?=$_SESSION["second"];?>);
            }
            
            remaining_time = localStorage.getItem('remaining_time');*/
            //var d = new Date(localStorage.getItem('year'), localStorage.getItem('month'), localStorage.getItem('day'), localStorage.getItem('hour'), localStorage.getItem('minute'), localStorage.getItem('second'), 0);
            var countDownDate;
            countDownDate = d;
            countDownDate.setSeconds( countDownDate.getSeconds() + parseInt(remaining_time) );
            countDownDate = countDownDate.getTime();
            // Set the date we're counting down to
            //var countDownDate = new Date().getTime();

            // Update the count down every 1 second
            var x = setInterval(function() {

                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Display the result in the element with id="timer"
                document.getElementById("timer").innerHTML = days + "d " + hours + "h "
                + minutes + "m " + seconds + "s ";

                // If the count down is finished, write some text
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("timer").innerHTML = "EXPIRED";
                    $('#btn_relogin').removeClass('d-none');
                    $('#btn_start').addClass('d-none');
                    $('#timer').removeClass('badge-success');
                    $('#timer').addClass('badge-danger');
                    $('audio#disconnected')[0].play();
                }
            }, 500);

            
        });
        
    </script>

</body>

</html>
