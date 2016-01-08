<?php

return [

    /**
     * Routes
     */
    'routes' => [
        'api/(?P<elementType>(Asset))(/(?P<elementId>[\w\-\d]+)?)?' => [
            'rest' => [
                'validator' => 'HttpMessagesRestMiddleware\\Validators\\AssetValidator',
            ],
        ],

        'api/(?P<elementType>(Category))(/(?P<elementId>[\w\-\d]+)?)?' => [
            'rest' => [
                'validator' => 'HttpMessagesRestMiddleware\\Validators\\CategoryValidator',
            ],
        ],

        'api/(?P<elementType>(Entry))(/(?P<elementId>[\w\-\d]+)?)?' => [
            'rest' => [
                'validator' => 'HttpMessagesRestMiddleware\\Validators\\EntryValidator',
            ],
        ],

        'api/(?P<elementType>(GlobalSet))(/(?P<elementId>[\w\-\d]+)?)?' => [
            'rest' => [
                'validator' => 'HttpMessagesRestMiddleware\\Validators\\GlobalSetValidator',
            ],
        ],

        'api/(?P<elementType>(MatrixBlock))(/(?P<elementId>[\w\-\d]+)?)?' => [
            'rest' => [
                'validator' => 'HttpMessagesRestMiddleware\\Validators\\MatrixBlockValidator',
            ],
        ],

        'api/(?P<elementType>(Commerce_Order))(/(?P<elementId>[\w\-\d]+)?)?' => [
            'rest' => [
                'validator' => 'HttpMessagesRestMiddleware\\Validators\\Commerce_OrderValidator',
            ],
        ],

        'api/(?P<elementType>(Tag))(/(?P<elementId>[\w\-\d]+)?)?' => [
            'rest' => [
                'validator' => 'HttpMessagesRestMiddleware\\Validators\\TagValidator',
            ],
        ],

        'api/(?P<elementType>(User))(/(?P<elementId>[\w\-\d]+)?)?' => [
            'rest' => [
                'validator' => 'HttpMessagesRestMiddleware\\Validators\\UserValidator',
            ],
        ],

    ],

    /**
     * Api Route Prefix
     *
     * The Api Route Prefix acts as a namespace and is prepended to all
     * routes that the API plugin defines.
     */
    'apiRoutePrefix' => 'api',

    /**
     * Content Recursion Limit
     *
     * This is the number of times content fields can be populated recursively.
     * With complex data models that have multiple relationships, populating content
     * automatically can pull in a lot of extra data.
     */
    'contentRecursionLimit' => 2,

    /**
     * Default Headers
     *
     * These headers will be sent with every Response.
     */
    'defaultHeaders' => [
        'Pragma'        => [
            'no-cache',
        ],
        'Cache-Control' => [
            'no-store',
            'no-cache',
            'must-revalidate',
            'post-check=0',
            'pre-check=0',
        ],
        'Content-Type' => [
            'application/json; charset=utf-8',
        ],
    ],

    /**
     * Default Serializers
     *
     * A Serializer structures your Transformed data in certain ways.
     * For more info, see http://fractal.thephpleague.com/serializers/.
     */
    'defaultSerializer' => 'ArraySerializer',

    /**
     * Serializers
     *
     * Available serializers that can be specified as default serializer.
     */
    'serializers' => [
        'ArraySerializer'     => 'League\\Fractal\\Serializer\\ArraySerializer',
        'DataArraySerializer' => 'League\\Fractal\\Serializer\\DataArraySerializer',
        'JsonApiSerializer'   => 'League\\Fractal\\Serializer\\JsonApiSerializer',
    ],

    /**
     * Element Types
     *
     * Define settings for each element type. If no setting is defined for an element type,
     * the default settings defined in the `*` wildcard will be inherited.
     */
    // 'elementTypes' => [

    //     '*' => [
    //         'enabled'     => true,
    //         'transformer' => 'HttpMessagesRestMiddleware\\Transformers\\ArrayTransformer',
    //         'validator'   => null,
    //         'middleware'  => ['auth'],
    //         'permissions' => [
    //             'public'        => ['GET'],
    //             'authenticated' => ['POST', 'PUT', 'PATCH'],
    //         ],
    //     ],

    //     'Asset' => [
    //         'enabled'     => true,
    //         'transformer' => 'HttpMessagesRestMiddleware\\Transformers\\AssetFileTransformer',
    //         'validator'   => 'HttpMessagesRestMiddleware\\Validators\AssetFileValidator',
    //     ],

    //     'Category' => [
    //         'enabled'     => true,
    //         'transformer' => 'HttpMessagesRestMiddleware\\Transformers\\CategoryTransformer',
    //         'validator'   => 'HttpMessagesRestMiddleware\\Validators\\CategoryValidator',
    //     ],

    //     'Entry' => [
    //         'enabled'     => true,
    //         'transformer' => 'HttpMessagesRestMiddleware\\Transformers\\EntryTransformer',
    //         'validator'   => 'HttpMessagesRestMiddleware\\Validators\\EntryValidator',
    //     ],

    //     'GlobalSet' => [
    //         'enabled'     => true,
    //         'transformer' => 'HttpMessagesRestMiddleware\\Transformers\\GlobalSetTransformer',
    //         'validator'   => 'HttpMessagesRestMiddleware\\Validators\\GlobalSetValidator',
    //     ],

    //     'MatrixBlock' => [
    //         'enabled'     => true,
    //         'transformer' => 'HttpMessagesRestMiddleware\\Transformers\\MatrixBlockTransformer',
    //         'validator'   => 'HttpMessagesRestMiddleware\\Validators\\MatrixBlockValidator',
    //     ],

    //     'Tag' => [
    //         'enabled'     => true,
    //         'transformer' => 'HttpMessagesRestMiddleware\\Transformers\\TagTransformer',
    //         'validator'   => 'HttpMessagesRestMiddleware\\Validators\\TagValidator',
    //     ],

    //     'User' => [
    //         'enabled'     => true,
    //         'transformer' => 'HttpMessagesRestMiddleware\\Transformers\\UserTransformer',
    //         'validator'   => 'HttpMessagesRestMiddleware\\Validators\\UserValidator',
    //     ],

    // ],

];
