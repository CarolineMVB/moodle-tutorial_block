<?php

namespace block_tutorial_block\output;

defined('MOODLE_INTERNAL') || die();

use renderable;
use renderer_base;
use templatable;

class content implements renderable, templatable
{
    public $text;
    public $footer;
    public $picture;

    public function __construct($text, $picture, $footer)
    {
        $this->text = $text;
        $this->footer = $footer;
        $this->picture = $picture;
    }

    public function export_for_template(renderer_base $output)
    {
        $data = array(
            'montexte' => $this->text,
            'footer' => $this->footer,
            'picture' => $this->picture,
        );
        return $data;
    }
}
