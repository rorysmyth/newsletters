<?php

class Api_Render_Controller extends Base_Controller {

    public function action_full($id, $variation)
    {
        return(htmlentities(Helpers::renderTemplate($id, $variation)));
    }

    public function action_code($id, $variation = 'default')
    {
        return Helpers::renderTemplate($id, $variation);
    }

    public function action_download_all($newsletter_id)
    {
    	// get all variations
    	$variations = Helpers::allVariations($newsletter_id);

    	// loop through
    	foreach ($variations as $variation) {
    		Newsletter::download_template($newsletter_id, $variation);
    	}
    	
        // zip 'em up
        $zip = Newsletter::zip_folder($newsletter_id);

        return $zip;
    }

}