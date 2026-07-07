<?php

  $con=mysqli_connect("localhost:3307","root","","voting");

  if(mysqli_connect_errno())
  {
    echo "<script>alert('cannot connect to the database')</script>".mysqli_connect_error();
    exit();
  }
?>