<!DOCTYPE html>
<html>

<script>
    function signOut() {
    //   var auth2 = gapi.auth2.getAuthInstance();
    //   auth2.signOut().then(function () {
    //     console.log('User signed out.');
    //   });
    //   var profile = auth2.currentUser.get().getBasicProfile();
    //   console.log(profile);
      sessionStorage.clear();
      document.location.href = 'login.php';
    }

    function onLoad() {
    //   gapi.load('auth2', function() {
    //     gapi.auth2.init();
    //   });
    }
  </script>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Leong Lee | Add New MV Ticket</title>
    <?php include_once("globalCSS.php"); 
    require_once 'include/common.php';?>
    <!-- <link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>


</head>

<body>

    <div id="wrapper">

        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                                <img alt="image" class="img-circle" src="img/profile_small.jpg" />
                            </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Johnan An</strong>
                                    </span> <span class="text-muted text-xs block">Data Analyst</span> </span> </a>
                        </div>
                        <div class="logo-element">
                            IN+
                        </div>
                    </li>
                    <?php include_once('navbar.php') ?>
                </ul>

            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <div id="google_translate_element"></div>
                            <script type="text/javascript">
                                function googleTranslateElementInit() {
                                new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
                                }
                            </script>
                            <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                        </li>
                        <li>
                            <a href="#" onclick="signOut();">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-8">
                    <h2>Add New MV Ticket</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="bargeList.php">Home</a>
                        </li>
                        <li>
                            <a href="ticketList.php">Ticket Depository</a>
                        </li>
                        <li class="active">
                            <strong>Add New MV Ticket</strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Add New MV Ticket Details</h5>
                            </div>
                            <div class="ibox-content">
                            <!--- Error Msg---->
                            <?php
                                if (isset($_SESSION['errors'])) {
                                    $errorMsgs = '';
                                    foreach ($_SESSION['errors'] as $errorMsg) {
                                        $errorMsgs .= "<br>" . "- " . $errorMsg;
                                    }
                                    echo "<div class='alert alert-danger'><strong>Error!</strong> {$errorMsgs}</div>";
                                    unset($_SESSION['errors']);
                                } elseif (isset($_SESSION['bid_success'])) {
                                    $courseCode = $_SESSION['bid_success'][0];
                                    $courseSect = $_SESSION['bid_success'][1];
                                    $courseAmnt = '$' . $_SESSION['bid_success'][2];
                                    echo "<div class='alert alert-success'><strong>Success!</strong> You have bidded <strong> {$courseCode} - {$courseSect} </strong> for {$courseAmnt} successfully.</div>";
                                    unset($_SESSION['bid_success']);
                                }
                                ?>
                                <form id="bidForm" action="addMotherVesselTicketProcess.php" method="post">
                                    <!-- <div class="form-group">
                                        <label for="course_code">MSSI ID</label>
                                        <input type="text" class="form-control" name='mothervessel_mssi' placeholder="Mother Vessel MSSI" required>
                                    </div> -->
                                    <?php
                                    $mvdao = new MotherVesselDAO();
                                    $allmothervessels = $mvdao->retrieveAll();
                                    ?>

                                    <div class="form-group">
                                        <label for="sectionNo">Select a Mother Vessel</label>
                                        <select class="form-control" name="mv_name" id="mothervessels">
                                            <?php
                                            foreach ($allmothervessels as $eachmothervessel) {
                                            ?>
                                                <option value="<?php echo $eachmothervessel->getMVMSSI(); ?>"><?php echo $eachmothervessel->getMVMSSI(); ?> - <?php echo $eachmothervessel->getMVname(); } ?></option>
                                        </select>
                                    </div>

                                    <input type="hidden" id="contract_id" name="contract_id" value="<?php echo $_GET['id'];?>" readonly>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="course_code">Cast On</label>
                                                <div class="form-group">
                                                    <div class="input-group" id="datetimepicker1">
                                                        <input type="text" id="cast_on" name="cast_on" placeholder="Cast On" class="form-control" required>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="course_code">Cast Off</label>
                                                <div class="form-group">
                                                    <div class="input-group" id="datetimepicker2">
                                                        <input type="text" id="cast_off" name="cast_off" placeholder="Cast Off" class="form-control">
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <div class="col-md-3">
                                                <label class="course_code">Discharge Time (Day)</label>
                                                <div class="input-group date">
                                                    <input type="text" class="form-control" name='mothervessel_mssi' placeholder="Discharge Time" required>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="course_code">Amount of Coal (ton)</label>
                                                <div class="input-group date">
                                                    <input type="text" class="form-control" name='amt_coal' placeholder="Amount of Coal (ton)" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="course_code">Remarks</label>
                                        <input type="text" class="form-control" name='remarks' placeholder="Remarks">
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="SubmitMVTicket">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">
                <div>
                    <strong>Copyrights</strong> Leong Lee &copy; 2021
                </div>
            </div>
        </div>
    </div>

    <!-- Mainly scripts -->
    <!-- <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="js/plugins/dataTables/datatables.min.js"></script>

    <!-- Custom and plugin javascript -->
    <!-- <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script> --> -->

    <!-- Page-Level Scripts -->
    <script type="text/javascript">
        $(function() {
            $('#datetimepicker1').datetimepicker();
        });

        $(function() {
            $('#datetimepicker2').datetimepicker();
        });
    </script>

    <!-- <script src="js/plugins/datapicker/bootstrap-datepicker.js"></script> -->

</body>

</html>