<?php
require_once("config/config.php");


require_once("./Controllers/NewsController.php");

$newsController = new NewsController();
$newsController->detail();