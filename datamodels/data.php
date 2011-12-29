<?php
class Data
{
	private static $db;

	private function __construct()
	{}

	private static function db()
	{
		if(is_null(self::$db))
			self::$db = new mysqli(Config::DbHost, Config::DbUser, Config::DbPass, Config::DbDb);
//		if(self::$db->connect_error)
//			throw new DatabaseException('Could not connect to database: '.self::$db->connect_error);
		return self::$db;

	}

	public static function getEntry($id)
	{
		$db = self::db();
		$sql = 'SELECT id, name, text FROM entries WHERE id = ?';
		$stmt = $db->prepare($sql);
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$stmt->fetch();
		$stmt->bind_result($id, $name, $text);
		$result = new Result(array('id' => $id, 'name' => $name, 'text' => $text));
		return $result;
	}

	public static function getEntryFromName($name)
	{
		$db = self::db();
		$sql = 'SELECT id, name, text FROM entries WHERE name = ?';
		$stmt = $db->prepare($sql);
		$stmt->bind_param('s', $name);
		$stmt->execute();
		$stmt->bind_result($id, $name, $text);
		$stmt->fetch();
		$result = new Result(array('id' => $id, 'name' => $name, 'text' => $text));
		return $result;
	}

	public static function getNewestEntries($count, $offset)
	{
		$db = self::db();
		$sql = 'SELECT id, name, text FROM entries ORDER BY date LIMIT ?,?';
		$stmt = $db->prepare($sql);
		$stmt->bind_param('ii', $offset, $count);
		$stmt->execute();
		$results = array();
		$stmt->bind_result($id, $name, $text);
		while($stmt->fetch())
		{
			$results[] = new Result(array('id' => $id, 'name' => $name, 'text' => $text));
		}
		return $results;
	}
	
	public static function getImage($name)
	{
		$db = self::db();
		$sql = 'SELECT image, imageType, UNIX_TIMESTAMP(updated) FROM entries WHERE name = ?';
		$stmt = $db->prepare($sql);
		$stmt->bind_param('s', $name);
		$stmt->execute();
		$stmt->fetch();
		$stmt->bind_result($image, $imageType, $updated);
		$result = new Result(array('image' => $image, 'imageType' => $imageType, 'updated' => $updated));
		return $result;
	}

	public static function install()
	{
		$db = self::db();
		$sql = <<<EOT
CREATE TABLE `entries`(
  `id` INT UNSIGNED NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `image` BLOB NOT NULL,
  `imageType` CHAR(3) NOT NULL,
  `text` TEXT NOT NULL,
  `date` TIMESTAMP NULL DEFAULT NULL,
  `updated` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX (`date`),
  UNIQUE (`name`)
) ENGINE = MYISAM;
EOT;
		$db->query($sql);
	}
}

class Result
{
	private $data;
	public function __construct($data)
	{
		$this->data = $data;
	}

	public function __get($key)
	{
		return $this->data[$key];
	}
}

class DatabaseException extends Exception {}
?>
