<?php
/**
 * ParsingApi
 * PHP version 5
 *
 * @category Class
 * @package  KlippaOCRAPI
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Klippa Custom OCR API
 *
 * # Introduction The Klippa Custom OCR Webservice API is a REST webservice for custom OCR implementations by Klippa.  The service replies are JSON only.  The service base URL is https://custom-ocr.klippa.com/api/v1. The service base URL for the test environment is https://test.custom-ocr.klippa.com/api/v1, we test experimental templates and features there. It also hosts the demo interface.  # Authentication ## APIKeyHeader The API requires the following header to be set:  Header | Description | --- |--- |   X-Auth-Key  |  The auth key provided by Klippa. |  The Key is provided per customer by Klippa.  ## APIKeyQueryParam The key can also be provided in the request query as ```?X-Auth-Key=key```  ## APIPublicKeyHeader The Public API requires the following header to be set:  Header | Description | --- |--- |   X-Auth-Public-Key  |  The public auth key provided by Klippa. |  ## APIPublicKeyQueryParam The key can also be provided in the request query as ```?X-Auth-Public-Key=public-key```   # Calling the API from public applications If you want to call the API from a public application, like a mobile app, you should **NOT** embed your API key in the app, this key could be extracted and abused.  The way to do this is using our API to [generate a public key](#operation/createPublicKey) from your backend, and send that public key to your application. That way only users that are authenticated are allowed to call the API. That way you can also better monitor which users are using the API and prevent abuse. You can also configure the public key to be valid for a certain time and give a maximum amount of scans.  The public key API is not available for every API key, we have to enable this for you.  We also have a [complete scanner SDK for Android and iOS](https://www.klippa.com/en/ocr/ocr-sdk/) available that has this API integrated.  The Public API requires the following header to be set:  Header | Description | --- |--- |   X-Auth-Public-Key  |  The public auth key provided by Klippa. |  The key can also be provided in the request query as ```?X-Auth-Public-Key=public-key```   # API Client libraries  Language | Client | --- |--- |   Go  |   [go.tar.gz](/docs/static/clients/go.tar.gz) |   Java  |   [java.tar.gz](/docs/static/clients/java.tar.gz) |   PHP  |   [php.tar.gz](/docs/static/clients/php.tar.gz) |   Python  |   [python.tar.gz](/docs/static/clients/python.tar.gz) |   Typescript (Axios)  |   [typescript.tar.gz](/docs/static/clients/typescript.tar.gz) |   Swift 3  |   [swift3.tar.gz](/docs/static/clients/swift3.tar.gz) |   Swift 4  |   [swift4.tar.gz](/docs/static/clients/swift4.tar.gz) |   # Error codes ## Authentication errors  Code | Name | --- |--- |   100001  |   ErrorCodeAuthMissingKey |   100002  |   ErrorCodeAuthInvalidKey |   100003  |   ErrorCodeAuthError |   100004  |   ErrorCodeAuthNoCreditsLeft |   100005  |   ErrorCodeAuthInvalidPublicKey |   100006  |   ErrorCodeAuthPublicKeyNoScansLeft |   100007  |   ErrorCodeAuthPublicKeyExpired |   ## PDF Parser errors  Code | Name | --- |--- |   200001  |   ErrorCodePDFParserDocumentError |   200002  |   Obsolete |   200003  |   Obsolete |   200004  |   ErrorCodePDFParserNoAccessToTemplate |   200005  |   ErrorCodePDFParserConvertError |   200006  |   ErrorCodePDFParserParseError |   ## Document Parser errors  Code | Name | --- |--- |   300001  |   ErrorCodeDocumentParserDocumentError |   300002  |   Obsolete |   300003  |   Obsolete |   300004  |   ErrorCodeDocumentParserNoAccessToTemplate |   300005  |   ErrorCodeDocumentParserConvertError |   300006  |   ErrorCodeDocumentParserParseError |   300007  |   ErrorCodeDocumentParserTooBigFileError |   ## Public Key errors  Code | Name | --- |--- |   400001  |   ErrorCodePublicKeyNotAllowed |   400002  |   ErrorCodePublicKeyCreationFailed |   400003  |   ErrorCodePublicKeyInvalidScanLimit |   400004  |   ErrorCodePublicKeyInvalidValidTime |   400005  |   ErrorCodePublicKeyLoadError |   400006  |   ErrorCodePublicKeyNotFoundError |  # Userdata  The user_data field allows for sending additional data into the parser and can be used to improve the recognition rate and processing speed. The user_data must be given as a JSON-encoded string. All fields are optional, a documents may be submitted without this field.  The following fields are accepted in the user_data object:  Key | Value type  | Description | --|--|--| `client`| `Relation` object | A relation object containing information about the client that submits the document. It should contain information either the merchant of the customer of the invoice. This is indicated by the `transaction_type` key. If the `transaction_type` is set to `purchase`, the client is considered to be the customer. If the `transaction_type` is set to `sale`, the client is considered to be the merchant. `transaction_type`  | string  | The transaction type of the document for the client. If the invoices contains a sale that the client made, this field can be set to `sale`. If the invoice contains a purchase that the client made, this field can be set to `purchase`.| `relations`  | array of `Relation` objects  | An optional list of relations which have previously been used by the client. The list does not have to be complete, the OCR may suggest merchants and customers which are not in this list. | `locale`| `Locale` object | If the language or originating country of the document is known, these values may be set.   ## Relation object  The relation object may contain the following fields. All fields are optional and may be omitted if a field is not available.  Key | Value type  | Description | --|--|--| name|string|The company name of the client street_name|string|The street name of the client address street_number|string|The street number of the client address zipcode|string|The zipcode of the client address city|string|The city of the client address country|string|The country of the client address. It must be provided as a 2-letter country code as specified by ISO 3166-1. For example `FR` for France and `NL` for The Netherlands vat_number|string|The vat number, formatted according to the EU VAT directive. It must start with the country code prefix, such as `FR` or `NL` coc_number|string|A chamber of commerce number. E.g. the Dutch KVK number, or the French SIRET/SIREN number phone|string|The phone number of the client. International calling codes, such as `+33` may be provided but are not required website|string|The full URL to the website email|string|The email address bank_account_number|string|The IBAN number  ## Locale object In case the language and/or originating country of the document are known, these may be set in the locale object. The locale object may contain the following fields. Both fields are optional.  Key | Value type  | Description | --|--|--| language|string|A 2-letter language code according to ISO 3166-1. country|string|A 2-letter country code according to ISO 639.  ## Userdata Example ``` { \"client\": { \"name\": \"\", \"street_name\": \"\", \"street_number\": \"\", \"zipcode\": \"\", \"city\": \"\", \"country\": \"\", \"vat_number\": \"\", \"coc_number\": \"\", \"phone\": \"\", \"website\": \"\", \"email\": \"\", \"bank_account_number\": \"\" }, \"transaction_type\": \"\", \"relations\": [ { \"name\": \"\", \"street_name\": \"\", \"street_number\": \"\", \"zipcode\": \"\", \"city\": \"\", \"country\": \"\", \"vat_number\": \"\", \"coc_number\": \"\", \"phone\": \"\", \"website\": \"\", \"email\": \"\", \"bank_account_number\": \"\" }, { \"name\": \"\", \"street_name\": \"\", \"street_number\": \"\", \"zipcode\": \"\", \"city\": \"\", \"country\": \"\", \"vat_number\": \"\", \"coc_number\": \"\", \"phone\": \"\", \"website\": \"\", \"email\": \"\", \"bank_account_number\": \"\" } ], \"locale\": { \"language\": \"\", \"country\": \"\" } } ```
 *
 * The version of the OpenAPI document: v0-13-45 - 71d7186abd1c5492b0e3ea562d8b7c6b4a0017ae
 * Contact: jeroen@klippa.com
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 4.3.0-SNAPSHOT
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace KlippaOCRAPI\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use KlippaOCRAPI\ApiException;
use KlippaOCRAPI\Configuration;
use KlippaOCRAPI\HeaderSelector;
use KlippaOCRAPI\ObjectSerializer;

/**
 * ParsingApi Class Doc Comment
 *
 * @category Class
 * @package  KlippaOCRAPI
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class ParsingApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $host_index (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        $host_index = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $host_index;
    }

    /**
     * Set the host index
     *
     * @param  int Host index (required)
     */
    public function setHostIndex($host_index)
    {
        $this->hostIndex = $host_index;
    }

    /**
     * Get the host index
     *
     * @return Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation parseDocument
     *
     * Template Financial (default): Parse GIF, PNG, JPG, PDF or TIFF file.
     *
     * @param  \SplFileObject $document The document to scan as a multipart/form-data file. (optional)
     * @param  string $url The document to scan as a file available at this URL. (optional)
     * @param  string $template The template to use for parsing. Empty for default parsing. (optional)
     * @param  string $pdf_text_extraction PDF Text extraction. Use full when you want the best quality scan, use fast when you want fast scan results. Fast will try to extract the text from the PDF. Full will actually scan the full PDF, which is slower. (optional, default to 'fast')
     * @param  string $user_data Extra metadata in JSON format to give to the parser. Only works with templates that are configured to accept user data. (optional)
     *
     * @throws \KlippaOCRAPI\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \KlippaOCRAPI\Model\ReceiptBody|\KlippaOCRAPI\Model\ValidationError|\KlippaOCRAPI\Model\Error
     */
    public function parseDocument($document = null, $url = null, $template = null, $pdf_text_extraction = 'fast', $user_data = null)
    {
        list($response) = $this->parseDocumentWithHttpInfo($document, $url, $template, $pdf_text_extraction, $user_data);
        return $response;
    }

    /**
     * Operation parseDocumentWithHttpInfo
     *
     * Template Financial (default): Parse GIF, PNG, JPG, PDF or TIFF file.
     *
     * @param  \SplFileObject $document The document to scan as a multipart/form-data file. (optional)
     * @param  string $url The document to scan as a file available at this URL. (optional)
     * @param  string $template The template to use for parsing. Empty for default parsing. (optional)
     * @param  string $pdf_text_extraction PDF Text extraction. Use full when you want the best quality scan, use fast when you want fast scan results. Fast will try to extract the text from the PDF. Full will actually scan the full PDF, which is slower. (optional, default to 'fast')
     * @param  string $user_data Extra metadata in JSON format to give to the parser. Only works with templates that are configured to accept user data. (optional)
     *
     * @throws \KlippaOCRAPI\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \KlippaOCRAPI\Model\ReceiptBody|\KlippaOCRAPI\Model\ValidationError|\KlippaOCRAPI\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function parseDocumentWithHttpInfo($document = null, $url = null, $template = null, $pdf_text_extraction = 'fast', $user_data = null)
    {
        $request = $this->parseDocumentRequest($document, $url, $template, $pdf_text_extraction, $user_data);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            switch($statusCode) {
                case 200:
                    if ('\KlippaOCRAPI\Model\ReceiptBody' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\KlippaOCRAPI\Model\ReceiptBody', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\KlippaOCRAPI\Model\ValidationError' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\KlippaOCRAPI\Model\ValidationError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 500:
                    if ('\KlippaOCRAPI\Model\Error' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\KlippaOCRAPI\Model\Error', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\KlippaOCRAPI\Model\ReceiptBody';
            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = (string) $responseBody;
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\KlippaOCRAPI\Model\ReceiptBody',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\KlippaOCRAPI\Model\ValidationError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\KlippaOCRAPI\Model\Error',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation parseDocumentAsync
     *
     * Template Financial (default): Parse GIF, PNG, JPG, PDF or TIFF file.
     *
     * @param  \SplFileObject $document The document to scan as a multipart/form-data file. (optional)
     * @param  string $url The document to scan as a file available at this URL. (optional)
     * @param  string $template The template to use for parsing. Empty for default parsing. (optional)
     * @param  string $pdf_text_extraction PDF Text extraction. Use full when you want the best quality scan, use fast when you want fast scan results. Fast will try to extract the text from the PDF. Full will actually scan the full PDF, which is slower. (optional, default to 'fast')
     * @param  string $user_data Extra metadata in JSON format to give to the parser. Only works with templates that are configured to accept user data. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function parseDocumentAsync($document = null, $url = null, $template = null, $pdf_text_extraction = 'fast', $user_data = null)
    {
        return $this->parseDocumentAsyncWithHttpInfo($document, $url, $template, $pdf_text_extraction, $user_data)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation parseDocumentAsyncWithHttpInfo
     *
     * Template Financial (default): Parse GIF, PNG, JPG, PDF or TIFF file.
     *
     * @param  \SplFileObject $document The document to scan as a multipart/form-data file. (optional)
     * @param  string $url The document to scan as a file available at this URL. (optional)
     * @param  string $template The template to use for parsing. Empty for default parsing. (optional)
     * @param  string $pdf_text_extraction PDF Text extraction. Use full when you want the best quality scan, use fast when you want fast scan results. Fast will try to extract the text from the PDF. Full will actually scan the full PDF, which is slower. (optional, default to 'fast')
     * @param  string $user_data Extra metadata in JSON format to give to the parser. Only works with templates that are configured to accept user data. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function parseDocumentAsyncWithHttpInfo($document = null, $url = null, $template = null, $pdf_text_extraction = 'fast', $user_data = null)
    {
        $returnType = '\KlippaOCRAPI\Model\ReceiptBody';
        $request = $this->parseDocumentRequest($document, $url, $template, $pdf_text_extraction, $user_data);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'parseDocument'
     *
     * @param  \SplFileObject $document The document to scan as a multipart/form-data file. (optional)
     * @param  string $url The document to scan as a file available at this URL. (optional)
     * @param  string $template The template to use for parsing. Empty for default parsing. (optional)
     * @param  string $pdf_text_extraction PDF Text extraction. Use full when you want the best quality scan, use fast when you want fast scan results. Fast will try to extract the text from the PDF. Full will actually scan the full PDF, which is slower. (optional, default to 'fast')
     * @param  string $user_data Extra metadata in JSON format to give to the parser. Only works with templates that are configured to accept user data. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function parseDocumentRequest($document = null, $url = null, $template = null, $pdf_text_extraction = 'fast', $user_data = null)
    {

        $resourcePath = '/parseDocument';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // form params
        if ($document !== null) {
            $multipart = true;
            $formParams['document'] = \GuzzleHttp\Psr7\try_fopen(ObjectSerializer::toFormValue($document), 'rb');
        }
        // form params
        if ($url !== null) {
            $formParams['url'] = ObjectSerializer::toFormValue($url);
        }
        // form params
        if ($template !== null) {
            $formParams['template'] = ObjectSerializer::toFormValue($template);
        }
        // form params
        if ($pdf_text_extraction !== null) {
            $formParams['pdf_text_extraction'] = ObjectSerializer::toFormValue($pdf_text_extraction);
        }
        // form params
        if ($user_data !== null) {
            $formParams['user_data'] = ObjectSerializer::toFormValue($user_data);
        }
        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['multipart/form-data']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($_tempBody));
            } else {
                $httpBody = $_tempBody;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Auth-Key');
        if ($apiKey !== null) {
            $headers['X-Auth-Key'] = $apiKey;
        }
        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Auth-Key');
        if ($apiKey !== null) {
            $queryParams['X-Auth-Key'] = $apiKey;
        }
        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Auth-Public-Key');
        if ($apiKey !== null) {
            $headers['X-Auth-Public-Key'] = $apiKey;
        }
        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Auth-Public-Key');
        if ($apiKey !== null) {
            $queryParams['X-Auth-Public-Key'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation parseDocumentEUPassport
     *
     * Template EU Passport: Parse GIF, PNG, JPG, PDF or TIFF file.
     *
     * @param  \SplFileObject $document The passport document to scan as a multipart/form-data file. (optional)
     * @param  string $url The passport document to scan as a file available at this URL. (optional)
     * @param  string $template The template to use for parsing. Empty for default parsing. (optional, default to 'eu-passport')
     * @param  string $pdf_text_extraction PDF Text extraction. Use full when you want the best quality scan, use fast when you want fast scan results. Fast will try to extract the text from the PDF. Full will actually scan the full PDF, which is slower. Speed difference: full: ~5s, fast: ~2.5. When a PDF does not contain text, e.g., scans of documents and pictures, we will automatically use full for that request. This value is ignored for non-PDF requests. (optional, default to 'fast')
     * @param  string $user_data Extra metadata in JSON format to give to the parser. Only works with templates that are configured to accept user data. (optional)
     *
     * @throws \KlippaOCRAPI\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \KlippaOCRAPI\Model\EuropeanPassportBody|\KlippaOCRAPI\Model\ValidationError|\KlippaOCRAPI\Model\Error
     */
    public function parseDocumentEUPassport($document = null, $url = null, $template = 'eu-passport', $pdf_text_extraction = 'fast', $user_data = null)
    {
        list($response) = $this->parseDocumentEUPassportWithHttpInfo($document, $url, $template, $pdf_text_extraction, $user_data);
        return $response;
    }

    /**
     * Operation parseDocumentEUPassportWithHttpInfo
     *
     * Template EU Passport: Parse GIF, PNG, JPG, PDF or TIFF file.
     *
     * @param  \SplFileObject $document The passport document to scan as a multipart/form-data file. (optional)
     * @param  string $url The passport document to scan as a file available at this URL. (optional)
     * @param  string $template The template to use for parsing. Empty for default parsing. (optional, default to 'eu-passport')
     * @param  string $pdf_text_extraction PDF Text extraction. Use full when you want the best quality scan, use fast when you want fast scan results. Fast will try to extract the text from the PDF. Full will actually scan the full PDF, which is slower. Speed difference: full: ~5s, fast: ~2.5. When a PDF does not contain text, e.g., scans of documents and pictures, we will automatically use full for that request. This value is ignored for non-PDF requests. (optional, default to 'fast')
     * @param  string $user_data Extra metadata in JSON format to give to the parser. Only works with templates that are configured to accept user data. (optional)
     *
     * @throws \KlippaOCRAPI\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \KlippaOCRAPI\Model\EuropeanPassportBody|\KlippaOCRAPI\Model\ValidationError|\KlippaOCRAPI\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function parseDocumentEUPassportWithHttpInfo($document = null, $url = null, $template = 'eu-passport', $pdf_text_extraction = 'fast', $user_data = null)
    {
        $request = $this->parseDocumentEUPassportRequest($document, $url, $template, $pdf_text_extraction, $user_data);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            switch($statusCode) {
                case 200:
                    if ('\KlippaOCRAPI\Model\EuropeanPassportBody' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\KlippaOCRAPI\Model\EuropeanPassportBody', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\KlippaOCRAPI\Model\ValidationError' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\KlippaOCRAPI\Model\ValidationError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 500:
                    if ('\KlippaOCRAPI\Model\Error' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\KlippaOCRAPI\Model\Error', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\KlippaOCRAPI\Model\EuropeanPassportBody';
            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = (string) $responseBody;
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\KlippaOCRAPI\Model\EuropeanPassportBody',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\KlippaOCRAPI\Model\ValidationError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\KlippaOCRAPI\Model\Error',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation parseDocumentEUPassportAsync
     *
     * Template EU Passport: Parse GIF, PNG, JPG, PDF or TIFF file.
     *
     * @param  \SplFileObject $document The passport document to scan as a multipart/form-data file. (optional)
     * @param  string $url The passport document to scan as a file available at this URL. (optional)
     * @param  string $template The template to use for parsing. Empty for default parsing. (optional, default to 'eu-passport')
     * @param  string $pdf_text_extraction PDF Text extraction. Use full when you want the best quality scan, use fast when you want fast scan results. Fast will try to extract the text from the PDF. Full will actually scan the full PDF, which is slower. Speed difference: full: ~5s, fast: ~2.5. When a PDF does not contain text, e.g., scans of documents and pictures, we will automatically use full for that request. This value is ignored for non-PDF requests. (optional, default to 'fast')
     * @param  string $user_data Extra metadata in JSON format to give to the parser. Only works with templates that are configured to accept user data. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function parseDocumentEUPassportAsync($document = null, $url = null, $template = 'eu-passport', $pdf_text_extraction = 'fast', $user_data = null)
    {
        return $this->parseDocumentEUPassportAsyncWithHttpInfo($document, $url, $template, $pdf_text_extraction, $user_data)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation parseDocumentEUPassportAsyncWithHttpInfo
     *
     * Template EU Passport: Parse GIF, PNG, JPG, PDF or TIFF file.
     *
     * @param  \SplFileObject $document The passport document to scan as a multipart/form-data file. (optional)
     * @param  string $url The passport document to scan as a file available at this URL. (optional)
     * @param  string $template The template to use for parsing. Empty for default parsing. (optional, default to 'eu-passport')
     * @param  string $pdf_text_extraction PDF Text extraction. Use full when you want the best quality scan, use fast when you want fast scan results. Fast will try to extract the text from the PDF. Full will actually scan the full PDF, which is slower. Speed difference: full: ~5s, fast: ~2.5. When a PDF does not contain text, e.g., scans of documents and pictures, we will automatically use full for that request. This value is ignored for non-PDF requests. (optional, default to 'fast')
     * @param  string $user_data Extra metadata in JSON format to give to the parser. Only works with templates that are configured to accept user data. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function parseDocumentEUPassportAsyncWithHttpInfo($document = null, $url = null, $template = 'eu-passport', $pdf_text_extraction = 'fast', $user_data = null)
    {
        $returnType = '\KlippaOCRAPI\Model\EuropeanPassportBody';
        $request = $this->parseDocumentEUPassportRequest($document, $url, $template, $pdf_text_extraction, $user_data);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'parseDocumentEUPassport'
     *
     * @param  \SplFileObject $document The passport document to scan as a multipart/form-data file. (optional)
     * @param  string $url The passport document to scan as a file available at this URL. (optional)
     * @param  string $template The template to use for parsing. Empty for default parsing. (optional, default to 'eu-passport')
     * @param  string $pdf_text_extraction PDF Text extraction. Use full when you want the best quality scan, use fast when you want fast scan results. Fast will try to extract the text from the PDF. Full will actually scan the full PDF, which is slower. Speed difference: full: ~5s, fast: ~2.5. When a PDF does not contain text, e.g., scans of documents and pictures, we will automatically use full for that request. This value is ignored for non-PDF requests. (optional, default to 'fast')
     * @param  string $user_data Extra metadata in JSON format to give to the parser. Only works with templates that are configured to accept user data. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function parseDocumentEUPassportRequest($document = null, $url = null, $template = 'eu-passport', $pdf_text_extraction = 'fast', $user_data = null)
    {

        $resourcePath = '/parseDocument/eu-passport';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // form params
        if ($document !== null) {
            $multipart = true;
            $formParams['document'] = \GuzzleHttp\Psr7\try_fopen(ObjectSerializer::toFormValue($document), 'rb');
        }
        // form params
        if ($url !== null) {
            $formParams['url'] = ObjectSerializer::toFormValue($url);
        }
        // form params
        if ($template !== null) {
            $formParams['template'] = ObjectSerializer::toFormValue($template);
        }
        // form params
        if ($pdf_text_extraction !== null) {
            $formParams['pdf_text_extraction'] = ObjectSerializer::toFormValue($pdf_text_extraction);
        }
        // form params
        if ($user_data !== null) {
            $formParams['user_data'] = ObjectSerializer::toFormValue($user_data);
        }
        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['multipart/form-data']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($_tempBody));
            } else {
                $httpBody = $_tempBody;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Auth-Key');
        if ($apiKey !== null) {
            $headers['X-Auth-Key'] = $apiKey;
        }
        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Auth-Key');
        if ($apiKey !== null) {
            $queryParams['X-Auth-Key'] = $apiKey;
        }
        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Auth-Public-Key');
        if ($apiKey !== null) {
            $headers['X-Auth-Public-Key'] = $apiKey;
        }
        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Auth-Public-Key');
        if ($apiKey !== null) {
            $queryParams['X-Auth-Public-Key'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation parseStructuredPDF
     *
     * Parse a structured PDF file.
     *
     * @param  \SplFileObject $document The passport document to scan as a multipart/form-data file. (required)
     * @param  string $template The template to use for parsing. Empty for default parsing. (optional)
     * @param  string $user_data Extra metadata in JSON format to give to the parser. Only works with templates that are configured to accept user data. (optional)
     *
     * @throws \KlippaOCRAPI\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \KlippaOCRAPI\Model\ReceiptBody|\KlippaOCRAPI\Model\ValidationError|\KlippaOCRAPI\Model\Error
     */
    public function parseStructuredPDF($document, $template = null, $user_data = null)
    {
        list($response) = $this->parseStructuredPDFWithHttpInfo($document, $template, $user_data);
        return $response;
    }

    /**
     * Operation parseStructuredPDFWithHttpInfo
     *
     * Parse a structured PDF file.
     *
     * @param  \SplFileObject $document The passport document to scan as a multipart/form-data file. (required)
     * @param  string $template The template to use for parsing. Empty for default parsing. (optional)
     * @param  string $user_data Extra metadata in JSON format to give to the parser. Only works with templates that are configured to accept user data. (optional)
     *
     * @throws \KlippaOCRAPI\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \KlippaOCRAPI\Model\ReceiptBody|\KlippaOCRAPI\Model\ValidationError|\KlippaOCRAPI\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function parseStructuredPDFWithHttpInfo($document, $template = null, $user_data = null)
    {
        $request = $this->parseStructuredPDFRequest($document, $template, $user_data);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            switch($statusCode) {
                case 200:
                    if ('\KlippaOCRAPI\Model\ReceiptBody' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\KlippaOCRAPI\Model\ReceiptBody', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\KlippaOCRAPI\Model\ValidationError' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\KlippaOCRAPI\Model\ValidationError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 500:
                    if ('\KlippaOCRAPI\Model\Error' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\KlippaOCRAPI\Model\Error', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\KlippaOCRAPI\Model\ReceiptBody';
            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = (string) $responseBody;
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\KlippaOCRAPI\Model\ReceiptBody',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\KlippaOCRAPI\Model\ValidationError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\KlippaOCRAPI\Model\Error',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation parseStructuredPDFAsync
     *
     * Parse a structured PDF file.
     *
     * @param  \SplFileObject $document The passport document to scan as a multipart/form-data file. (required)
     * @param  string $template The template to use for parsing. Empty for default parsing. (optional)
     * @param  string $user_data Extra metadata in JSON format to give to the parser. Only works with templates that are configured to accept user data. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function parseStructuredPDFAsync($document, $template = null, $user_data = null)
    {
        return $this->parseStructuredPDFAsyncWithHttpInfo($document, $template, $user_data)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation parseStructuredPDFAsyncWithHttpInfo
     *
     * Parse a structured PDF file.
     *
     * @param  \SplFileObject $document The passport document to scan as a multipart/form-data file. (required)
     * @param  string $template The template to use for parsing. Empty for default parsing. (optional)
     * @param  string $user_data Extra metadata in JSON format to give to the parser. Only works with templates that are configured to accept user data. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function parseStructuredPDFAsyncWithHttpInfo($document, $template = null, $user_data = null)
    {
        $returnType = '\KlippaOCRAPI\Model\ReceiptBody';
        $request = $this->parseStructuredPDFRequest($document, $template, $user_data);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'parseStructuredPDF'
     *
     * @param  \SplFileObject $document The passport document to scan as a multipart/form-data file. (required)
     * @param  string $template The template to use for parsing. Empty for default parsing. (optional)
     * @param  string $user_data Extra metadata in JSON format to give to the parser. Only works with templates that are configured to accept user data. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function parseStructuredPDFRequest($document, $template = null, $user_data = null)
    {
        // verify the required parameter 'document' is set
        if ($document === null || (is_array($document) && count($document) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $document when calling parseStructuredPDF'
            );
        }

        $resourcePath = '/parseStructuredPDF';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // form params
        if ($document !== null) {
            $multipart = true;
            $formParams['document'] = \GuzzleHttp\Psr7\try_fopen(ObjectSerializer::toFormValue($document), 'rb');
        }
        // form params
        if ($template !== null) {
            $formParams['template'] = ObjectSerializer::toFormValue($template);
        }
        // form params
        if ($user_data !== null) {
            $formParams['user_data'] = ObjectSerializer::toFormValue($user_data);
        }
        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['multipart/form-data']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($_tempBody));
            } else {
                $httpBody = $_tempBody;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Auth-Key');
        if ($apiKey !== null) {
            $headers['X-Auth-Key'] = $apiKey;
        }
        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Auth-Key');
        if ($apiKey !== null) {
            $queryParams['X-Auth-Key'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation parseText
     *
     * Parse plain text.
     *
     * @param  \KlippaOCRAPI\Model\TextUploadForm $body body (optional)
     *
     * @throws \KlippaOCRAPI\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \KlippaOCRAPI\Model\ReceiptBody|\KlippaOCRAPI\Model\ValidationError|\KlippaOCRAPI\Model\Error
     */
    public function parseText($body = null)
    {
        list($response) = $this->parseTextWithHttpInfo($body);
        return $response;
    }

    /**
     * Operation parseTextWithHttpInfo
     *
     * Parse plain text.
     *
     * @param  \KlippaOCRAPI\Model\TextUploadForm $body (optional)
     *
     * @throws \KlippaOCRAPI\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \KlippaOCRAPI\Model\ReceiptBody|\KlippaOCRAPI\Model\ValidationError|\KlippaOCRAPI\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function parseTextWithHttpInfo($body = null)
    {
        $request = $this->parseTextRequest($body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            switch($statusCode) {
                case 200:
                    if ('\KlippaOCRAPI\Model\ReceiptBody' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\KlippaOCRAPI\Model\ReceiptBody', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\KlippaOCRAPI\Model\ValidationError' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\KlippaOCRAPI\Model\ValidationError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 500:
                    if ('\KlippaOCRAPI\Model\Error' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\KlippaOCRAPI\Model\Error', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\KlippaOCRAPI\Model\ReceiptBody';
            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = (string) $responseBody;
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\KlippaOCRAPI\Model\ReceiptBody',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\KlippaOCRAPI\Model\ValidationError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\KlippaOCRAPI\Model\Error',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation parseTextAsync
     *
     * Parse plain text.
     *
     * @param  \KlippaOCRAPI\Model\TextUploadForm $body (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function parseTextAsync($body = null)
    {
        return $this->parseTextAsyncWithHttpInfo($body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation parseTextAsyncWithHttpInfo
     *
     * Parse plain text.
     *
     * @param  \KlippaOCRAPI\Model\TextUploadForm $body (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function parseTextAsyncWithHttpInfo($body = null)
    {
        $returnType = '\KlippaOCRAPI\Model\ReceiptBody';
        $request = $this->parseTextRequest($body);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'parseText'
     *
     * @param  \KlippaOCRAPI\Model\TextUploadForm $body (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function parseTextRequest($body = null)
    {

        $resourcePath = '/parseText';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($_tempBody));
            } else {
                $httpBody = $_tempBody;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Auth-Key');
        if ($apiKey !== null) {
            $headers['X-Auth-Key'] = $apiKey;
        }
        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Auth-Key');
        if ($apiKey !== null) {
            $queryParams['X-Auth-Key'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
