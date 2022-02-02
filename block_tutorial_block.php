<?php

defined('MOODLE_INTERNAL') || die();

class block_tutorial_block extends block_base {
    public function init() {
        $this->blockname = get_class($this);
        $this->title = get_string('pluginname', 'block_tutorial_block');
    }

    public function instance_allow_multiple() {
        return false;
    }

    public function has_config() {
        return true;
    }

    public function instance_allow_config() {
        return true;
    }

    public function get_content() {
        $this->content = new stdClass();
        $this->content->text = "hello";
        return $this->content;
    }

    public function applicable_formats() {
        return array('all' => true);
    }
}