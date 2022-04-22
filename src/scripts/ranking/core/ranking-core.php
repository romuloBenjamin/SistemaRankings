<?php
//Loud Config 
require "../../../config/config.php";
$config = new Config(getcwd());

//Get Post data
$post = json_decode(file_get_contents("php://input"));

//Get Ranking Class
require $config->dirs->path."modules/ranking/ranking-class.php";
$rank = new Ranking();
$rank->entry = $post;

//Get Responser
echo $rank->init();