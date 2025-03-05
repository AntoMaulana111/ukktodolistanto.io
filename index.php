<?php
require 'conn.php';

// Fetch all tasks
$stmt = $pdo->query("SELECT * FROM tasks");
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">To-Do List</h2>

    <form action="add.php" method="POST" class="mb-3">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="activity" class="form-control" placeholder="Activity" required>
            </div>
            <div class="col-md-2">
                <input type="date" name="deadline" class="form-control" required>
            </div>
            <div class="col-md-3">
                <select name="importance" class="form-control">
                    <option value="Urgent Important">Urgent Important</option>
                    <option value="Urgent Not Important">Urgent Not Important</option>
                    <option value="Not Urgent Important">Not Urgent Important</option>
                    <option value="Not Urgent Not Important">Not Urgent Not Important</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Add Task</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Checklist</th>
                <th>Activity</th>
                <th>Deadline</th>
                <th>Importance</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><input type="checkbox"></td>
                    <td><?= htmlspecialchars($task['activity']) ?></td>
                    <td><?= $task['deadline'] ?></td>
                    <td><?= $task['importance'] ?></td>
                    <td>
                        <a href="update.php?id=<?= $task['id'] ?>" class="btn btn-warning btn-sm">Update</a>
                        <a href="delete.php?id=<?= $task['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>