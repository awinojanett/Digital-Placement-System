<?php
// Include database connection
include 'conn.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $inst_name = $_POST['inst_name'];
    $location = $_POST['location'];
    $capacity = $_POST['capacity'];
    $status = $_POST['status'];

    // Prepare and execute the SQL query
    $query = "INSERT INTO tbl_institution (inst_name, location, capacity, status) 
              VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $inst_name, $location, $capacity, $status);
    
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Institution added successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: Could not add institution. Please try again.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Institution</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <!-- Button to view schools -->
        <a href="view_university.php" class="btn btn-primary mb-4">View Added Universities</a>
        <a href="index.php" class="btn btn-secondary mb-4">Back to Home</a>

        <!-- Form to add school details -->
        <div class="card">
            <div class="card-header">
                Add Institution
            </div>
            <div class="card-body">
                <form action="add_university.php" method="POST">
                    <div class="mb-3">
                        <label for="inst_name" class="form-label">Institution Name</label>
                        <input type="text" name="inst_name" class="form-control" required>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" name="location" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="capacity" class="form-label">Capacity</label>
                        <input type="text" name="capacity" class="form-control" required>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Add Institution</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
