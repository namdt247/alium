<html>
<title>Firebase Messaging Demo</title>
<style>
    div {
        margin-bottom: 15px;
    }
</style>
<body>
<div id="token"></div>
<div id="msg"></div>
<div id="notis"></div>
<div id="err"></div>
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-messaging.js"></script>
<script>
    MsgElem = document.getElementById("msg");
    TokenElem = document.getElementById("token");
    NotisElem = document.getElementById("notis");
    ErrElem = document.getElementById("err");
    // Initialize Firebase
    // TODO: Replace with your project's customized code snippet
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

    const messaging = firebase.messaging();
    messaging.requestPermission()
        .then(function () {
            MsgElem.innerHTML = "Notification permission granted."
            console.log("Notification permission granted.");

            // get the token in the form of promise
            return messaging.getToken()
        })
        .then(function(token) {
            console.log(token);
            TokenElem.innerHTML = "token is : " + token
        })
        .catch(function (err) {
            ErrElem.innerHTML =  ErrElem.innerHTML + "; " + err
            console.log("Unable to get permission to notify.", err);
        });

    messaging.onMessage(function(payload) {
        console.log("Message received. ", payload);
        NotisElem.innerHTML = NotisElem.innerHTML + JSON.stringify(payload)
    });
</script>

</body>

</html>
