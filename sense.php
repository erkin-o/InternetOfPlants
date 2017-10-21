<!DOCTYPE html>

<html>
<head>
<title>HackBudapest</title>
</head>
<body>

<h1>IoP </h1>
<p>Sample sensor value sending page.</p>

<?php
$servername = "35.158.158.128";
$username = "root";
$password = "👆";
$db= "HackBudapest";
$conn = new mysqli($servername, $username, $password, $db);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
$sql = $ok = $secdID = $secVoL = $secVoT = $secVoGH = "";
?>
<br>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ok = test_input($_POST["ok"]);
    $secdID = test_input($_POST["dID"]);
    $secVoL = test_input($_POST["VoL"]);
    $secVoT = test_input($_POST["VoT"]);
    $secVoGH = test_input($_POST["VoGH"]);
  }
  $Vals->dID = $secdID;
  $Vals->VoL = $secVoL;
  $Vals->VoT = $secVoT;
  $Vals->VoGH = $secVoGH;
  
  $myJSON = json_encode($Vals);
  
  echo $myJSON;
  $ff = json_decode($myJSON, true);

  echo $incomingMessage = "dID: " . $ff['dID'] . ", VoL: " . $ff['VoL'] . ", VoT: " . $ff['VoT'] . ", VoGH: " . $ff['VoGH'] ;
  // echo $incomingMessage = "dID: " . $secdID . ", VoL: " . $secVoL . ", VoT: " . $secVoT . ", VoGH: " . $secVoGH ;
  $t=time();
  $sql1 = "INSERT INTO SensorValues (deviceID, time, sensType, value) VALUES (" . $ff['dID'] . ", " . $t . ", 'VoL', " . $ff['VoL'] . ");" ;
  $sql2 = "INSERT INTO SensorValues (deviceID, time, sensType, value) VALUES (" . $ff['dID'] . ", " . $t . ", 'VoT', " . $ff['VoT'] . ");" ;
  $sql3 = "INSERT INTO SensorValues (deviceID, time, sensType, value) VALUES (" . $ff['dID'] . ", " . $t . ", 'VoGH', " . $ff['VoGH'] . ");" ;

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

if($ok=="yo"){
if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE && $conn->query($sql3) === TRUE) {
    echo "query successful\n" ;
} else {
    echo "Error: " . $conn->error;
}
}
$conn->close();
?>

<form action="#" method="post">
Device ID: <input type="text" name="dID" value=""><br/>
Value of Light: <input type="text" name="VoL" value=""><br/>
Value of Tempeture: <input type="text" name="VoT" value=""><br/>
Value of Ground Humanity: <input type="text" name="VoGH" value=""><br/>
<input type="hidden" name="ok" value="yo">

<input type="submit">
</form>


<textarea name="query" rows="5" cols="40"><?php echo $t;?></textarea>
<a href="users.php">Users</a>
</body>
</html>