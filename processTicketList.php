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

    <title>Leong Lee | MV Ticket Depository</title>
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
                    <h2>MV Ticket Depository</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="bargeList.php">Home</a>
                        </li>
                        <li class="active">
                            <strong>MV Ticket Depository</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-4">
                    <div class="title-action">
                        <?php

                            if (is_null(@$_POST['contract_id'])){
                                $cid = $_GET['id'];
                            }
                            else{$cid = $_POST['contract_id'];} 
                            ?>

                            <?php
                                if ($cid!=0){ ?>
                        <a href="addTicket.php?id=<?php echo $cid ?>" class="btn btn-primary">Add New MV Ticket</a>
                        <!-- <a href="addBargeTicket.php" class="btn btn-primary">Add New Barge Ticket</a> -->
                        <?php } ?>
                    </div>
                </div>
            </div>


            <?php
                $dao = new MVTicketDAO();
                if ($cid==0){
                    $allMVTickets = $dao->retrieveAll();
                    $cname = "All Contracts";
                }
                else{
                $allMVTickets = $dao->retrieveAllByContract($cid);
                $contractDAO = new ContractDAO();
                $thecontract = $contractDAO->retrieve($cid);
                $cname =  $thecontract->getContractName();
                }
            ?>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>MV Ticket Depository: <?php echo $cname?> </h5>
                            </div>
                            <div class="ibox-content">

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>MV MSSI</th>
                                                <th>MV Name</th>
                                                <th>Cast On</th>
                                                <th>Cast Off</th>
                                                <th>Amount of Coal (ton)</th>
                                                <th>Status</th>
                                                <th>Remarks</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php 
                                            foreach ($allMVTickets as $eachMVTicket) { ?>

                                                <tr class="gradeX">
                                                    <td><?php
                                                        echo $eachMVTicket->getMVTicketID();
                                                        ?>
                                                    </td>
                                                    <td><?php
                                                        echo $eachMVTicket->getMSSI();
                                                        ?>
                                                    </td>
                                                    <td><?php
                                                        echo $eachMVTicket->getShipName();
                                                        ?>
                                                    </td>
                                                    <td><?php
                                                        echo $eachMVTicket->getCastOn();
                                                        ?>
                                                    </td>
                                                    <td><?php
                                                        echo $eachMVTicket->getCastOff();
                                                        ?>
                                                    </td>
                                                    <td><?php
                                                        echo $eachMVTicket->getAmtOfCoal();
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                        if (empty($eachMVTicket->getCastOff())){
                                                            ?> Pending
                                                            <?php
                                                        }
                                                        else {
                                                            ?> Completed
                                                            <?php
                                                        }
                                                    ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                        echo $eachMVTicket->getRemarks();
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="bargeTicketList?id=<?php echo $eachMVTicket->getMVTicketID(); ?>">
                                                            <button class="thatbuttoncontainer">
                                                                <span>Barge Tickets</span>
                                                            </button>
                                                        </a>
                                                        <a href="editMotherVesselTicket?id=<?php echo $eachMVTicket->getMVTicketID(); ?>">
                                                            <button class="thatbuttoncontainer">
                                                                <span>Edit</span>
                                                            </button>
                                                        </a> 
                                                        <a href="delMotherVesselTicketProcess?id=<?php echo $eachMVTicket->getMVTicketID(); ?>" onClick="javascript: return confirm('Please confirm deletion of this MV Ticket');">
                                                            <button class="thatbuttoncontainer">
                                                                <span>Delete</span>
                                                            </button>
                                                        </a> 
                                                    </td>
                                                <?php } ?>
                                                </tr>
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
                        title: 'MV Ticket List'
                    },
                    {
                        extend: 'excel',
                        title: 'MV Ticket List'
                    },
                    {
                        extend: 'pdf',
                        title: 'MV Ticket List'
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