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

    <title>Leong Lee | Analytics</title>
    <?php
    include_once("globalCSS.php");
    require_once 'include/common.php';
    ?>
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
                    <h2>Analytics</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="bargeList.php">Home</a>
                        </li>
                        <li class="active">
                            <strong>Analytics</strong>
                        </li>
                    </ol>
                </div>
            </div>
            
            <!--Embed the Data Studio Report-->
            <iframe width="900" height="507" src="https://datastudio.google.com/embed/reporting/23802310-e1a2-4421-b032-0a78f5f031fc/page/3gyDC" frameborder="0" style="border:0" allowfullscreen></iframe>
            
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