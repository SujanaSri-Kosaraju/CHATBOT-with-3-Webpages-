<?php

require 'vendor/autoload.php';

include 'database.php';
$api_key = 'sec_9X6wk3bhc8bAfJr8I04D25xMpQcm3LSw';
$api_url = 'https://api.chatpdf.com/v1/chats/message';

// $openai = new OpenAi('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'); // Replace with your OpenAI API key

function sendMessageAndGetContent($sourceId, $messageContent, $api_key, $api_url)
{
    $headers = array(
        'x-api-key: ' . $api_key,
        'Content-Type: application/json'
    );
    $data = array(
        'sourceId' => $sourceId,
        'messages' => array(
            array(
                'role' => 'user',
                'content' => $messageContent
            )
        )
    );

    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);

    if ($response === false) {
        return 'Error: ' . curl_error($ch);
    } else {
        // Decode JSON response
        $decoded_response = json_decode($response, true);

        // Extract content from decoded response
        $content = isset($decoded_response['content']) ? $decoded_response['content'] : '';

        return $content;
    }

    curl_close($ch);
}

$userQuestion = $_POST['question'];
// Replace $pdfPath with the actual path to your PDF file
$sql = "SELECT * FROM tbl_content WHERE id = 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $name = $row['name'];
        $source = $row['path'];

        // echo "Path: " . $fileLink;
    }
}


$content = sendMessageAndGetContent($source, $userQuestion, $api_key, $api_url);



// Return the bot's response to the AJAX request
echo $content;
?>