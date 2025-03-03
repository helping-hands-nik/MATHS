<?php
$servername = "localhost";
$username = "root"; // Change if needed
$password = "";
$dbname = "registration_db";

// Connect to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $fatherName = $_POST['fatherName'];
    $motherName = $_POST['motherName'];
    $dob = $_POST['dob'];

    // Upload Image
    $image = $_FILES['image'];
    $imagePath = "uploads/" . time() . "_" . basename($image["name"]);
    move_uploaded_file($image["tmp_name"], $imagePath);

    // Upload Certificates
    $certificatePaths = [];
    foreach ($_FILES['certificates']['tmp_name'] as $key => $tmp_name) {
        $certificateName = time() . "_" . basename($_FILES['certificates']['name'][$key]);
        $certificatePath = "uploads/" . $certificateName;
        move_uploaded_file($_FILES['certificates']['tmp_name'][$key], $certificatePath);
        $certificatePaths[] = $certificatePath;
    }
    
    // Convert certificate paths to JSON format
    $certificatesJson = json_encode($certificatePaths);

    // Insert data into database
    $sql = "INSERT INTO candidates (name, father_name, mother_name, dob, image_path, certificate_paths) 
            VALUES ('$name', '$fatherName', '$motherName', '$dob', '$imagePath', '$certificatesJson')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true, "message" => "Registration successful"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
    }
}

$conn->close();
?>