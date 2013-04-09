<?php

class Site extends Eloquent
{
	public function newsletter()
	{
		return $this->has_many('Newsletter');
	}

	public static function related_newsletters($id)
	{
		$site = Site::find($id);
		$newsletters = $site->newsletter()
			->order_by('created_at', 'desc')
			->take(20)
			->get();
		return $newsletters;
	}
}