<?php
class Snippet extends Eloquent
{
	
	public function newsletter()
	{
		return $this->belongs_to('Newsletter');
	}

}