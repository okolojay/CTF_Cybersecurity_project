<?php
$host = "db";
$user = "vuln";
$pass = "vulnpass";
$dbname = "vulnlogin";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['patch'])) {
        echo "<h2>Vulnerability patched!</h2>";
        echo "<p>Flag: <strong>flag{patched_sql_vulnerability}</strong></p>";
        exit;
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result && $result->num_rows > 0) {
        echo "<h2>Welcome, $username!</h2>";
    } else {
        echo "<p>Invalid login.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Defend the App</title></head>
<body>
<h1>Login</h1>
<form method="post">
    <label>Username:</label><br>
    <input type="text" name="username"><br><br>

    <label>Password:</label><br>
    <input type="password" name="password"><br><br>

    <input type="submit" value="Login">
</form>
<hr>
<h2>Fix the Vulnerability</h2>
<form method="post">
    <input type="hidden" name="patch" value="true">
    <input type="submit" value="Patch SQL Injection">
</form>
</body>
</html>
