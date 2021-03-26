<?php
require_once ("DbConn.php");
session_start();
$uname = $_SESSION["uname"];
$studentId = $_SESSION["studentid"];
//echo $uname;
?>
<!DOCTYPE html>
<html>
<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="feedback_style.css">
<style>
</style>

<script type="text/javascript">
	function myFunction(){
	    var url_string = window.location.href
	    var url = new URL(url_string);
	    var inserted = url.searchParams.get("inserted");
	    if(inserted==1){
	    	openCity(event, 'YourFeedback');
	    }
	    else{
	    	openCity(event, 'About');
	    }
	}
</script>

</head>
<body onload='myFunction()'>

<h2>Feedback Maintainance</h2>

<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'About')">About</button>
  <div class="dropdown">
  <button class="tablinks" onclick="openCity(event, 'FeedbackCategory')">Feedback Category<i class="fa fa-caret-down"></i></button>
    <div class="dropdown-content">
    	<button onclick="openCity(event, 'Staff')">Staffs</button>
  		<button onclick="openCity(event, 'Canteen')">Canteen Facilities</button>
  		<button onclick="openCity(event, 'Cleanliness')">Cleanliness</button>
  		<button onclick="openCity(event, 'Bus')">Bus Facilities</button>
  		<button onclick="openCity(event, 'Hostel')">Hostel Facilities</button>
    </div>
  </div> 
  <button class="tablinks" onclick="openCity(event, 'YourFeedback')">Your Feedback</button>
  <button class="tablinks" onclick="openCity(event, 'NewFeedback')">Post New Feedback</button>
</div>

<div id="About" class="tabcontent">
  <h3>About</h3>
  <!-- Navigation -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" align="center"><font color="#00FF33">STUDENT FEEDBACK SYSTEM</font> </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Intro Content -->
        <div class="row" style="margin-bottom:50px;margin-left:50px">
               <P>Student Feedback system for College 
Here we have developed the a faculty feedback system, which is generally used in the college to rate the faculty based on the performance...Here we have 2 modules such as administrator, student.
Administrator is the one who creates the student account by adding all student info and assigning the username and password.
Admin als0 checks the result once all students entered the feedback..
We can start the development from the login page, where we have given the option to login as admin and student...Here since we have only one admin account, so no need to create the a database to store admin info...so the admin username is "admin" and password is "sandeep"...select admin in the radio button and login
You can perform all admin actions such as login to the account and check result..
I fyou entered the student user and password and selected student option, then it will show all student information and let you enter the feedback based on the subject..
Before we can look into the php code, you need to create a database called "feed" with two tables in it..one as student and another one as take
</P>
            </div>
        </div>
        <!-- /.row -->

        <!-- Footer -->
</div>

<?php
	function getCategoryFeedbacks($con,$Category,$studentId){
	  	$query="select feedbackdetails.PostedOn,feedbackdetails.Feedback,feedbackdetails.Status,feedbackdetails.UpVote_Count,feedbackdetails.DownVote_Count,feedbackdetails.FeedbackId from feedbackdetails INNER JOIN 
	  	feedback_category ON feedbackdetails.CategoryId=feedback_category.CategoryId WHERE feedback_category.CategoryId=$Category";
	  	$result=mysqli_query($con,$query);
	  	if($result->num_rows>0){
	  		while($row = $result->fetch_assoc()) {
	  			$queried_name=$row['PostedOn'];
	  			$Status=$row['Status'];
	  			$feedBack=$row['Feedback'];
	  			$Upvote=$row['UpVote_Count'];
	  			$Downvote=$row['DownVote_Count'];
	  			echo "<br>";
	  			echo "Posted On : $queried_name &nbsp&nbsp&nbsp Upvote Count : $Upvote &nbsp&nbsp&nbsp Downvote Count : $Downvote";
	  			echo "<br>";
	  			echo"<br>";
	  			$feedback_id = $row['FeedbackId'];
	  			$getVotes = "select * from votes WHERE StudentId=".$studentId." and feedbackId=".$feedback_id."";
	  			$innerResult=mysqli_query($con,$getVotes);

	  			$upvoteColor='black';
	  			$downvoteColor='black';
	  			$studentUpvote = 0;
	  			$studentDownvote = 0;

	  			while ($innerResult && $innerRow = mysqli_fetch_array($innerResult)){
		  			$studentUpvote = $innerRow['UpVote'];
		  			$studentDownvote = $innerRow['DownVote'];	  				
	  			}
	  			
	  			if($studentUpvote==1){
	  				$upvoteColor="blue";
	  			}
	  			else{
	  				$upvoteColor="black";
	  			}
	  			if($studentDownvote==1){
	  				$downvoteColor="blue";
	  			}
	  			else{
	  				$downvoteColor="black";
	  			}

	  			//echo $StatuS.$sql;
	      		echo "<div class='votes'>
	      		<div class='Upvotes'>
	      		<i id='upvotes".$row['FeedbackId']."' style='color:".$upvoteColor.";font-size:24px' onclick='upvote(this,".$row['FeedbackId'].",".$studentId.")' class='fas fa-chevron-circle-up'></i>
	      		</div>
	      		<div class='downvotes'>
	      		<i id='downvotes".$row['FeedbackId']."' style='color:".$downvoteColor.";font-size:24px' onclick='downvote(this,".$row['FeedbackId'].",".$studentId.")' class='fas fa-chevron-circle-down'></i></div>
	      		</div>
	      		<div class='Feedback'><p class='feedbackFont'>".$row['Feedback']."</p></div>";
	      		echo $Status;
	      		echo "<hr>";
	    	}
	    }
	}
?>



<script>

function incrementVote(feedback_id,student_id,upvotes,downvotes){
	$.ajax({
		url:'insertvotes.php',
		type:'post',
		data:{feedback_id:feedback_id,student_id:student_id,upvotes:upvotes,downvotes:downvotes},
		success:function(response){
		},
		error:function(xhr,status,error){
		}
	})
}


function decrementVote(feedback_id,student_id,upvotes,downvotes){
	$.ajax({
		url:'deletevotes.php',
		type:'post',
		data:{feedback_id:feedback_id,student_id:student_id,upvotes:upvotes,downvotes:downvotes},
		success:function(response){
		},
		error:function(xhr,status,error){
		}
	})
}

function upvote(x,feedback_id,student_id) {
  var a=document.getElementById('upvotes'+feedback_id);
  var b=document.getElementById('downvotes'+feedback_id);
  var color1 = a.style.color;
  if(color1=="blue"){
  	a.style.color = "black";
  	decrementVote(feedback_id,student_id,1,0);
  }
  else{
  	a.style.color = "blue";
  	b.style.color = "black";
  	incrementVote(feedback_id,student_id,1,0);
  }
}
</script>

<script>
function downvote(x,feedback_id,student_id) {
  var a=document.getElementById('downvotes'+feedback_id);
  var b=document.getElementById('upvotes'+feedback_id);
  var color1 = a.style.color;
  if(color1=="blue"){
  	a.style.color = "black";
  	decrementVote(feedback_id,student_id,0,1);

  }
  else{
  	a.style.color = "blue";
  	b.style.color = "black";
  	incrementVote(feedback_id,student_id,0,1);
  }
}
</script>


<div id="Staff" class="tabcontent">
	 <?php
	 getCategoryFeedbacks($con,1,$studentId)
  ?>

</div>
<div id="Canteen" class="tabcontent">
	 <?php
	 getCategoryFeedbacks($con,2,$studentId);
  ?>
</div>

<div id="Cleanliness" class="tabcontent">
	 <?php
	 getCategoryFeedbacks($con,3,$studentId);
  ?>
</div>



<div id="Bus" class="tabcontent">
	<?php
		getCategoryFeedbacks($con,4,$studentId);
	?>
</div>

<div id="Hostel" class="tabcontent">
	 <?php
	 getCategoryFeedbacks($con,5,$studentId);
  ?>
</div>


<div id="YourFeedback" class="tabcontent">
  <?php
  	$query="select feedbackdetails.PostedOn,feedbackdetails.Feedback,feedbackdetails.Status from feedbackdetails INNER JOIN 
  	students ON feedbackdetails.PostedBy=students.StudentId WHERE StudentId=$studentId";
  	$result=mysqli_query($con,$query);
  	if($result->num_rows>0){
  		while($row = $result->fetch_assoc()) {
  			$queried_name=$row['PostedOn'];
  			$sql=$row['Status'];
  			$feedBack=$row['Feedback'];
  			echo "<br>";
  			echo "Posted On : ";echo $queried_name;
  			echo "<br>";
  			echo"<br>";
  			//echo $StatuS.$sql;
      		echo "<div class='Feedback'><p class='feedbackFont'>".$row['Feedback']."</p></div>";
      		echo $sql;
      		echo "<hr>";
    }
    }
  ?>
</div>

<div id="NewFeedback" class=" tabContent loginPopup">
    <div class="formPopup" id="popupForm">
        <form action="save_feedback.php" class="formContainer" method="Post">
          <h1>Add your Feedback</h1>
        <label for="feedback">
          <strong>Feedback</strong>
        </label><br>
        <textarea style="width:100%;height:100px" rows='4' id="feedback" placeholder="Your Feedback" name="feedback" required></textarea>
        <p><strong>Category</strong></p>
  			<input type="radio" id="Staff" name="Category" value="1">
  			<label for="Staff">Staff</label><br>
  			<input type="radio" id="Canteen" name="Category" value="2">
  			<label for="Canteen">Canteen</label><br>
  			<input type="radio" id="Cleanliness" name="Category" value="3">
  			<label for="Cleanliness">Cleanliness</label><br>
  			<input type="radio" id="Bus" name="Category" value="4">
  			<label for="Bus">Bus Facilities</label><br>
  			<input type="radio" id="Hostel" name="Category" value="5">
  			<label for="Hostel">Hostel Facilities</label><br><br>
        <button type="submit" class="btn">Add</button>
        <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        </form>
    </div>
</div>
<script>
      function openForm() {
        document.getElementById("popupForm").style.display = "block";
      }
      function closeForm() {
        document.getElementById("popupForm").style.display = "none";
      }

function openCity(evt, tabPage) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  if(tabPage=="NewFeedback"){
  	openForm();
  }
  else{
  document.getElementById(tabPage).style.display = "block";  	
  }
  evt.currentTarget.className += " active";
}
</script>
   
</body>
</html> 
