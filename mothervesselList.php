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

    <?php
    require_once 'include/common.php';
    ?>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Leong Lee | Mother Vessel Depository</title>
    <?php
    include_once("globalCSS.php");
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
                    <h2>Mother Vessel Depository</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="bargeList.php">Home</a>
                        </li>
                        <li class="active">
                            <strong>Mother Vessel Depository</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-4">
                    <div class="title-action">
                        <a href="addMotherVessel.php" class="btn btn-primary">Add New Mother Vessel</a>
                    </div>
                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Mother Vessel Depository </h5>
                            </div>
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example">
                                        <thead>
                                            <?php
                                            require_once('include/MotherVesselDAO.php');
                                            $dao = new MotherVesselDAO();
                                            $result = $dao->retrieveAll();
                                            ?>
                                            <tr>
                                                <th>MV MSSI</th>
                                                <th>MV Name</th>
                                                <th>MV LOA (m)</th>
                                                <th>MV Capacity/DWT (ton)</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($result as $mothervessel) { ?>
                                                <tr>
                                                    <td><?php echo $mothervessel->getMVMSSI(); ?></td>
                                                    <td><?php echo $mothervessel->getMVname(); ?></td>
                                                    <td><?php echo $mothervessel->getMVLOA(); ?></td>
                                                    <td><?php echo $mothervessel->getMVcap(); ?></td>
                                                    <td>
                                                        <a href='editMotherVessel.php?id=<?php echo $mothervessel->getMVMSSI() ?>'>
                                                            <button class="thatbuttoncontainer">
                                                                <span>Edit</span>
                                                            </button>
                                                        </a>
                                                        <a href='delMotherVesselProcess.php?id=<?php echo $mothervessel->getMVMSSI() ?>' onClick="javascript: return confirm('Please confirm deletion of this Mother Vessel');">
                                                            <button class="thatbuttoncontainer">
                                                                <span>Delete</span>
                                                            </button>
                                                        </a>
                                                    </td>
                                                <?php } ?>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
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

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [{
                        extend: 'copy'
                    },
                    {
                        extend: 'csv',
                        title: 'MV List'
                    },
                    {
                        extend: 'excel',
                        title: 'MV List'
                    },
                    {
                        extend: 'pdf',
                        title: 'MV List'
                    },

                    {
                        extend: 'print',
                        customize: function(win) {
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    }
                ]

            });

        });
    </script>

</body>

</html>