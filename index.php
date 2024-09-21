<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Placement System</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<?php
    include 'conn.php'
    ?>
<body>
  <div class="container">
    <h1>Welcome home!</h1>
    <a href = "inst-signup.php" class="btn btn-primary" role="button">Add Student</a>
    <a href = "add_university.php" class="btn btn-primary" role="button">Add University</a>
    <a href = "add_school.php" class="btn btn-primary" role="button">Add High School</a>
     
     
<table class="table table-bordered table-striped">
  <thead class = "bg-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Index Number</th>
      <th scope="col">Birth Date</th>
      <th scope="col">Email</th>
      <th scope="col">Phone Number</th>
      <th scope="col">Grade</th>
      <th scope="col">Placed Institution</th>
      <th scope="col">High School</th>
      <th scope="col">KCSE Year</th>
      <th scope="col">Acount Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  <?php
    $raw = 0;

    $query = "SELECT * FROM tbl_students INNER JOIN tbl_grade ON tbl_grade.points = tbl_students.grades INNER JOIN tbl_institution ON tbl_students.placed_inst = tbl_institution.inst_id INNER JOIN tbl_highschool ON tbl_students.high_school = tbl_highschool.school_id";


    $run = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($run)){
      $raw++; 
     
    ?>


    <tr>
      <th scope="row"><?php echo $raw ?></th>
      <td><?php echo $row['index_number'] ?></td>
      <td><?php echo $row['birth_date'] ?></td>
      <td><?php echo $row['email'] ?></td>
      <td><?php echo $row['phone_no'] ?></td>
      <td><?php echo $row['grade'] ?></td>
      <td><?php echo $row['inst_name'] ?></td>
      <td><?php echo $row['school_name'] ?></td>
      <td><?php echo $row['kcse_year'] ?></td>
      <td style="background-color: <?php echo $row['acc_status'] == 1 ? 'green' : ''; ?>; color: orange;">
    <?php echo $row['acc_status'] == 1 ? 'Active' : 'Inactive'; ?>
      </td>
      <td> 
      <form method="post" action="update.php"style="display: inline-block">
                    <input  type="hidden" name="id" value="<?php echo $row['student_id'] ?>"/>
                    <button type="submit" class="btn btn-sm btn-success">Edit</button>
      </form>
      <form method="post" action="delete.php" style="display: inline-block">
                    <input  type="hidden" name="id" value="<?php echo $row['student_id'] ?>"/>
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
      </form>

               
    </td>

 
      
    </tr>
    <?php } ?>
  </tbody>
</table>


</div>
</body>
</html>