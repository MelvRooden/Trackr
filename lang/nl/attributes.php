<?php

// lang/nl/attributes.php

return [
    'loc' => [
        'address' => 'Adres',
        'city' => 'Plaats',
        'postcode' => 'Postcode',

        'streetAddress' => 'Straat',
        'houseNumber' => 'Huisnummer',
    ],
    'user' => [
        'name' => 'Gebruikersnaam',
        'email' => 'Email',
        'password' => 'Wachtwoord',

        'header' => [
            'createUser' => 'Nieuwe gebruiker'
        ],
        'success' => [
            'added' => 'Gebruiker toegevoegd'
        ],
        'error' => [
            'added' => 'Gebruiker is niet toegevoegd'
        ],
    ],
    'label' => [
        'barcode_id' => 'Barcode',
        'package_status' => 'Pakket status',
        'carrier_user_id' => 'Courier',
        'sender_user_id' => 'Verzender',
        'receiver_user_id' => 'Ontvanger',

        'csvUploadInput' => 'Selecteer een CSV bestand',

        'sender' => 'Sender',
        'receiver' => 'Receiver',
        'address' => 'address',

        'header' => [
            'uploadCSV' => 'Upload CSV bestand'
        ],
        'success' => [
            'added' => 'Label/labels toegevoegd'
        ],
        'error' => [
            'added' => 'Label/labels niet toegevoegd'
        ],
    ],
    'role' => [
        'name' => 'Rol',

        'superAdmin' => 'Super admin',
        'sender' => 'Verzender',
        'packer' => 'Inpakker',
        'receiver' => 'Ontvanger'
    ],
    'packageStatus' => [
        'registered' => 'Geregistreerd',
        'sortingCenter' => 'Bij verdeel center',
        'onTheWay' => 'Onderweg',
        'delivered' => 'Bezorgd',
        'registeredForPickUp' => 'Geregistreerd voor ophalen',

        'name' => 'Pakketstatus',
        'any' => 'Alle',
    ],
    'review' => [
        'rating' => 'Beoordeling',
        'comment' => 'Opmerking',

        'leaveReview' => 'Laat een beoordeling achter'
    ]
];
