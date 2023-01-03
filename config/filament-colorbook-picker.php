<?php

return [


    /*
     * Default option limit for the colorbook picker dropdown. A long list of options may
     * affect performance. This does not affect search ability when using the searchable
     * parameter. set integer value or null for a default value of 50
     */

    'option_limit' => 25,


    // WIP: Set a default color book to use for the colorbook picker

    'default_color_book' => [
        ['label' => 'Color Display Name 1', 'value' => 'color_value_name_1', 'hex' => 'FFFFFF'],
        ['label' => 'Color Display Name 2', 'value' => 'color_value_name_2', 'hex' => '000000'],
        ['label' => 'Color Display Name 3', 'value' => 'color_value_name_3', 'hex' => '111111'],
        ['label' => 'Color Display Name 4', 'value' => 'color_value_name_4', 'hex' => '222222'],
    ],


];
