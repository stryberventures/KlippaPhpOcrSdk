# KlippaOCRAPI\InformationApi

All URIs are relative to *https://custom-ocr.klippa.com/api/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**credits**](InformationApi.md#credits) | **GET** /credits | List available credits.
[**getAPIIndex**](InformationApi.md#getAPIIndex) | **GET** / | Information about the API.
[**getTemplates**](InformationApi.md#getTemplates) | **GET** /templates | List of available templates.
[**listStatisticsInput**](InformationApi.md#listStatisticsInput) | **GET** /statistics | 



## credits

> \KlippaOCRAPI\Model\GetCreditsBody credits()

List available credits.

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


$apiInstance = new KlippaOCRAPI\Api\InformationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->credits();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InformationApi->credits: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\KlippaOCRAPI\Model\GetCreditsBody**](../Model/GetCreditsBody.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [APIKeyQueryParam](../../README.md#APIKeyQueryParam)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## getAPIIndex

> \KlippaOCRAPI\Model\APIIndexBody getAPIIndex()

Information about the API.

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


$apiInstance = new KlippaOCRAPI\Api\InformationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getAPIIndex();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InformationApi->getAPIIndex: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\KlippaOCRAPI\Model\APIIndexBody**](../Model/APIIndexBody.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [APIKeyQueryParam](../../README.md#APIKeyQueryParam)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## getTemplates

> \KlippaOCRAPI\Model\GetTemplatesBody getTemplates()

List of available templates.

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


$apiInstance = new KlippaOCRAPI\Api\InformationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getTemplates();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InformationApi->getTemplates: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\KlippaOCRAPI\Model\GetTemplatesBody**](../Model/GetTemplatesBody.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [APIKeyQueryParam](../../README.md#APIKeyQueryParam)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## listStatisticsInput

> \KlippaOCRAPI\Model\GetStatisticsBody listStatisticsInput($date_min, $date_max, $granularity)



List credit usage

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


$apiInstance = new KlippaOCRAPI\Api\InformationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$date_min = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | The minimum date of the receipts.
$date_max = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | The maximum date of the receipts.
$granularity = 'day'; // string | The granularity of the stat.

try {
    $result = $apiInstance->listStatisticsInput($date_min, $date_max, $granularity);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InformationApi->listStatisticsInput: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **date_min** | **\DateTime**| The minimum date of the receipts. | [optional]
 **date_max** | **\DateTime**| The maximum date of the receipts. | [optional]
 **granularity** | **string**| The granularity of the stat. | [optional] [default to &#39;day&#39;]

### Return type

[**\KlippaOCRAPI\Model\GetStatisticsBody**](../Model/GetStatisticsBody.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [APIKeyQueryParam](../../README.md#APIKeyQueryParam)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

