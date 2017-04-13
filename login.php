<?php
session_start();
?>
<html>
  <body>
    <?php
      $users = array(
        'Ashley',
        'Dave',
        'Jim',
        'Ralph',
        'Jessica',
        'Mary'
      );
      $passwords = array(
        '1234',
        'password',
        '12345',
        '12345678',
        'test',
        'admin'
      );

      $username = null;
      $authenticated = false;

      if(isset($_POST['username']) && isset($_POST['password'])) {
        for($i=0;$i<6;++$i) {
          if($_POST['username'] == $users[$i]) {
            if($_POST['password'] == $passwords[$i]) {
              $authenticated = true;
              $username = $users[$i];
            }
          }
        }
      }

      if($authenticated) {
        $dbString = file_get_contents('hours.db');
        $db = json_decode($dbString, true);
        if($db[$username]['Monday'] !== null) {
          $monday = $db[$username]['Monday'];
        } else {
          $monday = 0;
        }
        if($db[$username]['Tuesday'] !== null) {
          $tuesday = $db[$username]['Tuesday'];
        } else {
          $tuesday = 0;
        }
        if($db[$username]['Wednesday'] !== null) {
          $wednesday = $db[$username]['Wednesday'];
        } else {
          $wednesday = 0;
        }
        if($db[$username]['Thursday'] !== null) {
          $thursday = $db[$username]['Thursday'];
        } else {
          $thursday = 0;
        }
        if($db[$username]['Friday'] !== null) {
          $friday = $db[$username]['Friday'];
        } else {
          $friday = 0;
        }
        if($db[$username]['Saturday'] !== null) {
          $saturday = $db[$username]['Saturday'];
        } else {
          $saturday = 0;
        }
        if($db[$username]['Sunday'] !== null) {
          $sunday = $db[$username]['Sunday'];
        } else {
          $sunday = 0;
        }
        $totalHours = $monday + $tuesday + $wednesday + $thursday + $friday + $saturday + $sunday;
      } else {
        header("Location: hourTracker.php");
      }
    ?>

    <h1><?php echo $username ?>'s Hours:</h1>
    <br/>
    <form id="hours" action="submitHours.php">
      <label for="monday">Monday:</label>
      <input type="number" name="monday" id="monday" value="<?php echo $monday ?>"/>
      <label for="tuesday">Tuesday:</label>
      <input type="number" name="tuesday" id="tuesday" value="<?php echo $tuesday ?>"/>
      <label for="wednesday">Wednesday:</label>
      <input type="number" name="wednesday" id="wednesday" value="<?php echo $wednesday ?>"/>
      <label for="thursday">Thursday:</label>
      <input type="number" name="thursday" id="thursday" value="<?php echo $thursday ?>"/>
      <label for="friday">Friday:</label>
      <input type="number" name="friday" id="friday" value="<?php echo $friday ?>"/>
      <label for="saturday">Saturday:</label>
      <input type="number" name="saturday" id="saturday" value="<?php echo $saturday ?>"/>
      <label for="sunday">Sunday:</label>
      <input type="number" name="sunday" id="sunday" value="<?php echo $sunday ?>"/>
      <input type="submit"/>
    </form>
    <br/>
    <h1>Total Hours: <?php echo $totalHours ?></h1>
  </body>
</html>
