<?php
  require_once('connect.php'); 
  
   session_start();
  
  
  mysqli_set_charset($Connect, 'utf8');
  
  if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $getRes = 0;
  
  $id_person = -1;
  
  if (isset($_POST['LIMIT'])) {
      if ($_POST['LIMIT'] < 0){ $LIMIT = 0; $_POST['LIMIT'] = 0;}
      else $LIMIT = $_POST['LIMIT'];
  }
  else $LIMIT = 25;
  
  if (isset($_POST["sortFamil"])){
     if (isset($_SESSION['io'])){
        if ($_SESSION['io'] == '⇧'){
            $_SESSION['io1'] = 'sort';
            $_SESSION['io2'] = 'sort';
            $_SESSION['io'] = '⇩';
        }
        else{
          $_SESSION['io1'] = 'sort';
          $_SESSION['io2'] = 'sort';
          $_SESSION['io'] = '⇧';
        }      
     }  
  }
  
  if (isset($_POST["sortVozr"])){
     if (isset($_SESSION['io1'])){
        if ($_SESSION['io1'] == '⇧'){
            $_SESSION['io'] = 'sort';
            $_SESSION['io2'] = 'sort';
            $_SESSION['io1'] = '⇩';
        }
        else{
          $_SESSION['io'] = 'sort';
          $_SESSION['io2'] = 'sort';
          $_SESSION['io1'] = '⇧';
        }      
     } 
  }
  
  if (isset($_POST["sortSport"])){
     if (isset($_SESSION['io2'])){
        if ($_SESSION['io2'] == '⇧'){
            $_SESSION['io'] = 'sort';
            $_SESSION['io1'] = 'sort';
            $_SESSION['io2'] = '⇩';
        }
        else{
          $_SESSION['io1'] = 'sort';
          $_SESSION['io'] = 'sort';
          $_SESSION['io2'] = '⇧';
        }      
     } 
  }
    
  
  
  
  if (isset($_POST['delSEACH'])){
     unset($_POST['SEACH']);
     unset($_POST['delSEACH']);
  }
  
  if (isset($_POST['delSEACH1'])){
     unset($_POST['SEACH1']);
     unset($_POST['delSEACH1']);
  }
  
  if (isset($_POST['delSEACH2'])){
     unset($_POST['SEACH2']);
     unset($_POST['delSEACH2']);
  }
        
  if(isset($_GET['del'])){
    mysqli_query($Connect, "DELETE FROM lists WHERE id_person = '".$_GET['del']."'");
    
    unset($_POST['фамилия']);
    unset($_POST['имя']);
    unset($_POST['отчество']);
    unset($_POST['пол']);
    unset($_POST['возраст']);
    unset($_POST['город']);
    unset($_POST['sport']);
    unset($_POST['гостиница']);
    unset($_POST['номер']);
    
    unset($_POST['Add']);
    unset($_POST['reload']);
    
    unset($_SESSION['restart']);      
    unset($_GET['del']);
    
    unset($_SESSION['id_person']);
    
    header("Location: http://www.bd18var.com/index.php#J3");
  }
  
   
      
  if (isset($_POST['reload'])){
     
    unset($_POST['фамилия']);
    unset($_POST['имя']);
    unset($_POST['отчество']);
    unset($_POST['пол']);
    unset($_POST['возраст']);
    unset($_POST['город']);
    unset($_POST['sport']);
    unset($_POST['гостиница']);
    unset($_POST['номер']);
    
    unset($_POST['Add']);
    unset($_POST['reload']);
    
    unset($_SESSION['restart']);
    unset($_SESSION['id_person']);       
    unset($_GET['del']);    
  }
  
  if (isset($_SESSION['restart'])){
     
    unset($_POST['фамилия']);
    unset($_POST['имя']);
    unset($_POST['отчество']);
    unset($_POST['пол']);
    unset($_POST['возраст']);
    unset($_POST['город']);
    unset($_POST['sport']);
    unset($_POST['гостиница']);
    unset($_POST['номер']);
    
    unset($_POST['Add']);
    unset($_POST['reload']);
    
    unset($_SESSION['restart']);      
    unset($_GET['del']);
    header("Location: http://www.bd18var.com/index.php#J2");    
  }    
?>

<html>
  <head>
    <title>Main Window</title>
  </head><link rel="stylesheet" type="text/css" href="../styles/stls.css">
  <body>
  <H1>СПИСОК ВЕТЕРАНОВ СПОРТА</H1>
  <br>
  
  
  <form action="index.php" method="post" style="margin-left:30%; text-align: center;width: 40%">
    <br><div align = "center">
    <div class="poster"><font color="red"> * </font> - <img src="../photo/info.png" height=18>
    <div class="descr">
    обязательны для заполнения
    </div>
    </div>
    </div>
    <H3>АНКЕТА</H3>                                                                       
    
    фамилия: <input type="text" onchange="form.submit()" name="фамилия" value = <?php if (isset($_POST['фамилия'])){ if ($_POST['фамилия'] != ""){ $getRes++; echo htmlspecialchars($_POST['фамилия']).'><br>'; } else echo '""> <font color="red"> * </font><br>'; } else echo '""><font color="red"> * </font><br>';?>
    имя: <input type="text" onchange="form.submit()" name="имя" value = <?php if (isset($_POST['имя'])){ if ($_POST['имя'] != ""){ $getRes++; echo htmlspecialchars($_POST['имя']).'><br>'; } else echo '""> <font color="red"> * </font><br>'; } else echo '""><font color="red"> * </font><br>';?>
    отчество: <input type="text" onchange="form.submit()" name="отчество" value = <?php if (isset($_POST['отчество'])){ if ($_POST['отчество'] != ""){ $getRes++; echo htmlspecialchars($_POST['отчество']).'><br>'; } else echo '""> <font color="red"> * </font><br>'; } else echo '""><font color="red"> * </font><br>';?>
    пол: <input type="radio" <?php if (isset($_POST['пол'])){ if ($_POST['пол'] == "Муж"){$getRes++;  echo "CHECKED"; }} else echo"CHECKED";?> name="пол" value="Муж"> М
         <input type="radio" <?php if (isset($_POST['пол'])) if ($_POST['пол'] == "Жен"){$getRes++;  echo "CHECKED"; }?> name="пол" value="Жен"> Ж <br>
    возрастная группа: <input onchange="form.submit()" type="number" name="возраст" value = <?php if (isset($_POST['возраст'])){ if ($_POST['возраст'] > 0 && $_POST['возраст'] < 8){ $getRes++; echo htmlspecialchars($_POST['возраст'])."><br>";} else echo '""><font color="red"> * </font><br>'; } else echo '""><font color="red"> * </font><br>';?>
    город: <input type="text" name="город" onchange="form.submit()" value = <?php if (isset($_POST['город'])){ $getRes++; $row = mysqli_fetch_assoc(mysqli_query($Connect,"SELECT `город` FROM city WHERE `город` LIKE '%".$_POST['город']."%' LIMIT 1")); if ($row == NULL){echo '"'.htmlspecialchars($_POST['город']).'"'; }else echo '"'.$row['город'].'"';} else echo '"Не Определено"'; ?> ><div class="poster"></font><img src="../photo/info.png" height=18>
    <div class="descr">
    Автозаполнение. Если город отсуствует в БД, он будет добавлен после обработки анкеты по нажатии кнопки
    </div>
    </div><br>
    
    
    
     
    вид спорта: <select name="sport"  onchange="form.submit()"> 
      <?php
        $result=mysqli_query($Connect, "SELECT `вид спорта` FROM sport ORDER BY `вид спорта` ASC");
    
        if (!$result) exit("Ошибка выполнения запроса ".mysqli_error($Connect)."??????");
    
        $combo = "";
        $nrows=mysqli_num_rows($result);
    
        
        
        $sel = $_POST['sport'];
        
        for ($i=0;$i<$nrows; $i++)
        { 
          $assoc=mysqli_fetch_assoc($result);
          $trig = $assoc['вид спорта'];
          if (stristr($trig, $sel)) $combo .= "<option selected value = '".$trig."'>".$trig."</option>";
          else $combo .= "<option value = '".$trig."'>".$trig."</option>";
        }
    
        $combo .= "</select>";
    
        echo $combo;
      ?><br>
    гостиница: <select name="гостиница"  onchange="form.submit()"><br> 
    <?php
        
        $result=mysqli_query($Connect, "SELECT `гостиница` FROM hotel ORDER BY `гостиница` ASC");
    
        if (!$result) exit("Ошибка выполнения запроса ".mysqli_error($Connect)."??????");
    
        $combo = "";
        $nrows=mysqli_num_rows($result);
    
        $sel = $_POST['гостиница'];
        
        for ($i=0;$i<$nrows; $i++)
        { 
          $assoc=mysqli_fetch_assoc($result);
          $trig = $assoc['гостиница'];
          
          
          if (stristr($trig, $sel)) $combo .= "<option selected value = '".$trig."'>".$trig."</option>";
          else $combo .= "<option value = '".$trig."'>".$trig."</option>";
        }
    
        $combo .= "</select>";
         
        echo $combo."<br>";
        
        if (isset($_POST['гостиница']))
          $hotel =  $_POST['гостиница'];
        
        else{
          $assoc = mysqli_fetch_assoc(mysqli_query($Connect, "SELECT `гостиница` FROM hotel WHERE hotel.id_hotel = 1")); $hotel = $assoc['гостиница'];
        }
        echo "номер: "; 
        $result=mysqli_query($Connect, "SELECT `номер`, `кол-во мест`, room.id_room FROM room WHERE room.id_hotel = (SELECT id_hotel FROM hotel WHERE hotel.`гостиница` LIKE '%".$hotel."%' LIMIT 1) && !(room.id_room in (SELECT id_room FROM lists))");
    
        if (!$result) exit("Ошибка выполнения запроса ".mysqli_error($Connect)."??????");
        
        
        $nrows=mysqli_num_rows($result);
    
        if (isset($_POST['номер'])) $sel = $_POST['номер'];
        else $sel = "1";
    
        if ($nrows == 0) echo '<font color="red">Нет свободных!</font>';
        else{
            $getRes++;
            $combo = '<select name="номер" onchange="form.submit()">';
        for ($i=0;$i<$nrows; $i++)
        {
          $assoc=mysqli_fetch_assoc($result);
          $trig = $assoc['номер']; 
          if ($trig == $sel) $combo .= "<option selected value = '".$trig."'>".$trig." [".$assoc['кол-во мест']."]</option>";
          else $combo .= "<option value = '".$trig."'>".$trig." [".$assoc['кол-во мест']."]</option>";
        }
    
        $combo .= "</select>";
    
        echo $combo;
        };
      echo '<p><input type="submit" name = "reload" value="Отменить"></p>';
      
      if ($getRes >= 7){
        $row = mysqli_fetch_assoc(mysqli_query($Connect,"SELECT id_person FROM person WHERE `фамилия` = '".$_POST['фамилия']."' && `имя` = '".$_POST['имя']."' && `отчество` = '".$_POST['отчество']."' LIMIT 1"));         
      if ($row != NULL) {
         $id_person = $row['id_person'];                           
         echo "<p> Человек с таким именем уже есть в базе. Перезаписать данные? <input type=\"submit\" value = \"Править\" id = \"Add\" name = \"Add\">
         <div class=\"poster\"><img src=\"../photo/info.png\" height=18>
    <div class=\"descr\">
    Данные будут изменены в таблице person и занесены/обновлены в таблице lists
    </div>
    </div></p>";
          
    }else echo '<input type="submit" value = "Добавить" name = "Add">';
      } else {
        echo '<font color="red">Заполните все поля!</font>';
      }    
      
    echo '<br><br></form>';
   
   
       
      
      
      
  if (isset($_POST['Add'])){
    $_SESSION['restart'] = 1; 
       
      
    $row = mysqli_fetch_assoc(mysqli_query($Connect,"SELECT id_city,`город` FROM city WHERE `город` LIKE '%".$_POST['город']."%' LIMIT 1"));
      if ($row == NULL) {                                        
        $sql='INSERT INTO city (`id_city`, `город`) VALUES ("","'.htmlspecialchars($_POST['город']).'")';
        mysqli_query($Connect, $sql);
     }
     $row = mysqli_fetch_assoc(mysqli_query($Connect,"SELECT id_city FROM city WHERE `город` = '".$_POST['город']."' LIMIT 1"));
     $id_city = $row['id_city'];
     
     
     $row = mysqli_fetch_assoc(mysqli_query($Connect,"SELECT id_sport FROM sport WHERE `вид спорта` = '".$_POST['sport']."' LIMIT 1"));
     $id_sport = $row['id_sport'];
     
     $row = mysqli_fetch_assoc(mysqli_query($Connect,"SELECT id_hotel FROM hotel WHERE `гостиница` = '".$_POST['гостиница']."' LIMIT 1"));
     $id_hotel = $row['id_hotel'];
     
     $row = mysqli_fetch_assoc(mysqli_query($Connect,"SELECT id_room FROM room WHERE `номер` = '".$_POST['номер']."' && id_hotel = '".$id_hotel."' LIMIT 1"));
     $id_room = $row['id_room'];
                  
      
        
     
     
     
     
     
     if ($_POST['пол'] == "Муж"){
          $pol = "м";
      }else {
          $pol = "ж";
     }
       
      if ($id_person == -1) {
         // новый человек
        $sql='INSERT INTO person (`id_person`, `фамилия`, `имя`, `отчество`, `пол`, `возрастная группа`, `id_city`, `id_sport`) VALUES ("","'.$_POST['фамилия'].'","'.$_POST['имя'].'","'.$_POST['отчество'].'","'.$pol.'","'.$_POST['возраст'].'","'.$id_city.'","'.$id_sport.'")';
        mysqli_query($Connect, $sql);
         
         $row = mysqli_fetch_assoc(mysqli_query($Connect,"SELECT person.id_person FROM person WHERE `фамилия` = '".$_POST['фамилия']."' && `имя` = '".$_POST['имя']."' && `отчество` = '".$_POST['отчество']."' LIMIT 1"));
         $id_person = $row['id_person'];
                           
        $sql='INSERT INTO lists (`id_record`, `id_person`, `id_room`) VALUE ("",'.$id_person.','.$id_room.')';
       mysqli_query($Connect, $sql);
       
      
        
       }else{
             $sql="UPDATE person SET `Возрастная группа` = '".$_POST['возраст']."', `id_city` = '".$id_city."', `id_sport` = '".$id_sport."' WHERE id_person = '".$id_person."'  LIMIT 1 ";
             mysqli_query($Connect, $sql);
                                       
             $row = mysqli_fetch_assoc(mysqli_query($Connect,"SELECT lists.id_person FROM lists, person WHERE person.id_person = lists.id_person && person.id_person = '".$id_person."' LIMIT 1"));
             
                          
              if ($row['id_person'] == $id_person){
                  $sql="UPDATE lists SET id_room = '".$id_room."' WHERE id_person = '".$id_person."'";
              }else{
                 $sql='INSERT INTO lists (`id_record`, `id_person`, `id_room`) VALUE ("","'.$id_person.'","'.$id_room.'")';
              }
             
            mysqli_query($Connect, $sql);                        
       }
    
        
        $_SESSION['id_person'] = $id_person; 
    }
        
    
           
     
         
  
  
         
  
        
        $combo = "<table align = \"center\">
                  <tr style=\"background-color: gray\">
                  <th>вид спорта</td>
                  <th>число ветеранов</th>
                  </tr>";
        
        
        
        $result = mysqli_query($Connect, "SELECT COUNT(DISTINCT `вид спорта`) AS `count` FROM sport, person, lists WHERE lists.id_person = person.id_person && sport.id_sport = person.id_sport");
        $assoc=mysqli_fetch_assoc($result);
        $nrows = $assoc['count'];
        
        $result=mysqli_query($Connect, "SELECT `вид спорта` , COUNT(`вид спорта`) AS `count` FROM lists, person, sport WHERE lists.id_person = person.id_person && sport.id_sport = person.id_sport GROUP BY sport.id_sport");
                        
        for ($i=0;$i<$nrows; $i++)
        { 
          if ($i % 2 == 0) $style = "style=\"background-color: silver\"";
          else $style = "style=\"background-color: #dddadd\"";
          
          $assoc=mysqli_fetch_assoc($result);
          $combo .= "<tr ".$style."><td>".$assoc['вид спорта']."</td><td>".$assoc['count']."</td></tr>";
        }                          
      
        $combo .= "</table><br><br><input type=button value=\"Печать\" name=\"Print\" onclick=\"var my=window.open('report.php'); my.print();\">
        <div class=\"poster\"><img src=\"../photo/info.png\" height=18>
    <div class=\"descr\">
    Отправка отчета (список ветеранов, сгруппирированных по виду спорта [l=3.1]) на печать.
    </div>
    </div><br>
        
    <input type=\"button\" value=\" Скачать \" onClick='location.href=\"http://www.bd18var.com/download.php\"'><div class=\"poster\"><img src=\"../photo/info.png\" height=18>
    <div class=\"descr\">
    Отправка отчета (список ветеранов, сгруппирированных по виду спорта [l=3.1]) на скачивание в виде текстового документа.
    </div>
    </div><br><input type=\"button\" value=\" Доп запрос \" onClick=\"window.open('answer.php')\"'><div class=\"poster\"><img src=\"../photo/info.png\" height=18>
    <div class=\"descr\">
    отдельная страница со всем списком ветеранов спорта с возможностью выбора кол-ва отображаемых записей
    </div>
    </div><br>";
        
        echo $combo;
        
          
  
  
    $sql="SELECT * FROM city, hotel, lists, person, room, sport WHERE lists.id_person = person.id_person && person.id_city = city.id_city && person.id_sport = sport.id_sport && lists.id_room = room.id_room && room.id_hotel = hotel.id_hotel";
    
    echo "<br><br><form id=\"J3\" action=\"index.php#J1\" method=\"post\">
     <div  class=\"poster\"><img src=\"../photo/info.png\" height=18>
    <div class=\"descr\">
    Предусмотрен поиск по совпадениям подстрок в строках среди 'фамилий', 'городов' и 'видов спорта'. А также возможность сортировки по этим столбцам. Limit - показывает заданное число записей из БД с учетом сортировки и поиска. Кнопка \"Вывод списка спортсменов, сгруппированных по виду спорта\" - это задание из L3 - та же самая страница, что отправляется в качестве отчета на печать.
    </div></div><div align = \"center\">
    Поиск по городу: <input onchange=\"form.submit()\" type=\"text\" name=\"SEACH1\" value = ";
     
     if (isset($_POST['SEACH1']))
      {
        echo "'".$_POST['SEACH1']."'";
      
        if ($_POST['SEACH1'] != "") $sql .= " && person.id_city = (SELECT id_city FROM `city` WHERE `город` LIKE '%".$_POST['SEACH1']."%')";
      }
  
  echo "><input type=\"submit\" value=\"<=\" name = 'delSEACH1'>  Поиск по фамилии: <input onchange=\"form.submit()\" type=\"text\" name=\"SEACH\" value = ";
     
     if (isset($_POST['SEACH']))
      {
        echo "'".$_POST['SEACH']."'";
      
        if ($_POST['SEACH'] != "") $sql .= " && `фамилия` LIKE '%".$_POST['SEACH']."%'";
      }
   
   
    if (isset($_POST['sortFamil'])){
       if (isset($_SESSION['io'])){
          if ($_SESSION['io'] == '⇧'){
              $sql .= " ORDER BY `фамилия` ASC"; 
          }
          else{
              $sql .= " ORDER BY `фамилия` DESC";
          }
       }else{
          $_SESSION['io'] = '⇧';
          $sql .= " ORDER BY `фамилия` DESC"; 
       } 
     }
     
     if (isset($_POST['sortVozr'])){
       if (isset($_SESSION['io1'])){
          if ($_SESSION['io1'] == '⇧'){
              $sql .= " ORDER BY `возрастная группа` ASC"; 
          }
          else{
              $sql .= " ORDER BY `возрастная группа` DESC";
          }
       }else{
          $_SESSION['io1'] = '⇧';
          $sql .= " ORDER BY `возрастная группа` DESC"; 
       } 
     }
     
     if (isset($_POST['sortSport'])){
       if (isset($_SESSION['io2'])){
          if ($_SESSION['io2'] == '⇧'){
              $sql .= " ORDER BY `вид спорта` ASC"; 
          }
          else{
              $sql .= " ORDER BY `вид спорта` DESC";
          }
       }else{
          $_SESSION['io2'] = '⇧';
          $sql .= " ORDER BY `вид спорта` DESC"; 
       } 
     }
      
     if (!isset($_POST['sortFamil']) && !isset($_POST['sortVozr']) && !isset($_POST['sortSport'])){
        $_SESSION['io'] = '⇧';
        $_SESSION['io1'] = 'sort';
        $_SESSION['io2'] = 'sort';
        
        $sql .= " ORDER BY `фамилия` ASC";
     }
     
     echo "><input type=\"submit\" value=\"<=\" name = 'delSEACH'>   Поиск по виду спорта: <input onchange=\"form.submit()\" type=\"text\" name=\"SEACH2\" value = ";
     
     if (isset($_POST['SEACH2']))
      {
        echo "'".$_POST['SEACH2']."'";
      
        if ($_POST['SEACH2'] != "") $sql .= " && `вид спорта` LIKE '%".$_POST['SEACH2']."%'";
      }
      
      
      
  echo "><input type=\"submit\" value=\"<=\" name = 'delSEACH2'>   <br><input type=\"submit\" value=\"Вывод списка спортсменов, сгруппированных по виду спорта\" onClick=\"window.open('report.php')\"> <input type=\"submit\" value=\"Вывод списка гостиниц\" onClick=\"window.open('hotel_list.php')\">";
  
  echo " LIMIT: <input onchange=\"form.submit()\" type=\"number\" min = \"0\" name=\"LIMIT\" value = ";
      
      if (isset($_POST['LIMIT'])) echo htmlspecialchars($_POST['LIMIT']); else echo $LIMIT;
      
      $sql .= " LIMIT ".$LIMIT;
      
  echo "></div> 
  <table id=\"J1\" align = \"center\">
  <tr style=\"background-color: gray\">
  <th>№</td>
  <th>Фамилия <input type=\"submit\" value=".$_SESSION['io']." name = 'sortFamil'></th>
  <th>Имя</th>
  <th>Отчество</th>
  <th>Пол</th>
  <th>Возрастная группа <input type=\"submit\" value=".$_SESSION['io1']." name = 'sortVozr'></form></th>
  <th>Город</th>
  <th>Вид спорта <input type=\"submit\" value=".$_SESSION['io2']." name = 'sortSport'></th>
  <th>Гостиница</th>
  <th>Номер</th>
  <th>Кол-во мест</th>
  <th>Del?</th>
  </tr>";
     $result=mysqli_query($Connect, $sql);
  
  if (!$result) exit("Ошибка выполнения запроса ".mysqli_error($Connect)."??????");
  
  $nrows=mysqli_num_rows($result);
  for ($i=0;$i<$nrows; $i++) {
$assoc=mysqli_fetch_assoc($result);
  $style = "style=\"background-color: silver\"";
  
  if ($i % 2 == 0) $style = "style=\"background-color: silver\"";
  else $style = "style=\"background-color: #dddadd\"";
  
  $a = "";
  
  if (isset($_SESSION['id_person'])) if ($assoc['id_person'] == $_SESSION['id_person']){
      $a = " name = \"J2\" ";
      
      $style = "style=\"background-color: red\"";
   } 
 
  
  echo
  "<tr ".$style.">
  <td>".($i + 1)."</td>
  <td>".$assoc['Фамилия']."</td>
  <td>".$assoc['Имя']."</td>
  <td>".$assoc['Отчество']."</td>
  <td>".$assoc['пол']."</td>
  <td>".$assoc['Возрастная группа']."</td>
  <td>".$assoc['город']."</td>
  <td>".$assoc['вид спорта']."</td>
  <td>".$assoc['гостиница']."</td>
  <td>".$assoc['номер']."</td>
  <td>".$assoc['кол-во мест']."</td>
  <td><a ".$a."href='index.php?del=".$assoc['id_person']."'><img src='../photo/del.png'></a></td></tr>";
  
  }
  
  if ($nrows == 0){
  echo
  "<tr style=\"background-color: silver\">
  <td align=\"center\">-//-</td>
  <td align=\"center\">-//-</td>
  <td align=\"center\">-//-</td>
  <td align=\"center\">-//-</td>
  <td align=\"center\">-//-</td>
  <td align=\"center\">-//-</td>
  <td align=\"center\">-//-</td>
  <td align=\"center\">-//-</td>
  <td align=\"center\">-//-</td>
  <td align=\"center\">-//-</td>
  <td align=\"center\">-//-</td></tr>";
  }
  
  echo "</table>";
?>

</body>
</html>
