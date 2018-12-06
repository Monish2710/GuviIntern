<?php
$db = mysqli_connect('localhost','root','','guvi');
$selected=mysqli_select_db($db,'register');

if(isset($_POST['email']))
{
	$email= $_POST['email'];

	$query= mysqli_query($db,"SELECT * FROM register WHERE email='$email'");
	if(mysqli_num_rows($query)>0)
	{
		header('location: pubbg.html');
	}
	else
	{
		header('location: reg.html');
	}
}
?>