<?php

class Block extends Eloquent
{

	public function newsletter()
	{
		return $this->belongs_to('newsletter');
	}

	public function brick()
	{
		return $this->belongs_to('brick');
	}
	
}