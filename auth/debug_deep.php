<?php
require_once '../Database/config.php';

try {
    echo "<h1>DEEP DEBUG MODE</h1>";
    echo "Connected to Database: <b>" . DB_NAME . "</b> on " . DB_HOST . "<br><br>";

    // Function to dump columns
    function dumpTable($pdo, $table) {
        echo "<h3>Table: $table</h3>";
        try {
            $stmt = $pdo->query("DESCRIBE `$table`");
            echo "<table border='1' cellspacing='0' cellpadding='5'><tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th></tr>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $bg = ($row['Field'] == 'middle_name') ? 'yellow' : 'white';
                echo "<tr style='background:$bg'><td>{$row['Field']}</td><td>{$row['Type']}</td><td>{$row['Null']}</td><td>{$row['Key']}</td><td>{$row['Default']}</td></tr>";
            }
            echo "</table>";
        } catch (Exception $e) {
            echo "Error describing table: " . $e->getMessage();
        }
    }

    dumpTable($pdo, 'students');
    dumpTable($pdo, 'enrollments');

    // TRIGGERS
    echo "<h3>Triggers</h3>";
    $stmt = $pdo->query("SHOW TRIGGERS");
    $triggers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($triggers) == 0) {
        echo "No triggers found (Good).";
    } else {
        echo "<table border='1'><tr><th>Trigger</th><th>Event</th><th>Table</th><th>Statement</th></tr>";
        foreach ($triggers as $t) {
            echo "<tr><td>{$t['Trigger']}</td><td>{$t['Event']}</td><td>{$t['Table']}</td><td><pre>{$t['Statement']}</pre></td></tr>";
        }
        echo "</table>";
    }

} catch (PDOException $e) {
    echo "Connection Error: " . $e->getMessage();
}
?>
