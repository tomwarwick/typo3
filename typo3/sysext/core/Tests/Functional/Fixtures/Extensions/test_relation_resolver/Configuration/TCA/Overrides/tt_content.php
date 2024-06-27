<?php

$overrides = [
    'palettes' => [
        'typo3tests_contentelementb_palette' => [
            'showitem' => 'typo3tests_contentelementb_select_single,typo3tests_contentelementb_select_one_to_one,typo3tests_contentelementb_select_checkbox,typo3tests_contentelementb_select_single_box,typo3tests_contentelementb_select_multiple,typo3tests_contentelementb_select_foreign,typo3tests_contentelementb_select_foreign_native,typo3tests_contentelementb_select_foreign_multiple',
        ],
    ],
    'columns' => [
        'typo3tests_contentelementb_collection' => [
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'typo3tests_contentelementb_collection',
                'foreign_field' => 'foreign_table_parent_uid',
            ],
            'exclude' => true,
            'label' => 'collection',
        ],
        'typo3tests_contentelementb_collection_recursive' => [
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'typo3tests_contentelementb_collection_recursive',
                'foreign_field' => 'foreign_table_parent_uid',
            ],
            'exclude' => true,
            'label' => 'collection_recursive',
        ],
        'typo3tests_contentelementb_categories_mm' => [
            'config' => [
                'type' => 'category',
            ],
            'exclude' => true,
            'label' => 'categories_mm',
        ],
        'typo3tests_contentelementb_categories_11' => [
            'config' => [
                'type' => 'category',
                'relationship' => 'oneToOne',
            ],
            'exclude' => true,
            'label' => 'categories_11',
        ],
        'typo3tests_contentelementb_categories_1m' => [
            'config' => [
                'type' => 'category',
                'relationship' => 'oneToMany',
            ],
            'exclude' => true,
            'label' => 'categories_1m',
        ],
        'typo3tests_contentelementb_pages_relation' => [
            'config' => [
                'type' => 'group',
                'allowed' => 'pages',
            ],
            'exclude' => true,
            'label' => 'pages_relation',
        ],
        'typo3tests_contentelementb_pages_relations' => [
            'config' => [
                'type' => 'group',
                'allowed' => 'pages',
            ],
            'exclude' => true,
            'label' => 'pages_relations',
        ],
        'typo3tests_contentelementb_circular_relation' => [
            'config' => [
                'type' => 'group',
                'allowed' => 'tt_content',
            ],
            'exclude' => true,
            'label' => 'circular_relation',
        ],
        'typo3tests_contentelementb_record_relation_recursive' => [
            'config' => [
                'type' => 'group',
                'allowed' => 'test_record',
            ],
            'exclude' => true,
            'label' => 'record_relation_recursive',
        ],
        'typo3tests_contentelementb_pages_content_relation' => [
            'config' => [
                'type' => 'group',
                'allowed' => 'pages,tt_content',
            ],
            'exclude' => true,
            'label' => 'pages_content_relation',
        ],
        'typo3tests_contentelementb_pages_mm' => [
            'config' => [
                'type' => 'group',
                'MM' => 'block_pages_mm',
                'allowed' => 'pages',
            ],
            'exclude' => true,
            'label' => 'pages_mm',
        ],
        'typo3tests_contentelementb_folder' => [
            'config' => [
                'type' => 'folder',
                'relationship' => 'manyToOne',
            ],
            'exclude' => true,
            'label' => 'folder',
        ],
        'typo3tests_contentelementb_folder_recursive' => [
            'config' => [
                'type' => 'folder',
            ],
            'exclude' => true,
            'label' => 'folder_recursive',
        ],
        'typo3tests_contentelementb_select_checkbox' => [
            'config' => [
                'type' => 'select',
            ],
            'exclude' => true,
            'label' => 'select_checkbox',
        ],
        'typo3tests_contentelementb_select_single_box' => [
            'config' => [
                'type' => 'select',
            ],
            'exclude' => true,
            'label' => 'select_single_box',
        ],
        'typo3tests_contentelementb_select_single' => [
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
            ],
            'exclude' => true,
            'label' => 'select_single',
        ],
        'typo3tests_contentelementb_select_one_to_one' => [
            'config' => [
                'type' => 'select',
                'relationship' => 'oneToOne',
                'foreign_table' => 'test_record',
            ],
            'exclude' => true,
            'label' => 'select_one_to_one',
        ],
        'typo3tests_contentelementb_select_multiple' => [
            'config' => [
                'type' => 'select',
            ],
            'exclude' => true,
            'label' => 'select_multiple',
        ],
        'typo3tests_contentelementb_select_foreign' => [
            'config' => [
                'type' => 'select',
                'foreign_table' => 'test_record',
            ],
            'exclude' => true,
        ],
        'typo3tests_contentelementb_select_foreign_native' => [
            'config' => [
                'type' => 'select',
                'foreign_table' => 'test_record',
            ],
            'exclude' => true,
            'label' => 'select_foreign_native',
        ],
        'typo3tests_contentelementb_select_foreign_multiple' => [
            'config' => [
                'type' => 'select',
                'foreign_table' => 'test_record',
            ],
            'exclude' => true,
            'label' => 'select_foreign_multiple',
        ],
        'typo3tests_contentelementb_flexfield' => [
            'config' => [
                'type' => 'flex',
                'ds' => [
                    'typo3tests_contentelementb' => '<T3FlexForms>' . "\n"
                        . '    <sheets type="array">' . "\n"
                        . '        <sDEF type="array">' . "\n"
                        . '            <ROOT type="array">' . "\n"
                        . '                <type>array</type>' . "\n"
                        . '                <el type="array">' . "\n"
                        . '                    <field index="header" type="array">' . "\n"
                        . '                        <label>header</label>' . "\n"
                        . '                        <config>' . "\n"
                        . '                            <type>input</type>' . "\n"
                        . '                        </config>' . "\n"
                        . '                    </field>' . "\n"
                        . '                    <field index="textarea" type="array">' . "\n"
                        . '                        <label>textarea</label>' . "\n"
                        . '                        <config>' . "\n"
                        . '                            <type>text</type>' . "\n"
                        . '                        </config>' . "\n"
                        . '                    </field>' . "\n"
                        . '                </el>' . "\n"
                        . '            </ROOT>' . "\n"
                        . '        </sDEF>' . "\n"
                        . '        <sheet2 type="array">' . "\n"
                        . '            <ROOT type="array">' . "\n"
                        . '                <type>array</type>' . "\n"
                        . '                <el>' . "\n"
                        . '                    <link>' . "\n"
                        . '                        <label>header</label>' . "\n"
                        . '                        <config>' . "\n"
                        . '                            <type>link</type>' . "\n"
                        . '                        </config>' . "\n"
                        . '                    </link>' . "\n"
                        . '                    <number>' . "\n"
                        . '                        <label>number</label>' . "\n"
                        . '                        <config>' . "\n"
                        . '                            <type>number</type>' . "\n"
                        . '                        </config>' . "\n"
                        . '                    </number>' . "\n"
                        . '                </el>' . "\n"
                        . '            </ROOT>' . "\n"
                        . '        </sheet2>' . "\n"
                        . '    </sheets>' . "\n"
                        . '</T3FlexForms>',
                    'default' => '<T3DataStructure>' . "\n"
                        . '  <ROOT>' . "\n"
                        . '    <type>array</type>' . "\n"
                        . '    <el>' . "\n"
                        . '      <xmlTitle>' . "\n"
                        . '        <label>The Title:</label>' . "\n"
                        . '        <config>' . "\n"
                        . '            <type>input</type>' . "\n"
                        . '            <size>48</size>' . "\n"
                        . '        </config>' . "\n"
                        . '      </xmlTitle>' . "\n"
                        . '    </el>' . "\n"
                        . '  </ROOT>' . "\n"
                        . '</T3DataStructure>',
                ],
                'ds_pointerField' => 'CType',
            ],
            'exclude' => true,
            'label' => 'flexfield',
        ],
        'typo3tests_contentelementb_json' => [
            'config' => [
                'type' => 'json',
            ],
            'exclude' => true,
            'label' => 'json',
        ],
        'typo3tests_contentelementb_datetime' => [
            'config' => [
                'type' => 'datetime',
            ],
            'exclude' => true,
            'label' => 'datetime',
        ],
        'typo3tests_contentelementb_datetime_nullable' => [
            'config' => [
                'type' => 'datetime',
                'nullable' => true,
            ],
            'exclude' => true,
            'label' => 'datetime nullable',
        ],
    ],
    'types' => [
        'typo3tests_contentelementb' => [
            'showitem' => '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,--palette--;;general,image,media,assets,typo3tests_contentelementb_collection,typo3tests_contentelementb_collection_recursive,typo3tests_contentelementb_categories_mm,typo3tests_contentelementb_categories_11,typo3tests_contentelementb_categories_1m,typo3tests_contentelementb_pages_relation,typo3tests_contentelementb_circular_relation,typo3tests_contentelementb_record_relation_recursive,typo3tests_contentelementb_pages_content_relation,typo3tests_contentelementb_pages_relations,typo3tests_contentelementb_pages_mm,typo3tests_contentelementb_folder,typo3tests_contentelementb_folder_recursive,--palette--;;typo3tests_contentelementb_palette,typo3tests_contentelementb_flexfield,typo3tests_contentelementb_json,typo3tests_contentelementb_datetime,typo3tests_contentelementb_datetime_nullable,--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,--palette--;;language,--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,--palette--;;hidden,--palette--;;access,--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,rowDescription',
            'columnsOverrides' => [
                'image' => [
                    'config' => [
                        'relationship' => 'manyToOne',
                    ],
                ],
                'typo3tests_contentelementb_collection' => [
                    'label' => 'collection',
                    'config' => [
                        'appearance' => [
                            'useSortable' => true,
                        ],
                    ],
                ],
                'typo3tests_contentelementb_collection_recursive' => [
                    'label' => 'collection_recursive',
                    'config' => [
                        'appearance' => [
                            'useSortable' => true,
                        ],
                    ],
                ],
                'typo3tests_contentelementb_categories_mm' => [
                    'label' => 'categories_mm',
                    'config' => [],
                ],
                'typo3tests_contentelementb_categories_11' => [
                    'label' => 'categories_11',
                    'config' => [],
                ],
                'typo3tests_contentelementb_categories_1m' => [
                    'label' => 'categories_1m',
                    'config' => [],
                ],
                'typo3tests_contentelementb_pages_relation' => [
                    'label' => 'pages_relation',
                    'config' => [
                        'relationship' => 'manyToOne',
                    ],
                ],
                'typo3tests_contentelementb_pages_relations' => [
                    'label' => 'pages_relations',
                    'config' => [],
                ],
                'typo3tests_contentelementb_circular_relation' => [
                    'label' => 'circular_relation',
                    'config' => [],
                ],
                'typo3tests_contentelementb_record_relation_recursive' => [
                    'label' => 'record_relation_recursive',
                    'config' => [],
                ],
                'typo3tests_contentelementb_pages_content_relation' => [
                    'label' => 'pages_content_relation',
                    'config' => [],
                ],
                'typo3tests_contentelementb_pages_mm' => [
                    'label' => 'pages_mm',
                    'config' => [],
                ],
                'typo3tests_contentelementb_folder' => [
                    'label' => 'folder',
                    'config' => [],
                ],
                'typo3tests_contentelementb_folder_recursive' => [
                    'label' => 'folder_recursive',
                    'config' => [],
                ],
                'typo3tests_contentelementb_select_single' => [
                    'config' => [
                        'items' => [
                            [
                                'label' => 'Foo 1',
                                'value' => '1',
                            ],
                            [
                                'label' => 'Foo 2',
                                'value' => '2',
                            ],
                            [
                                'label' => 'Foo 3',
                                'value' => '3',
                            ],
                        ],
                    ],
                ],
                'typo3tests_contentelementb_select_checkbox' => [
                    'label' => 'select_checkbox',
                    'config' => [
                        'renderType' => 'selectCheckBox',
                        'items' => [
                            [
                                'label' => 'Foo 1',
                                'value' => '1',
                            ],
                            [
                                'label' => 'Foo 2',
                                'value' => '2',
                            ],
                            [
                                'label' => 'Foo 3',
                                'value' => '3',
                            ],
                        ],
                    ],
                ],
                'typo3tests_contentelementb_select_single_box' => [
                    'label' => 'select_single_box',
                    'config' => [
                        'renderType' => 'selectSingleBox',
                        'items' => [
                            [
                                'label' => 'Foo 1',
                                'value' => '1',
                            ],
                            [
                                'label' => 'Foo 2',
                                'value' => '2',
                            ],
                            [
                                'label' => 'Foo 3',
                                'value' => '3',
                            ],
                        ],
                    ],
                ],
                'typo3tests_contentelementb_select_multiple' => [
                    'label' => 'select_multiple',
                    'config' => [
                        'renderType' => 'selectMultipleSideBySide',
                        'items' => [
                            [
                                'label' => 'Foo 1',
                                'value' => '1',
                            ],
                            [
                                'label' => 'Foo 2',
                                'value' => '2',
                            ],
                            [
                                'label' => 'Foo 3',
                                'value' => '3',
                            ],
                        ],
                    ],
                ],
                'typo3tests_contentelementb_select_foreign' => [
                    'label' => 'select_foreign',
                    'config' => [
                        'items' => [],
                    ],
                ],
                'typo3tests_contentelementb_select_foreign_multiple' => [
                    'label' => 'select_foreign_multiple',
                    'config' => [
                        'renderType' => 'selectMultipleSideBySide',
                        'items' => [],
                    ],
                ],
                'typo3tests_contentelementb_select_foreign_native' => [
                    'label' => 'select_foreign_native',
                    'config' => [
                        'relationship' => 'manyToOne',
                        'items' => [],
                    ],
                ],
                'typo3tests_contentelementb_flexfield' => [
                    'label' => 'flexfield',
                    'config' => [],
                ],
                'typo3tests_contentelementb_json' => [
                    'label' => 'json',
                    'config' => [],
                ],
                'typo3tests_contentelementb_datetime' => [
                    'label' => 'json',
                    'config' => [],
                ],
                'typo3tests_contentelementb_datetime_nullable' => [
                    'label' => 'json',
                    'config' => [],
                ],
            ],
        ],
    ],
    'ctrl' => [
        'typeicon_classes' => [
            'typo3tests_contentelementb' => 'tt_content-typo3tests_contentelementb-175ef6f',
        ],
        'searchFields' => 'header,header_link,subheader,bodytext,pi_flexform,typo3tests_contentelementb_flexfield,typo3tests_contentelementb_json',
    ],
];

$GLOBALS['TCA']['tt_content'] = array_replace_recursive($GLOBALS['TCA']['tt_content'], $overrides);
