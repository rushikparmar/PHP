<?php
  $heartbeat = $_REQUEST["tp"];
  $temperature = $_REQUEST["hb"];
 
  $t=time();
  $time= date('d/m/y h:i:s', $t);

  $host="localhost";
  $username="id7419802_firebird";
  $password="9893622460";
  $dbname="id7419802_firebird";
  
  $con= mysqli_connect($host,$username,$password);

  if(!isset($con) )
  {
    die("connection failed");
  }

  mysqli_select_db($con,$dbname) or die("db not connected");
  
  $query= "INSERT INTO fbv (patient, heartbeat, temperature, time) 
  values('$patient', '$heartbeat', '$temperature', '$time')";
  
  mysqli_query($con,$query);
  $r= mysqli_affected_rows($con);
  $to = 'zonek@outlook.com';
  $subject = "Patient $patient @ $time";
  $message = "heartbeat = $heartbeat temperature= $temperature";
  $headers = 'From: HealthCare';

  mail($to, $subject, $message, $headers);
 
  mysqli_close($con);
?>
