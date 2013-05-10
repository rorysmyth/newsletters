<?php

class Block extends Eloquent {
	
	public function site()
	{
		return $this->belongs_to('Site');
	}

}