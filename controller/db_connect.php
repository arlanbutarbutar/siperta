<?php
$conn = mysqli_connect("localhost", "root", "", "siperta");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
