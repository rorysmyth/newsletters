<?php

class Bug extends Eloquent
{
	public static function add_new_bug($data)
	{
		$bug = new Bug($data);
        $bug->save();
        return $bug;
	}
}
