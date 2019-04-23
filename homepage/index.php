<html> <head>
<title>First PHP Example</title> </head>
<body>
  <?php echo "<h1>TESTNIG FROM index.php</h1>";

  // connects to the database and makes a link
  $link = mysql_connect('shell.ecs.fullerton.edu', 'cs332t19', 'au0ieLah');

  // checks to see if the connection was made successfully. if not it closes
  if (!$link)
  {
    die('Could not connect: '.mysql_error());
  }
  echo "console.log(Connected successfully);";

  // selects the db and checks to make sure it was successfully connected
  if(!mysql_select_db("cs332t19",$link))
  {
    die("Unable to select database \'cs332t19\'");
  }


  mysql_close($link);

  ?>
<script language="PHP">
echo "\n<b>More PHP Output</b><br />\n";
</script>
</body> </html>
