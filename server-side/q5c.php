<?php
$con=mysqli_connect("db.soic.indiana.edu", "i308f17_team93", "my+sql=i308f17_team93", "i308f17_team93");
//Check Connection
if (mysqli_connect_errno())
{echo nl2br("Failed to connect to MySQL:" . mysqli_connect_error() . "\n");}
else
{echo nl2br("Established Database Connection \n");}

//escape variables for security
$sanid = mysqli_real_escape_string($con, $_POST['student']);
//perform select statement
$sql = "SELECT DISTINCT CONCAT(s.NameF, ' ', s.NameL) AS StudentName, c.Title AS Title, c.Credit_Hours AS Credit_Hours, ROUND(sem.GPA, 2) AS GPA FROM Student AS s, Semester AS sem, Course AS c, Course_Section AS cs WHERE s.StudentID = sem.StudentID AND cs.SectionID = sem.SectionID AND sem.Letter_Grade <> 'F' AND s.StudentID = ".$sanid." AND cs.CourseNum = c.CourseNum GROUP BY Title UNION ALL SELECT 'Total', '', SUM(t.Credit_Hours) AS Total_Credit_Hour, ROUND(SUM(t.GPA)/COUNT(t.Title), 2) AS Average_GPA FROM(SELECT DISTINCT CONCAT(s.NameF, ' ', s.NameL) AS StudentName, c.Title AS Title, c.Credit_Hours AS Credit_Hours, ROUND(sem.GPA, 2) AS GPA FROM Student AS s, Semester AS sem, Course AS c, Course_Section AS cs WHERE s.StudentID = sem.StudentID AND cs.SectionID = sem.SectionID AND sem.Letter_Grade <> 'F' AND s.StudentID = ".$sanid." AND cs.CourseNum = c.CourseNum GROUP BY Title) AS t;";

//get results and print table
$result=mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
	//output data of each row
	echo "<table border='1'><tr><th>Student Name</th><th>Course Title</th><th>Credit Hours</th><th>GPA</th></tr>";
	while($row = mysqli_fetch_assoc($result)) {
		echo "<tr><td>" .$row['StudentName']. "</td><td>" .$row['Title']. "</td><td>" .$row['Credit_Hours']. "</td><td>" .$row['GPA']. "</td></tr>";
	}
	echo "</table>";
} else {
	echo "0 results";
}
mysqli_close($con);
?>