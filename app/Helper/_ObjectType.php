<?php
/**
 * Created by PhpStorm.
 * User: quanvu
 * Date: 2019-05-02
 * Time: 13:34
 */

namespace App\Helper;


class _ObjectType
{
    // Meta product type
    const META_PRODUCT_MULTIPLE = 1;
    const META_PRODUCT_YESNO = 2;
    const META_PRODUCT_TEXT = 3;
    const META_PRODUCT_COLOR = 4;
    const META_PRODUCT_FONT = 5;
    const META_PRODUCT_FORALL = 6;

    // option of Meta product type
    const OPTION_PRODUCT_NORMAL = 1;
    const OPTION_PRODUCT_IMAGE = 2;
    const OPTION_PRODUCT_TEXT = 3;
    const OPTION_PRODUCT_NUMBER = 4;
    const OPTION_PRODUCT_RADIO = 5;
    const OPTION_PRODUCT_COLOR = 6;
    const OPTION_PRODUCT_FONT = 7;


    //status for order
    const ORDER_STT_NEW = 1;
    const ORDER_STT_FOUND = 2;
    const ORDER_STT_TEMPLATE = 3;
    const ORDER_STT_PRODUCE = 4;
    const ORDER_STT_DELIVER = 5;
    const ORDER_STT_RECEIVED = 6;
    const ORDER_STT_FINISH = 7;
    const ORDER_STT_CANCEL = 8;

    const ORDER_STT_SUGGEST = 10;
    const ORDER_STT_NON_SUGGEST = 11;
    const ORDER_STT_MORE_SUGGEST = 12;
    const ORDER_STT_CHOOSED_SUGGEST = 13;

    const ORDER_STT_SUP_RECEIVED = 20;
    const ORDER_STT_SUP_FEEDBACK = 21;
    const ORDER_STT_SUP_ACCEPT = 22;
    const ORDER_STT_SUP_NOTACCEPT = 23;
    const ORDER_STT_CHOOSED_SUP = 24;

    const ORDER_STT_PREPARE_PRODUCT = 30;
    const ORDER_STT_RECEIVED_PRODUCT = 31;
    const ORDER_STT_STORED_PRODUCT = 32;
    const ORDER_STT_DELIVER_PRODUCT = 33;
    const ORDER_STT_DELIVER_SUCCESS = 34;

    //type of order detail
    const ORDER_DETAIL_SUGGEST = 1;
    const ORDER_DETAIL_SALE = 2;
    const ORDER_DETAIL_SHIPPER = 3;

    //status of order detail
    const ORDER_DETAIL_NEW = 1;
    const ORDER_DETAIL_PROCESS = 2;
    const ORDER_DETAIL_ACCEPT = 3;
    const ORDER_DETAIL_REJECT = 4;
    const ORDER_DETAIL_RESOLVE = 5;
    const ORDER_DETAIL_FEEDBACK = 6;
    const ORDER_DETAIL_INSPECT = 7;
    const ORDER_DETAIL_CHOOSED = 8;
    const ORDER_DETAIL_CLOSED = 9;


    //user role for permission
    const ROLE_USER_SP_ADMIN = 'super-admin';
    const ROLE_USER_ADMIN = 'admin';
    const ROLE_USER_MOD = 'moderator';
    const ROLT_USER_NORMAL = 'normal';
    const ROLE_USER_SUPLLIER = 'supplier';
    const ROLE_USER_DEMANDER = 'demander';

    //key of supplier info
    const KEY_GENERAL_INFO = 'GeneralInfo';
    const KEY_BUSINESS_OWNER = 'BusinessOwner';
    const KEY_ORDER_PROCESS = 'OderProcess';
    const KEY_SERVICE = 'Service';
    const KEY_ADVANCE_INFO = 'AdvanceInfo';
    const KEY_ORDER_PASS = 'OrderPassed';
    const KEY_BANK_ACCOUNT = 'bankAccount';
    const KEY_PRODUCT = 'Product';

    //url web supplier
    const URL_WEB_SUPPLIER = 'https://factory.alium.vn';
    const PATH_MANAGER_ORDER = '/order/management/all';

    // key of user detail
    const KEY_SALE = 'sale';
    const KEY_SOURCE = 'source';
    const KEY_NOTE = 'note';

    // key source
    const sources = [
        'Zalo',
        'Facebook',
        'Instagram',
        'Google',
        'Linkedin',
        'Khác'
    ];

    // reason cancel order
    const REASON_CANCEL = [
        'Test',
        'Buyer',
        'Supplier',
        'System',
        'Khác'
    ];
}