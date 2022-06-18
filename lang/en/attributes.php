<?php

// lang/nl/attributes.php

return [
    'loc' => [
        'address' => 'Address',
        'city' => 'City',
        'postcode' => 'Postal code',

        'streetAddress' => 'Street address',
        'houseNumber' => 'House number',
    ],
    'user' => [
        'name' => 'Username',
        'email' => 'Email',
        'password' => 'Password',

        'header' => [
            'createUser' => 'New user'
        ],
        'success' => [
            'added' => 'User added'
        ],
        'error' => [
            'added' => 'User has not been added'
        ],
    ],
    'label' => [
        'barcode_id' => 'Barcode',
        'package_status' => 'Package status',
        'carrier_user_id' => 'Carrier',
        'sender_user_id' => 'Sender',
        'receiver_user_id' => 'Receiver',

        'csvUploadInput' => 'Select a CSV file',

        'sender' => 'Sender',
        'receiver' => 'Receiver',
        'address' => 'address',

        'header' => [
            'uploadCSV' => 'Upload CSV file'
        ],
        'success' => [
            'added' => 'Label/labels added'
        ],
        'error' => [
            'added' => 'Label/labels have not been added'
        ],
    ],
    'role' => [
        'name' => 'Role',

        'superAdmin' => 'Super admin',
        'sender' => 'Sender',
        'packer' => 'Packer',
        'receiver' => 'Receiver'
    ],
    'packageStatus' => [
        'registered' => 'Registered',
        'sortingCenter' => 'At sorting center',
        'onTheWay' => 'On the way',
        'delivered' => 'Delivered',
        'registeredForPickUp' => 'Registered for pick up',
    ]
];
