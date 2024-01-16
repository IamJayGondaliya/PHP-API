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

        $res = $config->insert($name,$age,$course);

        if($res) {
            // header("Location: dashboard.php");
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

            <form method="post">
                <div class="mb-3">
                    <label for="nameField" class="form-label">Student name</label>
                    <input type="text" class="form-control" id="nameField"  name="name">
                </div>
                <div class="mb-3">
                    <label for="ageField" class="form-label">Student age</label>
                    <input type="number" class="form-control" id="ageField"  name="age">
                </div>
                <div class="mb-3">
                    <label for="courseField" class="form-label">Student course</label>
                    <input type="text" class="form-control" id="courseField"  name="course">
                </div>
                <input type="submit" name="submit_btn" class="btn btn-primary" ></input>
            </form>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Course</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php while($data = mysqli_fetch_array($responce)) { ?>
                        <tr>
                            <th scope="row"> <?php echo $data['id']; ?> </th>
                            <td> <?php echo $data['name']; ?> </td>
                            <td> <?php echo $data['age']; ?> </td>
                            <td> <?php echo $data['course']; ?> </td>
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