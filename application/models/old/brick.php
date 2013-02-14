<?php

class Brick extends Eloquent {

	public function block()
	{
		return $this->has_many('block');
	}
		
}