<?php

declare(strict_types=1);

use TelegramOSINT\Client\InfoObtainingClient\Models\UserInfoModel;
use TelegramOSINT\Scenario\UserContactsScenario;

require_once __DIR__.'/../vendor/autoload.php';

// here we get contact list and get contact online status
// avatars are saved to current directory

if (!isset($argv[1])) {
    echo "please specify numbers (comma-separated): 79061231231,79061231232\n";
    exit(1);
}

$numbers = explode(',', $argv[1]);

$onComplete = function (UserInfoModel $model) {
    $photo_file = '';
    if ($model->photo){
        $photo_file = $model->phone.'.'.$model->photo->format;
        file_put_contents(
            $photo_file,
            $model->photo->bytes
        );
    }
    echo implode("\t|\t", [
        $model->phone,
        $model->username,
        $model->firstName,
        $model->lastName,
        $photo_file,
        $model->bio,
        $model->commonChatsCount,
        $model->langCode,
        '',
    ]);

    if ($model->status->was_online)
        echo date('Y-m-d H:i:s', $model->status->was_online)."\n";
    elseif ($model->status->is_hidden)
        echo "Hidden\n";
    elseif ($model->status->is_online)
        echo "Online\n";
    else
        echo "\n";
};

echo "Phone\t|\tUsername\t|\tFirst name\t|\tLast name\t|\tPhoto\t|\tAbout\t|\tCommon chats\t|\tLang\t|\tWas online\n\n";
$client = new UserContactsScenario(
    $numbers,
    $onComplete
);
/* @noinspection PhpUnhandledExceptionInspection */
$client->startActions();
