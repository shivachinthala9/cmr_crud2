<?php
    include 'db_conn.php';

    $id = $_GET['id'];

    if(isset($_POST['submit'])){
        $roll_no = $_POST['roll_no'];
        $student_name = $_POST['student_name'];
        $branch = $_POST['branch'];

        $sql = "UPDATE `student_details` SET `id`='$id',`roll_no`='$roll_no',`student_name`='$student_name',`branch`='$branch' WHERE id=$id";

        $result= mysqli_query($conn, $sql);

        if($result){
            header("Location: index.php?msg= Record updated successfuly.");
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }
?>
<!doctype html>
<html lang="en">
    <?php include 'header.php'?>
  <body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <?php
            if(isset($_GET['msg'])){
                $msg = $_GET['msg'];
                echo '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                '.$msg.'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ';
            }
        ?>
        <div class="row">
            <?php 

                $sql = "SELECT * FROM `student_details` WHERE id=$id LIMIT 1";
                $details_array = mysqli_query($conn, $sql);
                $details = mysqli_fetch_assoc($details_array);
            ?>
            <div class="col-4">
                <h3 class="fw-bold">Details Form</h1>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="rollno" class="form-label">Roll no</label>
                        <input id="rollno" name="roll_no" class="form-control" type="text" value="<?php echo $details['roll_no'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Student Name</label>
                        <input id="studentname" name="student_name" class="form-control" type="text" placeholder="Student Name" value="<?php echo $details['student_name'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="branch" class="form-label">Branch</label>
                        <select id="branch" class="form-select" name="branch">
                            <option value="Civil" <?php if($details['branch']=='Civil') echo 'selected'?> >Civil</option>
                            <option value="Computer Science" <?php if($details['branch']=='Computer Science') echo 'selected'?> >Computer Science</option>
                            <option value="Mechanical" <?php if($details['branch']=='Mechanical') echo 'selected'?> >Mechanical</option>
                            <option value="Electrical" <?php if($details['branch']=='Electrical') echo 'selected'?> >Electrical </option>
                            <option value="Electronics" <?php if($details['branch']=='Electronics') echo 'selected'?> >Electronics </option>
                          </select>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit" name="submit">Update</button>
                    </div>
                </form>
            </div>
            <div class="col-8">
                <h3 class="fw-bold">Student Details</h1>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Roll No</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Branch</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $sql = "SELECT * FROM student_details";
                        $data = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($data)){ ?>
                            <tr>
                                <td><?php echo $row['id'] ?></td>
                                <td><?php echo $row['roll_no'] ?></td>
                                <td><?php echo $row['student_name'] ?></td>
                                <td><?php echo $row['branch'] ?></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $row['id'] ?>" type="button" class="btn btn-outline-primary btn-sm">Update</a>
                                    <a href="delete.php?id=<?php echo $row['id'] ?>" type="button" class="btn btn-outline-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        <?php
                        }
                    ?>
                    </tbody>
                  </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>