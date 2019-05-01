<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>School Database Simulation</title> </head>

	<!-- Links to external style and helper functions -->
	<script src="assets/helper-functions.js"></script>
	<link rel="stylesheet" href="assets/styles.css">
</head>

<body>
	<script src="assets/helper-functions.js"></script>

	<title>Databases</title>

	<div id="Header"></div>

	<div id="Main">
	<header>Results</header>
    <!-- use the php tag to integrate php into your code -->
    <img src="https://i.ibb.co/6XMfjTd/header-underline.png">
	  <br><br>
    <?php

    // connects to the database and makes a link
    $link = mysql_connect('ecs.fullerton.edu', 'cs332t19', 'au0ieLah');

    // checks to see if the connection was made successfully. if not it closes
    if (!$link)
    {
      die('Could not connect to shell.ecs.fullerton.edu');
    }

    // selects the db and checks to make sure it was successfully connected
    if(!mysql_select_db("cs332t19",$link))
    {
      die("Unable to select database \'cs332t19\'");
    }

    // makes a query based on the daat given and prepopulate the table headers
		// use $_GET[<VALUE NAME>] to get GET request from the browser like a dictionary
    $query = "";
    $tableHeaders = "";
    $dataLoop = array();
    if ($_GET["userType"] == "Professor" && $_GET["searchType"] == "questionA")
    {
      $query = "SELECT PName, PTitle, Classroom, MeetingDays, BeginTime, EndTime
                FROM Sections S, MeetingDays MD, Professor P
                WHERE S.ProfSSN = ".$_GET["search1"].
								" AND S.CourseNum = MD.CourseNumber AND
                S.SNumber = MD.SectionNumber AND
                S.ProfSSN = P.SSN";

      $tableHeaders = "<table id ='OutputTable'>
                        <tr>
                          <th>Name</th>
                          <th>Title</th>
                          <th>Classroom</th>
                          <th>Meeting Days</th>
                          <th>Begin Time</th>
                          <th>End Time</th>
                        </tr>";

      $dataLoop = array("PName", "PTitle", "Classroom", "MeetingDays", "BeginTime", "EndTime");
    }
    elseif ($_GET["userType"] == "Professor" && $_GET["searchType"] == "questionB")
    {
      $query = "SELECT Grade, COUNT(*) as total
                FROM EnrollmentRecord ER
                WHERE  ER.CNum= ".$_GET["search1"]." AND
                   		ER.SectionNum = ".$_GET["search2"].
                " GROUP BY Grade";

      $tableHeaders = "<table id ='OutputTable'>
                        <tr>
                          <th>Grade</th>
                          <th>Count</th>
                        </tr>";

      $dataLoop = array("Grade", "total");
    }
    elseif ($_GET["userType"] == "Student" && $_GET["searchType"] == "questionA")
    {
      $query = "SELECT CTitle, Classroom, MeetingDays, BeginTime, EndTime, COUNT(*) as total
                FROM Sections S, Course C, MeetingDays MD, EnrollmentRecord ER
                WHERE S.CourseNum = ".$_GET["search1"]." AND
                  S.CourseNum = C.CNumber AND
                  MD.CourseNumber = S.CourseNum AND
                  MD.SectionNumber = S.SNumber AND
                  ER.SectionNum = S.SNumber AND
                  ER.CNum = S.CourseNum
                GROUP BY CTitle, Classroom, MeetingDays, BeginTime, EndTime";

      $tableHeaders = "<table id ='OutputTable'>
                        <tr>
                          <th>Course Title</th>
                          <th>Classroom</th>
                          <th>Meeting Days</th>
                          <th>Begin Time</th>
                          <th>End Time</th>
                          <th>Number of Students Enrolled</th>
                        </tr>";

      $dataLoop = array("CTitle", "Classroom", "MeetingDays", "BeginTime", "EndTime", "total");
    }
    else
    {
      $query = "SELECT C.CTitle, ER.Grade
                FROM Course C, EnrollmentRecord ER
                WHERE ER.StudCWID = ".$_GET["search1"]." AND
                  ER.CNum = C.CNumber";

      $tableHeaders = "<table id ='OutputTable'>
                        <tr>
                          <th>Course Title</th>
                          <th>Grade</th>
                        </tr>";

      $dataLoop = array("CTitle", "Grade");
    }

		// temp echo to make sure that the right query is being sent
    // echo $query."<br><br>";

    // reaches out to the db and makes the query and returns the result in $result
    $result = mysql_query($query, $link);

    // starts the table off
    echo $tableHeaders;

    // while there are arrays to be read print them
    while($row = mysql_fetch_array($result))
    {
      echo "<tr>";

      // prints out all the items based on the predefined items
      for ($i = 0; $i < count($dataLoop); ++$i)
      {
        echo "<td>".$row[$dataLoop[$i]]."</td>";
      }

      echo "</tr>";
    }

    // closes off the table header
    echo "</table>";

    // closes the link between the variable and the server
    mysql_close($link);

    ?>
  </div>

	<div id="Nav">
	<header>Search</header>
  <img src="https://i.ibb.co/2KjgxGV/search-underline.png">
	<br><br>

	<!-- Drop down list that can be selected for the user type -->
	<select id="userType" onchange="updateSearchType()">
		<option value="Professor">Professor</option>
		<option value="Student">Student</option>
	</select>
	<br><br>

	<!-- Drop down list that can be selected for the search type -->
	<select id="searchType" onchange="updateFormOptions()">
		<option value="questionA">Social Security Number</option>
		<option value="questionB">Course Number</option>
	</select>
	<br><br>

	<!-- Search form -->
  <form id="searchForm" action="http://ecs.fullerton.edu/~cs332t19/index.php" method="GET">
    <input type="submit" value="Search">
    <br><br>
		<!-- Serach fields for the user to enter in their data -->
    <text id="search1Text">Social Security Number</text><input id="searchField1" type="text" name="search1" placeholder="123456789"><br>
    <text id="search2Text"></text>
		<!-- these are my hacky way of sending more data into the GET request -->
    <input id="searchFieldHidden1" type="hidden" name="userType" value="Professor"><br>
    <input id="searchFieldHidden2" type="hidden" name="searchType" value="questionA"><br>
  </form>

	</div>
</body>
</html>
