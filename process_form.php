<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "payment_form";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $payment_amount = $_POST['payment_amount'];
    $proof_of_payment = $_FILES['proof_of_payment'];

    $upload_dir = "uploads/";
    $proof_path = $upload_dir . basename($proof_of_payment["name"]);
    move_uploaded_file($proof_of_payment["tmp_name"], $proof_path);

    $stmt = $conn->prepare("INSERT INTO submissions (name, email, payment_amount, proof_of_payment) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $name, $email, $payment_amount, $proof_path);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}
?>
