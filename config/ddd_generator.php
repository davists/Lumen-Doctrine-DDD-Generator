<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Paths
    |--------------------------------------------------------------------------
    |
    */

    'path' => [

        'dest_path'           => base_path('ddd_generator/files_output/'), //destination path

        'entity'              => 'Domain/{DOMAIN_NAME}/Entities/',

        'repository_contract' => 'Domain/{DOMAIN_NAME}/Contracts/',

        'repository'          => 'Infrastructure/Doctrine/Repositories/{DOMAIN_NAME}/',

        'entity_mapping'      => 'Infrastructure/Doctrine/Mappings/',

        'controller'          => 'Application/core/Http/Controllers/',

        'application_service' => 'Application/core/Services/',

        'service_provider'    => 'Application/core/Providers/',

        'route'              => 'routes/',

    ],

    /*
    |--------------------------------------------------------------------------
    | Namespaces
    |--------------------------------------------------------------------------
    |
    */

    'namespace' => [

        'entity'              => 'Domain\{DOMAIN_NAME}\Entities',

        'repository_contract' => 'Domain\{DOMAIN_NAME}\Contracts',

        'repository'          => 'Infrastructure\Doctrine\Repositories\{DOMAIN_NAME}',

        'controller'          => 'Application\Core\Http\Controllers',

        'application_service' => 'Application\Core\Services',

        'service_provider'    => 'Application\Core\Providers'
    ],


];
