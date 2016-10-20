<?php
/**
 * Created by PhpStorm.
 * User: xicond
 * Date: 9/5/16
 * Time: 08:37
 */

$rules = [
    [
        'class'=>'app\components\Redirect301UrlRule',
        'verb' => 'GET',
        'pattern' => '<action:(track|contact_us)>',
        'route' => 'site/<action>',
        'suffix' => '.php',
        'mode' => 1,
        'headers' => ['X-Robots-Tag' => 'noindex']

    ],
    [
        'verb' => 'POST',
        'pattern' => '<action:(track|contact_us)>',
        'route' => 'site/<action>',
        'suffix' => '.php',
        'mode' => 1

    ],
//                'POST contact_us.php' => 'site/contact_us',
    [
        'verb' => 'POST',
        'pattern' => '<action:(track|contact_us)>',
        'route' => 'POST site/<action>',
        'suffix' => '.php',
        'mode' => 2
    ],
    [
        'verb' => 'GET',
        'pattern' => '<action:(index|track|about|contact_us)>',
        'route' => 'site/<action>',
        'suffix' => '.html',
    ],
];

return $rules;