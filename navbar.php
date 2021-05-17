<script src="https://apis.google.com/js/platform.js"></script>
<meta name="google-signin-client_id" content="185601953019-ptg6dor3ft75g301sjimtg5ina6vbld9.apps.googleusercontent.com">

<script>

var user = sessionStorage.getItem('user');
if (user==null){
    document.location.href = 'login.php';
}


</script>

<?php
// require_once 'include/common.php';
// require_once 'include/protect.php';
// require_once 'include/Round.php';
// require_once 'include/RoundDAO.php';

// $round = new RoundDAO();
// $roundNo = $round->retrieve();
// $round = $roundNo[0];
include "config.php"

?>

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

  <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>

<li>
    <a href="bargeList.php"> <span class="nav-label"><?php echo $lang['navbar1'] ?></span></a>
</li>
<li>
    <a href="mothervesselList.php"><span class="nav-label"><?php echo $lang['navbar2'] ?></span></a>
</li>
<li>
    <a href="supplierList.php"><span class="nav-label"><?php echo $lang['navbar3'] ?></span></a>
</li>
<li>
    <a href="powerplantList.php"><span class="nav-label"><?php echo $lang['navbar4'] ?></span></a>
</li>
<li>
    <a href="contractList.php"><span class="nav-label"><?php echo $lang['navbar5'] ?></span></a>
</li>
<li>
    <a href="ticketList.php"><span class="nav-label"><?php echo $lang['navbar6'] ?></span></a>
</li>
<li>
    <a href="analytics.php"><span class="nav-label"><?php echo $lang['navbar7'] ?></span></a>
</li>