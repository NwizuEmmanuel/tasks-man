<?php
// Include database connection file
require_once '../config.php';

// Check if the ID is set in the request
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Prepare the SQL DELETE statement
    $query = "DELETE FROM tasks WHERE id = ?";
    $stmt = mysqli_prepare($mysqli, $query);

    if ($stmt) {
        // Bind the ID parameter to the statement
        mysqli_stmt_bind_param($stmt, "i", $id);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to the tasks list page with a success message
            header("Location: admin_page.php");
            exit();
        } else {
            echo "Error: Could not execute the delete query.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: Could not prepare the delete query.";
    }
} else {
    echo "Error: No ID provided.";
}

// Close the database connection
mysqli_close($conn);
?>