<?php

return array(
    'guest' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Guest',
        'bizRule' => null,
        'data' => null
    ),
    'account_user' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Account User',
        'children' => array('guest'),
        'bizRule' => null,
        'data' => null
    ),
    'account_admin' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Account Administrator',
        'children' => array('account_user'),
        'bizRule' => null,
        'data' => null
    ),
    'state_admin' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'State Administrator',
        'children' => array('account_admin'),
        'bizRule' => null,
        'data' => null
    ),
);