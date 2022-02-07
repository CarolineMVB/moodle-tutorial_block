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

    public function __construct($text, $footer)
    {
        $this->text = $text;
        $this->footer = $footer;
    }

    public function export_for_template(renderer_base $output)
    {
        $data = array(
            'montexte' => $this->text,
            'footer' => $this->footer,
        );
        return $data;
    }
}
