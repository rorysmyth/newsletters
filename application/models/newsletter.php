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

	public static function get_single_newsletter($id)
	{
		$newsletter = Newsletter::find($id);
		return $newsletter;
	}

	public static function update_newsletter($id)
	{
		$newsletter = Newsletter::find($id);

			if(Input::has('template')):
                $newsletter->template = Input::get('template');
            endif;

            if(Input::has('title')):
                $newsletter->title = Str::slug(Input::get('title'), '_');
            endif;

            if(Input::has('template_override')):
                $newsletter->template_override = Input::get('template_override');
            else:
                $newsletter->template_override = 0;
            endif;

            if(Input::has('template_id')):
                $newsletter->template_id = Input::get('template_id');
            endif;

        $newsletter->save();
	}

	public static function delete_newsletter($id)
	{
		$newsletter = Newsletter::find($id);
		Newsletter::delete_images_folder($id);
		$newsletter->delete();
	}

	public static function add_newsletter($data)
	{
		$newsletter = new Newsletter($data);
        $newsletter->save();

        // if template is sent with add
        // parse and add the snippets from the template
        if(Input::has('template')):
	        $snippets = Helpers::templateSnippets($data['template']);
	        $newsletter->snippet()->save($snippets);
        endif;

        Newsletter::create_images_folder($newsletter->id);

        return $newsletter;
	}

	public static function search_newsletters($query)
	{
		$search_results = Newsletter::where('title', 'LIKE', '%'.$query.'%')->get(array('title', 'id'));
		return $search_results;
	}

	public static function create_images_folder($id)
	{
		$dir = path('public') . '/img/newsletters/' . $id;
		File::mkdir($dir);
	}

	public static function delete_images_folder($id)
	{
		$dir = path('public') . '/img/newsletters/' . $id;
		File::rmDir($dir);
	}

	public static function download_template($id, $variation)
	{
		if(isset($id) and isset($variation)):
			$dir  = path('public') . 'img/newsletters/' . $id . '/html/';
			$file = $variation . '.html';
			$path = $dir . $file;
			$html = Helpers::renderTemplate($id, $variation);
			File::mkdir($dir);
			File::put($path, $html);
    	else:
    		return false;
    	endif;
	}

	public static function zip_folder($id)
	{
		$newsletter      = Newsletter::find($id);
		$dir             = path('public') . 'img/newsletters/' . $id . '/html/';
		$zip_file        = $dir . $newsletter->title . '.zip';
		$directory_files = scandir($dir);
		$excludes        = array("..", '.');
		$files           = array_diff($directory_files, $excludes);

		// if its already there, delete it
		if (file_exists($zip_file))
		{
			File::delete($zip_file);
		}

		$zip = new ZipArchive;

		if ($zip->open($zip_file, ZIPARCHIVE::CREATE) !== true ){
			return "failed to make zip";
		} else {

			foreach ($files as $file) {
				$path = $dir . $file;
				if(is_file($path)){
					$zip->addFile($path, $file);
				}
			}

		}

		$zip->close();

		return Response::download($zip_file);

	}

}