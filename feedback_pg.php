<!DOCTYPE html>
<html>
<head>
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
	}
</script>

</head>
<body onload='myFunction()'>

<h2>Feedback Maintainance</h2>

<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'About')">About</button>
  <button class="tablinks" onclick="openCity(event, 'FeedbackCategory')">Feedback Category</button>
  <button class="tablinks" onclick="openCity(event, 'YourFeedback')">Your Feedback</button>
  <button class="tablinks" onclick="openCity(event, 'NewFeedback')">Post New Feedback</button>
</div>

<div id="About" class="tabcontent">
  <h3>About</h3>
</div>

<div id="FeedbackCategory" class="tabcontent">
  <h3>Feedback Category</h3> 
</div>

<div id="YourFeedback" class="tabcontent">
  <h3>Your Feedback</h3>
  <?php
  	$query="select feedbackdetails.PostedOn,feedbackdetails.Feedback from feedbackdetails,students where feedbackdetails.PostedBy==students.StudentId";
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
