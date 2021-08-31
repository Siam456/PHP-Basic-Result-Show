<?php 

$error = 'Insert Correct Information!! Data not found..';
$stuinfo= '';

$db = mysqli_connect ( "localhost", "root", "", "studentinfo" ) or die("unable to connect");
  
if(isset($_POST['submit'])){
  $semester = $_POST['semester'];
  $campus = $_POST['campus'];
  $stuId = $_POST['id'];

  if(empty($stuId)){
    $error = 'Insert Correct Information!! Data not found..';
  }else{
    $sql = "SELECT * FROM student where stuId = '$stuId' AND semester='$semester' AND campus = '$campus'";

    $stuinfo = mysqli_query($db, $sql);
    $result = mysqli_query($db, $sql);

    $error= '';
  }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body style="background-color: #00b4d8;">
<header class="container-fluid">
<img src="../web Project/diu logo.png" alt="logo">
<div class="tagline">
    <h2>WEB BASED RESULT PUBLICATION SYSTEM FOR DAFFODIL INTERNATION UNIVERSITY</h2>
        <h4>GET YOUR SEMESTER RESULT HERE</H4>
</div>
</header>
<div class="container">
    <div class="myalart alert alert-success">
        <strong>Please Provide Your Information for your Semester Result.</strong> 

      </div>
    <div class="jumbotron">
      <form action="" method="POST" >
        <table border="0" style="width: 100%; text-align: center;">
          
          <tr>
            <td><h5><strong>Select Your Semester</strong></h5></td>
            <td>
              <div class="semester-select">
                <select name="semester">
                  <option value="Spring 2021">Spring 2021</option>
                  <option value="Summer 2021">Summer 2021</option>
                  <option value="Fall 2021">Fall 2021</option>
                </select>
              </div>
            </td>
          </tr>
          <tr>
            <td><h5><strong>Select Your Campus</strong></h5></td>
            <td>
              <div class="Campus-select">
                <select name= 'campus'>
                  <option value="Main Capmus">Main Campus</option>
                  <option value="Permanent Campus">Permanent Campus</option>
                </select>
              </div>
            </td>
          </tr>
          <tr>
            <td><h5><strong>Enter Your Versity ID</strong></h5></td>
            <td>
              <input type="text" id="stuid" name="id">
            </td>
          </tr>
        </table>
        <input type="submit"  name="submit" value='GET RESULT' class="btn btn-outline-primary" />
      </form>
      <h3 style="color: red;"><?php echo $error ?></h3>

      <?php 
      
      $row = mysqli_fetch_array($stuinfo);?>
      <h6>Name: <?php echo $row['stuname'] ?></h6>
      <h6>Student ID: <?php echo $row['stuId'] ?></h6>

      <h6>Campus: <?php echo $row['campus'] ?></h6>
      <h6>Semester: <?php echo $row['semester'] ?></h6>

    <table border="1" style="margin-top: 50px; width: 100%;">

    <tr>
        <th>Course</th>
        <th>cgpa</th>
      

    </tr>
    <tbody>
        <?php while($row2 = mysqli_fetch_array($result)) {?>
            <tr>
                
                <td>
                     <?php echo $row2['course'] ?>
                </td>
                
                <td class='task'>
                    <?php echo $row2['cgpa'] ?>
                </td>

               
            </tr>
        <?php } ?>
    </tbody>
</table>
      
    </div> 

  </div>
  <script src="../web Project/index.js"></script>
</body>
</html>