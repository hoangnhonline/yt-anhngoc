<?php 
$url = 'http://'.$_SERVER['SERVER_NAME'];
return [    
    'paging' => 100, // number rows for paging
    'uploads' => [
        'storage' => 'local',
        'webpath' => '/media/uploads'
    ],    

    'num_alert' => 10, // number rows for alert on top menu
    'upload_path' => public_path() . '/uploads/', // media_upload_path   
    'upload_url' => $url . '/uploads/', // image path,
    'max_size_upload' => 8000000    
];

?>
