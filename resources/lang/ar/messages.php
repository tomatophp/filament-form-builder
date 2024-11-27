<?php

return [
    'forms' => [
        'section' => [
            'information' => 'تفاصيل النموذج',
        ],
        'title' => 'منشيء النماذج',
        'single' => 'نموذج',
        'columns' => [
            'type' => 'النوع',
            'method' => 'الطريقة',
            'title' => 'العنوان',
            'key' => 'المفتاح',
            'description' => 'الوصف',
            'endpoint' => 'الرابط',
            'is_active' => 'نشط',
        ],
        'fields' => [
            'title' => 'الحقول',
            'single' => 'حقل',
            'columns' => [
                'type' => 'النوع',
                'name' => 'الاسم',
                'group' => 'المجموعة',
                'default' => 'القيمة الافتراضية',
                'is_relation' => 'علاقة',
                'relation_name' => 'اسم العلاقة',
                'relation_column' => 'عمود العلاقة',
                'sub_form' => 'نموذج فرعي',
                'is_multi' => 'متعدد',
                'has_options' => 'لديه خيارات',
                'options' => 'الخيارات',
                'label' => 'التسمية',
                'value' => 'القيمة',
                'placeholder' => 'النص البديل',
                'hint' => 'تلميح',
                'is_required' => 'مطلوب',
                'required_message' => 'رسالة الخطأ',
                'has_validation' => 'لديه تحقق',
                'validation' => 'التحقق',
                'rule' => 'القاعدة',
                'message' => 'الرسالة',
            ],
            'tabs' => [
                'general' => 'عام',
                'options' => 'الخيارات',
                'validation' => 'التحقق',
                'relation' => 'العلاقة',
                'labels' => 'التسميات',
            ],
            'actions' => [
                'preview' => 'معاينة',
            ],
        ],
        'requests' => [
            'title' => 'طلبات النموذج',
            'single' => 'طلب',
            'columns' => [
                'status' => 'الحالة',
                'description' => 'الوصف',
                'time' => 'الوقت',
                'date' => 'التاريخ',
                'payload' => 'الرسالة',
                'pending' => 'قيد الانتظار',
                'processing' => 'جاري المعالجة',
                'completed' => 'تم الانتهاء',
                'cancelled' => 'تم الإلغاء',

            ],
        ],
    ],
];
