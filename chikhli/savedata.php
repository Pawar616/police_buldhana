<?php
// Database connection (replace with your actual credentials)
$servername = "localhost";
$username = "root";  // Your database username
$password = "";  // Your database password
$dbname = "buldhana_police";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $postName = $_POST['postName'];
    $name = $_POST['name'];
    $mobileNumber = $_POST['mobileNumber'];
    $bno = $_POST['bno'];
    $gender = $_POST['gender'];
    $police_station = $_POST['police_station'];

    // Handle file upload
    $photo = $_FILES['photo']['name'];
    $target = "uploads/" . basename($photo);
    move_uploaded_file($_FILES['photo']['tmp_name'], $target);

    // Insert data into database
    $sql = "INSERT INTO mastersheet (post, name, mobile, b_n, gender, picture, police_station) 
            VALUES ('$postName', '$name', '$mobileNumber', '$bno', '$gender', '$photo', '$police_station')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
