<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $report = $_POST['report'];

    echo "<h2>Thank you for your submission.</h2>";
    
    // Keyword-based flag trigger
    if (stripos($report, 'sql injection') !== false || stripos($report, 'sql') !== false) {
        echo "<p><strong>Flag:</strong> <code>flag{reporting_successful}</code></p>";
    } else {
        echo "<p>We will review your report and contact you if needed.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Report a Vulnerability</title>
</head>
<body>
    <h1>Submit Vulnerability Report</h1>
    <form method="post">
        <label for="report">Describe the vulnerability:</label><br>
        <textarea name="report" rows="10" cols="50" placeholder="Please Describe your findings..."></textarea><br><br>
        <input type="submit" value="Submit Report">
    </form>
</body>
</html>

