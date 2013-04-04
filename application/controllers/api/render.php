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

}