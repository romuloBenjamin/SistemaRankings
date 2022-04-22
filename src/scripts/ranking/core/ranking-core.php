<?php
//Loud Config 
require "../../../config/config.php";
$config = new Config(getcwd());

//Get Ranking Class
require $config->dirs->path."modules/ranking/ranking-class.php";
$rank = new Ranking();

//Get Responser
//echo $rank;