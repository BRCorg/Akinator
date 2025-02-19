<?php

include "config/database.php";
include "repository/userRepository.php";
include "repository/quizRepository.php";

session_start();



$template = "index";
include "layout.phtml";