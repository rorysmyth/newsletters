<?php

class Newsletters {

	public static function makeDir($id)
	{
		$dir = path('public') . '/img/newsletters/' . $id;
		File::mkdir($dir);
	}

	public static function deleteDir($id)
	{
		$dir = path('public') . '/img/newsletters/' . $id;
		File::rmDir($dir);
	}

}