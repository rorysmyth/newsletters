<?php

class Data extends Eloquent
{

	public function newsletter()
	{
		return $this->has_one('newsletter');
	}

}
