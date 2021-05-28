<?php

include_once("User.php");

User::deleteUser();
header("location:index.php");
