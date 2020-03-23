<?php
/**
 * Receipt
 *
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

namespace KlippaOCRAPI\Model;

use \ArrayAccess;
use \KlippaOCRAPI\ObjectSerializer;

/**
 * Receipt Class Doc Comment
 *
 * @category Class
 * @package  KlippaOCRAPI
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class Receipt implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Receipt';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'amount' => 'int',
        'amount_change' => 'int',
        'amountexvat' => 'int',
        'currency' => 'string',
        'customer_address' => 'string',
        'customer_bank_account_number' => 'string',
        'customer_bank_account_number_bic' => 'string',
        'customer_city' => 'string',
        'customer_coc_number' => 'string',
        'customer_country' => 'string',
        'customer_email' => 'string',
        'customer_municipality' => 'string',
        'customer_name' => 'string',
        'customer_number' => 'string',
        'customer_phone' => 'string',
        'customer_province' => 'string',
        'customer_reference' => 'string',
        'customer_vat_number' => 'string',
        'customer_website' => 'string',
        'customer_zipcode' => 'string',
        'date' => 'string',
        'document_subject' => 'string',
        'document_type' => 'string',
        'hash' => 'string',
        'hash_duplicate' => 'bool',
        'invoice_number' => 'string',
        'invoice_type' => 'string',
        'lines' => '\KlippaOCRAPI\Model\ReceiptLineItem[]',
        'matched_keywords' => '\KlippaOCRAPI\Model\MatchedKeyword[]',
        'matched_lineitems' => '\KlippaOCRAPI\Model\MatchedLineItemItem[]',
        'merchant_address' => 'string',
        'merchant_bank_account_number' => 'string',
        'merchant_bank_account_number_bic' => 'string',
        'merchant_city' => 'string',
        'merchant_coc_number' => 'string',
        'merchant_country' => 'string',
        'merchant_country_code' => 'string',
        'merchant_email' => 'string',
        'merchant_main_activity_code' => 'string',
        'merchant_municipality' => 'string',
        'merchant_name' => 'string',
        'merchant_phone' => 'string',
        'merchant_province' => 'string',
        'merchant_vat_number' => 'string',
        'merchant_website' => 'string',
        'merchant_zipcode' => 'string',
        'order_number' => 'string',
        'package_number' => 'string',
        'payment_auth_code' => 'string',
        'payment_card_account_number' => 'string',
        'payment_card_bank' => 'string',
        'payment_card_issuer' => 'string',
        'payment_card_number' => 'string',
        'payment_due_date' => 'string',
        'payment_slip_code' => 'string',
        'payment_slip_customer_number' => 'string',
        'payment_slip_reference_number' => 'string',
        'paymentmethod' => 'string',
        'purchasedate' => 'string',
        'purchasetime' => 'string',
        'raw_text' => 'string',
        'receipt_number' => 'string',
        'server' => 'string',
        'shop_number' => 'string',
        'table_group' => 'string',
        'table_number' => 'string',
        'terminal_number' => 'string',
        'transaction_number' => 'string',
        'transaction_reference' => 'string',
        'vatamount' => 'int',
        'vatitems' => '\KlippaOCRAPI\Model\ReceiptVAT[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPIFormats = [
        'amount' => 'int64',
        'amount_change' => 'int64',
        'amountexvat' => 'int64',
        'currency' => null,
        'customer_address' => null,
        'customer_bank_account_number' => null,
        'customer_bank_account_number_bic' => null,
        'customer_city' => null,
        'customer_coc_number' => null,
        'customer_country' => null,
        'customer_email' => null,
        'customer_municipality' => null,
        'customer_name' => null,
        'customer_number' => null,
        'customer_phone' => null,
        'customer_province' => null,
        'customer_reference' => null,
        'customer_vat_number' => null,
        'customer_website' => null,
        'customer_zipcode' => null,
        'date' => null,
        'document_subject' => null,
        'document_type' => null,
        'hash' => null,
        'hash_duplicate' => null,
        'invoice_number' => null,
        'invoice_type' => null,
        'lines' => null,
        'matched_keywords' => null,
        'matched_lineitems' => null,
        'merchant_address' => null,
        'merchant_bank_account_number' => null,
        'merchant_bank_account_number_bic' => null,
        'merchant_city' => null,
        'merchant_coc_number' => null,
        'merchant_country' => null,
        'merchant_country_code' => null,
        'merchant_email' => null,
        'merchant_main_activity_code' => null,
        'merchant_municipality' => null,
        'merchant_name' => null,
        'merchant_phone' => null,
        'merchant_province' => null,
        'merchant_vat_number' => null,
        'merchant_website' => null,
        'merchant_zipcode' => null,
        'order_number' => null,
        'package_number' => null,
        'payment_auth_code' => null,
        'payment_card_account_number' => null,
        'payment_card_bank' => null,
        'payment_card_issuer' => null,
        'payment_card_number' => null,
        'payment_due_date' => null,
        'payment_slip_code' => null,
        'payment_slip_customer_number' => null,
        'payment_slip_reference_number' => null,
        'paymentmethod' => null,
        'purchasedate' => null,
        'purchasetime' => null,
        'raw_text' => null,
        'receipt_number' => null,
        'server' => null,
        'shop_number' => null,
        'table_group' => null,
        'table_number' => null,
        'terminal_number' => null,
        'transaction_number' => null,
        'transaction_reference' => null,
        'vatamount' => 'int64',
        'vatitems' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'amount' => 'amount',
        'amount_change' => 'amount_change',
        'amountexvat' => 'amountexvat',
        'currency' => 'currency',
        'customer_address' => 'customer_address',
        'customer_bank_account_number' => 'customer_bank_account_number',
        'customer_bank_account_number_bic' => 'customer_bank_account_number_bic',
        'customer_city' => 'customer_city',
        'customer_coc_number' => 'customer_coc_number',
        'customer_country' => 'customer_country',
        'customer_email' => 'customer_email',
        'customer_municipality' => 'customer_municipality',
        'customer_name' => 'customer_name',
        'customer_number' => 'customer_number',
        'customer_phone' => 'customer_phone',
        'customer_province' => 'customer_province',
        'customer_reference' => 'customer_reference',
        'customer_vat_number' => 'customer_vat_number',
        'customer_website' => 'customer_website',
        'customer_zipcode' => 'customer_zipcode',
        'date' => 'date',
        'document_subject' => 'document_subject',
        'document_type' => 'document_type',
        'hash' => 'hash',
        'hash_duplicate' => 'hash_duplicate',
        'invoice_number' => 'invoice_number',
        'invoice_type' => 'invoice_type',
        'lines' => 'lines',
        'matched_keywords' => 'matched_keywords',
        'matched_lineitems' => 'matched_lineitems',
        'merchant_address' => 'merchant_address',
        'merchant_bank_account_number' => 'merchant_bank_account_number',
        'merchant_bank_account_number_bic' => 'merchant_bank_account_number_bic',
        'merchant_city' => 'merchant_city',
        'merchant_coc_number' => 'merchant_coc_number',
        'merchant_country' => 'merchant_country',
        'merchant_country_code' => 'merchant_country_code',
        'merchant_email' => 'merchant_email',
        'merchant_main_activity_code' => 'merchant_main_activity_code',
        'merchant_municipality' => 'merchant_municipality',
        'merchant_name' => 'merchant_name',
        'merchant_phone' => 'merchant_phone',
        'merchant_province' => 'merchant_province',
        'merchant_vat_number' => 'merchant_vat_number',
        'merchant_website' => 'merchant_website',
        'merchant_zipcode' => 'merchant_zipcode',
        'order_number' => 'order_number',
        'package_number' => 'package_number',
        'payment_auth_code' => 'payment_auth_code',
        'payment_card_account_number' => 'payment_card_account_number',
        'payment_card_bank' => 'payment_card_bank',
        'payment_card_issuer' => 'payment_card_issuer',
        'payment_card_number' => 'payment_card_number',
        'payment_due_date' => 'payment_due_date',
        'payment_slip_code' => 'payment_slip_code',
        'payment_slip_customer_number' => 'payment_slip_customer_number',
        'payment_slip_reference_number' => 'payment_slip_reference_number',
        'paymentmethod' => 'paymentmethod',
        'purchasedate' => 'purchasedate',
        'purchasetime' => 'purchasetime',
        'raw_text' => 'raw_text',
        'receipt_number' => 'receipt_number',
        'server' => 'server',
        'shop_number' => 'shop_number',
        'table_group' => 'table_group',
        'table_number' => 'table_number',
        'terminal_number' => 'terminal_number',
        'transaction_number' => 'transaction_number',
        'transaction_reference' => 'transaction_reference',
        'vatamount' => 'vatamount',
        'vatitems' => 'vatitems'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'amount' => 'setAmount',
        'amount_change' => 'setAmountChange',
        'amountexvat' => 'setAmountexvat',
        'currency' => 'setCurrency',
        'customer_address' => 'setCustomerAddress',
        'customer_bank_account_number' => 'setCustomerBankAccountNumber',
        'customer_bank_account_number_bic' => 'setCustomerBankAccountNumberBic',
        'customer_city' => 'setCustomerCity',
        'customer_coc_number' => 'setCustomerCocNumber',
        'customer_country' => 'setCustomerCountry',
        'customer_email' => 'setCustomerEmail',
        'customer_municipality' => 'setCustomerMunicipality',
        'customer_name' => 'setCustomerName',
        'customer_number' => 'setCustomerNumber',
        'customer_phone' => 'setCustomerPhone',
        'customer_province' => 'setCustomerProvince',
        'customer_reference' => 'setCustomerReference',
        'customer_vat_number' => 'setCustomerVatNumber',
        'customer_website' => 'setCustomerWebsite',
        'customer_zipcode' => 'setCustomerZipcode',
        'date' => 'setDate',
        'document_subject' => 'setDocumentSubject',
        'document_type' => 'setDocumentType',
        'hash' => 'setHash',
        'hash_duplicate' => 'setHashDuplicate',
        'invoice_number' => 'setInvoiceNumber',
        'invoice_type' => 'setInvoiceType',
        'lines' => 'setLines',
        'matched_keywords' => 'setMatchedKeywords',
        'matched_lineitems' => 'setMatchedLineitems',
        'merchant_address' => 'setMerchantAddress',
        'merchant_bank_account_number' => 'setMerchantBankAccountNumber',
        'merchant_bank_account_number_bic' => 'setMerchantBankAccountNumberBic',
        'merchant_city' => 'setMerchantCity',
        'merchant_coc_number' => 'setMerchantCocNumber',
        'merchant_country' => 'setMerchantCountry',
        'merchant_country_code' => 'setMerchantCountryCode',
        'merchant_email' => 'setMerchantEmail',
        'merchant_main_activity_code' => 'setMerchantMainActivityCode',
        'merchant_municipality' => 'setMerchantMunicipality',
        'merchant_name' => 'setMerchantName',
        'merchant_phone' => 'setMerchantPhone',
        'merchant_province' => 'setMerchantProvince',
        'merchant_vat_number' => 'setMerchantVatNumber',
        'merchant_website' => 'setMerchantWebsite',
        'merchant_zipcode' => 'setMerchantZipcode',
        'order_number' => 'setOrderNumber',
        'package_number' => 'setPackageNumber',
        'payment_auth_code' => 'setPaymentAuthCode',
        'payment_card_account_number' => 'setPaymentCardAccountNumber',
        'payment_card_bank' => 'setPaymentCardBank',
        'payment_card_issuer' => 'setPaymentCardIssuer',
        'payment_card_number' => 'setPaymentCardNumber',
        'payment_due_date' => 'setPaymentDueDate',
        'payment_slip_code' => 'setPaymentSlipCode',
        'payment_slip_customer_number' => 'setPaymentSlipCustomerNumber',
        'payment_slip_reference_number' => 'setPaymentSlipReferenceNumber',
        'paymentmethod' => 'setPaymentmethod',
        'purchasedate' => 'setPurchasedate',
        'purchasetime' => 'setPurchasetime',
        'raw_text' => 'setRawText',
        'receipt_number' => 'setReceiptNumber',
        'server' => 'setServer',
        'shop_number' => 'setShopNumber',
        'table_group' => 'setTableGroup',
        'table_number' => 'setTableNumber',
        'terminal_number' => 'setTerminalNumber',
        'transaction_number' => 'setTransactionNumber',
        'transaction_reference' => 'setTransactionReference',
        'vatamount' => 'setVatamount',
        'vatitems' => 'setVatitems'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'amount' => 'getAmount',
        'amount_change' => 'getAmountChange',
        'amountexvat' => 'getAmountexvat',
        'currency' => 'getCurrency',
        'customer_address' => 'getCustomerAddress',
        'customer_bank_account_number' => 'getCustomerBankAccountNumber',
        'customer_bank_account_number_bic' => 'getCustomerBankAccountNumberBic',
        'customer_city' => 'getCustomerCity',
        'customer_coc_number' => 'getCustomerCocNumber',
        'customer_country' => 'getCustomerCountry',
        'customer_email' => 'getCustomerEmail',
        'customer_municipality' => 'getCustomerMunicipality',
        'customer_name' => 'getCustomerName',
        'customer_number' => 'getCustomerNumber',
        'customer_phone' => 'getCustomerPhone',
        'customer_province' => 'getCustomerProvince',
        'customer_reference' => 'getCustomerReference',
        'customer_vat_number' => 'getCustomerVatNumber',
        'customer_website' => 'getCustomerWebsite',
        'customer_zipcode' => 'getCustomerZipcode',
        'date' => 'getDate',
        'document_subject' => 'getDocumentSubject',
        'document_type' => 'getDocumentType',
        'hash' => 'getHash',
        'hash_duplicate' => 'getHashDuplicate',
        'invoice_number' => 'getInvoiceNumber',
        'invoice_type' => 'getInvoiceType',
        'lines' => 'getLines',
        'matched_keywords' => 'getMatchedKeywords',
        'matched_lineitems' => 'getMatchedLineitems',
        'merchant_address' => 'getMerchantAddress',
        'merchant_bank_account_number' => 'getMerchantBankAccountNumber',
        'merchant_bank_account_number_bic' => 'getMerchantBankAccountNumberBic',
        'merchant_city' => 'getMerchantCity',
        'merchant_coc_number' => 'getMerchantCocNumber',
        'merchant_country' => 'getMerchantCountry',
        'merchant_country_code' => 'getMerchantCountryCode',
        'merchant_email' => 'getMerchantEmail',
        'merchant_main_activity_code' => 'getMerchantMainActivityCode',
        'merchant_municipality' => 'getMerchantMunicipality',
        'merchant_name' => 'getMerchantName',
        'merchant_phone' => 'getMerchantPhone',
        'merchant_province' => 'getMerchantProvince',
        'merchant_vat_number' => 'getMerchantVatNumber',
        'merchant_website' => 'getMerchantWebsite',
        'merchant_zipcode' => 'getMerchantZipcode',
        'order_number' => 'getOrderNumber',
        'package_number' => 'getPackageNumber',
        'payment_auth_code' => 'getPaymentAuthCode',
        'payment_card_account_number' => 'getPaymentCardAccountNumber',
        'payment_card_bank' => 'getPaymentCardBank',
        'payment_card_issuer' => 'getPaymentCardIssuer',
        'payment_card_number' => 'getPaymentCardNumber',
        'payment_due_date' => 'getPaymentDueDate',
        'payment_slip_code' => 'getPaymentSlipCode',
        'payment_slip_customer_number' => 'getPaymentSlipCustomerNumber',
        'payment_slip_reference_number' => 'getPaymentSlipReferenceNumber',
        'paymentmethod' => 'getPaymentmethod',
        'purchasedate' => 'getPurchasedate',
        'purchasetime' => 'getPurchasetime',
        'raw_text' => 'getRawText',
        'receipt_number' => 'getReceiptNumber',
        'server' => 'getServer',
        'shop_number' => 'getShopNumber',
        'table_group' => 'getTableGroup',
        'table_number' => 'getTableNumber',
        'terminal_number' => 'getTerminalNumber',
        'transaction_number' => 'getTransactionNumber',
        'transaction_reference' => 'getTransactionReference',
        'vatamount' => 'getVatamount',
        'vatitems' => 'getVatitems'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }

    const DOCUMENT_TYPE_EMPTY = '';
    const DOCUMENT_TYPE_INVOICE = 'invoice';
    const DOCUMENT_TYPE_RECEIPT = 'receipt';
    const DOCUMENT_TYPE_BANK_TRANSACTION = 'bank_transaction';
    const DOCUMENT_TYPE_BANK_OVERVIEW = 'bank_overview';
    const DOCUMENT_TYPE_PARKING = 'parking';
    const DOCUMENT_TYPE_PETROL = 'petrol';
    const DOCUMENT_TYPE_TICKET = 'ticket';
    const DOCUMENT_TYPE_BOARDING_PASS = 'boarding_pass';
    const DOCUMENT_TYPE_OTHER = 'other';
    const INVOICE_TYPE_EMPTY = '';
    const INVOICE_TYPE_INVOICE = 'invoice';
    const INVOICE_TYPE_CREDIT_INVOICE = 'credit_invoice';
    const PAYMENTMETHOD_EMPTY = '';
    const PAYMENTMETHOD_CASH = 'cash';
    const PAYMENTMETHOD_CREDITCARD = 'creditcard';
    const PAYMENTMETHOD_PIN = 'pin';
    const PAYMENTMETHOD_BANK = 'bank';
    

    
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getDocumentTypeAllowableValues()
    {
        return [
            self::DOCUMENT_TYPE_EMPTY,
            self::DOCUMENT_TYPE_INVOICE,
            self::DOCUMENT_TYPE_RECEIPT,
            self::DOCUMENT_TYPE_BANK_TRANSACTION,
            self::DOCUMENT_TYPE_BANK_OVERVIEW,
            self::DOCUMENT_TYPE_PARKING,
            self::DOCUMENT_TYPE_PETROL,
            self::DOCUMENT_TYPE_TICKET,
            self::DOCUMENT_TYPE_BOARDING_PASS,
            self::DOCUMENT_TYPE_OTHER,
        ];
    }
    
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getInvoiceTypeAllowableValues()
    {
        return [
            self::INVOICE_TYPE_EMPTY,
            self::INVOICE_TYPE_INVOICE,
            self::INVOICE_TYPE_CREDIT_INVOICE,
        ];
    }
    
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getPaymentmethodAllowableValues()
    {
        return [
            self::PAYMENTMETHOD_EMPTY,
            self::PAYMENTMETHOD_CASH,
            self::PAYMENTMETHOD_CREDITCARD,
            self::PAYMENTMETHOD_PIN,
            self::PAYMENTMETHOD_BANK,
        ];
    }
    

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['amount'] = isset($data['amount']) ? $data['amount'] : null;
        $this->container['amount_change'] = isset($data['amount_change']) ? $data['amount_change'] : null;
        $this->container['amountexvat'] = isset($data['amountexvat']) ? $data['amountexvat'] : null;
        $this->container['currency'] = isset($data['currency']) ? $data['currency'] : null;
        $this->container['customer_address'] = isset($data['customer_address']) ? $data['customer_address'] : null;
        $this->container['customer_bank_account_number'] = isset($data['customer_bank_account_number']) ? $data['customer_bank_account_number'] : null;
        $this->container['customer_bank_account_number_bic'] = isset($data['customer_bank_account_number_bic']) ? $data['customer_bank_account_number_bic'] : null;
        $this->container['customer_city'] = isset($data['customer_city']) ? $data['customer_city'] : null;
        $this->container['customer_coc_number'] = isset($data['customer_coc_number']) ? $data['customer_coc_number'] : null;
        $this->container['customer_country'] = isset($data['customer_country']) ? $data['customer_country'] : null;
        $this->container['customer_email'] = isset($data['customer_email']) ? $data['customer_email'] : null;
        $this->container['customer_municipality'] = isset($data['customer_municipality']) ? $data['customer_municipality'] : null;
        $this->container['customer_name'] = isset($data['customer_name']) ? $data['customer_name'] : null;
        $this->container['customer_number'] = isset($data['customer_number']) ? $data['customer_number'] : null;
        $this->container['customer_phone'] = isset($data['customer_phone']) ? $data['customer_phone'] : null;
        $this->container['customer_province'] = isset($data['customer_province']) ? $data['customer_province'] : null;
        $this->container['customer_reference'] = isset($data['customer_reference']) ? $data['customer_reference'] : null;
        $this->container['customer_vat_number'] = isset($data['customer_vat_number']) ? $data['customer_vat_number'] : null;
        $this->container['customer_website'] = isset($data['customer_website']) ? $data['customer_website'] : null;
        $this->container['customer_zipcode'] = isset($data['customer_zipcode']) ? $data['customer_zipcode'] : null;
        $this->container['date'] = isset($data['date']) ? $data['date'] : null;
        $this->container['document_subject'] = isset($data['document_subject']) ? $data['document_subject'] : null;
        $this->container['document_type'] = isset($data['document_type']) ? $data['document_type'] : null;
        $this->container['hash'] = isset($data['hash']) ? $data['hash'] : null;
        $this->container['hash_duplicate'] = isset($data['hash_duplicate']) ? $data['hash_duplicate'] : null;
        $this->container['invoice_number'] = isset($data['invoice_number']) ? $data['invoice_number'] : null;
        $this->container['invoice_type'] = isset($data['invoice_type']) ? $data['invoice_type'] : null;
        $this->container['lines'] = isset($data['lines']) ? $data['lines'] : null;
        $this->container['matched_keywords'] = isset($data['matched_keywords']) ? $data['matched_keywords'] : null;
        $this->container['matched_lineitems'] = isset($data['matched_lineitems']) ? $data['matched_lineitems'] : null;
        $this->container['merchant_address'] = isset($data['merchant_address']) ? $data['merchant_address'] : null;
        $this->container['merchant_bank_account_number'] = isset($data['merchant_bank_account_number']) ? $data['merchant_bank_account_number'] : null;
        $this->container['merchant_bank_account_number_bic'] = isset($data['merchant_bank_account_number_bic']) ? $data['merchant_bank_account_number_bic'] : null;
        $this->container['merchant_city'] = isset($data['merchant_city']) ? $data['merchant_city'] : null;
        $this->container['merchant_coc_number'] = isset($data['merchant_coc_number']) ? $data['merchant_coc_number'] : null;
        $this->container['merchant_country'] = isset($data['merchant_country']) ? $data['merchant_country'] : null;
        $this->container['merchant_country_code'] = isset($data['merchant_country_code']) ? $data['merchant_country_code'] : null;
        $this->container['merchant_email'] = isset($data['merchant_email']) ? $data['merchant_email'] : null;
        $this->container['merchant_main_activity_code'] = isset($data['merchant_main_activity_code']) ? $data['merchant_main_activity_code'] : null;
        $this->container['merchant_municipality'] = isset($data['merchant_municipality']) ? $data['merchant_municipality'] : null;
        $this->container['merchant_name'] = isset($data['merchant_name']) ? $data['merchant_name'] : null;
        $this->container['merchant_phone'] = isset($data['merchant_phone']) ? $data['merchant_phone'] : null;
        $this->container['merchant_province'] = isset($data['merchant_province']) ? $data['merchant_province'] : null;
        $this->container['merchant_vat_number'] = isset($data['merchant_vat_number']) ? $data['merchant_vat_number'] : null;
        $this->container['merchant_website'] = isset($data['merchant_website']) ? $data['merchant_website'] : null;
        $this->container['merchant_zipcode'] = isset($data['merchant_zipcode']) ? $data['merchant_zipcode'] : null;
        $this->container['order_number'] = isset($data['order_number']) ? $data['order_number'] : null;
        $this->container['package_number'] = isset($data['package_number']) ? $data['package_number'] : null;
        $this->container['payment_auth_code'] = isset($data['payment_auth_code']) ? $data['payment_auth_code'] : null;
        $this->container['payment_card_account_number'] = isset($data['payment_card_account_number']) ? $data['payment_card_account_number'] : null;
        $this->container['payment_card_bank'] = isset($data['payment_card_bank']) ? $data['payment_card_bank'] : null;
        $this->container['payment_card_issuer'] = isset($data['payment_card_issuer']) ? $data['payment_card_issuer'] : null;
        $this->container['payment_card_number'] = isset($data['payment_card_number']) ? $data['payment_card_number'] : null;
        $this->container['payment_due_date'] = isset($data['payment_due_date']) ? $data['payment_due_date'] : null;
        $this->container['payment_slip_code'] = isset($data['payment_slip_code']) ? $data['payment_slip_code'] : null;
        $this->container['payment_slip_customer_number'] = isset($data['payment_slip_customer_number']) ? $data['payment_slip_customer_number'] : null;
        $this->container['payment_slip_reference_number'] = isset($data['payment_slip_reference_number']) ? $data['payment_slip_reference_number'] : null;
        $this->container['paymentmethod'] = isset($data['paymentmethod']) ? $data['paymentmethod'] : null;
        $this->container['purchasedate'] = isset($data['purchasedate']) ? $data['purchasedate'] : null;
        $this->container['purchasetime'] = isset($data['purchasetime']) ? $data['purchasetime'] : null;
        $this->container['raw_text'] = isset($data['raw_text']) ? $data['raw_text'] : null;
        $this->container['receipt_number'] = isset($data['receipt_number']) ? $data['receipt_number'] : null;
        $this->container['server'] = isset($data['server']) ? $data['server'] : null;
        $this->container['shop_number'] = isset($data['shop_number']) ? $data['shop_number'] : null;
        $this->container['table_group'] = isset($data['table_group']) ? $data['table_group'] : null;
        $this->container['table_number'] = isset($data['table_number']) ? $data['table_number'] : null;
        $this->container['terminal_number'] = isset($data['terminal_number']) ? $data['terminal_number'] : null;
        $this->container['transaction_number'] = isset($data['transaction_number']) ? $data['transaction_number'] : null;
        $this->container['transaction_reference'] = isset($data['transaction_reference']) ? $data['transaction_reference'] : null;
        $this->container['vatamount'] = isset($data['vatamount']) ? $data['vatamount'] : null;
        $this->container['vatitems'] = isset($data['vatitems']) ? $data['vatitems'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getDocumentTypeAllowableValues();
        if (!is_null($this->container['document_type']) && !in_array($this->container['document_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'document_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getInvoiceTypeAllowableValues();
        if (!is_null($this->container['invoice_type']) && !in_array($this->container['invoice_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'invoice_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getPaymentmethodAllowableValues();
        if (!is_null($this->container['paymentmethod']) && !in_array($this->container['paymentmethod'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'paymentmethod', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets amount
     *
     * @return int|null
     */
    public function getAmount()
    {
        return $this->container['amount'];
    }

    /**
     * Sets amount
     *
     * @param int|null $amount The total amount, in cents
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->container['amount'] = $amount;

        return $this;
    }

    /**
     * Gets amount_change
     *
     * @return int|null
     */
    public function getAmountChange()
    {
        return $this->container['amount_change'];
    }

    /**
     * Sets amount_change
     *
     * @param int|null $amount_change The change amount, in cents
     *
     * @return $this
     */
    public function setAmountChange($amount_change)
    {
        $this->container['amount_change'] = $amount_change;

        return $this;
    }

    /**
     * Gets amountexvat
     *
     * @return int|null
     */
    public function getAmountexvat()
    {
        return $this->container['amountexvat'];
    }

    /**
     * Sets amountexvat
     *
     * @param int|null $amountexvat The total amount without vat, in cents
     *
     * @return $this
     */
    public function setAmountexvat($amountexvat)
    {
        $this->container['amountexvat'] = $amountexvat;

        return $this;
    }

    /**
     * Gets currency
     *
     * @return string|null
     */
    public function getCurrency()
    {
        return $this->container['currency'];
    }

    /**
     * Sets currency
     *
     * @param string|null $currency The three-letter currency code, as defined in ISO 4217, e.g. `EUR`
     *
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->container['currency'] = $currency;

        return $this;
    }

    /**
     * Gets customer_address
     *
     * @return string|null
     */
    public function getCustomerAddress()
    {
        return $this->container['customer_address'];
    }

    /**
     * Sets customer_address
     *
     * @param string|null $customer_address The address line of the customer, as written on the document
     *
     * @return $this
     */
    public function setCustomerAddress($customer_address)
    {
        $this->container['customer_address'] = $customer_address;

        return $this;
    }

    /**
     * Gets customer_bank_account_number
     *
     * @return string|null
     */
    public function getCustomerBankAccountNumber()
    {
        return $this->container['customer_bank_account_number'];
    }

    /**
     * Sets customer_bank_account_number
     *
     * @param string|null $customer_bank_account_number The IBAN number of the customer.
     *
     * @return $this
     */
    public function setCustomerBankAccountNumber($customer_bank_account_number)
    {
        $this->container['customer_bank_account_number'] = $customer_bank_account_number;

        return $this;
    }

    /**
     * Gets customer_bank_account_number_bic
     *
     * @return string|null
     */
    public function getCustomerBankAccountNumberBic()
    {
        return $this->container['customer_bank_account_number_bic'];
    }

    /**
     * Sets customer_bank_account_number_bic
     *
     * @param string|null $customer_bank_account_number_bic The BIC associated with the IBAN number of the customer
     *
     * @return $this
     */
    public function setCustomerBankAccountNumberBic($customer_bank_account_number_bic)
    {
        $this->container['customer_bank_account_number_bic'] = $customer_bank_account_number_bic;

        return $this;
    }

    /**
     * Gets customer_city
     *
     * @return string|null
     */
    public function getCustomerCity()
    {
        return $this->container['customer_city'];
    }

    /**
     * Sets customer_city
     *
     * @param string|null $customer_city customer_city
     *
     * @return $this
     */
    public function setCustomerCity($customer_city)
    {
        $this->container['customer_city'] = $customer_city;

        return $this;
    }

    /**
     * Gets customer_coc_number
     *
     * @return string|null
     */
    public function getCustomerCocNumber()
    {
        return $this->container['customer_coc_number'];
    }

    /**
     * Sets customer_coc_number
     *
     * @param string|null $customer_coc_number The chamber of commerce number of the customer
     *
     * @return $this
     */
    public function setCustomerCocNumber($customer_coc_number)
    {
        $this->container['customer_coc_number'] = $customer_coc_number;

        return $this;
    }

    /**
     * Gets customer_country
     *
     * @return string|null
     */
    public function getCustomerCountry()
    {
        return $this->container['customer_country'];
    }

    /**
     * Sets customer_country
     *
     * @param string|null $customer_country The name of the country, as written on the document
     *
     * @return $this
     */
    public function setCustomerCountry($customer_country)
    {
        $this->container['customer_country'] = $customer_country;

        return $this;
    }

    /**
     * Gets customer_email
     *
     * @return string|null
     */
    public function getCustomerEmail()
    {
        return $this->container['customer_email'];
    }

    /**
     * Sets customer_email
     *
     * @param string|null $customer_email customer_email
     *
     * @return $this
     */
    public function setCustomerEmail($customer_email)
    {
        $this->container['customer_email'] = $customer_email;

        return $this;
    }

    /**
     * Gets customer_municipality
     *
     * @return string|null
     */
    public function getCustomerMunicipality()
    {
        return $this->container['customer_municipality'];
    }

    /**
     * Sets customer_municipality
     *
     * @param string|null $customer_municipality customer_municipality
     *
     * @return $this
     */
    public function setCustomerMunicipality($customer_municipality)
    {
        $this->container['customer_municipality'] = $customer_municipality;

        return $this;
    }

    /**
     * Gets customer_name
     *
     * @return string|null
     */
    public function getCustomerName()
    {
        return $this->container['customer_name'];
    }

    /**
     * Sets customer_name
     *
     * @param string|null $customer_name The name of the customer
     *
     * @return $this
     */
    public function setCustomerName($customer_name)
    {
        $this->container['customer_name'] = $customer_name;

        return $this;
    }

    /**
     * Gets customer_number
     *
     * @return string|null
     */
    public function getCustomerNumber()
    {
        return $this->container['customer_number'];
    }

    /**
     * Sets customer_number
     *
     * @param string|null $customer_number A number used by the merchant to identify the customer
     *
     * @return $this
     */
    public function setCustomerNumber($customer_number)
    {
        $this->container['customer_number'] = $customer_number;

        return $this;
    }

    /**
     * Gets customer_phone
     *
     * @return string|null
     */
    public function getCustomerPhone()
    {
        return $this->container['customer_phone'];
    }

    /**
     * Sets customer_phone
     *
     * @param string|null $customer_phone customer_phone
     *
     * @return $this
     */
    public function setCustomerPhone($customer_phone)
    {
        $this->container['customer_phone'] = $customer_phone;

        return $this;
    }

    /**
     * Gets customer_province
     *
     * @return string|null
     */
    public function getCustomerProvince()
    {
        return $this->container['customer_province'];
    }

    /**
     * Sets customer_province
     *
     * @param string|null $customer_province customer_province
     *
     * @return $this
     */
    public function setCustomerProvince($customer_province)
    {
        $this->container['customer_province'] = $customer_province;

        return $this;
    }

    /**
     * Gets customer_reference
     *
     * @return string|null
     */
    public function getCustomerReference()
    {
        return $this->container['customer_reference'];
    }

    /**
     * Sets customer_reference
     *
     * @param string|null $customer_reference A reference to this document, given by the customer
     *
     * @return $this
     */
    public function setCustomerReference($customer_reference)
    {
        $this->container['customer_reference'] = $customer_reference;

        return $this;
    }

    /**
     * Gets customer_vat_number
     *
     * @return string|null
     */
    public function getCustomerVatNumber()
    {
        return $this->container['customer_vat_number'];
    }

    /**
     * Sets customer_vat_number
     *
     * @param string|null $customer_vat_number The VAT number of the customer. It contains the two-letter country code, followed by a country-specific implementation of the VAT number.
     *
     * @return $this
     */
    public function setCustomerVatNumber($customer_vat_number)
    {
        $this->container['customer_vat_number'] = $customer_vat_number;

        return $this;
    }

    /**
     * Gets customer_website
     *
     * @return string|null
     */
    public function getCustomerWebsite()
    {
        return $this->container['customer_website'];
    }

    /**
     * Sets customer_website
     *
     * @param string|null $customer_website customer_website
     *
     * @return $this
     */
    public function setCustomerWebsite($customer_website)
    {
        $this->container['customer_website'] = $customer_website;

        return $this;
    }

    /**
     * Gets customer_zipcode
     *
     * @return string|null
     */
    public function getCustomerZipcode()
    {
        return $this->container['customer_zipcode'];
    }

    /**
     * Sets customer_zipcode
     *
     * @param string|null $customer_zipcode The zipcode of the customer. Dutch postcodes are formatted as 1234 AB
     *
     * @return $this
     */
    public function setCustomerZipcode($customer_zipcode)
    {
        $this->container['customer_zipcode'] = $customer_zipcode;

        return $this;
    }

    /**
     * Gets date
     *
     * @return string|null
     */
    public function getDate()
    {
        return $this->container['date'];
    }

    /**
     * Sets date
     *
     * @param string|null $date The purchase datetime as ISO string, E.g. `2019-07-01T16:46:00`
     *
     * @return $this
     */
    public function setDate($date)
    {
        $this->container['date'] = $date;

        return $this;
    }

    /**
     * Gets document_subject
     *
     * @return string|null
     */
    public function getDocumentSubject()
    {
        return $this->container['document_subject'];
    }

    /**
     * Sets document_subject
     *
     * @param string|null $document_subject The subject of the document
     *
     * @return $this
     */
    public function setDocumentSubject($document_subject)
    {
        $this->container['document_subject'] = $document_subject;

        return $this;
    }

    /**
     * Gets document_type
     *
     * @return string|null
     */
    public function getDocumentType()
    {
        return $this->container['document_type'];
    }

    /**
     * Sets document_type
     *
     * @param string|null $document_type document_type
     *
     * @return $this
     */
    public function setDocumentType($document_type)
    {
        $allowedValues = $this->getDocumentTypeAllowableValues();
        if (!is_null($document_type) && !in_array($document_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'document_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['document_type'] = $document_type;

        return $this;
    }

    /**
     * Gets hash
     *
     * @return string|null
     */
    public function getHash()
    {
        return $this->container['hash'];
    }

    /**
     * Sets hash
     *
     * @param string|null $hash Unique hash of the receipt.
     *
     * @return $this
     */
    public function setHash($hash)
    {
        $this->container['hash'] = $hash;

        return $this;
    }

    /**
     * Gets hash_duplicate
     *
     * @return bool|null
     */
    public function getHashDuplicate()
    {
        return $this->container['hash_duplicate'];
    }

    /**
     * Sets hash_duplicate
     *
     * @param bool|null $hash_duplicate Whether we have seen the hash before for the current key.
     *
     * @return $this
     */
    public function setHashDuplicate($hash_duplicate)
    {
        $this->container['hash_duplicate'] = $hash_duplicate;

        return $this;
    }

    /**
     * Gets invoice_number
     *
     * @return string|null
     */
    public function getInvoiceNumber()
    {
        return $this->container['invoice_number'];
    }

    /**
     * Sets invoice_number
     *
     * @param string|null $invoice_number The number of the invoice
     *
     * @return $this
     */
    public function setInvoiceNumber($invoice_number)
    {
        $this->container['invoice_number'] = $invoice_number;

        return $this;
    }

    /**
     * Gets invoice_type
     *
     * @return string|null
     */
    public function getInvoiceType()
    {
        return $this->container['invoice_type'];
    }

    /**
     * Sets invoice_type
     *
     * @param string|null $invoice_type invoice_type
     *
     * @return $this
     */
    public function setInvoiceType($invoice_type)
    {
        $allowedValues = $this->getInvoiceTypeAllowableValues();
        if (!is_null($invoice_type) && !in_array($invoice_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'invoice_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['invoice_type'] = $invoice_type;

        return $this;
    }

    /**
     * Gets lines
     *
     * @return \KlippaOCRAPI\Model\ReceiptLineItem[]|null
     */
    public function getLines()
    {
        return $this->container['lines'];
    }

    /**
     * Sets lines
     *
     * @param \KlippaOCRAPI\Model\ReceiptLineItem[]|null $lines lines
     *
     * @return $this
     */
    public function setLines($lines)
    {
        $this->container['lines'] = $lines;

        return $this;
    }

    /**
     * Gets matched_keywords
     *
     * @return \KlippaOCRAPI\Model\MatchedKeyword[]|null
     */
    public function getMatchedKeywords()
    {
        return $this->container['matched_keywords'];
    }

    /**
     * Sets matched_keywords
     *
     * @param \KlippaOCRAPI\Model\MatchedKeyword[]|null $matched_keywords If keywords have been given in the userdata, matched_keywords will contain the id's of the keywords that matched, and their number of occurrences.
     *
     * @return $this
     */
    public function setMatchedKeywords($matched_keywords)
    {
        $this->container['matched_keywords'] = $matched_keywords;

        return $this;
    }

    /**
     * Gets matched_lineitems
     *
     * @return \KlippaOCRAPI\Model\MatchedLineItemItem[]|null
     */
    public function getMatchedLineitems()
    {
        return $this->container['matched_lineitems'];
    }

    /**
     * Sets matched_lineitems
     *
     * @param \KlippaOCRAPI\Model\MatchedLineItemItem[]|null $matched_lineitems If keywords have been given for lineitems in the userdata, matched_lineitems will contain the id's of the keywords that matched, and the lineitems on which the matches were made.
     *
     * @return $this
     */
    public function setMatchedLineitems($matched_lineitems)
    {
        $this->container['matched_lineitems'] = $matched_lineitems;

        return $this;
    }

    /**
     * Gets merchant_address
     *
     * @return string|null
     */
    public function getMerchantAddress()
    {
        return $this->container['merchant_address'];
    }

    /**
     * Sets merchant_address
     *
     * @param string|null $merchant_address The address line of the merchant, as written on the document
     *
     * @return $this
     */
    public function setMerchantAddress($merchant_address)
    {
        $this->container['merchant_address'] = $merchant_address;

        return $this;
    }

    /**
     * Gets merchant_bank_account_number
     *
     * @return string|null
     */
    public function getMerchantBankAccountNumber()
    {
        return $this->container['merchant_bank_account_number'];
    }

    /**
     * Sets merchant_bank_account_number
     *
     * @param string|null $merchant_bank_account_number The IBAN number of the merchant.
     *
     * @return $this
     */
    public function setMerchantBankAccountNumber($merchant_bank_account_number)
    {
        $this->container['merchant_bank_account_number'] = $merchant_bank_account_number;

        return $this;
    }

    /**
     * Gets merchant_bank_account_number_bic
     *
     * @return string|null
     */
    public function getMerchantBankAccountNumberBic()
    {
        return $this->container['merchant_bank_account_number_bic'];
    }

    /**
     * Sets merchant_bank_account_number_bic
     *
     * @param string|null $merchant_bank_account_number_bic The BIC associated with the IBAN number of the merchant
     *
     * @return $this
     */
    public function setMerchantBankAccountNumberBic($merchant_bank_account_number_bic)
    {
        $this->container['merchant_bank_account_number_bic'] = $merchant_bank_account_number_bic;

        return $this;
    }

    /**
     * Gets merchant_city
     *
     * @return string|null
     */
    public function getMerchantCity()
    {
        return $this->container['merchant_city'];
    }

    /**
     * Sets merchant_city
     *
     * @param string|null $merchant_city merchant_city
     *
     * @return $this
     */
    public function setMerchantCity($merchant_city)
    {
        $this->container['merchant_city'] = $merchant_city;

        return $this;
    }

    /**
     * Gets merchant_coc_number
     *
     * @return string|null
     */
    public function getMerchantCocNumber()
    {
        return $this->container['merchant_coc_number'];
    }

    /**
     * Sets merchant_coc_number
     *
     * @param string|null $merchant_coc_number The chamber of commerce number of the merchant
     *
     * @return $this
     */
    public function setMerchantCocNumber($merchant_coc_number)
    {
        $this->container['merchant_coc_number'] = $merchant_coc_number;

        return $this;
    }

    /**
     * Gets merchant_country
     *
     * @return string|null
     */
    public function getMerchantCountry()
    {
        return $this->container['merchant_country'];
    }

    /**
     * Sets merchant_country
     *
     * @param string|null $merchant_country The name of the country, as written on the document
     *
     * @return $this
     */
    public function setMerchantCountry($merchant_country)
    {
        $this->container['merchant_country'] = $merchant_country;

        return $this;
    }

    /**
     * Gets merchant_country_code
     *
     * @return string|null
     */
    public function getMerchantCountryCode()
    {
        return $this->container['merchant_country_code'];
    }

    /**
     * Sets merchant_country_code
     *
     * @param string|null $merchant_country_code The name of the country as two-letter country code
     *
     * @return $this
     */
    public function setMerchantCountryCode($merchant_country_code)
    {
        $this->container['merchant_country_code'] = $merchant_country_code;

        return $this;
    }

    /**
     * Gets merchant_email
     *
     * @return string|null
     */
    public function getMerchantEmail()
    {
        return $this->container['merchant_email'];
    }

    /**
     * Sets merchant_email
     *
     * @param string|null $merchant_email merchant_email
     *
     * @return $this
     */
    public function setMerchantEmail($merchant_email)
    {
        $this->container['merchant_email'] = $merchant_email;

        return $this;
    }

    /**
     * Gets merchant_main_activity_code
     *
     * @return string|null
     */
    public function getMerchantMainActivityCode()
    {
        return $this->container['merchant_main_activity_code'];
    }

    /**
     * Sets merchant_main_activity_code
     *
     * @param string|null $merchant_main_activity_code The main activity code of the merchant
     *
     * @return $this
     */
    public function setMerchantMainActivityCode($merchant_main_activity_code)
    {
        $this->container['merchant_main_activity_code'] = $merchant_main_activity_code;

        return $this;
    }

    /**
     * Gets merchant_municipality
     *
     * @return string|null
     */
    public function getMerchantMunicipality()
    {
        return $this->container['merchant_municipality'];
    }

    /**
     * Sets merchant_municipality
     *
     * @param string|null $merchant_municipality merchant_municipality
     *
     * @return $this
     */
    public function setMerchantMunicipality($merchant_municipality)
    {
        $this->container['merchant_municipality'] = $merchant_municipality;

        return $this;
    }

    /**
     * Gets merchant_name
     *
     * @return string|null
     */
    public function getMerchantName()
    {
        return $this->container['merchant_name'];
    }

    /**
     * Sets merchant_name
     *
     * @param string|null $merchant_name The name of the merchant
     *
     * @return $this
     */
    public function setMerchantName($merchant_name)
    {
        $this->container['merchant_name'] = $merchant_name;

        return $this;
    }

    /**
     * Gets merchant_phone
     *
     * @return string|null
     */
    public function getMerchantPhone()
    {
        return $this->container['merchant_phone'];
    }

    /**
     * Sets merchant_phone
     *
     * @param string|null $merchant_phone merchant_phone
     *
     * @return $this
     */
    public function setMerchantPhone($merchant_phone)
    {
        $this->container['merchant_phone'] = $merchant_phone;

        return $this;
    }

    /**
     * Gets merchant_province
     *
     * @return string|null
     */
    public function getMerchantProvince()
    {
        return $this->container['merchant_province'];
    }

    /**
     * Sets merchant_province
     *
     * @param string|null $merchant_province merchant_province
     *
     * @return $this
     */
    public function setMerchantProvince($merchant_province)
    {
        $this->container['merchant_province'] = $merchant_province;

        return $this;
    }

    /**
     * Gets merchant_vat_number
     *
     * @return string|null
     */
    public function getMerchantVatNumber()
    {
        return $this->container['merchant_vat_number'];
    }

    /**
     * Sets merchant_vat_number
     *
     * @param string|null $merchant_vat_number The VAT number of the merchant. It contains the two-letter country code, followed by a country-specific implementation of the VAT number.
     *
     * @return $this
     */
    public function setMerchantVatNumber($merchant_vat_number)
    {
        $this->container['merchant_vat_number'] = $merchant_vat_number;

        return $this;
    }

    /**
     * Gets merchant_website
     *
     * @return string|null
     */
    public function getMerchantWebsite()
    {
        return $this->container['merchant_website'];
    }

    /**
     * Sets merchant_website
     *
     * @param string|null $merchant_website merchant_website
     *
     * @return $this
     */
    public function setMerchantWebsite($merchant_website)
    {
        $this->container['merchant_website'] = $merchant_website;

        return $this;
    }

    /**
     * Gets merchant_zipcode
     *
     * @return string|null
     */
    public function getMerchantZipcode()
    {
        return $this->container['merchant_zipcode'];
    }

    /**
     * Sets merchant_zipcode
     *
     * @param string|null $merchant_zipcode The zipcode of the merchant. Dutch postcodes are formatted as 1234 AB
     *
     * @return $this
     */
    public function setMerchantZipcode($merchant_zipcode)
    {
        $this->container['merchant_zipcode'] = $merchant_zipcode;

        return $this;
    }

    /**
     * Gets order_number
     *
     * @return string|null
     */
    public function getOrderNumber()
    {
        return $this->container['order_number'];
    }

    /**
     * Sets order_number
     *
     * @param string|null $order_number The order number
     *
     * @return $this
     */
    public function setOrderNumber($order_number)
    {
        $this->container['order_number'] = $order_number;

        return $this;
    }

    /**
     * Gets package_number
     *
     * @return string|null
     */
    public function getPackageNumber()
    {
        return $this->container['package_number'];
    }

    /**
     * Sets package_number
     *
     * @param string|null $package_number Package number, usually found on packaging slips
     *
     * @return $this
     */
    public function setPackageNumber($package_number)
    {
        $this->container['package_number'] = $package_number;

        return $this;
    }

    /**
     * Gets payment_auth_code
     *
     * @return string|null
     */
    public function getPaymentAuthCode()
    {
        return $this->container['payment_auth_code'];
    }

    /**
     * Sets payment_auth_code
     *
     * @param string|null $payment_auth_code The transaction authorization code
     *
     * @return $this
     */
    public function setPaymentAuthCode($payment_auth_code)
    {
        $this->container['payment_auth_code'] = $payment_auth_code;

        return $this;
    }

    /**
     * Gets payment_card_account_number
     *
     * @return string|null
     */
    public function getPaymentCardAccountNumber()
    {
        return $this->container['payment_card_account_number'];
    }

    /**
     * Sets payment_card_account_number
     *
     * @param string|null $payment_card_account_number The account number of the card that was used to complete the payment
     *
     * @return $this
     */
    public function setPaymentCardAccountNumber($payment_card_account_number)
    {
        $this->container['payment_card_account_number'] = $payment_card_account_number;

        return $this;
    }

    /**
     * Gets payment_card_bank
     *
     * @return string|null
     */
    public function getPaymentCardBank()
    {
        return $this->container['payment_card_bank'];
    }

    /**
     * Sets payment_card_bank
     *
     * @param string|null $payment_card_bank payment_card_bank
     *
     * @return $this
     */
    public function setPaymentCardBank($payment_card_bank)
    {
        $this->container['payment_card_bank'] = $payment_card_bank;

        return $this;
    }

    /**
     * Gets payment_card_issuer
     *
     * @return string|null
     */
    public function getPaymentCardIssuer()
    {
        return $this->container['payment_card_issuer'];
    }

    /**
     * Sets payment_card_issuer
     *
     * @param string|null $payment_card_issuer Name of the party that issued the credit- or debit card
     *
     * @return $this
     */
    public function setPaymentCardIssuer($payment_card_issuer)
    {
        $this->container['payment_card_issuer'] = $payment_card_issuer;

        return $this;
    }

    /**
     * Gets payment_card_number
     *
     * @return string|null
     */
    public function getPaymentCardNumber()
    {
        return $this->container['payment_card_number'];
    }

    /**
     * Sets payment_card_number
     *
     * @param string|null $payment_card_number payment_card_number
     *
     * @return $this
     */
    public function setPaymentCardNumber($payment_card_number)
    {
        $this->container['payment_card_number'] = $payment_card_number;

        return $this;
    }

    /**
     * Gets payment_due_date
     *
     * @return string|null
     */
    public function getPaymentDueDate()
    {
        return $this->container['payment_due_date'];
    }

    /**
     * Sets payment_due_date
     *
     * @param string|null $payment_due_date Date on which the payment is due as ISO string, E.g. `2019-07-01T00:00:00`
     *
     * @return $this
     */
    public function setPaymentDueDate($payment_due_date)
    {
        $this->container['payment_due_date'] = $payment_due_date;

        return $this;
    }

    /**
     * Gets payment_slip_code
     *
     * @return string|null
     */
    public function getPaymentSlipCode()
    {
        return $this->container['payment_slip_code'];
    }

    /**
     * Sets payment_slip_code
     *
     * @param string|null $payment_slip_code The full code of the payment slip
     *
     * @return $this
     */
    public function setPaymentSlipCode($payment_slip_code)
    {
        $this->container['payment_slip_code'] = $payment_slip_code;

        return $this;
    }

    /**
     * Gets payment_slip_customer_number
     *
     * @return string|null
     */
    public function getPaymentSlipCustomerNumber()
    {
        return $this->container['payment_slip_customer_number'];
    }

    /**
     * Sets payment_slip_customer_number
     *
     * @param string|null $payment_slip_customer_number The customer number of the payment slip
     *
     * @return $this
     */
    public function setPaymentSlipCustomerNumber($payment_slip_customer_number)
    {
        $this->container['payment_slip_customer_number'] = $payment_slip_customer_number;

        return $this;
    }

    /**
     * Gets payment_slip_reference_number
     *
     * @return string|null
     */
    public function getPaymentSlipReferenceNumber()
    {
        return $this->container['payment_slip_reference_number'];
    }

    /**
     * Sets payment_slip_reference_number
     *
     * @param string|null $payment_slip_reference_number The reference number of the payment slip
     *
     * @return $this
     */
    public function setPaymentSlipReferenceNumber($payment_slip_reference_number)
    {
        $this->container['payment_slip_reference_number'] = $payment_slip_reference_number;

        return $this;
    }

    /**
     * Gets paymentmethod
     *
     * @return string|null
     */
    public function getPaymentmethod()
    {
        return $this->container['paymentmethod'];
    }

    /**
     * Sets paymentmethod
     *
     * @param string|null $paymentmethod paymentmethod
     *
     * @return $this
     */
    public function setPaymentmethod($paymentmethod)
    {
        $allowedValues = $this->getPaymentmethodAllowableValues();
        if (!is_null($paymentmethod) && !in_array($paymentmethod, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'paymentmethod', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['paymentmethod'] = $paymentmethod;

        return $this;
    }

    /**
     * Gets purchasedate
     *
     * @return string|null
     */
    public function getPurchasedate()
    {
        return $this->container['purchasedate'];
    }

    /**
     * Sets purchasedate
     *
     * @param string|null $purchasedate The purchase date as `yyyy-mm-dd` string, e.g. `2019-07-01`
     *
     * @return $this
     */
    public function setPurchasedate($purchasedate)
    {
        $this->container['purchasedate'] = $purchasedate;

        return $this;
    }

    /**
     * Gets purchasetime
     *
     * @return string|null
     */
    public function getPurchasetime()
    {
        return $this->container['purchasetime'];
    }

    /**
     * Sets purchasetime
     *
     * @param string|null $purchasetime The purchase time as hh:mm:ss string, e.g. `16:46:00`
     *
     * @return $this
     */
    public function setPurchasetime($purchasetime)
    {
        $this->container['purchasetime'] = $purchasetime;

        return $this;
    }

    /**
     * Gets raw_text
     *
     * @return string|null
     */
    public function getRawText()
    {
        return $this->container['raw_text'];
    }

    /**
     * Sets raw_text
     *
     * @param string|null $raw_text Original plain text of receipt.
     *
     * @return $this
     */
    public function setRawText($raw_text)
    {
        $this->container['raw_text'] = $raw_text;

        return $this;
    }

    /**
     * Gets receipt_number
     *
     * @return string|null
     */
    public function getReceiptNumber()
    {
        return $this->container['receipt_number'];
    }

    /**
     * Sets receipt_number
     *
     * @param string|null $receipt_number The receipt ticket number
     *
     * @return $this
     */
    public function setReceiptNumber($receipt_number)
    {
        $this->container['receipt_number'] = $receipt_number;

        return $this;
    }

    /**
     * Gets server
     *
     * @return string|null
     */
    public function getServer()
    {
        return $this->container['server'];
    }

    /**
     * Sets server
     *
     * @param string|null $server server
     *
     * @return $this
     */
    public function setServer($server)
    {
        $this->container['server'] = $server;

        return $this;
    }

    /**
     * Gets shop_number
     *
     * @return string|null
     */
    public function getShopNumber()
    {
        return $this->container['shop_number'];
    }

    /**
     * Sets shop_number
     *
     * @param string|null $shop_number A number that identifies the store in which the payment was processed. Usually found on EFT receipts.
     *
     * @return $this
     */
    public function setShopNumber($shop_number)
    {
        $this->container['shop_number'] = $shop_number;

        return $this;
    }

    /**
     * Gets table_group
     *
     * @return string|null
     */
    public function getTableGroup()
    {
        return $this->container['table_group'];
    }

    /**
     * Sets table_group
     *
     * @param string|null $table_group table_group
     *
     * @return $this
     */
    public function setTableGroup($table_group)
    {
        $this->container['table_group'] = $table_group;

        return $this;
    }

    /**
     * Gets table_number
     *
     * @return string|null
     */
    public function getTableNumber()
    {
        return $this->container['table_number'];
    }

    /**
     * Sets table_number
     *
     * @param string|null $table_number table_number
     *
     * @return $this
     */
    public function setTableNumber($table_number)
    {
        $this->container['table_number'] = $table_number;

        return $this;
    }

    /**
     * Gets terminal_number
     *
     * @return string|null
     */
    public function getTerminalNumber()
    {
        return $this->container['terminal_number'];
    }

    /**
     * Sets terminal_number
     *
     * @param string|null $terminal_number A number that identifies the terminal on which the payment was processed. Usually found on EFT receipts.
     *
     * @return $this
     */
    public function setTerminalNumber($terminal_number)
    {
        $this->container['terminal_number'] = $terminal_number;

        return $this;
    }

    /**
     * Gets transaction_number
     *
     * @return string|null
     */
    public function getTransactionNumber()
    {
        return $this->container['transaction_number'];
    }

    /**
     * Sets transaction_number
     *
     * @param string|null $transaction_number The transaction number provided by the payment processor. Usually found on EFT receipts.
     *
     * @return $this
     */
    public function setTransactionNumber($transaction_number)
    {
        $this->container['transaction_number'] = $transaction_number;

        return $this;
    }

    /**
     * Gets transaction_reference
     *
     * @return string|null
     */
    public function getTransactionReference()
    {
        return $this->container['transaction_reference'];
    }

    /**
     * Sets transaction_reference
     *
     * @param string|null $transaction_reference A transaction reference provided by the merchant
     *
     * @return $this
     */
    public function setTransactionReference($transaction_reference)
    {
        $this->container['transaction_reference'] = $transaction_reference;

        return $this;
    }

    /**
     * Gets vatamount
     *
     * @return int|null
     */
    public function getVatamount()
    {
        return $this->container['vatamount'];
    }

    /**
     * Sets vatamount
     *
     * @param int|null $vatamount The total VAT amount, in cents
     *
     * @return $this
     */
    public function setVatamount($vatamount)
    {
        $this->container['vatamount'] = $vatamount;

        return $this;
    }

    /**
     * Gets vatitems
     *
     * @return \KlippaOCRAPI\Model\ReceiptVAT[]|null
     */
    public function getVatitems()
    {
        return $this->container['vatitems'];
    }

    /**
     * Sets vatitems
     *
     * @param \KlippaOCRAPI\Model\ReceiptVAT[]|null $vatitems vatitems
     *
     * @return $this
     */
    public function setVatitems($vatitems)
    {
        $this->container['vatitems'] = $vatitems;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


