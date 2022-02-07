<?php

$settings->add(new admin_setting_heading(
    'headerconfig',
    get_string('headerconfig', 'block_tutorial_block'),
    get_string('descconfig', 'block_tutorial_block'),
));

$settings->add(new admin_setting_configcheckbox(
    'tutorial_block/Allow_HTML',
    get_string('labelallowhtml', 'block_tutorial_block'),
    get_string('descallowhtml', 'block_tutorial_block'),
    '0'
));
