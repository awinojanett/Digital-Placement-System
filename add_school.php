<?php
// Include database connection
include 'conn.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $school_name = $_POST['school_name'];
    $category = $_POST['category'];
    $location = $_POST['location'];
    $contact_name = $_POST['contact_name'];
    $contact_no = $_POST['contact_no'];
    $status = $_POST['status'];

    // Prepare and execute the SQL query
    $query = "INSERT INTO tbl_highschool (school_name, category, location, contact_name, contact_no, status) 
              VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssss", $school_name, $category, $location, $contact_name, $contact_no, $status);
    
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>School added successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: Could not add school. Please try again.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add School</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <!-- Button to view schools -->
        <a href="view_schools.php" class="btn btn-primary mb-4">View Added Schools</a>
        <a href="index.php" class="btn btn-secondary mb-4">Back to Home</a>

        <!-- Form to add school details -->
        <div class="card">
            <div class="card-header">
                Add School
            </div>
            <div class="card-body">
                <form action="add_school.php" method="POST">
                    <div class="mb-3">
                        <label for="school_name" class="form-label">School Name</label>
                        <input type="text" name="school_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" name="category" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" name="location" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact_name" class="form-label">Contact Name</label>
                        <input type="text" name="contact_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact_no" class="form-label">Contact Number</label>
                        <input type="text" name="contact_no" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Add School</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
