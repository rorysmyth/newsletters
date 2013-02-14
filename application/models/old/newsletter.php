<?php

class Newsletter extends Eloquent
{
	
	public function brick()
	{
		return $this->has_many('brick');
	}

	public function data()
	{
		return $this->has_many('data');
	}

}