<?php
require_once 'config.php';
require_once 'datamodels/content.php';
require_once 'datamodels/data.php';
require_once 'datamodels/entrylist.php';
require_once 'datamodels/entry.php';
require_once 'datamodels/site.php';

if(!Config::DebugMode)
	set_exception_handler(function($e){echo 'Error';});

$ss = new Site();
$ss->add(Entry::getNewest());
$ss->show();

?>
