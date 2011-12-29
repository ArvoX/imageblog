<?php
if(!file_exists('config.php'))
	die('no config.php fount');

require_once 'config.php';
require_once 'datamodels/data.php';

Data::install();
?>
