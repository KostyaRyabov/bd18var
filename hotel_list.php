<html>
  <head>
    <title>Report Window</title>
  </head>
  <body><link rel="stylesheet" type="text/css" href="../styles/stls.css">
  <H1 align = "center">ОТЧЕТ</H1>

<?php  
  require_once('connect.php'); 
  
   session_start();
   
   mysqli_set_charset($Connect, 'utf8');
  
  if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  //echo "<form action=\"index.php\"><input style=\"position: absolute;top:1;right: 1\" type=\"submit\" value = \"назад\"></form>";

  $result = mysqli_query($Connect, "SELECT `гостиница` FROM hotel");
  
  if (!$result) exit("Ошибка выполнения запроса ".mysqli_error($Connect)."??????");
  
  $nrows=mysqli_num_rows($result);
  
  echo "<table align = \"center\">
  <tr style=\"background-color: gray\">
  <th>№</td>
  <th>Гостиница</th>
  </tr>";
  for ($i=0;$i<$nrows; $i++) {
$assoc=mysqli_fetch_assoc($result);
  if ($i % 2 == 0) $style = "style=\"background-color: silver\"";
  else $style = "style=\"background-color: #dddadd\"";
  
  echo
  "<tr ".$style.">
  <td>".($i + 1)."</td>
  <td>".$assoc['гостиница']."</td></tr>";
  }
?>

</body>
</html>  
  
  
