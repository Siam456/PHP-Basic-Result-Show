<?php
    // database connection

    $db = mysqli_connect ( "localhost", "root", "", "studentinfo" ) or die("unable to connect");

    if(isset($_POST['submit'])){
        $nameq = $_POST['stuname'];
        $semester = $_POST['semester'];

        $stuid = $_POST['studentid'];
        $campus = $_POST['campus'];
        $course = $_POST['course'];
        $cgpa = $_POST['cgpa'];


        if(empty($stuid)){
            $error = "Need to fill Student ID";
        } else if(empty($campus)){
            $error = "Need to fill Campus";
        } else if(empty($course)){
            $error = "Need to fill course";
        } else if(empty($cgpa)){
            $error = "Need to fill cgpa";
        } else if(empty($semester)){
            $error = "Need to fill semester";
        } else{
            $sql = "INSERT INTO student (stuname, stuId, semester, course, campus, cgpa) VALUES ('$nameq','$stuid','$semester','$course','$campus','$cgpa')";
            mysqli_query($db, $sql);
            header('location: data.php');
        }
    }
    
    $sql = "SELECT * FROM student";
    $stuinfo = mysqli_query($db, $sql);

    //delete task
    if(isset($_GET['del_task'])){
        $id = $_GET['del_task'];
        $sql = "DELETE FROM student WHERE id = $id";
        mysqli_query($db, $sql);
        header('location: data.php'); 
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Document</title>

    <style>
        .dataForm{
            display: none;
        }
    </style>
</head>
<body>
    <div class="container" style="text-align: center;">
        <h2>Data Form</h2>
        <button id='addbtn' onclick=visibleform() >Add Student Info</button>

<form  method="POST" action="data.php" id='form' class='dataForm'>
  <label for="name">Your name:</label><br>
  <input type="text" id="name" name='stuname'><br>

  

  <label for="semister">Your Semester:</label><br>
  <select name="semester">
        <option value="Spring 2021">Spring 2021</option>
        <option value="Summer 2021">Summer 2021</option>
        <option value="Fall 2021">Fall 2021</option>
    </select><br>

  <label for="studentid">Student ID:</label><br>
  <input type="text" id="studentid" name="studentid" ><br>

  <label for="campus">Campus:</label><br>
  <select name= 'campus'>
    <option value="Main Capmus">Main Campus</option>
    <option value="Permanent Campus">Permanent Campus</option>
  </select>
<br>
  <label for="course">Course:</label><br>
  <input type="text" id="course" name="course"><br>

  <label for="CGPA">CGPA:</label><br>
  <input type="text" id="cgpa" name = "cgpa" ><br><br>

  <input type="submit" value="Submit" name="submit">
  <button id='cancelBtn' onclick=invisibleform() >Cancel</button>
</form> 

<table border="1" style="margin-top: 50px; width: 100%;">
    <tr>
        <th>Student Name</th>
        <th>Student ID</th>
        <th>semister</th>
        <th>Course</th>
        <th>CGPA</th>
        <th>Campus</th>
        <th>Action</th>

    </tr>

    <tbody>
        <?php while($row = mysqli_fetch_array($stuinfo)) {?>
            <tr>
                
                <td>
                     <?php echo $row['stuname'] ?>
                </td>
                
                <td class='task'>
                    <?php echo $row['stuId'] ?>
                </td>

                <td class='task'>
                    <?php echo $row['semester'] ?>
                </td>

                <td class='task'>
                    <?php echo $row['course'] ?>
                </td>

                <td class='task'>
                    <?php echo $row['cgpa'] ?>
                </td>

                <td class='task'>
                    <?php echo $row['campus'] ?>
                </td>
               
                <td class="delete">
                    <a href="data.php?del_task=<?php echo $row['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
    </div>

    <script>
        var form = document.getElementById('form');
        var addbtn = document.getElementById('addbtn');

        function visibleform(){
            form.classList.remove("dataForm");
            addbtn.classList.add("dataForm");
        }

        document.getElementById("cancelBtn").addEventListener("click", function(event){
            event.preventDefault();
            form.classList.add("dataForm");
            addbtn.classList.remove("dataForm");
        });
    </script>
   

</body>
</html>