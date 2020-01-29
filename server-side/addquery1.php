<?php
$con=mysqli_connect("db.soic.indiana.edu", "i308f17_team93", "my+sql=i308f17_team93", "i308f17_team93");
//Check Connection
if (mysqli_connect_errno())
{echo nl2br("Failed to connect to MySQL:" . mysqli_connect_error() . "\n");}
else
{echo nl2br("Established Database Connection \n");}

//perform select statement
$sql = "SELECT CONCAT(f.NameF, ' ', f.NameL) AS Faculty_Member, b.Name AS Building
FROM Faculty AS f, Room AS r, Building AS b
WHERE f.RoomID = r.RoomID
    AND r.BuildingID = b.BuildingID;";

//get results and print table
$result=mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
	//output data of each row
	echo "<table border='1'><tr><th>Faculty Member</th><th>Building</th></tr>";
	while($row = mysqli_fetch_assoc($result)) {
		echo "<tr><td>" .$row['Faculty_Member']. "</td><td>" .$row['Building']. "</td></tr>";
	}
	echo "</table>";
} else {
	echo "0 results";
}
mysqli_close($con);
?>