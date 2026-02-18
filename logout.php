<?php

session_start();

// The array is now empty & the session destoyed :
session_unset();
session_destroy();

// Go back to home page :
header('Location: index.php');
exit();