<html> <head>
<title>First PHP Example</title> </head>
<body>
  <?php echo "<h1>TESTING FROM index.php</h1>";

  // connects to the database and makes a link
  $link = mysql_connect('ecs.fullerton.edu', 'cs332t19', 'au0ieLah');

  // checks to see if the connection was made successfully. if not it closes
  if (!$link)
  {
    die('Could not connect to shell.ecs.fullerton.edu');
  }
  echo "<div>console.log(Connected to server successfully);</div>";

  // selects the db and checks to make sure it was successfully connected
  if(!mysql_select_db("cs332t19",$link))
  {
    die("Unable to select database \'cs332t19\'");
  }
  echo "<p>console.log(Connected to database successfully);</p>";

  // ===== PROFESSOR A =====
  // Given the social security number of a professor, list the titles, classrooms, meeting
  // days and time of his/her classes.
  /*
  int inputSSN;       // this holds the professor's SSN that was received from the user

  SELECT PTitle, Classroom, MeetingDays, BeginTime, EndTime
  FROM Sections S, MeetingDays MD, Professor P
  WHERE S.ProfSSN = inputSSN AND
        S.CourseNum = MD.CourseNumber AND
        S.SNumber = MD.SectionNumber AND
        S.ProfSSN = P.SSN;
  */

  // ===== PROFESSOR B =====
  // Given a course number and a section number, count how many students get each
  // distinct grade, i.e. 'A', 'A-', 'B+', 'B', 'B-', etc.
  /*
  int inputCNum;      // this holds the inputted course number from the user
  int inputSNum;      // this holds the inputted section number from the user

  SELECT Grade, COUNT(*)
  FROM EnrollmentRecord ER
  WHERE ER.SectionNum = inputSNum AND
        ER.CNum = inputCNum
  GROUP BY Grade;
  */

  // ===== STUDENT A =====
  // Given a course number list the sections of the course, including the classrooms, the
  // meeting days and time, and the number of students enrolled in each section.
  /*
  int inputCNum;      // this holds the inputted course number from the user

  SELECT CTitle, Classroom, MeetingDays, BeginTime, EndTime, COUNT(*)
  FROM Sections S, Course C, MeetingDays MD, EnrollmentRecord ER
  WHERE S.CourseNum = inputCNum AND
        S.CourseNum = Course.CNumber AND
        MD.CourseNumber = S.CourseNum AND
        MD.SectionNumber = S.SNumber AND
        ER.SectionNum = S.CourseNum AND
        ER.CNum = S.SNumber
  GROUP BY S.SNumber;
  */

  // ===== STUDENT B =====
  // Given the campus wide ID of a student, list all the courses the student took and
  // the grades.
  /*
  int inputCWID;      // this holds the inputted CWID from the user\

  SELECT C.CTitle, ER.Grade
  FROM Course C, EnrollmentRecord ER
  WHERE ER.StudCWID = inputCWID AND
        ER.Cnum = C.CNumber;
  */

  // basic query for testing
  // $query = "SELECT * from Professor";

  // makes a query based on the daat given
  $query = "SELECT * from Professor WHERE Professor.SSN=" . htmlspecialchars($_GET["search1"]);
  echo $query."<br><br>";

  // reaches out to the db and makes the query and returns the result in $result
  $result = mysql_query($query, $link);

  // while there are arrays to be read print them
  echo "SSN      PName      PAddress          PTeleNum   Sex   PTitle    Salary   <br>";
  while($row = mysql_fetch_array($result)) {
      echo $row["SSN"].$row["PName"].$row["PAddress"].$row["PTeleNum"].$row["Sex"].$row["PTitle"].$row["Salary"]."<br>";
  }
  echo "<br><br>";

  // a test to output data from the form to the php scriting site
  echo $_GET["search1"];
  echo "<br><br>";
  echo $_GET["search2"];

  // closes the link between the variable and the server
  mysql_close($link);

  ?>

<!-- <script language="PHP">
echo "\n<b>More PHP Output</b><br />\n";
</script> -->

</body>
</html>
