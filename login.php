<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Validate the data
  if (empty($email) || empty($password)) {
    echo "Please fill in all the fields.";
  } else {
    // Connect to the MySQL database
    $conn = mysqli_connect("localhost", "root", "", "4th semester");

    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch user data from the database
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
      // User found, redirect to a logged-in page or perform desired actions
      echo "Login successful!";
    } else {
      // User not found or invalid credentials
      echo "Invalid email or password.";
    }

    // Close database connection
    mysqli_close($conn);
  }
}
?>
