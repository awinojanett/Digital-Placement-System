<?php
session_start();

$tesy =  $_SESSION['LoginUser'];

echo "welcome $tesy ";