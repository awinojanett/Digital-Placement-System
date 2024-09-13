<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Placement System</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel = "stylesheet" href = "style.css">
</head>
<br>
<br>

<?php
    include 'conn.php';

    // Fetching the student details using the POSTed id
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $query = "SELECT * FROM tbl_students 
                  INNER JOIN tbl_institution ON tbl_students.placed_inst = tbl_institution.inst_id 
                  INNER JOIN tbl_grade ON tbl_grade.points = tbl_students.grades 
                  WHERE tbl_students.student_id = '$id'";
        $run = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($run);
    }

    // Update logic when form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
        $index_number = $_POST['index_number'];
        $birth_date = $_POST['birth_date'];
        $email = $_POST['email'];
        $phone_no = $_POST['phone_no'];
        $grades = $_POST['grades'];
        $placed_inst = $_POST['placed_inst'];
        $high_school = $_POST['high_school'];
        $kcse_year = $_POST['kcse_year'];
        $student_id = $_POST['id']; // hidden field for the student id

        // Update query
        $updateQuery = "UPDATE tbl_students SET 
                            index_number = '$index_number', 
                            birth_date = '$birth_date',
                            email = '$email',
                            phone_no = '$phone_no',
                            grades = '$grades',
                            placed_inst = '$placed_inst',
                            high_school = '$high_school',
                            kcse_year = '$kcse_year'
                        WHERE student_id = '$student_id'";
        
        if (mysqli_query($conn, $updateQuery)) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
?>

<div class="container">
    <form action="update.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['student_id']; ?>">
        <div class="mb-3">
            <label for="ExampleInputUsername" class="form-label">Index Number</label>
            <input type="text" name="index_number" class="form-control" value="<?php echo $row['index_number']; ?>" id="ExampleInputUsername" autocomplete="off">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Birth Date</label>
            <input type="date" name="birth_date" class="form-control" value="<?php echo $row['birth_date']; ?>" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="ExampleInputInstitution" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" id="ExampleInputInstitution">
        </div>
        <div class="mb-3">
            <label for="ExampleInputInstitution" class="form-label">Phone number</label>
            <input type="text" name="phone_no" required maxlength="10" value="<?php echo $row['phone_no']; ?>" class="form-control" id="ExampleInputInstitution">
        </div>
        <div class="mb-3">
            <label for="ExampleInputInstitution" class="form-label">Grade</label>
            <select name="grades" class="form-control">
                <option value="12" <?php echo ($row['grades'] == 12) ? 'selected' : ''; ?>>A</option>
                <option value="11" <?php echo ($row['grades'] == 11) ? 'selected' : ''; ?>>A-</option>
                <!-- Add more options similarly -->
            </select>
        </div>
        <div class="mb-3">
            <label for="ExampleInputInstitution" class="form-label">Placed Institution</label>
            <select name="placed_inst" class="form-control">
                <option value="12" <?php echo ($row['placed_inst'] == 12) ? 'selected' : ''; ?>>Egerton University</option>
                <option value="11" <?php echo ($row['placed_inst'] == 11) ? 'selected' : ''; ?>>Kibabii University</option>
                <!-- Add more options similarly -->
            </select>
        </div>
        <div class="mb-3">
            <label for="ExampleInputInstitution" class="form-label">High School</label>
            <select name="high_school" class="form-control">
                <!-- This dropdown should list actual high schools, not grades -->
                <!-- Example schools added for demonstration -->
                <option value="12" <?php echo ($row['high_school'] == 12) ? 'selected' : ''; ?>>School A</option>
                <option value="11" <?php echo ($row['high_school'] == 11) ? 'selected' : ''; ?>>School B</option>
                <!-- Add more options -->
            </select>
        </div>
        <div class="mb-3">
            <label for="ExampleInputInstitution" class="form-label">KCSE Year</label>
            <input type="number" name="kcse_year" class="form-control" value="<?php echo $row['kcse_year']; ?>" id="ExampleInputInstitution">
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update</button>
    </form>
</div>
