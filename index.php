<?php

    include("config/config.php");

    $config = new Config();

    /*
        Associative array   =>  Map => key & value

        Super globals:

        $_GET       =>  Associative array   => by form method
        $_POST      =>  Associative array   => by form method
        $_REQUEST   =>  Associative array   => submit / button press
        $_SERVER    =>  Associative array   => at the time of API call

        Error handler:  '@'
            - assigns value after initialization of the variable being assigned.

        header():
            - adds raw data in the headers which is required to the page    
        
    */

    $submit_btn = @$_REQUEST['submit_btn'];

    $res = -1;

    if(isset($submit_btn)) {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $course = $_POST['course'];

        $res = $config->insert($name,$age,$course); //1/0

        if($res) {
            // header("Location: dashboard.php");
        }
    }

    /*
            - Press delete
            - fetch id
            - use SQL
    */

    $delete_btn = @$_REQUEST['btn_delete'];

    if(isset($delete_btn)) {
        $id = $_POST['delete_id'];

        $delete_res = $config->delete($id);

        if($delete_res) {
            echo "<div class='container pt-5'><div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Deleted !!</strong> id $id deleted successfully...
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div></div>";
        }
        else {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Failled !!</strong> id $id failled to delete...
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
    }


    /*
            - Press button
            - Fetch id
            - Fetch data
            - use SQL
    */

    $update_btn = @$_REQUEST['btn_update'];

    if(isset($update_btn)) {
        $update_id = $_POST['update_id'];
        $update_name = $_POST['update_name'];
        $update_age = $_POST['update_age'];
        $update_course = $_POST['update_course'];

        $button_updt = @$_REQUEST['button_updt'];

        if(isset($button_updt)) {
            $name = $_POST['name'];
            $age = $_POST['age'];
            $course = $_POST['course'];

            echo "Id: $update_id, Name: $name, Age: $age, Course: $course";

            $config->update($update_id,$name,$age,$course);
        }

    }

    


    $responce = $config->getAllData();

?>

<!-- Boiler plate   =>  !   : Emmet Abbreviation -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP Page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <!-- get/post -->
        
        <div class="container pt-5">

            <?php if($res == 1) {?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Hurrayyy !</strong> Record inserted successfully...
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } else if($res == 0) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Alas !</strong> Record insertion insertion...
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php }?>

            <form method="get">
                <div class="mb-3">
                    <label for="nameField" class="form-label">Student name</label>
                    <input type="text" class="form-control" id="nameField"  name="name" value="<?php
                        if($update_btn != null) {
                            echo $update_name;
                        }
                    ?>">
                </div>
                <div class="mb-3">
                    <label for="ageField" class="form-label">Student age</label>
                    <input type="number" class="form-control" id="ageField"  name="age" value="<?php
                        if($update_btn != null) {
                            echo $update_age;
                        }
                    ?>">
                </div>
                <div class="mb-3">
                    <label for="courseField" class="form-label">Student course</label>
                    <input type="text" class="form-control" id="courseField"  name="course" value="<?php
                        if($update_btn != null) {
                            echo $update_course;
                        }
                    ?>">
                </div>
                <input type="submit" value="<?php
                    echo $update_btn != null ? "UPDATE" : "SUBMIT";
                ?>" name="<?php echo $update_btn != null ? "button_updt" : "submit_btn" ?>" class="btn btn-primary" ></input>
            </form>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Course</th>
                        <th scope="col" span="2">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php while($data = mysqli_fetch_array($responce)) { ?>
                        <tr>
                            <th scope="row"> <?php echo $data['id']; ?> </th>
                            <td> <?php echo $data['name']; ?> </td>
                            <td> <?php echo $data['age']; ?> </td>
                            <td> <?php echo $data['course']; ?> </td>
                            <td> 
                                <form action="" method="post">
                                    <input type="hidden" value="<?php echo $data['id'];?>" name="update_id">
                                    <input type="hidden" value="<?php echo $data['name'];?>" name="update_name">
                                    <input type="hidden" value="<?php echo $data['age'];?>" name="update_age">
                                    <input type="hidden" value="<?php echo $data['course'];?>" name="update_course">
                                    <input type="submit" value="Update" class="btn btn-primary" name="btn_update">
                                </form>
                            </td>
                            <td> 
                                <form action="" method="post">
                                    <input type="hidden" value="<?php echo $data['id'];?>" name="delete_id">
                                    <input type="submit" value="Delete" class="btn btn-danger" name="btn_delete">
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>


            <!-- <form action="" method="post">
                Name: <input type="text" name="name"> <br>
                Age: <input type="number" name="age"> <br>
                Course: <input type="text" name="course"> <br>
                <input type="submit" value="SUBMIT" name="submit_btn">
            </form> -->
        </div>
    </body>
</html>