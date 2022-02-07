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

    // Cache le titre du block
    public function hide_header()
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

        if (get_config('tutorial_block', 'Allow_HTML') == '0') {
            $this->content->text = strip_tags($this->content->text);
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

    public function instance_config_save($data, $nolongerused = false)
    {
        if (get_config('tutorial_block', 'Allow_HTML') == '0') {
            $data->text = strip_tags($data->text);
        }
        // Et maintenant, passez à l'implémentation par défaut définie dans la classe parent
        return parent::instance_config_save($data, $nolongerused);
    }

    public function applicable_formats()
    {
        return array('all' => true);
    }
}
