<?php

return [
    'meta'      => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => "mytrackr - Free time tracking and productivity software", // set false to total remove
            'description'  => 'mytrackr allows you to efficiently track your time, set up projects, hourly rates cost estimates, milestones and much more!', // set false to total remove
            'separator'    => ' - ',
            'keywords'     => ['time tracking', 'online timer', 'timesheets', 'time management system', 'employee time tracking', 'productivity tracking', 'work hours', 'project management system', 'project milestones'],
            'canonical'    => null, // Set null for using Url::current(), set false to total remove
        ],

        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
        ],
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => 'mytrackr', // set false to total remove
            'description' => 'mytrackr allows you to efficiently track your time, set up projects, hourly rates cost estimates, milestones and much more!', // set false to total remove
            'url'         => null, // Set null for using Url::current(), set false to total remove
            'type'        => 'website',
            'site_name'   => 'mytrackr',
            'images'      => ['https://mytrackr.app/img/ogimage.png'],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
          'card'        => 'summary',
          'site'        => '@MadMikeyB',
        ],
    ],
];
