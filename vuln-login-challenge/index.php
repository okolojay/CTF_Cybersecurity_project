<?php
$host = "db";
$user = "vuln";
$pass = "vulnpass";
$dbname = "vulnlogin";

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vulnerable SQL query - directly using user input
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo "<h2>Welcome, $username!</h2>";
        echo "<p> Congratulations! Flag: <b>flag{login_bypassed_successfully}</b></p>";
    } else {
        echo "<p>Invalid login.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vulnerable Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="post">
        <label>Username:</label><br>
        <input type="text" name="username"><br><br>

        <label>Password:</label><br>
        <input type="password" name="password"><br><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>

