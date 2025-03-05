<?php
require 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $activity = $_POST['activity'];
    $deadline = $_POST['deadline'];
    $importance = $_POST['importance'];

    $stmt = $pdo->prepare("INSERT INTO tasks (activity, deadline, importance) VALUES (:activity, :deadline, :importance)");
    $stmt->execute(['activity' => $activity, 'deadline' => $deadline, 'importance' => $importance]);

    header("Location: index.php");
    exit();
}
?>