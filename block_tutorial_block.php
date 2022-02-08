<?php

require_once "locallib.php";

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
        return false;
    }

    public function get_content()
    {
        $this->content = new stdClass();
        $text = "Hello, <br> Je suis un block de test.";
        $footer = "Pied de block.";

        var_dump($this->config->text['text']);

        if (!empty($this->config->text['text'])) {
            $text = $this->config->text['text'];
        }

        if (get_config('tutorial_block', 'Allow_HTML') == '0') {
            $text = strip_tags($this->content->text);
        }

        $picture = null;
        if (isset($this->config->modelfile)) {
            $picture = add_picture($this->config->modelfile, $this->context->id);
        }

        $content = new \block_tutorial_block\output\content($text, $picture, $footer);
        $renderer = $this->page->get_renderer('block_tutorial_block');
        $this->content->text = $renderer->render($content);

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
        if ($data->modelfile) {
            file_save_draft_area_files(
                $data->modelfile,
                $this->context->id,
                'block_tutorial_block',
                'modelfile',
                0
            );
        }

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
