<?php

defined('MOODLE_INTERNAL') || die();

function add_picture($modelfile, $contextid)
{

    global $DB;
    $picture_record = $DB->get_record_sql('SELECT *
                                            FROM {files}
                                            WHERE filename != "."
                                            AND contextid = ?
                                            AND component = ?
                                            AND filearea = ?
                                            AND itemid = ?',
        array($contextid, 'block_tutorial_block', 'modelfile', 0));

    $fs = get_file_storage();

    $fileinfo = array(
        'component' => 'block_tutorial_block', // habituellement = nom de la table
        'filearea' => 'modelfile', // habituellement = nom de la table
        'itemid' => 0, // habituellement = ID de la ligne dans le tableau
        'contextid' => $contextid, // ID du contexte
        'filepath' => '/', // tout chemin commençant et se terminant par /
        'filename' => $picture_record->filename); // tout nom de fichier

    $file = $fs->get_file($fileinfo['contextid'], $fileinfo['component'], $fileinfo['filearea'],
        $fileinfo['itemid'], $fileinfo['filepath'], $fileinfo['filename']);

    if ($file) {
        $picture = moodle_url::make_pluginfile_url(
            $contextid,
            'block_tutorial_block',
            'modelfile',
            $file->get_itemid(),
            $file->get_filepath(),
            $file->get_filename()
        );
    }

    return $picture;
}
