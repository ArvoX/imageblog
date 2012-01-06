<?php
class MenuBar implements Content
{
	private $items = array();
	function __construct()
	{
		foreach(Data::getMenubarMenus() as $menu)
			$this->items[] = new MenuBarItem($menu);
	}

	public function show()
	{
		echo '<ul class="menubar">';
		foreach($this->items as $item)
		{
			echo "\t";
			$menu->show();
		}
		echo '</ul>';
	}
}

class MenuBarItem implements Content
{
	private $id, $name, $url, $align;

	public function __construct($id, $name, $url, $align)
	{
		$this->id = $id;
		$this->name = $name;
		$this->url = $url;
		switch($aling)
		{
			case 'l':
				$this->align = 'left';
				break;
			case 'c':
				$this->align = 'center';
				break;
			case 'r':
				$this->align = 'rigth';
				break;
		}
	}

	public function show()
	{
		
		echo <<<EOT
<li class="$this->aling"><a href="$this->url">$this->name</a></li>

EOT;
	}
}
