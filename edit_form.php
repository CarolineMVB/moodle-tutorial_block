<?php

class block_tutorial_block_edit_form extends block_edit_form
{
    protected function specific_definition($mform)
    {
        // MODIFIER LE CONTENU DU BLOC
        // Titre de l'en-tête de section selon le fichier de langue.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));
        // Un exemple de variable de chaîne avec une valeur par défaut.
        $mform->addElement('text', 'config_text', get_string('blockstring', 'block_tutorial_block'));
        $mform->setDefault('config_text', 'Valeur par défaut');
        $mform->setType('config_text', PARAM_RAW);

        // MODIFIER LE TITRE DU BLOC
        $mform->addElement('text', 'config_title', get_string('blocktitle', 'block_tutorial_block'));
        $mform->setDefault('config_title', 'Titre');
        $mform->setType('config_title', PARAM_TEXT);
    }
}
