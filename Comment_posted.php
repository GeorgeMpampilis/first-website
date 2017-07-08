<?php
include('Connect.php');	

$submit=$_POST['submit'];

$email = $comment = "";
$emailErr = $commentErr = "";
$flag = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["comment"])) {
    $commentErr = "Comment is required";
	$flag = false;
	
	
  } elseif(!empty($_POST["comment"]) && (!empty($_POST["email"]))){
	  $comment=htmlentities($_POST['comment']);
	  $email=htmlentities($_POST['email']);
	  // check if e-mail address syntax is valid
      if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
		  $emailErr = "Invalid email format"; 
		  $flag = false;
	  }else{
		  $flag = true;
	  }
  }elseif(!empty($_POST["comment"]) && (empty($_POST["email"]))){
		$comment=htmlentities($_POST['comment']);
		$flag = true;
	
  }else{
		
		 $flag = false;
	 }
}

if($submit && $flag==true)
{
    if($comment)
    {
    $sql="INSERT INTO comments (email,comment) VALUES ('$email','$comment')";
	$smt = $pdo -> prepare($sql);
	$smt->execute( array(':email'=>$email, ':comment'=>$comment));	
    }
	header('Location: Comments.php');
}
?>