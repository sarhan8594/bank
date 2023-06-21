<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Database connection credentials
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $database = "bank";

    // Create a database connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to retrieve the username and password from the table
    $selectQuery = "SELECT * FROM students WHERE uname = '$username'";
    $result = $conn->query($selectQuery);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row["pword"];

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Set the session variable
            $_SESSION["username"] = $username;

            // Redirect to the next page
            header("Location:         <script>
            const form = document.querySelector('form');
            form.addEventListener('submit', function(event) {
              event.preventDefault();
              const selectedOption = document.querySelector('input[name="group"]:checked').value;
              switch (selectedOption) {
                case 'student':
                  window.location.href = 'student/index.html';
                  break;
                case 'employee':
                  window.location.href = 'EMP/index.html';
                  break;
                case 'entrepreneur':
                  window.location.href = 'entrepreneur/index.html';
                  break;
                default:
                  alert('Please select an option');
              }
            });
          </script>");
            exit();
        }
    }

    // Display an alert box if the credentials are invalid
    echo "<script>alert('Invalid username or password!');</script>";
}

?>