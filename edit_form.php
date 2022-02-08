<?php

defined('MOODLE_INTERNAL') || die();

class block_tutorial_block_edit_form extends block_edit_form
{
    protected function specific_definition($mform)
    {
        // Titre de l'en-tête de section selon le fichier de langue.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // MODIFIER LE TITRE DU BLOC
        $mform->addElement('text', 'config_title', get_string('blocktitle', 'block_tutorial_block'));
        $mform->setDefault('config_title', 'Titre');
        $mform->setType('config_title', PARAM_TEXT);

        // MODIFIER LE CONTENU DU BLOC
        // Un exemple de variable de chaîne avec une valeur par défaut.
        $mform->addElement('editor', 'config_text', get_string('blockstring', 'block_tutorial_block'), array('rows' => 17, 'cols' => 100, 'class' => 'smalltext'));
        $mform->setDefault('config_text', 'Contenu du bloc');
        $mform->setType('config_text', PARAM_RAW);

        //MODIFIER L'IMAGE DU BLOC
        $mform->addElement('filepicker', 'config_modelfile', get_string('file'), null, ['accepted_types' => '*']);

        // MODIFIER LE FOOTER DU BLOC
        $mform->addElement('text', 'config_footer', get_string('blockfooter', 'block_tutorial_block'));
        $mform->setDefault('config_footer', 'Pied de bloc');
        $mform->setType('config_footer', PARAM_TEXT);
    }
}
