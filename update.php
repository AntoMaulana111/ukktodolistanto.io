<?php
require 'conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $task = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $activity = $_POST['activity'];
    $deadline = $_POST['deadline'];
    $importance = $_POST['importance'];

    $stmt = $pdo->prepare("UPDATE tasks SET activity = :activity, deadline = :deadline, importance = :importance WHERE id = :id");
    $stmt->execute(['activity' => $activity, 'deadline' => $deadline, 'importance' => $importance, 'id' => $id]);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Update Task</h2>
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?= $task['id'] ?>">
        <div class="mb-3">
            <label>Activity</label>
            <input type="text" name="activity" class="form-control" value="<?= $task['activity'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Deadline</label>
            <input type="date" name="deadline" class="form-control" value="<?= $task['deadline'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Importance</label>
            <select name="importance" class="form-control">
                <option value="Urgent Important">Urgent Important</option>
                <option value="Urgent Not Important">Urgent Not Important</option>
                <option value="Not Urgent Important">Not Urgent Important</option>
                <option value="Not Urgent Not Important">Not Urgent Not Important</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update Task</button>
    </form>
</div>
</body>
</html>