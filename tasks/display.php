<?php
# include_once("config.php"); already included in index.php

$result = mysqli_query($mysqli, "SELECT id, task, duedate, user_id, status FROM tasks WHERE user_id = '".$_SESSION['id']."' ORDER BY duedate ASC");
if (!$result) {
    die("Query failed: " . mysqli_error($mysqli));
}
?>

<?php if (mysqli_num_rows($result) > 0) : ?>
    <table border="1" style="border-collapse: collapse;">
        <tr>
            <th>Task</th>
            <th>Status</th>
            <th>Due Date</th>
            <th colspan="2">Actions</th>
        </tr>
        <?php while ($task = mysqli_fetch_array($result)): ?>
            <tr>
                <td><?= $task['task'] ?></td>
                <td><?= $task['status'] ?></td>
                <td><?= $task['duedate'] ?></td>
                <td>
                    <form action="tasks/edit.php" method="get">
                        <input type="hidden" name="id" value="<?= $task['id'] ?>">
                        <input type="hidden" name="task" value="<?= $task['task'] ?>">
                        <input type="hidden" name="status" value="<?= $task['status'] ?>">
                        <input type="hidden" name="duedate" value="<?= $task['duedate'] ?>">
                        <input type="hidden" name="user_id" value="<?= $task['user_id'] ?>">
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
        <?php endwhile ?>
    </table>
<?php endif ?>