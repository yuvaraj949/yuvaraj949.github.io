<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    // Ensure the response directory exists
    $responseDir = __DIR__ . '/response';
    if (!is_dir($responseDir)) {
        mkdir($responseDir, 0777, true);
    }

    // Create the base file name
    $baseFileName = str_replace(' ', '_', $name) . '.txt';
    $filePath = $responseDir . '/' . $baseFileName;

    // Append a serial number if the file already exists
    $counter = 1;
    while (file_exists($filePath)) {
        $filePath = $responseDir . '/' . str_replace('.txt', '', $baseFileName) . '_' . $counter . '.txt';
        $counter++;
    }

    // Format the message
    $formattedMessage = $name . "\n" . $email . "\n" . $message;

    // Save the message to the file
    file_put_contents($filePath, $formattedMessage);

    // JavaScript for alert and redirect
    echo '<script>
            alert("Message sent successfully");
            window.location.href = "index.html";
          </script>';
} else {
    echo '<script>
            alert("Invalid request method");
            window.location.href = "contact.html";
          </script>';
}
?>

