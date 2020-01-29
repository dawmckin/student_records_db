--Caleb Heidorn
--Dalton McKinney
--Cyan Chen
--Josh Samakow

--//////////////////////////////1b////////////////////////////////
(SELECT s.NameF, s.NameL, sem.GPA AS GPA 
FROM Student AS s, Semester AS sem 
WHERE s.StudentID = sem.StudentID 
    AND sem.SectionID = 1 
GROUP by s.NameL
ORDER BY s.NameL, s.NameF
)
UNION ALL
(
SELECT 'Average GPA', '', AVG(sem.GPA) as Average_GPA
FROM Student AS s, Semester as sem
WHERE s.StudentID = sem.StudentID 
    AND sem.SectionID = 1
) ;


--///////////////////////////////3a/////////////////////////////
SELECT CONCAT(f.NameF, " ", f.NameL) AS FacultyName, c.Title, COUNT(*) AS Count
FROM Faculty AS f, Semester AS sem, Section AS s, Course AS c
WHERE f.FacultyID = sem.FacultyID
    AND sem.SectionID = s.SectionID
    AND s.CourseNum = c.CourseNum 
GROUP BY FacultyName, c.Title;

--/////////////////////////5c//////////////////////////////
SELECT DISTINCT CONCAT(s.NameF, " ", s.NameL) AS StudentName, c.Title AS Title, c.Credit_Hours AS Credit_Hours, ROUND(sem.GPA, 2) AS GPA
FROM Student AS s, Semester AS sem, Course AS c, Course_Section AS cs
WHERE s.StudentID = sem.StudentID
AND cs.SectionID = sem.SectionID
AND sem.Letter_Grade <> "F"
AND s.StudentID = 5
AND cs.CourseNum = c.CourseNum
GROUP BY Title

UNION ALL

SELECT 'Total', '', SUM(t.Credit_Hours) AS Total_Credit_Hour, ROUND(SUM(t.GPA)/COUNT(t.Title), 2) AS Average_GPA
FROM(SELECT DISTINCT CONCAT(s.NameF, " ", s.NameL) AS StudentName, c.Title AS Title, c.Credit_Hours AS Credit_Hours, ROUND(sem.GPA, 2) AS GPA
FROM Student AS s, Semester AS sem, Course AS c, Course_Section AS cs
WHERE s.StudentID = sem.StudentID
AND cs.SectionID = sem.SectionID
AND sem.Letter_Grade <> "F"
AND s.StudentID = 5
AND cs.CourseNum = c.CourseNum
GROUP BY Title) AS t;

--/////////////////////////6c//////////////////////////////
SELECT CONCAT(f.NameF, " ", f.NameL) AS People_in_building1_FALL2017, "Faculty" AS Status
FROM Faculty AS f, Room AS r, Semester AS sem
WHERE r.BuildingID = 1
    AND sem.Year = 2017
    AND sem.Term = "Fall"
    AND f.RoomID = r.RoomID
    AND sem.FacultyID = f.FacultyID
GROUP BY People_in_building1_FALL2017

UNION

SELECT CONCAT(s.NameF, " ", s.NameL) AS StudentName, 'Student'
FROM Student AS s, Room AS r, Semester AS sem
WHERE r.BuildingID = 1
    AND sem.Year = 2017
    AND sem.Term = "Fall"
    AND sem.RoomID = r.RoomID
    AND sem.StudentID = s.StudentID
GROUP BY StudentName

UNION

SELECT CONCAT(a.NameF, " ", a.NameL) AS AdvisorName, 'Advisor'
FROM Room AS r, Semester AS sem, Advisor AS a
WHERE r.BuildingID = 1
    AND sem.Year = 2017
    AND sem.Term = "Fall"
    AND a.RoomID = r.RoomID
GROUP BY AdvisorName;

--/////////////////////////9a//////////////////////////////
SELECT m.Name AS Major, d.Name AS Department, m.Required_CreditHour, m.Required_OverallGPA
FROM Major AS m, Department AS d, Department_Major AS dm, Course AS c
WHERE dm.DeptID = d.DeptID
    AND dm.MajorID = m.MajorID
GROUP BY Major;

------------------------------------------------------------------------------------------------------
--(ADDITIONAL)What building each faculty member has an office in 

SELECT CONCAT(f.NameF, " ", f.NameL) AS Faculty_Member, b.Name AS Building
FROM Faculty AS f, Room AS r, Building AS b
WHERE f.RoomID = r.RoomID
    AND r.BuildingID = b.BuildingID;

--(ADDITIONAL)Show all faculty that have taught a specific class

SELECT CONCAT(f.NameF, " ",f.NameL) AS Faculty_Name
FROM Faculty AS f, Section AS s
WHERE s.FacultyID = f.FacultyID
    AND s.CourseNum = 'INFO-I 308'
GROUP BY Faculty_Name;
