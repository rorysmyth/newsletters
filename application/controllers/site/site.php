<?php

class Site_Controller extends Base_Controller
{

    public function __construct()
    {
        Asset::container('footer')
            ->add('jquery','js/jquery.js')
            ->add('prettify_js','js/lang-css.js')
            ->add('prettify_js','js/prettify.js')
            ->add('bootstrap_js','js/bootstrap.min.js',array('jquery'))
            ->add('handlebars','js/handlebars.js')
            ->add('scripts','js/scripts.js');

        Asset::container('header')
            ->add('prettify_css','css/prettify.css')
            ->add('bootstrap_css','css/bootstrap.min.css')
            ->add('styles','css/style.css');
    }

}