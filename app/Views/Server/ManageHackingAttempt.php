<?php

include('conn.php');

// Assuming you're using session to store the user ID
$userid = session()->userid;

// Update the SQL query to also select the username
$sql = "SELECT `username`, `expiration_date` FROM `users` WHERE `id_users` = '".$userid."'";
$query = mysqli_query($conn, $sql);

if ($query) {
    // Fetch the user information
    $user = mysqli_fetch_assoc($query);

    // Extract the username and expiration date from the fetched data
    $username = $user['username'];
    $expiration_date = $user['expiration_date'];

    // Set the user tag
    $user_tag = ($username == 'Icycubes') ? '[OWNER]' : '[MEMBERS]';
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Icys Web Chat</title>
    <!-- Google fonts. -->
    <link href='https://fonts.googleapis.com/css?family=Bungee+Outline' rel='stylesheet'/>
    <link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet'/>
    <!-- Use font awesome icons. -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- Use firebase app and database. -->
    <script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-database.js"></script>
    <style>
        /* (CSS remains the same) */
        body {
            background-color: #2E2D2D;
            font-family: 'Varela Round';
            font-weight: 400;
            overflow: hidden;
            color: #fff;
            animation: blur 0.5s ease-out;
            margin: 0;
        }
        * {
            outline: none;
            border: none;
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        #title_container {
            width: 100%;
            height: 225px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #159BE8;
            border-bottom: 5px solid #fff;
            box-shadow: 0 0 30px -18px #159BE8;
        }
        #title_inner_container {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #title {
            color: #fff;
            font-size: 55px;
            letter-spacing: 2px;
            user-select: none;
        }
        #join_container {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 50px;
        }
        #join_inner_container {
            width: 50%;
            max-width: 500px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        #join_input_container, #join_button_container {
            width: 100%;
            margin: 10px 0;
            display: flex;
            justify-content: center;
        }
        #join_input {
            width: 80%;
            height: 40px;
            color: #2E2D2D;
            font-family: 'Varela Round';
            font-size: 15px;
            text-align: center;
            background-color: #fff;
            border: 2px solid #2E2D2D;
            border-radius: 5px;
        }
        #join_input:focus {
            box-shadow: 0 0 10px #159BE8;
        }
        #join_button {
            width: 80%;
            height: 40px;
            font-family: 'Varela Round';
            font-size: 15px;
            font-weight: bold;
            text-align: center;
            color: #fff;
            background-color: #159BE8;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        #join_button:hover {
            background-color: #0f7fc1;
        }
        #chat_container {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 40px;
            animation: fadeIn 1s linear;
        }
        #chat_inner_container {
            width: 80%;
            max-width: 800px;
            height: 80vh;
            background-color: #3a3a3a;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            margin: 0 auto; /* Ensure it is centered horizontally */
        }
        #chat_content_container {
            flex-grow: 1; /* Take all available space */
            overflow-y: auto;
            padding: 15px;
            font-family: 'Varela Round';
            color: #fff;
            scroll-behavior: smooth;
        }
        #chat_input_container {
            width: 100%;
            height: 10%;
            display: flex;
            align-items: center;
            padding: 15px;
            border-top: 2px dashed #2E2D2D;
            background-color: #444;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }
        #chat_input {
            width: 90%;
            height: 100%;
            background-color: #555;
            color: #fff;
            font-size: 15px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #159BE8;
            margin-right: 10px;
        }
        #chat_input_send {
            width: 10%;
            height: 100%;
            font-size: 18px;
            background-color: #159BE8;
            text-align: center;
            color: #fff;
            cursor: pointer;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #chat_input_send.enabled:hover {
            background-color: #0f7fc1;
        }
        #chat_logout_container {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
        }
        #chat_logout {
            color: #159BE8;
            cursor: pointer;
            font-size: 14px;
        }
        #chat_logout:hover {
            text-decoration: underline;
        }
        .message_container {
            width: 100%;
            display: flex;
            margin-bottom: 20px;
        }
        .message_inner_container {
            width: 100%;
            color: #fff;
        }
        .message_user_container {
            width: 100%;
        }
        .message_user {
            font-weight: bold;
            font-size: 14px;
        }
        .message_content_container {
            width: 100%;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .message_content {
            font-weight: normal;
            font-size: 14px;
            margin-top: 5px;
        }
        .enabled {
            transition: background-color 0.5s;
            color: #fff;
            background-color: #159BE8;
            cursor: pointer;
        }
        #title_container.chat_title_container {
            transition: 0.8s;
            height: 100px;
        }
        #title.chat_title {
            transition: 0.8s;
            font-size: 47px;
        }
        .loader_container {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .loader {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            border-top: 6px solid #159BE8;
            border-bottom: 6px solid #2E2D2D;
            border-left: 6px solid #E9FFF9;
            border-right: 6px solid #E9FFF9;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        @keyframes fadeIn {
            0% {opacity: 0;}
            100% {opacity: 1;}
        }
        @keyframes blur {
            0% {filter: blur(5px);}
            100% {}
        }
        ::selection {
            background-color: #159BE8;
            color: #fff;
        }
        /* width */
        ::-webkit-scrollbar {
            width: 6px;
        }
        /* Track */
        ::-webkit-scrollbar-track {
            background: #444;
        }
        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #159BE8;
            border-radius: 5px;
        }
        @media (max-width: 600px) {
            #join_inner_container, #chat_inner_container {
                width: 90%;
            }
            #join_input, #join_button {
                width: 100%;
            }
            #chat_input {
                width: 80%;
            }
            #chat_input_send {
                width: 20%;
            }
        }
    </style>
</head>
<body>
    <script>
        window.onload = function() {
            var firebaseConfig = {
                apiKey: "AIzaSyC_PNDcFOk7ngTzklZwLubbK48pr4UU8GE",
                authDomain: "argggg-e15cc.firebaseapp.com",
                databaseURL: "https://argggg-e15cc-default-rtdb.firebaseio.com",
                projectId: "argggg-e15cc",
                storageBucket: "argggg-e15cc.appspot.com",
                messagingSenderId: "254062469557",
                appId: "1:254062469557:web:ac1a57d3f2781b08f70e15"
            };
            firebase.initializeApp(firebaseConfig);

            var database = firebase.database();

            var myName = "<?php echo $username; ?>";
            var myTag = "<?php echo $user_tag; ?>";
            
            function joinChat() {
                if (myName != "") {
                    document.getElementById("join_container").style.display = "none";
                    document.getElementById("chat_container").style.display = "block";
                    document.getElementById("title_container").classList.add("chat_title_container");
                    document.getElementById("title").classList.add("chat_title");
                    document.getElementById("chat_input").focus();

                    // Load existing messages
                    loadMessages();
                } else {
                    alert("Please enter a name to join the chat.");
                }
            }

            function sendMessage() {
                var message = document.getElementById("chat_input").value;
                if (message != "") {
                    database.ref("messages").push().set({
                        "sender": myName + " - " + myTag,
                        "message": message
                    });
                    document.getElementById("chat_input").value = "";
                } else {
                    alert("Please enter a message to send.");
                }
            }

            function loadMessages() {
                database.ref("messages").once("value", function(snapshot) {
                    var messages = snapshot.val();
                    var html = "";
                    for (var message in messages) {
                        html += "<div class='message_container'>";
                        html += "<div class='message_inner_container'>";
                        html += "<div class='message_user_container'>";
                        html += "<span class='message_user'>" + messages[message].sender + ": </span>";
                        html += "</div>";
                        html += "<div class='message_content_container'>";
                        html += "<span class='message_content'>" + messages[message].message + "</span>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                    }
                    document.getElementById("chat_content_container").innerHTML = html;
                    document.getElementById("chat_content_container").scrollTop = document.getElementById("chat_content_container").scrollHeight;
                });
            }

            database.ref("messages").on("child_added", function (snapshot) {
                var html = "";
                html += "<div class='message_container'>";
                    html += "<div class='message_inner_container'>";
                        html += "<div class='message_user_container'>";
                            html += "<span class='message_user'>" + snapshot.val().sender + ": </span>";
                        html += "</div>";
                        html += "<div class='message_content_container'>";
                            html += "<span class='message_content'>" + snapshot.val().message + "</span>";
                        html += "</div>";
                    html += "</div>";
                html += "</div>";
                document.getElementById("chat_content_container").innerHTML += html;
                document.getElementById("chat_content_container").scrollTop = document.getElementById("chat_content_container").scrollHeight;
            });

            document.getElementById("join_button").addEventListener("click", joinChat);
            document.getElementById("chat_input_send").addEventListener("click", sendMessage);
            document.getElementById("chat_input").addEventListener("keydown", function(event) {
                if (event.key === "Enter") {
                    sendMessage();
                }
            });

            document.getElementById("chat_logout").addEventListener("click", function() {
                myName = "";
                document.getElementById("join_container").style.display = "flex";
                document.getElementById("chat_container").style.display = "none";
                document.getElementById("title_container").classList.remove("chat_title_container");
                document.getElementById("title").classList.remove("chat_title");
                document.getElementById("join_input").value = "";
                document.getElementById("chat_content_container").innerHTML = "";
            });

            document.getElementById("home_link").addEventListener("click", function() {
                window.location.href = "http://bonakidsilaakrigs.x10.mx";
            });

            // Automatically join the chat if a username is already set
            if (myName != "") {
                joinChat();
            }
        };
    </script>
    <div id="title_container">
        <div id="title_inner_container">
            <span id="title">Icys Web Chat</span>
        </div>
    </div>
    <div id="join_container">
        <div id="join_inner_container">
            <div id="join_input_container">
                <input type="text" id="join_input" placeholder="Enter your name" value="<?php echo $username; ?>" readonly />
            </div>
            <div id="join_button_container">
                <button id="join_button">Join Chat</button>
            </div>
        </div>
    </div>
    <div id="chat_container" style="display: none;">
        <div id="chat_inner_container">
            <div id="chat_content_container">
            </div>
            <div id="chat_input_container">
                <input type="text" id="chat_input" placeholder="Type your message here" />
                <button id="chat_input_send" class="enabled">Send</button>
            </div>
            <div id="chat_logout_container">
                <span id="chat_logout">Logout</span>
            </div>
            <div id="home_link_container" style="margin-top: 10px; text-align: center;">
                <span id="home_link" style="color: #159BE8; cursor: pointer; font-size: 14px;">Go to Home</span>
            </div>
        </div>
    </div>
</body>
</html>
