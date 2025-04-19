<?php
session_start();
include_once __DIR__ . "/../TaskModel.php";

$tasks = new TaskModel();
$result = $tasks->getAllTaskByUserId($_SESSION["userid"]);
?>

<?php if ($result) : ?>
    <table border="1" style="border-collapse: collapse;">
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Status</th>
            <th>Due Date</th>
            <th colspan="2">Actions</th>
        </tr>
        <?php foreach ($result as $task): ?>
            <tr>
                <td><?= $task['name'] ?></td>
                <td><?= $task['description'] ?></td>
                <td><?= $task['status'] ?></td>
                <td><?= $task['duedate'] ?></td>
                <td>
                    <form action="tasks/edit.php" method="get">
                        <input type="hidden" name="id" value="<?= $task['id'] ?>">
                        <input type="hidden" name="name" value="<?= $task['name'] ?>">
                        <input type="hidden" name="description" value="<?= $task['description'] ?>">
                        <input type="hidden" name="status" value="<?= $task['status'] ?>">
                        <input type="hidden" name="duedate" value="<?= $task['duedate'] ?>">
                        <button type="submit">Edit</button>
                    </form>
                </td>
                <td>
                    <form action="tasks/delete.php" method="post">
                        <input type="hidden" name="id" value="<?= $task['id'] ?>">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif ?>