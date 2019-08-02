<?php
 require_once('connect.php'); 
  
   session_start();
   
   mysqli_set_charset($Connect, 'utf8');
  
  if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

 if (isset($_POST['LIMIT'])) $LIMIT = $_POST['LIMIT'];
  else $LIMIT = 25;
?>

<html>
  <head>
    <title>Report Window</title>
  </head>
  <body><link rel="stylesheet" type="text/css" href="../styles/stls.css">
  <H1>ОТЧЕТ (LITE)</H1>

  <form action="answer.php" method="post" style="margin-left:40%; text-align: center;width: 20%;">
     LIMIT: <input onchange="form.submit()" type="number" name="LIMIT" value = <?php if (isset($_POST['LIMIT'])) echo htmlspecialchars($_POST['LIMIT']); else echo $LIMIT;?> >
  </form>

<?php  
$sql="SELECT * FROM city, lists, person, sport WHERE lists.id_person = person.id_person && person.id_city = city.id_city && person.id_sport = sport.id_sport ORDER BY `фамилия` ASC LIMIT ".$LIMIT;
  $result=mysqli_query($Connect, $sql);
  
  if (!$result) exit("Ошибка выполнения запроса ".mysqli_error($Connect)."??????");
  
  $nrows=mysqli_num_rows($result);
  echo "<table align = \"center\">
  <tr style=\"background-color: gray\">
  <th>№</td>
  <th>Фамилия</th>
  <th>Имя</th>
  <th>Отчество</th>
  <th>Пол</th>
  <th>Возрастная группа</th>
  <th>Город</th>
  <th>Вид спорта</th>
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
  <td>".$assoc['пол']."</td>
  <td>".$assoc['Возрастная группа']."</td>
  <td>".$assoc['город']."</td>
  <td>".$assoc['вид спорта']."</td></tr>";
  
  }
  echo "</table>";
?>

</body>
</html>  
  
  
