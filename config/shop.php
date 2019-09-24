<?php

return [
    'shipping_token' => env('SHIPPING_API_TOKEN'),
    'name' => env('SHOP_NAME', 'Atlantic Group LLC'),
    'country' => env('SHOP_COUNTRY_ISO', 'RU'),
    'country_id' => env('SHOP_COUNTRY_ID', +7),
    'weight' => env('SHOP_WEIGHT', 'kg'),
    'email' => env('SHOP_EMAIL', 'autocheb.usa@gmail.com'),
    'phone' => env('SHOP_PHONE', '+79373905551'),
    'inn' => env('SHOP_INN', '2124043106'),
    'ogrn' => env('SHOP_OGRN', '1162130068528'),
    'site' => env('SHOP_SITE', 'auto-iz-usa.com'),
    'youtube' => env('SHOP_YOUTUBE', 'https://www.youtube.com/channel/UCz8Z0GATVi8aB6JgpScCn-Q?view_as=subscriber'),
    'vk' => env('SHOP_VK', 'https://vk.com/clubautoizusa'),
    'skype' => env('SHOP_SKYPE', 's31sega'),
    'address' => env('SHOP_ADDRESS', '429950 г. Новочебоксарск ул. Промышленная, д. 49'),
    'warehouse' => [
        'address_1' => 'ул. Промышленная, д. 49',
        'address_2' => '',
        'state' => '',
        'city' => 'Новочебоксарск',
        'country' => 'RU',
        'zip' => '429950',
    ]
];