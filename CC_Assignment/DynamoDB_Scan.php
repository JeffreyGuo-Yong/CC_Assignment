<?php

require "aws/aws-autoloader.php";
require "databaseInfo.php";

use Aws\DynamoDb\Exception\DynamoDbException;

echo "begin<br/>";

// create credentials to save access key, secret key and session token
$credentials = new Aws\Credentials\Credentials(access_key, secret_key);

echo "created credentials<br/>";

// create sdk
$sdk = new Aws\Sdk([

    'version' => 'latest',
    'region' => 'ap-southeast-2',
    'credentials' => $credentials

]);

echo "created SDK<br/>";

$dynamoDB = $sdk->createDynamoDb();

echo "created DB object<br/>";

$tableName = 'Test';

$parameters = [
    'TableName' => $tableName
];

echo "created parameters<br/>";

try {
    //$result = $dynamoDB->getItem($parameters);
    $result = $dynamoDB->scan($parameters);
} catch (DynamoDbException $e){
    echo $e->getMessage();
}

echo "got result<br/>";

foreach ($result['Items'] as $test){
    //echo $music['Artist']; -- 输出的是Array
    echo $test['ID']['S'] . "\n" . $test['name']['S'] . "\n" . $test['age']['N'] . "<br/>";
}

?>