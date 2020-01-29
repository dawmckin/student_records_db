<!doctype html>
<html>
<head><title>Group 93 Final Project</title></head>
<body>
<p>Team 93 - Caleb Heidorn, Dalton McKinney, Cyan Chen, Josh Samakow</p>
<hr>
<h2>Query 1b</h2>
<p>Produce a class roster for a *specified section* sorted by student’s last name, first name.
At the end, include the average grade (GPA for the class.)</p>
<p><i>Try Section 1 to get multiple students</i></p>
<form action="q1b.php" method="POST">
	Section: <select name='section'>
	<?php
	$conn = mysqli_connect("db.soic.indiana.edu","i308f17_team93","my+sql=i308f17_team93","i308f17_team93");
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
		$result = mysqli_query($conn,"SELECT distinct Title, SectionID FROM Section ORDER BY SectionID;");
		while ($row = mysqli_fetch_assoc($result)) {
					  unset($id, $title);
					  $id = $row['SectionID'];
					  $title = $row['Title']; 
					  echo '<option value="'.$id.'">'.$title.' '.$id.'</option>';
	}
	?>
	</select>
	<br><br>
	<input type="submit" value="Run Query 1b">
</form>
<hr>

<h2>Query 3a</h2>
<p>Produce a list of all faculty and all the courses they have ever taught. Show how many
times they have taught each course.</p>
<form action="q3a.php" method="POST">
	<input type="submit" value="Run Query 3a">
</form>
<hr>

<h2>Query 5c</h2>
<p>Produce a chronological list of all courses taken by a *specified student*. Show grades
earned. Include overall hours earned and GPA at the end.</p>
<p><i>Try Constantin Josefs</i></p>
<form action="q5c.php" method="POST">
	Student: <select name='student'>
	<?php
	$conn = mysqli_connect("db.soic.indiana.edu","i308f17_team93","my+sql=i308f17_team93","i308f17_team93");
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
		$result = mysqli_query($conn,"SELECT NameF, NameL, StudentID FROM Student ORDER BY NameF;");
		while ($row = mysqli_fetch_assoc($result)) {
					  unset($id, $nameF, $nameL);
					  $id = $row['StudentID'];
					  $nameF = $row['NameF'];
					  $nameL = $row['NameL'];					  
					  echo '<option value="'.$id.'">'.$nameF.' '.$nameL.'</option>';
	}
	?>
	</select>
	<br><br>
	<input type="submit" value="Run Query 5c">
</form>
<hr>

<h2>Query 6c</h2>
<p>Produce a list of students and faculty who were in a *particular building* at a *particular
time*. Also include in the list faculty and advisors who have offices in that building.</p>
<p><i>Try Informatics East, 2017, Fall</i></p>
<form action="q6c.php" method="POST">
	Building: <select name='building'>
	<?php
	$conn = mysqli_connect("db.soic.indiana.edu","i308f17_team93","my+sql=i308f17_team93","i308f17_team93");
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
		$result = mysqli_query($conn,"SELECT Name, BuildingID FROM Building ORDER BY Name;");
		while ($row = mysqli_fetch_assoc($result)) {
					  unset($id, $name);
					  $id = $row['BuildingID'];
					  $name = $row['Name'];				  
					  echo '<option value="'.$id.'">'.$name.'</option>';
	}
	?>
	</select>
	<br><br>
	Year: <select name='year'>
	<?php
	$conn = mysqli_connect("db.soic.indiana.edu","i308f17_team93","my+sql=i308f17_team93","i308f17_team93");
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
		$result = mysqli_query($conn,"SELECT DISTINCT Year FROM Semester;");
		while ($row = mysqli_fetch_assoc($result)) {
					  unset($year);
					  $year = $row['Year'];			  
					  echo '<option value="'.$year.'">'.$year.'</option>';
	}
	?>
	</select>
	<br><br>
	Term: <select name='term'>
	<?php
	$conn = mysqli_connect("db.soic.indiana.edu","i308f17_team93","my+sql=i308f17_team93","i308f17_team93");
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
		$result = mysqli_query($conn,"SELECT DISTINCT Term FROM Semester;");
		while ($row = mysqli_fetch_assoc($result)) {
					  unset($term);
					  $term = $row['Term'];			  
					  echo '<option value="'.$term.'">'.$term.'</option>';
	}
	?>
	</select>
	<br><br>
	<input type="submit" value="Run Query 6c">
</form>

<hr>
<h2>Query 9a</h2>
<p>Produce a list of majors offered, along with the department that offers them and their
requirements to graduate (hours earned and overall GPA).</p>
<form action="q9a.php" method="POST">
	<input type="submit" value="Run Query 9a">
</form>
<hr>

<h2>Additional Query 1</h2>
<p>Show which buildings each faculty member has their office in.</p>
<form action="addquery1.php" method="POST">
	<input type="submit" value="Run Additional Query 1">
</form>
<hr>

<h2>Additional Query 2</h2>
<p>Show all faculty that have taught a specific class (Try Info-I 308).</p>
<form action="addquery2.php" method="POST">
Class: <select name='class'>
	<?php
	$conn = mysqli_connect("db.soic.indiana.edu","i308f17_team93","my+sql=i308f17_team93","i308f17_team93");
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
		$result = mysqli_query($conn,"SELECT distinct CourseNum FROM Section ORDER BY CourseNum;");
		while ($row = mysqli_fetch_assoc($result)) {
					  unset($cid);
					  $cid = $row['CourseNum']; 
					  echo '<option value="'.$cid.'">'.$cid.'</option>';
	}
	?>
	</select>
	<br><br>
	<input type="submit" value="Run Additional Query 2">
</form>
<hr>
</body>
</html>