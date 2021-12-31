<?php

use Berkayk\OneSignal\OneSignalFacade;

/**
 * @param  array $data
 *
 * @return  bool
 */
function sendPushNotification(array $data): bool
{
    $parameters = [
        'headings'           => [
            'en' => $data['heading'],
        ],
        'contents'           => [
            'en' =>  $data['description'],
        ],
        'include_player_ids' => $data['player_ids'],
    ];

    OneSignalFacade::sendNotificationCustom($parameters);

    return true;
} 

