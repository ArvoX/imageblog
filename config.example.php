<?php
class Config
{
	const DebugMode = false;
	const NumberOfEntries = 20;
	const Title = 'Image blog';
	const Style = 'style.css';

	const DbHost = 'localhost';
	const DbUser = 'user';
	const DbPass = 'pass';
	const DbDb   = self::DbUser;
	
	private function __construct()
	{}
}
?>
