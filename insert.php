<?php
$username = $_POST['username'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$year = $_POST['year'];
$rollno = $_POST['rollno'];
if (!empty($username) || !empty($password) || !empty($gender) || !empty($email) ||
!empty($year) || !empty($rollno)) {
 $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "guvi";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email From register Where email = ? Limit 1";
     $INSERT = "INSERT Into register (username, password, gender, email, year, rollno) values(?, ?, ?, ?, ?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssssii", $username, $password, $gender, $email, $year, $rollno);
      $stmt->execute();
      header('location: logiin.html');
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
   // $stmt->close();
   //$conn->close();
    }
} else {
 echo "All field are required";
 die();
}


// Create JSON file
function get_data()
{
   $connect=mysqli_connect('localhost','root','','guvi');
   $query="SELECT * FROM register";
   $result=mysqli_query($connect,$query);
   $userdata=array();
   while ($row=mysqli_fetch_array($result)) {
      $userdata[]=array(
        'username' =>  $row["username"],
        'password' =>  $row["password"],
        'gender'   =>  $row["gender"],
        'email'    =>  $row["email"],
        'year'     =>  $row["year"],
        'rollno'   =>  $row["rollno"]
      );
   }
   return json_encode($userdata);
}
/*echo '<pre>';
print_r(get_data());
echo '</pre>';*/
$filename=date("d-m-Y") . ".json";

if (file_put_contents($filename, get_data())) {
    echo $filename . 'file_created';}
else
    {echo $filename . 'file_created_error';}
?>