<?php

include 'database.php';

// Include the function to upload file and get response
function uploadFileAndGetResponse($file_path, $api_key, $api_url)
{
    // Initialize cURL
    $curl = curl_init();

    // Set cURL options
    curl_setopt_array(
        $curl,
        array(
            CURLOPT_URL => $api_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'x-api-key: ' . $api_key
            ),
            CURLOPT_POSTFIELDS => array(
                'file' => new CURLFile($file_path)
            )
        )
    );

    // Execute cURL request
    $response = curl_exec($curl);

    // Close cURL connection
    curl_close($curl);

    // Decode the JSON response
    $response_array = json_decode($response, true);

    // Extract and return the sourceId
    return isset($response_array['sourceId']) ? $response_array['sourceId'] : null;
}

// Ensure the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if the file was uploaded without errors
    if (isset($_FILES["pdfFile"]) && $_FILES["pdfFile"]["error"] == UPLOAD_ERR_OK) {

        // Define the upload directory
        $uploadDir = "uploads/";

        // Get the uploaded file's name and generate a unique name
        $originalFileName = basename($_FILES["pdfFile"]["name"]);
        $uniqueFileName = uniqid() . '_' . $originalFileName;

        // Define the path where the file will be saved
        $filePath = $uploadDir . $uniqueFileName;

        // Move the uploaded file to the destination
        if (move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $filePath)) {
            // Call the function to upload the file and get the response
            $sourceId = uploadFileAndGetResponse($filePath, 'sec_9X6wk3bhc8bAfJr8I04D25xMpQcm3LSw', 'https://api.chatpdf.com/v1/sources/add-file');

            // Insert the file information into the database
            $stmt = $conn->prepare("UPDATE tbl_content SET path = ?, name = ? WHERE id = 1");
            $stmt->bind_param("ss", $sourceId, $originalFileName);
            $stmt->execute();
            $stmt->close();

            // Close the database connection
            $conn->close();

            // Display success message
            echo "File Processed";
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Error: " . $_FILES["pdfFile"]["error"];
    }
}
?>
















<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload PDF</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Upload PDF Files</h2>
        <div class="card mx-auto" style="width: 500px; border-radius: 10px; padding: 20px;">
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="pdfFile">Select PDF File:</label>

                    <input type="file" class="form-control-file" id="pdfFile" name="pdfFile" accept=".pdf" required>
                    <small class="text-muted">Limit 200MB per file</small>

                </div>
                <button type="submit" class="btn btn-primary mt-3">Upload</button>
            </form>
        </div>
    </div>

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>