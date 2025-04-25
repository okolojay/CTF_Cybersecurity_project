<?php
$host = "db";
$user = "finaluser";
$pass = "finalpass";
$dbname = "finaldb";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo "<p>Welcome $username</p>";
        echo "<p>Flag: flag{sql_injection_success}</p>";
    } else {
        echo "<p>Invalid login.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Choose Your Role</title></head>
<body>
    <h1>Welcome to the Challenge</h1>


    <h2>Login (for Attack)</h2>
    <form method="post">
        <input type="hidden" name="login" value="1">
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><br>
        <input type="submit" value="Login">
    </form>

    <hr>

    <h2><a href="patch.php">Patch the Vulnerability (Defend)</a></h2>
    <h2><a href="submit_report.php">Report a Vulnerability (Report)</a></h2>
</body>
</html>

