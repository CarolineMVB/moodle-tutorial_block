<?php

namespace block_tutorial_block\output;

defined('MOODLE_INTERNAL') || die();

use plugin_renderer_base;

class renderer extends plugin_renderer_base
{
    public function render_content(content $output)
    {
        $data = $output->export_for_template($this);
        return parent::render_from_template('block_tutorial_block/content', $data);
    }
}
