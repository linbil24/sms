<?php
require_once '../Database/config.php';

try {
    echo "<h1>Database Debug Info</h1>";
    echo "<p><b>Database:</b> " . DB_NAME . "</p>";
    echo "<p><b>Host:</b> " . DB_HOST . "</p>";

    // Dump Students Table
    $stmt = $pdo->query("SHOW CREATE TABLE students");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<h3>Students Table</h3>";
    echo "<pre>" . htmlspecialchars($row['Create Table']) . "</pre>";

    // Dump Enrollments Table
    $stmt = $pdo->query("SHOW CREATE TABLE enrollments");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<h3>Enrollments Table</h3>";
    echo "<pre>" . htmlspecialchars($row['Create Table']) . "</pre>";

    // Check Triggers
    $stmt = $pdo->query("SHOW TRIGGERS");
    $triggers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<h3>Triggers</h3>";
    if (count($triggers) > 0) {
        foreach ($triggers as $t) {
            echo "<p><b>Trigger:</b> " . $t['Trigger'] . " on table <b>" . $t['Table'] . "</b><br>";
            echo "Statement: " . htmlspecialchars($t['Statement']) . "</p>";
        }
    } else {
        echo "<p>No triggers found.</p>";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
