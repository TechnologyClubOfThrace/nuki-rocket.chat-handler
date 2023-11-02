<?php
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data as JSON
    $rawPostData = file_get_contents('php://input');
    
    // Decode the JSON data
    $postData = json_decode($rawPostData, true);

    // Check if the JSON decoding was successful
    if ($postData === null) {
        http_response_code(400); // Bad Request
        echo "Invalid JSON data.";
    } else {
        // Extract the "message" and "date" fields
        $message = $postData['message'];
        $date = $postData['data']['date'];

        // Format the date
        $formattedDate = date('d/m/Y, H:i:s', strtotime($date));

        // Echo the message and formatted date
        //echo "Message: $message<br>";
        //echo "Formatted Date: $formattedDate";
        
        
        $url = "https://rocket.chat.com/api/v1/chat.postMessage";  // Your RocketChat Server URL

        // Create POST data as an associative array
        $data = [
            'roomId' => 'RoomName',
            'text' => $message . ' - ' . $formattedDate,
        ];

        // Create headers as an associative array with Bot Token and ID
        $headers = [
            'X-Auth-Token: XXXXX',
            'X-User-Id: XXXXX',
            'Content-Type: application/json',
        ];

        // Convert the data to JSON
        $jsonData = json_encode($data);

        // Create a context for the stream with headers
        $context = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => implode("\r\n", $headers),
                'content' => $jsonData,
            ],
        ]);

        // Perform the POST request and capture the response
        $response = file_get_contents($url, false, $context);

        // Check for errors
        if ($response === false) {
            echo 'Error making POST request.';
        } else {
            // Handle the response (you can print or process it as needed)
            echo $response;
        }

    }
} else {
    // If the request method is not POST, return an error message
    http_response_code(405); // Method Not Allowed
    echo "This endpoint only accepts POST requests.";
}
?>
