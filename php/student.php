<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $username = $_POST["uname"];
    $password = $_POST["pword"];

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

    // SQL query to insert the username and password into the table
    $insertQuery = "INSERT INTO student (uname, pword)
                    VALUES ('$username', '$password')";

    if ($conn->query($insertQuery) === true) {
        header("Location: ../login page.html");
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
