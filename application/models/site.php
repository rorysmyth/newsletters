<?php

class Site extends Eloquent
{
	public function newsletter()
	{
		return $this->has_many('Newsletter');
	}
}