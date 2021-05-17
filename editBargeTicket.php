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

    <title>Leong Lee | Edit Barge Ticket Details</title>
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
                    <h2>Edit Barge Ticket Details</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a href="ticketList.php">Ticket Depository</a>
                        </li>
                        <li class="active">
                            <strong>Edit Barge Ticket Details</strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Edit Barge Ticket Details</h5>
                            </div>
                            <div class="ibox-content">
                                <form id="bidForm" action="editBargeTicketProcess.php" method="post">
                                <input type="hidden" id="barge_ticket_id" name="barge_ticket_id" value="<?php echo $_GET['id'];?>" readonly>
                                <?php
                                    $dao = new BargeTicketDAO();
                                    $bargeticket = $dao->retrieve($_GET['id']);

                                    $bargedao = new BargeDAO();
                                    $thebarge =  $bargedao->retrieve($bargeticket->getMSSI());
                                    $allbarge = $bargedao->retrieveAll();
                                    
                                ?>
                                    <div class="form-group">
                                        <label class="course_code">Select a Barge</label>
                                        <select class="form-control m-b" name="barge_name" id="barges">
                                        <option value="<?php echo $thebarge->getbMSSI(); ?>"><?php echo $thebarge->getbMSSI(); ?> - <?php echo $thebarge->getbname(); ?></option>
                                        <?php
                                            foreach ($allbarge as $eachbarge) {
                                        ?>
                                            <option value="<?php echo $eachbarge->getbMSSI(); ?>"><?php echo $eachbarge->getbMSSI(); ?> - <?php echo $eachbarge->getbname(); } ?></option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="course_code">Cast On @ MV</label>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" id="cast_on_mv" name="cast_on_mv" placeholder="Cast On @ MV" class="form-control" value="<?php echo $bargeticket->getCastOnMV(); ?>" readonly>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="course_code">Cast Off @ MV</label>
                                                <div class="form-group">
                                                    <div class="input-group" <?php if (empty($bargeticket->getCastOffMV())){?> id="datetimepicker2"><?php } else { echo ">"; }?>
                                                        <input type="text" id="cast_off_mv" name="cast_off_mv" placeholder="Cast Off @ MV" class="form-control" value="<?php echo $bargeticket->getCastOffMV(); ?>" <?php if (!empty($bargeticket->getCastOffMV())){?> readonly <?php }?>>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="course_code">Arrival @ PP</label>
                                                <div class="form-group">
                                                    <div class="input-group" <?php if (empty($bargeticket->getArrivalPP())){?> id="datetimepicker3"><?php } else { echo ">"; }?>
                                                        <input type="text" id="arrival_pp" name="arrival_pp" placeholder="Arrival @ PP" class="form-control" value="<?php echo $bargeticket->getArrivalPP(); ?>" <?php if (!empty($bargeticket->getArrivalPP())){?> readonly <?php }?>>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="course_code">Cast On @ PP</label>
                                                <div class="form-group">
                                                    <div class="input-group" <?php if (empty($bargeticket->getCastOnPP())){?> id="datetimepicker4"><?php } else { echo ">"; }?>
                                                        <input type="text" id="cast_on_pp" name="cast_on_pp" placeholder="Cast On @ PP" class="form-control" value="<?php echo $bargeticket->getCastOnPP(); ?>" <?php if (!empty($bargeticket->getCastOnPP())){?> readonly <?php }?>>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="course_code">Cast Off @ PP</label>
                                                <div class="form-group">
                                                    <div class="input-group" <?php if (empty($bargeticket->getCastOffPP())){?> id="datetimepicker5"><?php } else { echo ">"; }?>
                                                        <input type="text" id="cast_off_pp" name="cast_off_pp" placeholder="Cast Off @ PP" class="form-control" value="<?php echo $bargeticket->getCastOffPP(); ?>" <?php if (!empty($bargeticket->getCastOffPP())){?> readonly <?php }?>>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="course_code">Amount of Coal (ton)</label>
                                                <input type="text" class="form-control" id='discharged_qty' name='discharged_qty' placeholder="Amount of Coal (ton)" value="<?php echo $bargeticket->getAmtOfCoal(); ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="course_code">Remarks</label>
                                        <input type="text" class="form-control" id='remarks' name='remarks' placeholder="Remarks" value="<?php echo $bargeticket->getRemarks(); ?>">
                                    </div>
                                    <!--return back to addTicket page-->
                                    <button type="submit" class="btn btn-primary" name="SubmitBargeTicket">Submit</button>

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
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script> -->

    <!-- Page-Level Scripts -->
    <script type="text/javascript">
        $(function() {
            $('#datetimepicker1').datetimepicker();
        });

        $(function() {
            $('#datetimepicker2').datetimepicker();
        });

        $(function() {
            $('#datetimepicker3').datetimepicker();
        });

        $(function() {
            $('#datetimepicker4').datetimepicker();
        });

        $(function() {
            $('#datetimepicker5').datetimepicker();
        });
    </script>
    <!-- <script src="js/plugins/datapicker/bootstrap-datepicker.js"></script> -->

</body>

</html>