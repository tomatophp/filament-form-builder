<?php

return [
    'forms' => [
        'section' => [
            'information' => 'Form Information',
        ],
        'title' => 'Form Builder',
        'single' => 'Form',
        'columns' => [
            'type' => 'Type',
            'method' => 'Method',
            'title' => 'Title',
            'key' => 'Key',
            'description' => 'Description',
            'endpoint' => 'Endpoint',
            'is_active' => 'Is Active',
        ],
        'fields' => [
            'title' => 'Fields',
            'single' => 'Field',
            'columns' => [
                'type' => 'Type',
                'name' => 'Name',
                'group' => 'Group',
                'default' => 'Default',
                'is_relation' => 'Is Relation',
                'relation_name' => 'Relation Name',
                'relation_column' => 'Relation Column',
                'sub_form' => 'Sub Form',
                'is_multi' => 'Is Multi',
                'has_options' => 'Has Options',
                'options' => 'Options',
                'label' => 'Label',
                'value' => 'Value',
                'placeholder' => 'Placeholder',
                'hint' => 'Hint',
                'is_required' => 'Is Required',
                'required_message' => 'Required Message',
                'has_validation' => 'Has Validation',
                'validation' => 'Validation',
                'rule' => 'Rule',
                'message' => 'Message',
            ],
            'tabs' => [
                'general' => 'General',
                'options' => 'Options',
                'validation' => 'Validation',
                'relation' => 'Relation',
                'labels' => 'Labels',
            ],
            'actions' => [
                'preview' => 'Preview',
            ],
        ],
        'requests' => [
            'title' => 'Form Requests',
            'single' => 'Request',
            'columns' => [
                'status' => 'Status',
                'description' => 'Description',
                'time' => 'Time',
                'date' => 'Date',
                'payload' => 'Payload',
                'pending' => 'Pending',
                'processing' => 'Processing',
                'completed' => 'Completed',
                'cancelled' => 'Cancelled',

            ],
        ],
    ],
];
