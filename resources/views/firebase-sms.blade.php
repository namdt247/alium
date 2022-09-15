<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Firebase Phone Authentication</title>
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-auth.js"></script>
    <script defer src="https://www.gstatic.com/firebasejs/6.0.2/firebase-firestore.js"></script>



    <script>
        // Initialize Firebase
        var config = {
            apiKey: "AIzaSyB_oLcjB4O0-eD-D35-yH6gLMi7MgFaJgo",
            authDomain: "alium-240106.firebaseapp.com",
            databaseURL: "https://alium-240106.firebaseio.com",
            projectId: "alium-240106",
            storageBucket: "alium-240106.appspot.com",
            messagingSenderId: "296317457218",
            appId: "1:296317457218:web:554d04193d56423e"
        };
        firebase.initializeApp(config);
    </script>
    <script src="https://cdn.firebase.com/libs/firebaseui/2.3.0/firebaseui.js"></script>
    <link type="text/css" rel="stylesheet" href="https://cdn.firebase.com/libs/firebaseui/2.3.0/firebaseui.css" />
    <link href="firebase-style.css" rel="stylesheet" type="text/css" media="screen" />

</head>
<body>
<div id="container">
    <h3>Firebase Phone Number Auth. Demo</h3>
    <div id="loading">Loading...</div>
    <div id="loaded" class="hidden">
        <div id="main">
            <div id="user-signed-in" class="hidden">
                <div id="user-info">
                    <div id="photo-container">
                        <img id="photo">
                    </div>
                    <div id="name"></div>
                    <div id="email"></div>
                    <div id="phone"></div>
                    <div class="clearfix"></div>
                </div>
                <p>
                    <button id="sign-out">Sign Out</button>
                    <button id="delete-account">Delete account</button>
                </p>
            </div>
            <div id="user-signed-out" class="hidden">
                <h4>You are signed out.</h4>
                <div id="firebaseui-spa">
                    <h3>Single Page App mode:</h3>
                    <div id="firebaseui-container"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="firebase-sms.js"></script>
</body>
</html>