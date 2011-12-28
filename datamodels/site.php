<?php
class Site
{
	private $content = array();
	private $title, $style;

	public function __construct($title = Config::Title, $style = Config::Style)
	{
		$this->title = $title;
		$this->style = $style;
	}

	public function add(Content $obj)
	{
		$this->content[] = $obj;
	}

	public function show()
	{
		echo <<<EOT
<!DOCTYPE html>
<html>
<head>
<title>$this->title</title>
<link type='text/css' rel='stylesheet' href='$this->style'>
</head>
<body>

EOT;
		foreach($this->content as $obj)
			$obj->show();
		echo <<<EOT
</body>
</html>

EOT;
	}
}
?>
