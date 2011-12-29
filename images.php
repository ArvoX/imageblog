<?php
require_once 'config.php';
require_once 'datamodels/data.php';

$name = $_GET['img'];
$data = Data::getImage($name);

function ext_to_mime_type($ext)
{
	switch($ext)
	{
		case 'jpg':
			$ext = 'jpeg';
		case 'jpeg':
		case 'tiff':
		case 'bmp':
		case 'psd':
		case 'png':
		case 'gif':
			return "image/$ext";
	}
}

header('Content-type: '.ext_to_mime_type($data->imageType));
header('Content-Length: '.strlen($data->image));
header('Last-Modified: '.date('r', $data->updated));

echo $data->image;

?>
