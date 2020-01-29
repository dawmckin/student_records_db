<?php
$con=mysqli_connect("db.soic.indiana.edu", "i308f17_team93", "my+sql=i308f17_team93", "i308f17_team93");
//Check Connection
if (mysqli_connect_errno())
{echo nl2br("Failed to connect to MySQL:" . mysqli_connect_error() . "\n");}
else
{echo nl2br("Established Database Connection \n");}

//escape variables for security
$sancid = mysqli_real_escape_string($con, $_POST['class']);
//perform select statement
$sql = "SELECT CONCAT(f.NameF, ' ',f.NameL) AS Faculty_Name
FROM Faculty AS f, Section AS s
WHERE s.FacultyID = f.FacultyID
    AND s.CourseNum = '".$sancid."'
GROUP BY Faculty_Name;";

//get results and print table
$result=mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
	//output data of each row
	echo "<table border='1'><tr><th>Faculty Name</th></tr>";
	while($row = mysqli_fetch_assoc($result)) {
		echo "<tr><td>" .$row['Faculty_Name']. "</td></tr>";
	}
	echo "</table>";
} else {
	echo "0 results";
}
mysqli_close($con);
?>