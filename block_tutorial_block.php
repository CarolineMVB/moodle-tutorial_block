<?php
// block_tutorial_block.php

defined('MOODLE_INTERNAL') || die();

class block_tutorial_block extends block_base
{
    public function init()
    {
        $this->blockname = get_class($this);
        $this->title = get_string('pluginname', 'block_tutorial_block');
    }

    public function instance_allow_multiple()
    {
        return false;
    }

    public function has_config()
    {
        return true;
    }

    public function instance_allow_config()
    {
        return true;
    }

    public function get_content()
    {
        $this->content = new stdClass();
        $this->content->text = "Hello, <br> Je suis un block de test.";
        $this->content->footer = "Pied de block.";

        if (!empty($this->config->text)) {
            $this->content->text = $this->config->text;
        }

        return $this->content;
    }

    public function specialization()
    {
        if (isset($this->config)) {
            if (empty($this->config->title)) {
                $this->title = get_string('defaulttitle', 'block_tutorial_block');
            } else {
                $this->title = $this->config->title;
            }

            if (empty($this->config->text)) {
                $this->config->text = get - string('defaulttext', 'block_tutorial_block');
            }
        }
    }

    public function applicable_formats()
    {
        return array('all' => true);
    }
}
