<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $username = $_POST['username'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $gender = $_POST['gender'];
  $dob = $_POST['dob'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirm_password'];

  // Validate the data
  if (empty($username) || empty($email) || empty($phone) || empty($gender) || empty($dob) || empty($password) || empty($confirmPassword)) {
    echo "Please fill in all the fields.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format.";
  } elseif (!preg_match("/[0-9]/", $phone)) {
    echo "Invalid phone number format.";
  } elseif ($password !== $confirmPassword) {
    echo "Passwords do not match.";
  } elseif (strlen($password) < 6 || !preg_match("/[0-9]/", $password) || !preg_match("/[!@#$%^&*]/", $password)) {
    echo "Password must be at least 6 characters long, contain at least one number and one special character.";
  } else {
    // Connect to the MySQL database
    $conn = mysqli_connect("localhost", "root", "", "4th semester");

    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    // Insert the user data into the database
    $sql = "INSERT INTO users (username, email, phone, gender, dob, password) VALUES ('$username', '$email', '$phone', '$gender', '$dob', '$password')";

    if (mysqli_query($conn, $sql)) {
      echo "Registration successful!";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
  }
}
?>
