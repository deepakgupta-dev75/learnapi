<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\SecretsManager\SecretsManagerClient;
use Exception;

class AWSController extends Controller
{
    protected $access_key_id;
    protected $secret_access_key;
    protected $region;
    protected $s3_bucket_name;
    protected $s3Client;
    protected $secretsManagerClient;

    public function __construct()
    {
        $this->access_key_id = getenv('AWS_ACCESS_KEY_ID');
        $this->secret_access_key = getenv('AWS_SECRET_ACCESS_KEY');
        $this->region = getenv('AWS_DEFAULT_REGION');
        $this->s3_bucket_name = getenv('S3_BUCKET_NAME');

        $sharedData = [
            'region' => $this->region,
            'version' => 'latest',
            'credentials' => [
                'key' => $this->access_key_id,
                'secret' => $this->secret_access_key,
            ],
        ];

        $this->s3Client = new S3Client($sharedData);
        $this->secretsManagerClient = new SecretsManagerClient($sharedData);
    }

    public function uploadFileToS3($filePath, $key)
    {
        try {
            $result = $this->s3Client->putObject([
                'Bucket' => $this->s3_bucket_name,
                'Key' => $key,
                'SourceFile' => $filePath,
            ]);
            return $this->sendResponse($result);
        } catch (AwsException $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function getSecret($secretName)
    {
        try {
            $result = $this->secretsManagerClient->getSecretValue([
                'SecretId' => $secretName,
            ]);
            if (isset($result['SecretString'])) {
                return $this->sendResponse($result['SecretString']);
            } else {
                return $this->sendResponse(base64_decode($result['SecretBinary']));
            }
        } catch (AwsException $e) {
            return $this->sendError($e->getMessage());
        }
    }



}