<?php
/**
 * @see https://github.com/artesaos/seotools
 */

return [
    'meta' => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => "Alium ứng dụng kết nối trực tiếp xưởng may tới khách hàng!", // set false to total remove
            'titleBefore'  => false, // Put defaults.title before page title, like 'It's Over 9000! - Dashboard'
            'description'  => 'Alium ứng dụng kết nối trực tiếp xưởng may tới khách hàng', // set false to total remove
            'separator'    => ' - ',
            'keywords'     => ['Alium'],
            'canonical'    => null, // Set null for using Url::current(), set false to total remove
            'robots'       => 'all', // Set to 'all', 'none' or any combination of index/noindex and follow/nofollow
        ],
        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
        ],
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => 'Alium ứng dụng kết nối trực tiếp xưởng may tới khách hàng', // set false to total remove
            'description' => 'Alium ứng dụng kết nối trực tiếp xưởng may tới khách hàng', // set false to total remove
            'url'         => null, // Set null for using Url::current(), set false to total remove
            'type'        => 'article',
            'site_name'   => 'Alium',
            'images'      => ['https://alium.com.vn/img/alium-feature.jpeg'],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            //'card'        => 'summary',
            //'site'        => '@LuizVinicius73',
        ],
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            'title'       => 'Alium ứng dụng kết nối trực tiếp xưởng may tới khách hàng', // set false to total remove
            'description' => 'Alium ứng dụng kết nối trực tiếp xưởng may tới khách hàng', // set false to total remove
            'url'         => null, // Set null for using Url::current(), set false to total remove
            'type'        => 'WebPage',
            'images'      => ['https://alium.com.vn/img/alium-feature.jpeg'],
        ],
    ],
];
