# Customize

## How to change the layout?

Go to `module/Customize/view`, create a `layout` directory and in this directory you have to create a file like `layout.twig` with the content of [default-design](https://github.com/kokspflanze/PServerCore/blob/master/view/layout/layout.twig).
These file that you create will be your custom design, so there you can everything you need=).
Now you have to register your custom layout in the config, for that you have to go to `module/Customize/config/module.config.php`, there you have to add `'layout/layout' => __DIR__ . '/../view/layout/layout.twig',`.
So the file will look like 
 
 ```php
<?php
return [
    'view_manager' => [
        'template_map' => [
            'layout/layout' => __DIR__ . '/../view/layout/layout.twig',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
 ```
 
These workflow will also work with other layout parts, check the PServerCMS [config](https://github.com/kokspflanze/PServerCore/blob/master/config/module.config.php#L154) at the part `template_map`.

Hint: it works also with the `module/controller/action` name if there is no alias set for a layout page.
example: `'p-server-core/index/index' => __DIR__ . '/../view/customize/index/news.twig',`