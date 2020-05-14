<?php

require "aws/aws-autoloader.php";
require "databaseInfo.php";

use Aws\DynamoDb\Exception\DynamoDbException;
date_default_timezone_set("Australia/Melbourne");

$credentials = new Aws\Credentials\Credentials(access_key, secret_key);

$sdk = new Aws\Sdk(
    [
        'version' => 'latest',
        'region' => 'ap-southeast-2',
        'credentials' => $credentials
    ]
);

$dynamoDB = $sdk->createDynamoDb();
$marshaler = new Aws\DynamoDb\Marshaler();

$tableName = 'Test';
$date = date('Y-m-d H:i:s');
echo $date;

$item = $marshaler->marshalJson('{
    "ID" : "6",
    "name" : "Emily",
    "age" : 20,
    "major" : "IT",
    "date" : "' . $date . '"
}');

$parameters = [
    'TableName' => $tableName,
    'Item' => $item
];

try {
    $result = $dynamoDB->putItem($parameters);
} catch (DynamoDbException $e) {
    echo $e->getMessage() . "\n";
}

?>

