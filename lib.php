<?php

defined('MOODLE_INTERNAL') || die();

function block_tutorial_block_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array())
{
    // Assurez-vous que le filearea est l'un de ceux utilisés par le plugin.
    if ($filearea !== 'modelfile') {
        return false;
    }

    // Laissez cette ligne de côté si vous définissez l'itemid à null dans make_pluginfile_url (définissez $itemid à 0 à la place).
    $itemid = array_shift($args); // Le premier élément du tableau $args.

    // Utiliser l'itemid pour récupérer tout enregistrement de données pertinent et effectuer tout contrôle de sécurité pour vérifier si l'utilisateur a réellement accès au fichier en question.
    // l'utilisateur a réellement accès au fichier en question.

    // Extrait le nom de fichier / le chemin d'accès au fichier à partir du tableau $args.
    $filename = array_pop($args); // Le dernier élément dans le tableau $args.
    if (!$args) {
        $filepath = '/'; // $args est vide => le chemin est '/'.
    } else {
        $filepath = '/' . implode('/', $args) . '/'; // $args contient des éléments du chemin de fichier
    }

    // Récupérer le fichier à partir de l'API Fichiers.
    $fs = get_file_storage();
    $file = $fs->get_file($context->id, 'block_tutorial_block', $filearea, $itemid, $filepath, $filename);
    if (!$file) {
        return false; // Le fichier n'existe pas.
    }

    // Nous pouvons maintenant renvoyer le fichier au navigateur, dans ce cas avec une durée de vie du cache de 1 jour et sans filtrage.
    send_stored_file($file, 86400, 0, $forcedownload, $options);
}
