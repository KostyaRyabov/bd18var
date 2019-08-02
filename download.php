<?php
  require_once('connect.php'); 
  
   session_start();
  
  mysqli_set_charset($Connect, 'utf8');
  
  if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  $fp = fopen("./docs/list.txt","w+");
  
  fputs($fp, "                                ОТЧЕТ". PHP_EOL);
  
  $result = mysqli_query($Connect, "SELECT COUNT(DISTINCT `вид спорта`) AS `count` FROM sport, person, lists WHERE lists.id_person = person.id_person && sport.id_sport = person.id_sport");
        $assoc=mysqli_fetch_assoc($result);
        $ntabs = $assoc['count'];

  $sss = mysqli_query($Connect, "SELECT `вид спорта`, COUNT(`вид спорта`) AS `count` FROM sport, person, lists WHERE lists.id_person = person.id_person && sport.id_sport = person.id_sport GROUP BY `вид спорта`");
  
  for ($j=0;$j<$ntabs; $j++) {
    $assoc=mysqli_fetch_assoc($sss);
    $num = $assoc['count'];
    fputs($fp, PHP_EOL.PHP_EOL.PHP_EOL."-------------------------------".$assoc['вид спорта']."-------------------------------". PHP_EOL);
  
    $sql="SELECT * FROM city, lists, person, sport WHERE lists.id_person = person.id_person && person.id_city = city.id_city && person.id_sport = sport.id_sport && sport.`вид спорта` = '".$assoc['вид спорта']."' ORDER BY person.`фамилия` asc, person.`имя` asc, person.`отчество` asc";
  $result=mysqli_query($Connect, $sql);
  
  if (!$result) exit("Ошибка выполнения запроса ".mysqli_error($Connect)."??????");
  
  $nrows=mysqli_num_rows($result);
  
    for ($i = 0; $i < $nrows; $i++){
      $assoc=mysqli_fetch_assoc($result);
      fputs($fp,"[".($i + 1)."] ".$assoc['Фамилия']." ".$assoc['Имя']." ".$assoc['Отчество']." | ".$assoc['пол']." | ".$assoc['Возрастная группа']." | ".$assoc['город']." | ".$assoc['вид спорта']. PHP_EOL); 
    }
    fputs($fp, "-------------------------------".$num."-------------------------------". PHP_EOL);
  }
  
  fclose($fp);
  
  header('Content-type: application/txt');
  header('Content-Disposition: attachment; filename="list.txt"');
  readfile('./docs/list.txt');
?>