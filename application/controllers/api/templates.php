<?php

class Api_Templates_Controller extends Base_Controller
{
    public $restful = true;

    public function get_index($id = null)
    {
        
    }

    public function post_index()
    {
        $rules = array(
            'title' => 'required',
            'code'  => 'required'
        );

        $template = new Template();

        $new = array(
            'title'   => Input::get('title'),
            'code'    => Input::get('code'),
            'site_id' => Input::get('site_id')
        );

        $validation = Validator::make($new, $rules);

        if($validation->fails())
        {
            return Redirect::to_route('templates_new')
                ->with_input()
                ->with_errors($validation->errors);
        } else {
            $template->title = Input::get('title');
            $template->code = Input::get('code');
            $template->site_id = Input::get('site_id');
            $template->save();
            return Redirect::to_route('newsletters_all');
        }

    }

    public function put_index($id)
    {
        $code = Input::get('code');
        $template = Template::find($id);
        $template->code = $code;
        $template->save();
        return "saved";
    }

    public function post_make()
    {
        // get all blocks
        $block_ids = Input::get('values');
        // $block_ids = array(2,2,1);
        
        // make a "complete" array with all the final block html
        $final_html = array();

        // blocks used
        $used_blocks = array();

        // go through each block
        foreach ($block_ids as $block) {

            $block = Block::find($block);
            
            $id    = $block->id;
            $code  = $block->code;
            $title  = $block->slug;

            // if the block hasn't been processed before add it
            // if a block with that id HAS been processed before, append
            // array of all the titles that have been used with a counter value
            // $counter = array(  "header" => 1, article" => 4, );
            if (!array_key_exists($title, $used_blocks)) {
                $used_blocks[$title] = 1;
                $working_title = "section_" . $title . "_";
            } else {
                $used_blocks[$title]++;
                $working_title = "section_" . $title . "-" . $used_blocks[$title] . "_";
            }

            // find the variables in it
            $scan = preg_match_all('/\{\{(.+?)\}\}/', $code, $matches);
            $matched_snippets = $matches[1];

            $unique_snippets = array_unique($matched_snippets);

            // replace the code with the variables prepended
            foreach ($unique_snippets as $snippet) {
                // find "title" replace with "section_article_title"
                // also make sure that section_ hasn't been used as it may be used as part of a global snippet group
                if(preg_match('/section_/', $snippet) === 0)
                {
                    $code = str_replace("{{".$snippet."}}", "{{".$working_title . $snippet . "}}", $code);
                }
            }

            array_push($final_html, $code);

        }

        $generated_html = implode("\n", $final_html);
        return $generated_html;
    }

}