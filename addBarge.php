<?php
require_once 'include/common.php';
?>
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

    <title>Leong Lee | Add New Barge</title>
    <?php include_once("globalCSS.php"); ?>
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
                    <h2>Add New Barge</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="bargeList.php">Home</a>
                        </li>
                        <li>
                            <a href="bargeList.php">Barge Depository</a>
                        </li>
                        <li class="active">
                            <strong>Add New Barge</strong>
                        </li>
                    </ol>
                </div>
                <!--<div class="col-lg-4">
                    <div class="title-action">
                        <a href="addBarge.php" target="_blank" class="btn btn-primary">Add New Barge</a>
                    </div>
                </div>-->
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Add New Barge Details</h5>
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

                                <form id="addBargeForm" action="addBargeProcess.php" method="post">
                                    <div class="form-group">
                                        <label for="barge_mssi">Barge MSSI</label>
                                        <input type="text" class="form-control" name='barge_mssi' placeholder="Barge MSSI" id='barge_mssi'>
                                    </div>
                                    <div class="form-group">
                                        <label for="barge_name">Barge Name</label>
                                        <input type="text" class="form-control" name='barge_name' placeholder="Barge Name" id="barge_name">
                                    </div>
                                    <div class="form-group">
                                        <label for="barge_LOA">Barge LOA (m)</label>
                                        <input type="text" class="form-control" name='barge_LOA' placeholder="Barge LOA (m)" id="barge_LOA">
                                    </div>
                                    <div class="form-group">
                                        <label for="barge_cap">Barge Capacity/DWT (ton)</label>
                                        <input type="text" class="form-control" name='barge_capacity' placeholder="Barge Capacity/DWT (ton)" id="barge_capacity">
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="SubmitBarge">Submit</button>
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
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="js/plugins/dataTables/datatables.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

</body>

</html>