<html> <head>
<title>First PHP Example</title> </head>
<body>
  <?php echo "<h1>TESTNIG FROM index.php</h1>";

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

  // basic query for testing
  $query = "SELECT * from Professor";
  // reaches out to the db and makes the query and returns the result in $result
  $result = mysql_query($query, $link);

  // while there are arrays to be read print them
  while($row = mysql_fetch_array($result)) {
      echo $row["SSN"]."<br>";
  }

  // closes the link between the variable and the server
  mysql_close($link);

  ?>

<!-- <script language="PHP">
echo "\n<b>More PHP Output</b><br />\n";
</script> -->

</body>
</html>
