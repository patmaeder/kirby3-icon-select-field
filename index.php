<?php

/*
 * Define the path to the icons on your sever. 
 * Usually those should be stored in your assets directory.
 */
$path = '/assets/feather/';

Kirby::plugin('patmaeder/icon-select-field', [
    'fields' => [
        'icon' => [
            'props' => [
                'path' => $path,
                'icons' => function () use ($path) {
                    return Dir::files('.' . $path);
                },
            ]
        ]
    ],
    'fieldMethods' => [
        'toIcon' => function ($field) use ($path) {
            return $path . $field->value;
        }
    ]
]);
