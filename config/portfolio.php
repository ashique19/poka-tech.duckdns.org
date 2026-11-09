<?php

/*
| Poka Tech content. Edit this file to change case studies, samples, and contact.
| UI chrome lives in lang/en/portfolio.php and lang/ar/portfolio.php.
|
| theme: theme-1 | theme-2 | theme-3   (one switch for the accent)
| logo:  concept-1 | concept-2 | concept-3
| Default brand: concept-2 + theme-2 (indigo). See the README.
|
| Do not add prices, testimonials, client logos, or result metrics.
| WhatsApp and the contact mailbox come from the environment.
*/

$t = static fn (string $en, string $ar): array => ['en' => $en, 'ar' => $ar];

$shot = static function (string $src, int $width, int $height, string $captionEn, string $captionAr) use ($t): array {
    return [
        'src' => $src,
        'width' => $width,
        'height' => $height,
        'caption' => $t($captionEn, $captionAr),
        'alt' => $t($captionEn, $captionAr),
    ];
};

$pair = static function (string $base, string $captionEn, string $captionAr) use ($shot): array {
    return [
        $shot($base.'-desktop.webp', 1440, 900, $captionEn.' — desktop', $captionAr.' — سطح المكتب'),
        $shot($base.'-mobile.webp', 390, 844, $captionEn.' — mobile', $captionAr.' — الجوال'),
    ];
};

return [
    'studio' => [
        'name' => 'Poka Tech',
        'founder' => 'Ashiqul Islam',
        'github' => 'https://github.com/ashique19',
        'years' => 15,
        'domain' => 'poka-tech.duckdns.org',
    ],

    'locales' => ['en', 'ar'],

    // Default accent theme (indigo). One value switches the accent.
    'theme' => env('PORTFOLIO_THEME', 'theme-2'),
    'logo' => env('PORTFOLIO_LOGO', 'concept-2'),

    'themes' => [
        'theme-1' => ['label' => 'Teal', 'accent' => '#0F5F58'],
        'theme-2' => ['label' => 'Indigo', 'accent' => '#1E3A8A'],
        'theme-3' => ['label' => 'Clay', 'accent' => '#7C2D12'],
    ],

    'logos' => ['concept-1', 'concept-2', 'concept-3'],

    'contact' => [
        'whatsapp' => env('WHATSAPP_NUMBER', '8801785636359'),
        'email' => env('CONTACT_EMAIL', 'ashique19@gmail.com'),
    ],

    'service_keys' => [
        'websites',
        'ecommerce',
        'accounting',
        'logistics',
        'crm',
        'hrm',
        'pos',
        'erp',
        'android',
        'games',
        'custom',
    ],

    'case_studies' => [
        [
            'slug' => 'zatca-e-invoicing',
            'name' => $t('ZATCA e-invoicing', 'الفوترة الإلكترونية (ZATCA)'),
            'summary' => $t(
                'A multi-tenant invoicing foundation for the Saudi market, with a ZATCA-oriented e-invoicing module. The repository says this is not a certification.',
                'أساس فوترة متعدد المستأجرين للسوق السعودي، مع وحدة موجّهة إلى الفوترة الإلكترونية لدى هيئة الزكاة. المستودع ينص على أن هذا ليس اعتمادًا.'
            ),
            'problem' => $t(
                'Saudi businesses need invoicing software that can move toward ZATCA e-invoicing, including more than one tenant on the same product. The public repository is a development foundation for that, with an isolated module for e-invoicing primitives. It states that nothing in the repository claims ZATCA certification or guaranteed compliance.',
                'تحتاج الأعمال في السعودية إلى برنامج فوترة يمكنه الاتجاه نحو الفوترة الإلكترونية لهيئة الزكاة، مع أكثر من مستأجر على المنتج نفسه. المستودع العام أساس تطوير لذلك، مع وحدة منفصلة لأساسيات الفوترة الإلكترونية. وينص على أنه لا يدّعي اعتماد هيئة الزكاة ولا يضمن الامتثال.'
            ),
            'built' => [
                'en' => [
                    'Single-database multi-tenancy, with a tenant scope on tenant-owned records.',
                    'English and Arabic interfaces, with right-to-left layout for Arabic.',
                    'A café storefront (home and menu) for the Fancy Coffee tenant, plus separate platform and tenant logins.',
                    'A point of sale: terminal, order history, end of day, and a simplified invoice when checkout runs.',
                    'A ZATCA-oriented module: UBL invoices (standard, simplified, credit and debit notes), an invoice hash chain, a QR code for the first tags, and a simulation client. The README marks XML signing as a stub and says the hash and some QR tags are still open.',
                    'Issued invoices stay immutable. Corrections go through credit and debit notes.',
                    'A theme export that can pack a tenant storefront for use outside the SaaS.',
                ],
                'ar' => [
                    'تعدد مستأجرين على قاعدة واحدة، مع نطاق مستأجر على سجلاته.',
                    'واجهات بالإنجليزية والعربية، مع اتجاه من اليمين إلى اليسار للعربية.',
                    'واجهة مقهى (الرئيسية والقائمة) لمستأجر Fancy Coffee، مع دخول منفصل للمنصة وللمستأجر.',
                    'نقطة بيع: الشاشة، سجل الطلبات، إقفال اليوم، وفاتورة مبسّطة عند الدفع.',
                    'وحدة موجّهة إلى زاتكا: فواتير UBL (قياسية ومبسّطة وإشعارات دائن ومدين)، وسلسلة تجزئة للفاتورة، ورمز QR للوسوم الأولى، وعميل محاكاة. يصف الملف README التوقيع بأنه غير مكتمل، ويترك التجزئة وبعض وسوم QR مفتوحة.',
                    'الفواتير المُصدرة لا تُعدَّل. التصحيح يتم بإشعار دائن أو مدين.',
                    'تصدير سمة يمكنه حزم واجهة المستأجر للاستخدام خارج المنتج.',
                ],
            ],
            'stack' => [
                'en' => [
                    'PHP 8.3',
                    'Laravel 13',
                    'Livewire 3',
                    'Tailwind CSS 4',
                    'Vite',
                    'Pest',
                    'SQLite by default; MySQL and PostgreSQL via environment',
                    'Spatie Laravel Permission',
                ],
                'ar' => [
                    'PHP 8.3',
                    'Laravel 13',
                    'Livewire 3',
                    'Tailwind CSS 4',
                    'Vite',
                    'Pest',
                    'SQLite افتراضيًا؛ وMySQL وPostgreSQL عبر الإعداد',
                    'Spatie Laravel Permission',
                ],
            ],
            'notes' => $t(
                'First tenant: Fancy Coffee. The repository includes a Fancy Coffee demo tenant, a café theme, and a requirements-traceability note for a Fancy Coffee proposal. Screenshots on this page were taken from a local run of that repository after VAT, commercial registration, street address, phone, map coordinates, and customer records were replaced with dummy values.',
                'أول مستأجر: Fancy Coffee. يتضمن المستودع مستأجرًا تجريبيًا باسم Fancy Coffee، وسمة مقهى، وملاحظة تتبع لمتطلبات عرض Fancy Coffee. لقطات هذه الصفحة من تشغيل محلي للمستودع بعد استبدال ضريبة القيمة المضافة والسجل التجاري والعنوان والهاتف وإحداثيات الخريطة وسجلات العملاء بقيم تجريبية.'
            ),
            'demo_url' => null,
            'links' => [
                [
                    'label' => $t('Source repository', 'المستودع'),
                    'url' => 'https://github.com/ashique19/zatca',
                ],
                [
                    'label' => $t('ZATCA e-invoicing portal', 'بوابة الفوترة الإلكترونية'),
                    'url' => 'https://zatca.gov.sa/en/E-Invoicing/Pages/default.aspx',
                ],
            ],
            'screenshots' => array_merge(
                $pair(
                    'images/work/zatca/storefront-home',
                    'Café storefront home. Captured from the ZATCA repository.',
                    'الصفحة الرئيسية لواجهة المقهى. من مستودع زاتكا.'
                ),
                $pair(
                    'images/work/zatca/storefront-menu',
                    'Café menu. Captured from the ZATCA repository.',
                    'قائمة المقهى. من مستودع زاتكا.'
                ),
                $pair(
                    'images/work/zatca/pos-terminal',
                    'Point of sale terminal. Captured from the ZATCA repository.',
                    'شاشة نقطة البيع. من مستودع زاتكا.'
                ),
                $pair(
                    'images/work/zatca/order-history',
                    'Order history. Captured from the ZATCA repository.',
                    'سجل الطلبات. من مستودع زاتكا.'
                ),
                $pair(
                    'images/work/zatca/dashboard',
                    'Point of sale home. Captured from the ZATCA repository.',
                    'الصفحة الرئيسية لنقطة البيع. من مستودع زاتكا.'
                ),
            ),
            'shot_source' => 'app',
        ],
        [
            'slug' => 'academia-training',
            'name' => $t('Academia Training', 'Academia Training'),
            'summary' => $t(
                'A public site and admin foundation for a European professional training platform. The repository describes this as the early phases: foundation, data, and the public site.',
                'موقع عام وأساس لوحة إدارة لمنصة تدريب مهني أوروبية. يصف المستودع هذا بأنه المراحل الأولى: الأساس والبيانات والموقع العام.'
            ),
            'problem' => $t(
                'A European professional training business needed a public catalogue, a schedule across cities, and two lead paths that stay separate: one for companies and one for individual learners. The repository is built to a written specification and covers the foundation, the data model, and the public site.',
                'احتاج نشاط تدريب مهني أوروبي إلى فهرس عام، وجدول عبر مدن، ومسارين للطلبات لا يختلطان: واحد للشركات وواحد للمتدربين. بُني المستودع وفق مواصفة مكتوبة ويغطي الأساس ونموذج البيانات والموقع العام.'
            ),
            'built' => [
                'en' => [
                    'A public site with a home page, a faceted catalogue, course pages, a schedule (list and calendar), city and country pages, corporate and online pages, offers, an FAQ, a glossary, an about page, legal pages, and a thank-you page.',
                    'Livewire pieces named in the README: catalogue, schedule browser, corporate inquiry, registration, and search.',
                    'A Filament admin panel, with roles and permissions.',
                    'GDPR tools named in the README: consent on lead rows, an export command, and a forget command.',
                    'The README says later phases are not in this build: public blog routes, notifications and mail, reports and exports, payment, learner and corporate portals, an LMS, sitemap generation, and a media library on the public pages.',
                ],
                'ar' => [
                    'موقع عام: الصفحة الرئيسية، فهرس بمرشّحات، صفحات الدورات، جدول (قائمة وتقويم)، صفحات المدن والدول، صفحات الشركات والتدريب عبر الإنترنت، العروض، الأسئلة الشائعة، المسرد، من نحن، صفحات قانونية، وصفحة شكر.',
                    'مكوّنات Livewire يذكرها الملف README: الفهرس، متصفّح الجدول، استفسار الشركات، التسجيل، والبحث.',
                    'لوحة Filament، مع أدوار وصلاحيات.',
                    'أدوات GDPR يذكرها الملف README: موافقة على صفوف الطلبات، وأمر تصدير، وأمر حذف.',
                    'يقول الملف README إن المراحل اللاحقة ليست في هذا البناء: مدونة عامة، والتنبيهات والبريد، والتقارير والتصدير، والدفع، وبوابات المتدربين والشركات، ونظام تعلم، وتوليد خريطة موقع، ومكتبة وسائط على الصفحات العامة.',
                ],
            ],
            'stack' => [
                'en' => [
                    'PHP 8.3',
                    'Laravel 12',
                    'Livewire 3',
                    'Filament 4',
                    'Tailwind CSS 4',
                    'Vite',
                    'Pest',
                    'SQLite by default; PostgreSQL recommended; MySQL 8 supported',
                ],
                'ar' => [
                    'PHP 8.3',
                    'Laravel 12',
                    'Livewire 3',
                    'Filament 4',
                    'Tailwind CSS 4',
                    'Vite',
                    'Pest',
                    'SQLite افتراضيًا؛ وPostgreSQL موصى به؛ وMySQL 8 مدعوم',
                ],
            ],
            'notes' => $t(
                'The repository README says Academia Training Solutions is a trade name of SlimCijfers Analytics B.V. Screenshots were taken from a local run seeded with dummy courses, not the imported catalogue.',
                'يقول الملف README إن Academia Training Solutions اسم تجاري لـ SlimCijfers Analytics B.V. اللقطات من تشغيل محلي ببيانات دورات تجريبية، لا من الفهرس المستورد.'
            ),
            'demo_url' => null,
            'links' => [
                [
                    'label' => $t('Source repository', 'المستودع'),
                    'url' => 'https://github.com/ashique19/academia',
                ],
            ],
            'screenshots' => array_merge(
                $pair(
                    'images/work/academia/home',
                    'Public home. Captured from the Academia repository with dummy data.',
                    'الصفحة الرئيسية العامة. من مستودع Academia ببيانات تجريبية.'
                ),
                $pair(
                    'images/work/academia/catalogue',
                    'Course catalogue. Captured from the Academia repository with dummy data.',
                    'فهرس الدورات. من مستودع Academia ببيانات تجريبية.'
                ),
                $pair(
                    'images/work/academia/course',
                    'Course page. Captured from the Academia repository with dummy data.',
                    'صفحة دورة. من مستودع Academia ببيانات تجريبية.'
                ),
                $pair(
                    'images/work/academia/schedule',
                    'Schedule. Captured from the Academia repository with dummy data.',
                    'الجدول. من مستودع Academia ببيانات تجريبية.'
                ),
                $pair(
                    'images/work/academia/corporate',
                    'Corporate training page. Captured from the Academia repository with dummy data.',
                    'صفحة تدريب الشركات. من مستودع Academia ببيانات تجريبية.'
                ),
            ),
            'shot_source' => 'app',
        ],
    ],

    'samples' => [
        'accounting' => ['kind' => $t('accounting software', 'برامج المحاسبة')],
        'logistics' => ['kind' => $t('logistics software', 'برامج اللوجستيات')],
        'crm' => ['kind' => $t('CRM software', 'برامج إدارة العملاء')],
        'hrm' => ['kind' => $t('HRM software', 'برامج الموارد البشرية')],
        'pos' => ['kind' => $t('store and POS software', 'برامج المتجر ونقاط البيع')],
        'erp' => ['kind' => $t('ERP software', 'برامج تخطيط الموارد')],
        'ecommerce' => ['kind' => $t('an online store', 'متجر إلكتروني')],
        'android' => ['kind' => $t('an Android app', 'تطبيق أندرويد')],
        'game' => ['kind' => $t('a web game', 'لعبة ويب')],
    ],
];
