# KlippaOCRAPI\PublicKeyApi

All URIs are relative to *https://custom-ocr.klippa.com/api/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**createPublicKey**](PublicKeyApi.md#createPublicKey) | **POST** /publicKey | Create a public key.
[**publicKeyInfo**](PublicKeyApi.md#publicKeyInfo) | **GET** /publicKey | Get information about the public key.
[**publicKeyInfoByID**](PublicKeyApi.md#publicKeyInfoByID) | **GET** /publicKey/{PublicKeyID} | Get information about the public key by a public key ID.



## createPublicKey

> \KlippaOCRAPI\Model\CreatePublicKeyBody createPublicKey($body)

Create a public key.

The public key API is not available for every API key, we have to enable this for you.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: APIKeyHeader
$config = KlippaOCRAPI\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = KlippaOCRAPI\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Key', 'Bearer');

// Configure API key authorization: APIKeyQueryParam
$config = KlippaOCRAPI\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = KlippaOCRAPI\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Key', 'Bearer');


$apiInstance = new KlippaOCRAPI\Api\PublicKeyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \KlippaOCRAPI\Model\CreatePublicKeyForm(); // \KlippaOCRAPI\Model\CreatePublicKeyForm | 

try {
    $result = $apiInstance->createPublicKey($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PublicKeyApi->createPublicKey: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\KlippaOCRAPI\Model\CreatePublicKeyForm**](../Model/CreatePublicKeyForm.md)|  | [optional]

### Return type

[**\KlippaOCRAPI\Model\CreatePublicKeyBody**](../Model/CreatePublicKeyBody.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [APIKeyQueryParam](../../README.md#APIKeyQueryParam)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## publicKeyInfo

> \KlippaOCRAPI\Model\GetPublicKeyInfoBody publicKeyInfo()

Get information about the public key.

This call can only be made with public key authentication.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: APIPublicKeyHeader
$config = KlippaOCRAPI\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Public-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = KlippaOCRAPI\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Public-Key', 'Bearer');

// Configure API key authorization: APIPublicKeyQueryParam
$config = KlippaOCRAPI\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Public-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = KlippaOCRAPI\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Public-Key', 'Bearer');


$apiInstance = new KlippaOCRAPI\Api\PublicKeyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->publicKeyInfo();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PublicKeyApi->publicKeyInfo: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\KlippaOCRAPI\Model\GetPublicKeyInfoBody**](../Model/GetPublicKeyInfoBody.md)

### Authorization

[APIPublicKeyHeader](../../README.md#APIPublicKeyHeader), [APIPublicKeyQueryParam](../../README.md#APIPublicKeyQueryParam)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## publicKeyInfoByID

> \KlippaOCRAPI\Model\GetPublicKeyInfoBody publicKeyInfoByID($public_key_id)

Get information about the public key by a public key ID.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: APIKeyHeader
$config = KlippaOCRAPI\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = KlippaOCRAPI\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Key', 'Bearer');

// Configure API key authorization: APIKeyQueryParam
$config = KlippaOCRAPI\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = KlippaOCRAPI\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Key', 'Bearer');


$apiInstance = new KlippaOCRAPI\Api\PublicKeyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$public_key_id = 'public_key_id_example'; // string | The ID of the public key.

try {
    $result = $apiInstance->publicKeyInfoByID($public_key_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PublicKeyApi->publicKeyInfoByID: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **public_key_id** | **string**| The ID of the public key. |

### Return type

[**\KlippaOCRAPI\Model\GetPublicKeyInfoBody**](../Model/GetPublicKeyInfoBody.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [APIKeyQueryParam](../../README.md#APIKeyQueryParam)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

