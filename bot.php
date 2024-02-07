<?php

include 'database.php';

$sql = "SELECT * FROM tbl_content WHERE id = 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $name = $row['name'];
        $fileLink = $row['path'];

        // echo "Path: " . $fileLink;
    }
} else {
    $name = "N/A";
}







?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bot</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Set a fixed height for the chat container */
        .chat-container {
            height: 85vh;
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 10px;
        }

        /* Style the chat messages */
        .message {
            margin-bottom: 10px;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            font-size: 17px;
        }

        .user-message {
            text-align: right;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 17px;
        }

        /* Style the input field and button */
        .input-container {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 20px;
            background-color: #f8f9fa;
            border-top: 1px solid #ccc;
        }

        /* Style the header */
        .header {
            text-align: center;
            background-color: #007bff;
            color: #fff;
            padding: 5px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>BOT</h2>
        <small>Last processed (
            <?php echo $name; ?>
            )
        </small>
    </div>

    <div class="container chat-container" id="chatContainer">
        <!-- Dummy Data -->
        <div class="message">
            <img src="images/bot.png" alt="Bot Icon" style="width: 30px; height: 30px; border-radius: 50%;">
            Bot: Hi..Nice to meet you..May I know your query please?
        </div>
    </div>

    <div class="input-container">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Type your message..." id="userInput">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" id="btn-send" onclick="clickOnButton()">Send</button>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and Popper.js -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="jquery-3.7.1.min.js"></script>



    <script>
        function handleEnterKey(event) {
            if (event.key === "Enter") {
                clickOnButton();
            }
        }

        function clickOnButton() {
            var userInput = document.getElementById('userInput').value;
            appendMessage(true, userInput);
            document.getElementById('userInput').value = '';
            // alert(userInput);
            fetch('get.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'question=' + encodeURIComponent(userInput),
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(response => {
                    // Append bot response to the chat container
                    appendMessage(false, response);
                })
                .catch(error => {
                    console.error('Error sending the question to the server:', error);
                    alert('Error sending the question to the server. Error: ' + error.message);
                });


        }

        function appendMessage(isUser, message) {
            var chatContainer = document.getElementById('chatContainer');
            var messageDiv = document.createElement('div');
            messageDiv.classList.add('message');

            if (isUser) {
                messageDiv.classList.add('user-message');
                messageDiv.innerHTML = '<img src="images/man.png" alt="User Icon" style="width: 30px; height: 30px; border-radius: 50%;"> User: ' + message;
            } else {
                messageDiv.innerHTML = '<img src="images/bot.png" alt="Bot Icon" style="width: 30px; height: 30px; border-radius: 50%;"> Bot: ' + message;
            }

            chatContainer.appendChild(messageDiv);
            chatContainer.scrollTop = chatContainer.scrollHeight; // Scroll to the bottom
        }


    </script>
</body>

</html>