<!DOCTYPE html>
<style>
    .container {
        height: 200px;
        position: relative;
        border: 3px solid green;
    }

    .center {
        margin: auto;
        width: 25%;
        padding: 10px;
    }
</style>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Google Sign-In -->
    <meta name="google-signin-client_id" content="185601953019-ptg6dor3ft75g301sjimtg5ina6vbld9.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <title>LLI TDMP | Log In</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">
    
    <div class="text-center">
        <br><br><br>
        <img src="img/Logo.jpg" class="rounded" width="480" height="270">
        <br><br><br>
        <h2 style="font-family:Helvetica; font-weight: bold">Welcome to LLI Transshipment Data Management Portal</h2>
        <br><br><br>
    </div>

    <div class="center" id="my-signin2"></div>     





<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
    
    <script>
        
        function onSuccess(googleUser) {
            console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
            sessionStorage.setItem("user", googleUser.getBasicProfile().getName());
            document.location.href = 'bargelist.php';
        }
        function onFailure(error) {
            console.log(error);
        }
        function renderButton() {
            gapi.signin2.render('my-signin2', {
            'scope': 'profile email',
            'width': 300,
            'height': 50,
            'longtitle': true,
            'theme': 'dark',
            'onsuccess': onSuccess
            });  
        }


        function init() {
            gapi.load('auth2', function() {
                /* Ready. Make a call to gapi.auth2.init or some other API */
                gapi.auth2.init({
                    client_id: '185601953019-ptg6dor3ft75g301sjimtg5ina6vbld9.apps.googleusercontent.com'
                }).then(function (){
                    gapi.auth2.getAuthInstance().signOut();
                    gapi.auth2.getAuthInstance().disconnect();
                    console.log("CALL ME");
                });
                
            renderButton();
            });

            
        }
        
</script>
        
    </script>

    <script src="https://apis.google.com/js/platform.js?onload=init" async defer></script>
    
    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>