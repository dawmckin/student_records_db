<?php
$conn=mysqli_connect("db.soic.indiana.edu", "i308f17_team93", "my+sql=i308f17_team93", "i308f17_team93");

if (mysqli_connect_error())
    {echo nl2br("Failed to connect to MySQL: " . mysqli_connect_error(). "\n");}
else
    {echo nl2br("Established Database Connection \n");}

$sanbid = mysqli_real_escape_string($conn, $_POST['building']);
$sanyear = mysqli_real_escape_string($conn, $_POST['year']);
$santerm = mysqli_real_escape_string($conn, $_POST['term']);

$sql_select = "SELECT CONCAT(f.NameF, ' ', f.NameL) AS People_in_building, 'Faculty' AS Status
FROM Faculty AS f, Room AS r, Semester AS sem
WHERE r.BuildingID = ".$sanbid."
	AND sem.Year = ".$sanyear."
	AND sem.Term = '".$santerm."'
	AND f.RoomID = r.RoomID
	AND sem.FacultyID = f.FacultyID
GROUP BY People_in_building

UNION

SELECT CONCAT(s.NameF, ' ', s.NameL) AS StudentName, 'Student'
FROM Student AS s, Room AS r, Semester AS sem
WHERE r.BuildingID = ".$sanbid."
	AND sem.Year = ".$sanyear."
	AND sem.Term = '".$santerm."'
	AND sem.RoomID = r.RoomID
	AND sem.StudentID = s.StudentID
GROUP BY StudentName

UNION

SELECT CONCAT(a.NameF, ' ', a.NameL) AS AdvisorName, 'Advisor'
FROM Room AS r, Semester AS sem, Advisor AS a
WHERE r.BuildingID = ".$sanbid."
	AND sem.Year = ".$sanyear."
	AND sem.Term = '".$santerm."'
	AND a.RoomID = r.RoomID
GROUP BY AdvisorName;";
$result = mysqli_query($conn, $sql_select);

echo "<table border='1'>
		<tr>
			<th>People_in_building</th>
			<th>Status</th>
		</tr>";
			
if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		echo "<tr>
					<td>" . $row["People_in_building"]. "</td>
					<td>" . $row["Status"]. "</td>
			 </tr>";
		}
	echo "</table>";
} else {
    echo "0 results";
}
mysqli_close($conn);
?> 