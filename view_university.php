<?php
// Include database connection
include 'conn.php';

// Define how many results you want per page
$results_per_page = 5;

// Find out the number of results stored in the database
$query = "SELECT COUNT(*) AS total FROM tbl_institution";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$total_schools = $row['total'];

// Determine number of total pages available
$number_of_pages = ceil($total_schools / $results_per_page);

// Determine which page number visitor is currently on
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;

// Determine the starting limit number for the results on the displaying page
$starting_limit = ($page - 1) * $results_per_page;

// Retrieve selected results from the database
$query = "SELECT * FROM tbl_institution LIMIT $starting_limit, $results_per_page";
$result = $conn->query($query);

// Calculate the starting number for the display ID
$display_id = ($page - 1) * $results_per_page + 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Institutions</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Added Institutions</h2>
        <a href="add_university.php" class="btn btn-primary mb-4">Add New Institution</a>
        <a href="index.php" class="btn btn-secondary mb-4">Back to Home</a>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Institution Name</th>
                    <th>Location</th>
                    <th>Capacity</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        // Use $display_id for the display ID and then increment it
                        echo "<td>" . $display_id . "</td>";
                        echo "<td>" . $row['inst_name'] . "</td>";
                        echo "<td>" . $row['location'] . "</td>";
                        echo "<td>" . $row['capacity'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "</tr>";

                        // Increment the display ID for the next row
                        $display_id++;
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>No institutions found.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <nav>
            <ul class="pagination">
                <?php
                // Display the "Previous" button if you're not on the first page
                if ($page > 1) {
                    echo '<li class="page-item"><a class="page-link" href="view_university.php?page=' . ($page - 1) . '">Previous</a></li>';
                }

                // Display links for all pages
                for ($i = 1; $i <= $number_of_pages; $i++) {
                    if ($i == $page) {
                        echo '<li class="page-item active"><a class="page-link" href="view_university.php?page=' . $i . '">' . $i . '</a></li>';
                    } else {
                        echo '<li class="page-item"><a class="page-link" href="view_university.php?page=' . $i . '">' . $i . '</a></li>';
                    }
                }

                // Display the "Next" button if you're not on the last page
                if ($page < $number_of_pages) {
                    echo '<li class="page-item"><a class="page-link" href="view_university.php?page=' . ($page + 1) . '">Next</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>
</body>
</html>
