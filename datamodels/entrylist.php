<?php
class EntryList implements Content
{
	private $entries = array();
	public function __construct()
	{}

	public function add(Entry $entry)
	{
		$this->entries[] = $entry;
	}

	public function show()
	{
		echo '<div class="entrylist">'."\n";
		foreach($this->entries as $entry)
			$entry->show();
		echo '</div>'."\n";
	}
}
