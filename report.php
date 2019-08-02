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

  $result = mysqli_query($Connect, "SELECT COUNT(DISTINCT `вид спорта`) AS `count` FROM sport, person, lists WHERE lists.id_person = person.id_person && sport.id_sport = person.id_sport");
        $assoc=mysqli_fetch_assoc($result);
        $ntabs = $assoc['count'];

  $sss = mysqli_query($Connect, "SELECT `вид спорта`, COUNT(`вид спорта`) AS `count` FROM sport, person, lists WHERE lists.id_person = person.id_person && sport.id_sport = person.id_sport GROUP BY `вид спорта`");

  for ($j=0;$j<$ntabs; $j++) {
    $assoc=mysqli_fetch_assoc($sss);
    $num = $assoc['count'];
    echo "<H3>".$assoc['вид спорта']."</H3>";


$sql="SELECT * FROM city, lists, person, sport WHERE lists.id_person = person.id_person && person.id_city = city.id_city && person.id_sport = sport.id_sport && sport.`вид спорта` = '".$assoc['вид спорта']."' ORDER BY person.`фамилия` asc, person.`имя` asc, person.`отчество` asc";
  $result=mysqli_query($Connect, $sql);
  
  if (!$result) exit("Ошибка выполнения запроса ".mysqli_error($Connect)."??????");
  
  $nrows=mysqli_num_rows($result);
  echo "<table align = \"center\">
  <tr style=\"background-color: gray\">
  <th>№</td>
  <th>Фамилия</th>
  <th>Имя</th>
  <th>Отчество</th>
  <th>Возрастная группа</th>
  <th>Город</th>
  </tr>";
  for ($i=0;$i<$nrows; $i++) {
$assoc=mysqli_fetch_assoc($result);
  $style = "style=\"background-color: silver\"";
  
  if ($i % 2 == 0) $style = "style=\"background-color: silver\"";
  else $style = "style=\"background-color: #dddadd\"";
  
  
  
  echo
  "<tr ".$style.">
  <td>".($i + 1)."</td>
  <td>".$assoc['Фамилия']."</td>
  <td>".$assoc['Имя']."</td>
  <td>".$assoc['Отчество']."</td>
  <td>".$assoc['Возрастная группа']."</td>
  <td>".$assoc['город']."</td></tr>";
  }
  echo "</table><H4> { ".$num." } </H4><br><br>";
  }
?>

</body>
</html>  
  
  
