<?php
include 'db_connect.php';
try {
    $stmt = $pdo->query("SELECT * FROM Patients");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo $row['first_name'] . ' ' . $row['last_name'] . ' - ' . $row['national_id'] . '<br>';
    }
} catch (PDOException $e) {
    echo 'خطا: ' . $e->getMessage();
}
?>