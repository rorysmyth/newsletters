<?php

class Variation extends Eloquent
{

	public function newsletter()
	{
		return $this->belongs_to('Newsletter');
	}

}