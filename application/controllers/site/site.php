<?php

class Site_Controller extends Base_Controller
{

    public function __construct()
    {
        Asset::container('footer')
            ->add('jquery','js/jquery.js')
            ->add('bootstrap_js','js/bootstrap.min.js')
            ->add('handlebars','js/handlebars.js')
            ->add('scripts','js/scripts.js');

        Asset::container('header')
            ->add('prettify_css','css/prettify.css')
            ->add('bootstrap_css','css/bootstrap.min.css')
            ->add('styles','css/style.css');
    }

}