<?php

$sMetadataVersion = '2.0';

$aModule = [
    'id' => 'category_media_properties_ext',
    'title' => [
        'en' => 'Category attachments',
        'de' => 'Kategorie Anhänge '
    ],
    'description' => [
        'en' => 'Category attachments',
        'de' => 'Kategorie Anhänge '
    ],
    'author' => 'SmileyThane',
    'version' => '0.0.1',
    'url' => 'http://www.oxid-esales.com/en/',
    'email' => 'thane.crios@gmail.com',
    'extend' => [
        OxidEsales\Eshop\Application\Model\Category::class => \SmileyThane\CategoryExtendModule\Application\Model\Category::class,
        OxidEsales\Eshop\Application\Controller\Admin\CategoryMain::class => \SmileyThane\CategoryExtendModule\Application\Controller\Admin\CategoryMain::class,
    ],
    'blocks' => [
        [
            'template' => 'include/category_main_form.tpl',
            'block' => 'admin_category_main_form',
            'file' => 'Application/views/admin/tpl/blocks/category_media_ext.tpl',
            'position' => '1'
        ],
    ]
];
