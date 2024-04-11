<?php

return [
    'rju' => [
        [
            'type' => "text",
            'value' => "",
            'label' => "Nama / Instansi",
            'key' => "name",
        ],
        [
            'type' => "textarea",
            'value' => "",
            'label' => "Alamat (Lengkap Sesuai KTP)",
            'key' => "address",
        ],
        [
            'type' => "number",
            'value' => "",
            'label' => "Nomor WhatsApp",
            'key' => "phone",
        ],
        [
            'type' => "dropdown",
            'value' => "",
            'label' => "Peruntukan RJU",
            'key' => "purpose",
            'options' => [
                'Makanan / Minuman', 'Fotocopy', 'Banner', 'Kegiatan Promosi', 'Test Drive Kendaraan',
                'Kotak Brosur', 'Iklan Produk', 'Gerai ATM'
            ],
        ],
        [
            'type' => "view",
            'label' => "Informasi CP 0895807713939",
        ]
    ],
    'pap' => [
        [
            'type' => "textarea",
            'value' => "",
            'label' => "Alamat",
            'key' => "address",
        ],
        [
            'type' => "text",
            'value' => "",
            'label' => "Pekerjaan",
            'key' => "job",
        ],
        [
            'type' => "text",
            'value' => "",
            'label' => "Jenis Usaha",
            'key' => "business_classification",
        ],
        [
            'type' => "textarea",
            'value' => "",
            'label' => "Tempat Usaha",
            'key' => "business_location",
        ],
        [
            'type' => "view",
            'label' => "Informasi CP 0895807713939",
        ]
    ]
];