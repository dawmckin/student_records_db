<?php
$conn=mysqli_connect("db.soic.indiana.edu", "i308f17_team93", "my+sql=i308f17_team93", "i308f17_team93");

if (mysqli_connect_error())
    {echo nl2br("Failed to connect to MySQL: " . mysqli_connect_error(). "\n");}
else
    {echo nl2br("Established Database Connection \n");}

$sql_select = "SELECT m.Name AS Major, d.Name AS Department, m.Required_CreditHour AS Required_CreditHour, m.Required_OverallGPA AS Required_OverallGPA
FROM Major AS m, Department AS d, Department_Major AS dm, Course AS c
WHERE dm.DeptID = d.DeptID
	AND dm.MajorID = m.MajorID
GROUP BY Major;";
$result = mysqli_query($conn, $sql_select);

echo "<table border='1'>
		<tr>
			<th>Major</th>
			<th>Department</th>
			<th>Required Credit Hour</th>
			<th>Required Overall GPA</th>
		</tr>";
			
if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		echo "<tr>
					<td>" . $row["Major"]. "</td>
					<td>" . $row["Department"]. "</td>
					<td>" . $row["Required_CreditHour"]. "</td>
					<td>" . $row["Required_OverallGPA"]. "</td>
			 </tr>";
		}
	echo "</table>";
} else {
    echo "0 results";
}
mysqli_close($conn);
?> 