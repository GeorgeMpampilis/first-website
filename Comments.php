<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" media="all" href="css/project.css">
<link rel="stylesheet" type="text/css" media="all" href="css/gallery_style.css">
<link rel="shortcut icon" type="image/x-icon" href="Project-Images/favicon.ico" />
<title>Steve Aoki</title>
<script type="text/javascript">
function check_limit(element1,limit,element2) {
  // διάβασε τι γράφει μέσα στο textarea
	var myText = document.getElementById(element1).value;
  
  // μέτρα το μήκος του (πόσοι χαρακτήρες είναι)
	var myTextLength = myText.length;
  
  // συνδέσου στο element2
	var counterElement=document.getElementById(element2);
  
	if ( myTextLength > limit ) {   //αν το κείμενο ειναι μεγαλύτερο από limit
    // αντικατέστησε το κείμενο στο textarea με τους πρώτους limit χαρακτήρες    
	  document.getElementById(element1).value = myText.substr(0,limit);
    // βγάλε alert
	  alert("You can not write more characters!");
    // τύπωσε σχετικό κείμενο στο element2
	  counterElement.innerHTML = "Character limit reached!";
	}
	else {  // τύπωσε σχετικό κείμενο στο element2	  
    counterElement.innerHTML="" + (limit-myTextLength) + " Characters left";
	}
}

function validateForm()
{
	var result=true;
	var comment=document.forms["form"]["comment"].value;
	var email=document.forms["form"]["email"].value;


	if (comment==null || comment=="")
	{
	  alert("Comment box must be filled out");
	  result=false;
	}
	else if ( (comment!=null || comment!="") && email.length!=0 ) 
	{
		  var atpos=email.indexOf("@");
		  var dotpos=email.lastIndexOf(".");
	      if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length)
	      {
	  		alert("Not a valid e-mail address");
	  		result=false;
	}
	}
	else{
	
		result=true;
	}
	return result;

}

</script>
</head>

<body>
<div id="container">
  <div id="header">
    <div id="headerbackground"></div>
  </div>
  <div id="menubar">
    <nav class="menubarlinks">
      <ul >
        <li ><a href="Home.html" >Home</a></li>
        <li ><a href="Biography.html" >Biography</a></li>
        <li><a href="Discography.html" >Discography</a></li>
        <li><a href="Photos.html">Photos and Videos</a></li>
        <li><a href="News.html">News</a></li>
        <li class="active"><a href="Comments.php">Comments</a></li>
      </ul>
    </nav>
  </div>
  <div id="social-menu">
    <nav class="social">
      <ul >
        <li><a href="https://twitter.com/steveaoki" target="_blank" title="Twitter"><i></i><img alt="Twitter" src="Project-Images/twitter_icon.jpg" width="30" height="30" ></a></li>
        <li><a href="https://www.facebook.com/Steve.Aoki" target="_blank" title="Facebook"><i></i> <img alt="Facebook" src="Project-Images/facebook_icon.jpg" width="30" height="30" ></a></li>
        <li><a href="http://instagram.com/steveaoki" target="_blank" title="Instagram"><i></i> <img alt="Instagram" src="Project-Images/instagram_icon.jpg" width="30" height="30" ></a></li>
        <li><a href="http://www.youtube.com/steveaoki" target="_blank" title="Youtube"><i></i><img alt="Youtube" src="Project-Images/youtube_icon.jpg" width="30" height="30" ></a></li>
        <li><a href="https://soundcloud.com/steveaoki" target="_blank" title="Soundcloud"><i></i><img alt="Soundcloud" src="Project-Images/soundcloud_icon.jpg" width="30" height="30" ></a></li>
      </ul>
    </nav>
  </div>
  <div id="main">
    <div class="box">
      <?php
include('Connect.php');

  $recordsPerPage = 5;
  if (isset($_GET['page']))   
    $curPage = $_GET['page'];
  else                          
    $curPage = 1;
  $startIndex = ($curPage-1) * $recordsPerPage;
 
  try{
	  
    $sql = "SELECT count(commentID) as recCount FROM comments";
    $smt = $pdo->query($sql);
    $record = $smt->fetch(PDO::FETCH_ASSOC);
    $pages = ceil($record['recCount']/$recordsPerPage);  
  	$smt->closeCursor();  

    $record=null;
    $sql = "SELECT * FROM comments LIMIT $startIndex, $recordsPerPage";
 	  $smt = $pdo->query($sql);
    while ( $record = $smt->fetch(PDO::FETCH_ASSOC) ) {
		?>
      <div class="comment_box">
        <?php   
		echo "<a href=".$record['email']. "><img src=".$record['comment']."</></a>";  
	echo "<img src=".$record['email']. "> alt=".$record['comment']."/>";  
       echo "<b>From:</b> ".$record['email']."<br/>";
       
	   echo "<br/>";
	   echo "".$record['comment'];
	    ?>
      </div>
      <?php
	  }	 
  	$smt->closeCursor();
    $pdo = null;	  
	  } catch (PDOException $e) {
      print "Database Error: " . $e->getMessage() . "<br/>";
      die();
    }
?>
      <hr/>
      <center>
        <form name="form" action="Comment_posted.php" method="POST" onsubmit="return validateForm()">
          <table>
            <tr>
              <td >Email (Optional): <br>
                <input  type="text" name="email"  id="email" size="45">
                </td>
            </tr>
            <tr>
              <td colspan="2">Comment: </td>
            </tr>
            <tr>
              <td colspan="5">
             <textarea name="comment" id="comments" rows="5" onkeyup="check_limit('comments',150,'chars_left_counter');"></textarea>
             <p id="chars_left_counter">150 characters left.</p>
              </td>
            </tr>
            <tr>
              <td colspan="2"><input type="submit" name="submit" value="Comment"></td>
            </tr>
          </table>
        </form>
      </center>
      <hr/>
      <p>
        <?php 
        for ($i=1; $i<=$pages; $i++) {
          if ($i<>$curPage) { ?>
        <a href="Comments.php?page=<?php echo $i ?>"><?php echo $i ?></a>&nbsp;&nbsp;
        <?php  
          } else
             echo $i."&nbsp;&nbsp;";
        } ?>
      </p>
    </div>
  </div>
  <div id="footer">
    <div id="leftfooter">Copyright &copy; 2014</div>
    <div id="rightfooter">
      <div id="rightpart">G.Mpampilis</div>
      <div id="leftpart">Desing:&nbsp;</div>
    </div>
  </div>
</div>
</body>
</html>
