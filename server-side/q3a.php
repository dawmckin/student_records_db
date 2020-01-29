<?php
$con=mysqli_connect("db.soic.indiana.edu", "i308f17_team93", "my+sql=i308f17_team93", "i308f17_team93");
//Check Connection
if (mysqli_connect_errno())
{echo nl2br("Failed to connect to MySQL:" . mysqli_connect_error() . "\n");}
else
{echo nl2br("Established Database Connection \n");}

//perform select statement
$sql = "SELECT CONCAT(f.NameF, ' ', f.NameL) AS FacultyName, c.Title, COUNT(*) AS Count FROM Faculty AS f, Semester AS sem, Section AS s, Course AS c WHERE f.FacultyID = sem.FacultyID AND sem.SectionID = s.SectionID AND s.CourseNum = c.CourseNum GROUP BY FacultyName, c.Title;";

//get results and print table
$result=mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
	//output data of each row
	echo "<table border='1'><tr><th>Faculty Name</th><th>Course Title</th><th>Times Taught</th></tr>";
	while($row = mysqli_fetch_assoc($result)) {
		echo "<tr><td>" .$row['FacultyName']. "</td><td>" .$row['Title']. "</td><td>" .$row['Count']. "</td></tr>";
	}
	echo "</table>";
} else {
	echo "0 results";
}
mysqli_close($con);
?>