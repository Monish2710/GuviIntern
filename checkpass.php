<?php
$db = mysqli_connect('localhost','root','','guvi');
$selected=mysqli_select_db($db,'register');
//session_start();
//$SESSION['email']=$email;
if(isset($_POST['userPassword']))
{
	$userPassword= $_POST['userPassword'];

	$query= mysqli_query($db,"SELECT * FROM register WHERE password='$userPassword'");
	if(mysqli_num_rows($query)>0)
	{
		//header('location: valid.php');
		//insert.php
		//$result = mysqli_query($db, $query);
	$qwerty = array();
    while($row =mysqli_fetch_assoc($query))
    {
        $qwerty[] = $row;
    }
    $fp = fopen('showdetails.json', 'w');
    fwrite($fp, json_encode($qwerty));//writing PHP array value to JSON file
    fclose($fp);
    $json=file_get_contents("showdetails.json");//To get the value from JSON file
            $data =  json_decode($json,true);

            if (count($data)) {
            // Open the table
            foreach ($data as $stand)
          {
           echo '<br><center><h2>Your Details</h2><br><br><table width="500" height="500" border=12>';
           echo '<tr><td><strong>';
           echo "Name : ";
           echo '</strong>&nbsp &nbsp &nbsp &nbsp &nbsp';
           echo $stand["username"];//To Get the array value dept of stand
           echo '</td></tr>';
		       echo '<tr><td><strong>';
           echo "Password : ";
           echo '</strong>&nbsp &nbsp';
           echo $stand["password"];
           echo '</td></tr>';
           

           echo '<tr><td><strong>';
           echo "Gender : ";
           echo '</strong>&nbsp &nbsp &nbsp';
           echo $stand["gender"];
           echo '</td></tr>';

           echo '<tr><td><strong>';
           echo "Email : ";
           echo '</strong>&nbsp &nbsp &nbsp &nbsp';
           echo $stand["email"];
           echo '</td></tr>';

           echo '<tr><td><strong>';
           echo "Year : ";
           echo '</strong>&nbsp &nbsp &nbsp &nbsp &nbsp';
           echo $stand["year"];
           echo '</td></tr>';

           echo '<tr><td><strong>';
           echo "Roll No : ";
           echo '</strong>&nbsp &nbsp &nbsp &nbsp';
           echo $stand["rollno"];
           echo '</td></tr>';

           echo '</center></table>';
           
            }
        }

       //mysqli_close($conn);//Closing DB connection
     exit();
	}
	else
	{
		header('location: pubbbg.html');
	}
}
?>