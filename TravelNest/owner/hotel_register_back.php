<!-- New Hotel Registration of a Hotel Owner -->

<?php
//session handling
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: user_login_front.php");
    exit;
}

require_once('dbconnect.php');

// Get the owner ID from the session
$owner_email = $_SESSION['email'];
$stmt = $conn->prepare("SELECT ho_id FROM Hotel_Owner WHERE ho_email = ?");
$stmt->bind_param("s", $owner_email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$owner_id = $row['ho_id'];


//got the details of the hotel from the form and storing them in variables
$name = $_POST['h_name'];
$phone = $_POST['h_number'];
$email = $_POST['h_email'];
$location = $_POST['h_location'];
$description = $_POST['h_description'];
$roomCount = $_POST['roomCount'];


// Handle the image upload
$image = $_FILES['h_image']['name'];
$target_dir = "hotel_pic/";
$target_file = $target_dir . basename($image);


// Checking img and moving it to hotel_pic folder
if (!empty($image) && move_uploaded_file($_FILES['h_image']['tmp_name'], $target_file)) {
    if (!empty($name) && !empty($phone) && !empty($email) && !empty($location) && !empty($description)) {

        // Insert the hotel into the database
        $stmt = $conn->prepare("INSERT INTO Hotel VALUES (NULL, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sisssi", $name, $phone, $email, $location, $description, $owner_id);

        if ($stmt->execute()) {
            $last_id = $conn->insert_id; // Get the hotel ID from the last insert AND insert the image
            $stmt = $conn->prepare("INSERT INTO Hotel_image_archive VALUES (?, ?)"); // Insert the image into the database
            $stmt->bind_param("ss", $last_id, $image);
            $stmt->execute();

            // Get the number of room types

            // Prepare the statement to insert the room data
            $stmt = $conn->prepare("INSERT INTO Room VALUES (?, ?, ?, ?)");

            // Insert each room type into the database
            for ($i = 0; $i < $roomCount; $i++) {
                $r_type = $_POST['r_type' . $i];
                $r_price = $_POST['r_price' . $i];
                $r_quantity = $_POST['r_quantity' . $i];
                $stmt->bind_param("isii", $last_id, $r_type, $r_price, $r_quantity);
                $stmt->execute();
            }
            header('Location: owner_dashboard_front.php');
            exit;
        }
    }
}

?>