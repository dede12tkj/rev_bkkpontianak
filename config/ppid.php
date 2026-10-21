<?php

return [
    // Alamat website PPID (sudah dipisah dari website ini). Dipakai untuk menu PPID dan redirect URL lama.
    'url' => rtrim(env('PPID_URL', 'https://ppid.bkkpontianak.com'), '/'),
];
