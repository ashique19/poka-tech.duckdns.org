<?php

/*
| Screen ids for /mockups/{slug}/{screen} (local/testing). Used by the capture script.
*/
return [
    'accounting' => [
        'screens' => ['dashboard', 'invoices', 'ledger', 'pl-report'],
        'mobile' => true,
        'desktop' => true,
    ],
    'logistics' => [
        'screens' => ['dashboard', 'shipments', 'dispatch', 'delivery-report'],
        'mobile' => true,
        'desktop' => true,
    ],
    'crm' => [
        'screens' => ['pipeline', 'contacts', 'deal', 'activities'],
        'mobile' => true,
        'desktop' => true,
    ],
    'hrm' => [
        'screens' => ['roster', 'leave', 'profile', 'payroll'],
        'mobile' => true,
        'desktop' => true,
    ],
    'pos' => [
        'screens' => ['register', 'checkout', 'stock', 'eod'],
        'mobile' => true,
        'desktop' => true,
    ],
    'erp' => [
        'screens' => ['hub', 'purchasing', 'inventory', 'finance'],
        'mobile' => true,
        'desktop' => true,
    ],
    'ecommerce' => [
        'screens' => ['shop', 'product', 'checkout', 'orders'],
        'mobile' => true,
        'desktop' => true,
    ],
    'android' => [
        'screens' => ['home', 'orders', 'scan', 'profile'],
        'mobile' => true,
        'desktop' => false,
    ],
    'game' => [
        'screens' => ['play', 'menu', 'scores'],
        'mobile' => true,
        'desktop' => true,
    ],
];
