<?php

define('THEMEPATH','./assets/themes/');

define('ACTIVETHEME',getSetting('ActiveTheme'));
define('WEBSITENAME',getSetting('WebsiteName'));
define('DEFAULTVIEWTYPE', GetSetting('DefaultViewType'));
define('DEFAULTDETAILVIEW', GetSetting('DefaultDetailView'));
define('ALLOWSHARE', GetSetting('AllowShare'));


function ShowJsonError($error){
    echo json_encode(array('error'=>$error));
}

function ShowJsonSuccess($success){
    echo json_encode(array('error'=>0,'success'=>$success));
}