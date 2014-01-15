<?php

define('AKTIF', 1);
define('NONAKTIF', 3);
define('REJECT', 5);

define('BARU', 1);
define('BEKAS', 2);

define('THEMEPATH','./assets/themes/');

define('ACTIVETHEME',getSetting('ActiveTheme'));
define('WEBSITENAME',getSetting('WebsiteName'));
define('DEFAULTVIEWTYPE', GetSetting('DefaultViewType'));
define('DEFAULTDETAILVIEW', GetSetting('DefaultDetailView'));
define('ALLOWSHARE', GetSetting('AllowShare'));
define('AUTOAPPROVE', GetSetting('AutoApprove'));


function ShowJsonError($error){
    echo json_encode(array('error'=>$error));
}

function ShowJsonSuccess($success){
    echo json_encode(array('error'=>0,'success'=>$success));
}