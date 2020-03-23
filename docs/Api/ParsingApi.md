# KlippaOCRAPI\ParsingApi

All URIs are relative to *https://custom-ocr.klippa.com/api/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**parseDocument**](ParsingApi.md#parseDocument) | **POST** /parseDocument | Template Financial (default): Parse GIF, PNG, JPG, PDF or TIFF file.
[**parseDocumentEUPassport**](ParsingApi.md#parseDocumentEUPassport) | **POST** /parseDocument/eu-passport | Template EU Passport: Parse GIF, PNG, JPG, PDF or TIFF file.
[**parseStructuredPDF**](ParsingApi.md#parseStructuredPDF) | **POST** /parseStructuredPDF | Parse a structured PDF file.
[**parseText**](ParsingApi.md#parseText) | **POST** /parseText | Parse plain text.



## parseDocument

> \KlippaOCRAPI\Model\ReceiptBody parseDocument($document, $url, $template, $pdf_text_extraction, $user_data)

Template Financial (default): Parse GIF, PNG, JPG, PDF or TIFF file.

Body is the raw document file in the ```document``` field. You can also give a URL in the ```url``` field to let the API download the file. Note: you need to either pass a document or a URL. The service accepts image (jpg/png/gif) and PDF files.  The template (when available) has to be given in the ```template``` value or in the query argument ```template```. The query overwrites the form value.  The output is not the same for every template.  Note: ***this request is in multipart/form-data***.

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

// Configure API key authorization: APIPublicKeyHeader
$config = KlippaOCRAPI\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Public-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = KlippaOCRAPI\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Public-Key', 'Bearer');

// Configure API key authorization: APIPublicKeyQueryParam
$config = KlippaOCRAPI\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Public-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = KlippaOCRAPI\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Public-Key', 'Bearer');


$apiInstance = new KlippaOCRAPI\Api\ParsingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document = "/path/to/file.txt"; // \SplFileObject | The document to scan as a multipart/form-data file.
$url = 'url_example'; // string | The document to scan as a file available at this URL.
$template = 'template_example'; // string | The template to use for parsing. Empty for default parsing.
$pdf_text_extraction = 'fast'; // string | PDF Text extraction. Use full when you want the best quality scan, use fast when you want fast scan results. Fast will try to extract the text from the PDF. Full will actually scan the full PDF, which is slower.
$user_data = 'user_data_example'; // string | Extra metadata in JSON format to give to the parser. Only works with templates that are configured to accept user data.

try {
    $result = $apiInstance->parseDocument($document, $url, $template, $pdf_text_extraction, $user_data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ParsingApi->parseDocument: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document** | **\SplFileObject****\SplFileObject**| The document to scan as a multipart/form-data file. | [optional]
 **url** | **string**| The document to scan as a file available at this URL. | [optional]
 **template** | **string**| The template to use for parsing. Empty for default parsing. | [optional]
 **pdf_text_extraction** | **string**| PDF Text extraction. Use full when you want the best quality scan, use fast when you want fast scan results. Fast will try to extract the text from the PDF. Full will actually scan the full PDF, which is slower. | [optional] [default to &#39;fast&#39;]
 **user_data** | **string**| Extra metadata in JSON format to give to the parser. Only works with templates that are configured to accept user data. | [optional]

### Return type

[**\KlippaOCRAPI\Model\ReceiptBody**](../Model/ReceiptBody.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [APIKeyQueryParam](../../README.md#APIKeyQueryParam), [APIPublicKeyHeader](../../README.md#APIPublicKeyHeader), [APIPublicKeyQueryParam](../../README.md#APIPublicKeyQueryParam)

### HTTP request headers

- **Content-Type**: multipart/form-data
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## parseDocumentEUPassport

> \KlippaOCRAPI\Model\EuropeanPassportBody parseDocumentEUPassport($document, $url, $template, $pdf_text_extraction, $user_data)

Template EU Passport: Parse GIF, PNG, JPG, PDF or TIFF file.

Body is the raw document file in the ```document``` field. You can also give a URL in the ```url``` field to let the API download the file. Note: you need to either pass a document or a URL. The service accepts image (jpg/png/gif) and PDF files.  The template (when available) has to be given in the ```template``` value or in the query argument ```template```. The query overwrites the form value.  The output is not the same for every template.  Note: ***this request is in multipart/form-data***.

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

// Configure API key authorization: APIPublicKeyHeader
$config = KlippaOCRAPI\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Public-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = KlippaOCRAPI\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Public-Key', 'Bearer');

// Configure API key authorization: APIPublicKeyQueryParam
$config = KlippaOCRAPI\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Public-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = KlippaOCRAPI\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Public-Key', 'Bearer');


$apiInstance = new KlippaOCRAPI\Api\ParsingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document = "/path/to/file.txt"; // \SplFileObject | The passport document to scan as a multipart/form-data file.
$url = 'url_example'; // string | The passport document to scan as a file available at this URL.
$template = 'eu-passport'; // string | The template to use for parsing. Empty for default parsing.
$pdf_text_extraction = 'fast'; // string | PDF Text extraction. Use full when you want the best quality scan, use fast when you want fast scan results. Fast will try to extract the text from the PDF. Full will actually scan the full PDF, which is slower. Speed difference: full: ~5s, fast: ~2.5. When a PDF does not contain text, e.g., scans of documents and pictures, we will automatically use full for that request. This value is ignored for non-PDF requests.
$user_data = 'user_data_example'; // string | Extra metadata in JSON format to give to the parser. Only works with templates that are configured to accept user data.

try {
    $result = $apiInstance->parseDocumentEUPassport($document, $url, $template, $pdf_text_extraction, $user_data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ParsingApi->parseDocumentEUPassport: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document** | **\SplFileObject****\SplFileObject**| The passport document to scan as a multipart/form-data file. | [optional]
 **url** | **string**| The passport document to scan as a file available at this URL. | [optional]
 **template** | **string**| The template to use for parsing. Empty for default parsing. | [optional] [default to &#39;eu-passport&#39;]
 **pdf_text_extraction** | **string**| PDF Text extraction. Use full when you want the best quality scan, use fast when you want fast scan results. Fast will try to extract the text from the PDF. Full will actually scan the full PDF, which is slower. Speed difference: full: ~5s, fast: ~2.5. When a PDF does not contain text, e.g., scans of documents and pictures, we will automatically use full for that request. This value is ignored for non-PDF requests. | [optional] [default to &#39;fast&#39;]
 **user_data** | **string**| Extra metadata in JSON format to give to the parser. Only works with templates that are configured to accept user data. | [optional]

### Return type

[**\KlippaOCRAPI\Model\EuropeanPassportBody**](../Model/EuropeanPassportBody.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [APIKeyQueryParam](../../README.md#APIKeyQueryParam), [APIPublicKeyHeader](../../README.md#APIPublicKeyHeader), [APIPublicKeyQueryParam](../../README.md#APIPublicKeyQueryParam)

### HTTP request headers

- **Content-Type**: multipart/form-data
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## parseStructuredPDF

> \KlippaOCRAPI\Model\ReceiptBody parseStructuredPDF($document, $template, $user_data)

Parse a structured PDF file.

Only use this when you are sure your PDF is plain text and not an image of a document.  Results in quicker / better parses in cases where the PDF only consists of plain text.  Body is the raw document file in the document field.  The template (when available) has to be given in the template value.  The output is not the same for every template.  Note: ***this request is in multipart/form-data***.

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


$apiInstance = new KlippaOCRAPI\Api\ParsingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document = "/path/to/file.txt"; // \SplFileObject | The passport document to scan as a multipart/form-data file.
$template = 'template_example'; // string | The template to use for parsing. Empty for default parsing.
$user_data = 'user_data_example'; // string | Extra metadata in JSON format to give to the parser. Only works with templates that are configured to accept user data.

try {
    $result = $apiInstance->parseStructuredPDF($document, $template, $user_data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ParsingApi->parseStructuredPDF: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document** | **\SplFileObject****\SplFileObject**| The passport document to scan as a multipart/form-data file. |
 **template** | **string**| The template to use for parsing. Empty for default parsing. | [optional]
 **user_data** | **string**| Extra metadata in JSON format to give to the parser. Only works with templates that are configured to accept user data. | [optional]

### Return type

[**\KlippaOCRAPI\Model\ReceiptBody**](../Model/ReceiptBody.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [APIKeyQueryParam](../../README.md#APIKeyQueryParam)

### HTTP request headers

- **Content-Type**: multipart/form-data
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## parseText

> \KlippaOCRAPI\Model\ReceiptBody parseText($body)

Parse plain text.

The template (when available) has to be given in the template property.  The output is not the same for every template.

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


$apiInstance = new KlippaOCRAPI\Api\ParsingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \KlippaOCRAPI\Model\TextUploadForm(); // \KlippaOCRAPI\Model\TextUploadForm | 

try {
    $result = $apiInstance->parseText($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ParsingApi->parseText: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\KlippaOCRAPI\Model\TextUploadForm**](../Model/TextUploadForm.md)|  | [optional]

### Return type

[**\KlippaOCRAPI\Model\ReceiptBody**](../Model/ReceiptBody.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [APIKeyQueryParam](../../README.md#APIKeyQueryParam)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

