<?php

include("User.php");

echo "test1";
echo User::deleteUser();
echo "test2";
header("location:index.php");
