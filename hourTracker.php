<?php
session_start();
?>
<html>
	<head>
		<title>company time tracking software</title>
    <script
      src="https://code.jquery.com/jquery-3.2.1.min.js"
      integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
      crossorigin="anonymous">
    </script>
	</head>
	<body>
    <br/>
    <h1>Please log in</h1>
    <form action='' method='post'>
      <label for="username">Username:</label>
      <input type='text' name='username' id="username">
      <label for="password">Password:</label>
      <input type='password' name='password' id="password">
      <input type='submit'>
      <br/>
    </form>
    <?php
      $_SESSION["authenticated"] = false;

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

      if(isset($_POST['username']) && isset($_POST['password'])) {
        for($i=0;$i<6;++$i) {
          if($_POST['username'] == $users[$i]) {
            if($_POST['password'] == $passwords[$i]) {
              $_SESSION["authenticated"] = true;
              $_SESSION["username"] = $users[$i];
            }
          }
        }
      }

      if($_SESSION["authenticated"]) {
        $dbString = file_get_contents('hours.db');
        $db = json_decode($dbString, true);
        if($db[$_SESSION["username"]]['Monday'] !== null) {
          $monday = $db[$_SESSION["username"]]['Monday'];
        } else {
          $monday = 0;
        }
        if($db[$_SESSION["username"]]['Tuesday'] !== null) {
          $tuesday = $db[$_SESSION["username"]]['Tuesday'];
        } else {
          $tuesday = 0;
        }
        if($db[$_SESSION["username"]]['Wednesday'] !== null) {
          $wednesday = $db[$_SESSION["username"]]['Wednesday'];
        } else {
          $wednesday = 0;
        }
        if($db[$_SESSION["username"]]['Thursday'] !== null) {
          $thursday = $db[$_SESSION["username"]]['Thursday'];
        } else {
          $thursday = 0;
        }
        if($db[$_SESSION["username"]]['Friday'] !== null) {
          $friday = $db[$_SESSION["username"]]['Friday'];
        } else {
          $friday = 0;
        }
        if($db[$_SESSION["username"]]['Saturday'] !== null) {
          $saturday = $db[$_SESSION["username"]]['Saturday'];
        } else {
          $saturday = 0;
        }
        if($db[$_SESSION["username"]]['Sunday'] !== null) {
          $sunday = $db[$_SESSION["username"]]['Sunday'];
        } else {
          $sunday = 0;
        }
        $totalHours = $monday + $tuesday + $wednesday + $thursday + $friday + $saturday + $sunday;
        echo "Hi " . $_SESSION["username"];
      } else {
        echo "Username/password incorrect. Please try again";
      }
    ?>
	</body>
</html>
