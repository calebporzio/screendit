<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. A "local" driver, as well as a variety of cloud
    | based drivers are available for your choosing. Just store away!
    |
    | Supported: "local", "ftp", "s3", "rackspace"
    |
    */

    'default' => 's3',

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => 's3',

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => 'AKIAINRQ3LVGIGDVACZA',
            'secret' => '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',
            'region' => 'us-east-1',
            'bucket' => 'screendit',
        ],

        // 's3' => [
        //     'driver' => 's3',
        //     'key' => 'AKIAIZEPOCEVFDPFVPZA',
        //     'secret' => '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',
        //     'region' => 'us-east-1',
        //     'bucket' => 'screendit',
        // ],

    ],

];
