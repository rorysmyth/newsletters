<?php

class Site_Controller extends Base_Controller
{

    public function __construct()
    {
        Asset::container('footer')
            ->add('jquery','js/jquery.js')
            ->add('yui','js/yui/build/yui/yui-min.js')
            ->add('bootstrap_js','js/bootstrap.min.js')
            ->add('bootstrap_switch_js','js/bootstrap-switch.js')
            ->add('handlebars','js/handlebars.js')
            ->add('blockui','js/blockui.js')
            ->add('scripts','js/scripts.js');

        Asset::container('admin_footer')
            ->add('jquery','js/jquery.js')
            ->add('bootstrap_js','js/bootstrap.min.js');

        Asset::container('header')
            ->add('prettify_css','css/prettify.css')
            ->add('bootstrap_css','css/bootstrap.min.css')
            ->add('bootstrap_switch_css','css/bootstrap-switch.css')
            ->add('styles','css/style.css');
    }

}