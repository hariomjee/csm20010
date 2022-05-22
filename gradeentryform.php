<?php      
session_start();
$un=$_SESSION['name'];

if(!$un){
    header("Location:login.php");
}

if(isset($_POST['btnbtnlogout'])){
    unset($_SESSION["name"]);
    header("Location:login.php");
    die;
}

//create a connection to mysql server

$servername = "localhost";
$username = "root";
$password = "";
$conn="";

try {

    $conn = new PDO("mysql:host=$servername;dbname=mca2nd", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
} catch(PDOException $e) {
    //echo "Connection failed: " . $e->getMessage();
}

//save the grades
if(isset($_POST['save'])){
    $arr2=unserialize($_POST["grades"]);
    for($j=0; $j<count($arr2); $j++){
        $varuser=$arr2[$j][1];
        $varcourse=$arr2[$j][2];
        $vargrade=$_POST[$j];
        $q="update student_course set grade='".$vargrade."' where user_id='".$varuser."' and course_code='".$varcourse."'";
        $s=$conn->prepare($q);
        $s->execute();
        if (!$s->execute()) {
            print_r($s->errorInfo());
        }
    }
}

// array of courses
$q="select * from course_details";
$s=$conn->prepare($q);
$s->execute();
$courses=$s->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['save'])){
    $q="select * from course_details";
    $s=$conn->prepare($q);
    $s->execute();
}

if(isset($_POST['loadstudents']))
{
    // array of selected users
    $q="select * from user_details u, course_details c, student_course s where u.user_name=s.user_id and s.course_code=c.course_code and c.course_code='".$_POST['courses']."'";
    $s=$conn->prepare($q);
    $s->execute();
    $users=$s->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <link href="ourcss1.css" rel="stylesheet">
    <title>GRADE ENTRY</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <form action="gradeentryform.php" method="POST">
          
              <div class="col d-flex justify-content-between bg-info" style="padding: 2%;">
                    <h1 class="text-white">GRADE ENTRY FORM</h1>
                    <button class='btn btn-danger' type="submit" name="btnbtnlogout">LOGOUT</button>
              </div>
            </form>
        </div>
        <div class="row">
            <div class="col">
                <form action='gradeentryform.php' method='POST'>
                
                    <div class="container mt-4">
                      <div class="row">
                        <div class="col-md-2">
                            <label>SELECT COURSE</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <select class="form-select" name="courses">
                                <option value="none">NONE</option>

                        <?php for($j=0; $j<count($courses); $j++){ ?>
                                <option value="<?php echo $courses[$j]['course_code']?>"><?php echo $courses[$j]['course_code']?></option>;

                            <?php } ?>

                                </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary" name="loadstudents">LOAD STUDENTS</button>
                            </div>
                          </div>
                        </div>
                        <form action="gradeentryform.php" method="POST">
                        <table class="table table-bordered mt-4">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NAME</th>
                                    <th>ROLL NO</th>
                                    <th>GRADE</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $arr=array();
                                if(isset($_POST['loadstudents']))
                                {   
                                    for($j=0; $j<count($users); $j++){
                                        $slno=$j+1;
                                        array_push($arr,(array($j,$users[$j]['user_id'],$users[$j]['course_code']))); ?>

                                    <tr>
                                        <td><?php echo $slno ?></td>
                                        <td><?php echo $users[$j]['user_name'] ?></td>
                                        <td><?php echo $users[$j]['rollno'] ?></td>
                                        <td> 
                                            <?php if($users[$j]['grade']=='O'){ ?>
                                                  <select class="form-select" name="<?php echo $j ?>">
                                                      <option value="">NONE</option>
                                                      <option value="O" selected>O</option>
                                                      <option value="A+">A+</option>
                                                      <option value="A">A</option>
                                                  </select>
                                                  </td>
                                              </tr>
                                          <?php }   
                                          else if($users[$j]['grade']=='A'){ ?>
                                                    <select class="form-select" name="<?php echo $j ?>">
                                                        <option value="">NONE</option>
                                                        <option value="O">O</option>
                                                        <option value="A+">A+</option>
                                                        <option value="A" selected>A</option>
                                                    </select>
                                                    </td>
                                                </tr>
                                            <?php }
                                        else if($users[$j]['grade']=='A+'){ ?>
                                                  <select class="form-select" name="<?php echo $j ?>">
                                                      <option value="">NONE</option>
                                                      <option value="O">O</option>
                                                      <option value="A+" selected>A+</option>
                                                      <option value="A">A</option>
                                                  </select>
                                                  </td>
                                              </tr>
                                          <?php }
                                        else { ?>
                                                  <select class="form-select" name="<?php echo $j ?>">
                                                      <option value="" selected>NONE</option>
                                                      <option value="O">O</option>
                                                      <option value="A+">A+</option>
                                                      <option value="A">A</option>
                                                  </select>
                                                  </td>
                                              </tr>
                                          <?php 
                                                }
                                            }
                                                $arr1 = serialize($arr); ?>
                                                <input type="hidden" name="grades" value='<?php echo $arr1 ?>'/>
                                          <?php } ?>
                                      <tr>
                                          <td colspan=3></td>
                                          <td><button class="btn btn-primary" name="save">SAVE</button></td>
                                      </tr>
                                    </tbody>
                                </table>
                        </form>
                </form>
            
            </div>
        </div>
                
    </div>

    

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>

</body>

</html>