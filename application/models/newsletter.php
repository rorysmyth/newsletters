<?php

class Newsletter extends Eloquent
{

	public function site()
	{
		return $this->belongs_to('Site');
	}

	public function snippet()
	{
		return $this->has_many('Snippet');
	}

}