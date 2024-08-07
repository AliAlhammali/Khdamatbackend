<?php

return [
    'api_version' => 'V1',
    'default_template_path' => storage_path('crud_generator'.DIRECTORY_SEPARATOR.'templates'),
    'fields_files_path' => storage_path('crud_generator'.DIRECTORY_SEPARATOR.'fields'.DIRECTORY_SEPARATOR),
    'custom_template_path' => '',
    'template-names' => [
        'api-controllers' => 'api-controller.ae',
        'web-controllers' => 'web-controller.ae',
        'models' => 'model.ae',
        'services' => 'services.ae',
        'dto' => 'dto.ae',
        'list-dto' => 'list-dto.ae',
        'dto-mapper' => 'dto-mapper.ae',
        'repositories' => 'repositories.ae',
        'filters' => 'filters.ae',
        'request' => 'request.ae',

    ],
    'dirs' => [
        'main-container-dir-name' => 'KhadamatTeck',
        'sup-container-dir-name' => '',
        'dir_names' => [
            'Controllers',
            'DTOs',
            'Events',
            'Listeners',
            'Mappers',
            'Models',
            'Repositories',
            'Requests',
            'Services',
            'Filters'
        ],
    ]
];
