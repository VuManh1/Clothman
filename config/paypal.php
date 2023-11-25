<?php

return [
    'client_id' => env('PAYPAL_CLIENT_ID'),
    'secret' => env('PAYPAL_SECRET'),
    'settings' => [
        'mode' => env('PAYPAL_MODE'),
        // Thời gian của một kết nối (tính bằng giây)
        'http.ConnectionTimeOut' => 30,
        'log.logEnabled' => true,
        // Đường dẫn đền file sẽ ghi log
        'log.FileName' => storage_path() . '/logs/paypal.log',
        // Kiểu log
        'log.LogLevel' => 'FINE'
    ],
];
