<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Analyzer</title>
    <link rel="stylesheet" href="chat.css">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #ffffff;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            font-family: 'Arial', sans-serif;
        }

        h1 {
            color: #333;
            font-size: 32px;
            margin-bottom: 20px;
            font-family: 'Times New Roman', Times, serif;
        }

        .card-container {
            display: flex;
            margin-left: 25px;
        }

        .card {
            width: 120px;
            height: 120px;
            border-radius: 5%;
            border: 1px solid #c6c6c6;
            margin-right: 25px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .card:hover {
            background-color: #ffcccc;
            /* Light red on hover */
        }

        .icon {
            font-size: 50px;
            color: #333;
        }



        .text {
            font-size: 16px;
            margin-top: 10px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
</head>

<body>
    <!-- <h1>PDF Analyzer</h1> -->

    <!-- <div class="card-container">
        <div class="card" onclick="uploadPDF()">
            <i class="fas fa-file-pdf icon"></i>
            <div class="text">Upload PDF</div>
        </div>

        <div class="card" onclick="openChatBot()">
            <i class="fas fa-robot icon"></i>
            <div class="text">Open Chat Bot</div>
        </div>
    </div> -->

    <div class="chat-bar-collapsible">
        <button id="chat-button" type="button" class="collapsible">PDF Bot
            <i id="chat-icon" style="color: #fff;" class="fa fa-comments"></i>
            <i id="close-icon" style="color: #fff; margin-left:180px; display:none" class="fa fa-close"></i>

        </button>

        <div class="content">
            <div class="full-chat-block">
                <!-- Message Container -->
                <!-- <span class="close-icon" onclick="closeChat()">&times;</span> -->

                <div class="outer-container">
                    <div class="chat-container">
                        <div class="additional-buttons">
                            <div class="card-container">
                                <div class="card" onclick="uploadPDF()">
                                    <i class="fas fa-file-pdf icon"></i>
                                    <div class="text">Upload PDF</div>
                                </div>

                                <div class="card" onclick="openChatBot()">
                                    <i class="fas fa-robot icon"></i>
                                    <div class="text">Open Chat Bot</div>
                                </div>
                            </div>
                        </div>
                        <!-- Messages -->
                        <div id="chatbox">
                            <h5 id="chat-timestamp"></h5>
                            <!-- <p id="botStarterMessage" class="botText"><span>Loading...</span></p> -->
                        </div>

                        <br></br>
                        <br></br>
                        <br></br>
                        <br></br>
                        <br></br>





                    </div>

                    <div id="chat-bar-bottom">
                        <p></p>
                    </div>
                </div>
            </div>


        </div>
    </div>

    </div>


    <script>
        function uploadPDF() {
            // Add your upload PDF logic here
            var newTabUrl = 'upload.php';

            // Open the URL in a new tab
            window.open(newTabUrl, '_blank');
        }

        function openChatBot() {
            // Add your open chat bot logic here
            var newTabUrl = 'bot.php';

            // Open the URL in a new tab
            window.open(newTabUrl, '_blank');
        }
    </script>
</body>
<script src="scripts/chat.js"></script>

</html>