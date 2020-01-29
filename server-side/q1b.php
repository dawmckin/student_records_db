<?php
$con=mysqli_connect("db.soic.indiana.edu", "i308f17_team93", "my+sql=i308f17_team93", "i308f17_team93");
//Check Connection
if (mysqli_connect_errno())
{echo nl2br("Failed to connect to MySQL:" . mysqli_connect_error() . "\n");}
else
{echo nl2br("Established Database Connection \n");}

//escape variables for security
$sanid = mysqli_real_escape_string($con, $_POST['section']);
//perform select statement
$sql = "(SELECT s.NameF, s.NameL, sem.GPA AS GPA 
FROM Student AS s, Semester AS sem 
WHERE s.StudentID = sem.StudentID 
    AND sem.SectionID = ".$sanid."
GROUP by s.NameL
ORDER BY s.NameL, s.NameF
)
UNION ALL
(
SELECT 'Average GPA', '', AVG(sem.GPA) as Average_GPA
FROM Student AS s, Semester as sem
WHERE s.StudentID = sem.StudentID 
    AND sem.SectionID = ".$sanid."
);";

//get results and print table
$result=mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
	//output data of each row
	echo "<table border='1'><tr><th>First Name</th><th>Last Name</th><th>Average GPA</th></tr>";
	while($row = mysqli_fetch_assoc($result)) {
		echo "<tr><td>" .$row['NameF']. "</td><td>" .$row['NameL']. "</td><td>" .$row['GPA']. "</td></tr>";
	}
	echo "</table>";
} else {
	echo "0 results";
}
mysqli_close($con);
?>