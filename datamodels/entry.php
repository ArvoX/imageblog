<?php
class Entry implements Content
{
	private $id, $name, $text;
	private function __construct($id, $name, $text)
	{
		$this->id = $id;
		$this->name = $name;
		$this->text = $text;
	}

	public static function get($id)
	{
		$data = Data::getEntry($id);
		return new self($data->id, $data->name, $data->text);
	}

	public static function getNewest($offset = 0, $count = Config::NumberOfEntries)
	{
		$entrylist = new EntryList();
		foreach(Data::getNewestEntries($count, $offset) as $data)
			$entrylist->add(new self($data->id, $data->name, $data->text));
		return $entrylist;
	}

	public function show()
	{
		echo <<<EOT
<div class='entry' id='entry$this->id'>
	<h1>$this->name</h1>
	<img src='images/$this->name' alt='$this->name'>
	<div>$this->text</div>
</div>

EOT;
	}
}
?>
