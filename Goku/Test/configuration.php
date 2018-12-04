<?php
return array(
'document_root' => __DIR__,
'module_path' => array(),
'service_path' => array(
    __DIR__.'/../../'
),
'library_path' => array(),
'modules' => array(),
'params' => array(),
'services' => array(
    'Goku' => array(
        'class' => \X\Service\Goku\Service::class,
        'enable' => true,
        'delay' => true,
        'params' => array(
            'projects' => array(
                'test' => array(
                    'host' => 'goku.local',
                    'account' => '4292ed0fac97c172e0324c4e3ff727ae',
                    'secret' => '9b2d439c4d4fac7945b194917b8cfc57',
                    'id' => 'test',
                ),
            )
        ),
    ),
),
);