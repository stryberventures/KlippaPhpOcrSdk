<?php
/**
 * EuropeanPassport
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
 * EuropeanPassport Class Doc Comment
 *
 * @category Class
 * @package  KlippaOCRAPI
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class EuropeanPassport implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'EuropeanPassport';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'authority' => 'string',
        'date_of_birth' => 'string',
        'date_of_expiry' => 'string',
        'date_of_issue' => 'string',
        'document_code' => 'string',
        'document_number' => 'string',
        'document_type' => 'string',
        'gender' => 'string',
        'given_names' => 'string',
        'height' => 'string',
        'issuing_country' => 'string',
        'nationality' => 'string',
        'personal_number' => 'string',
        'place_of_birth' => 'string',
        'raw_text' => 'string',
        'surname' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPIFormats = [
        'authority' => null,
        'date_of_birth' => null,
        'date_of_expiry' => null,
        'date_of_issue' => null,
        'document_code' => null,
        'document_number' => null,
        'document_type' => null,
        'gender' => null,
        'given_names' => null,
        'height' => null,
        'issuing_country' => null,
        'nationality' => null,
        'personal_number' => null,
        'place_of_birth' => null,
        'raw_text' => null,
        'surname' => null
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
        'authority' => 'authority',
        'date_of_birth' => 'date_of_birth',
        'date_of_expiry' => 'date_of_expiry',
        'date_of_issue' => 'date_of_issue',
        'document_code' => 'document_code',
        'document_number' => 'document_number',
        'document_type' => 'document_type',
        'gender' => 'gender',
        'given_names' => 'given_names',
        'height' => 'height',
        'issuing_country' => 'issuing_country',
        'nationality' => 'nationality',
        'personal_number' => 'personal_number',
        'place_of_birth' => 'place_of_birth',
        'raw_text' => 'raw_text',
        'surname' => 'surname'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'authority' => 'setAuthority',
        'date_of_birth' => 'setDateOfBirth',
        'date_of_expiry' => 'setDateOfExpiry',
        'date_of_issue' => 'setDateOfIssue',
        'document_code' => 'setDocumentCode',
        'document_number' => 'setDocumentNumber',
        'document_type' => 'setDocumentType',
        'gender' => 'setGender',
        'given_names' => 'setGivenNames',
        'height' => 'setHeight',
        'issuing_country' => 'setIssuingCountry',
        'nationality' => 'setNationality',
        'personal_number' => 'setPersonalNumber',
        'place_of_birth' => 'setPlaceOfBirth',
        'raw_text' => 'setRawText',
        'surname' => 'setSurname'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'authority' => 'getAuthority',
        'date_of_birth' => 'getDateOfBirth',
        'date_of_expiry' => 'getDateOfExpiry',
        'date_of_issue' => 'getDateOfIssue',
        'document_code' => 'getDocumentCode',
        'document_number' => 'getDocumentNumber',
        'document_type' => 'getDocumentType',
        'gender' => 'getGender',
        'given_names' => 'getGivenNames',
        'height' => 'getHeight',
        'issuing_country' => 'getIssuingCountry',
        'nationality' => 'getNationality',
        'personal_number' => 'getPersonalNumber',
        'place_of_birth' => 'getPlaceOfBirth',
        'raw_text' => 'getRawText',
        'surname' => 'getSurname'
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
        $this->container['authority'] = isset($data['authority']) ? $data['authority'] : null;
        $this->container['date_of_birth'] = isset($data['date_of_birth']) ? $data['date_of_birth'] : null;
        $this->container['date_of_expiry'] = isset($data['date_of_expiry']) ? $data['date_of_expiry'] : null;
        $this->container['date_of_issue'] = isset($data['date_of_issue']) ? $data['date_of_issue'] : null;
        $this->container['document_code'] = isset($data['document_code']) ? $data['document_code'] : null;
        $this->container['document_number'] = isset($data['document_number']) ? $data['document_number'] : null;
        $this->container['document_type'] = isset($data['document_type']) ? $data['document_type'] : null;
        $this->container['gender'] = isset($data['gender']) ? $data['gender'] : null;
        $this->container['given_names'] = isset($data['given_names']) ? $data['given_names'] : null;
        $this->container['height'] = isset($data['height']) ? $data['height'] : null;
        $this->container['issuing_country'] = isset($data['issuing_country']) ? $data['issuing_country'] : null;
        $this->container['nationality'] = isset($data['nationality']) ? $data['nationality'] : null;
        $this->container['personal_number'] = isset($data['personal_number']) ? $data['personal_number'] : null;
        $this->container['place_of_birth'] = isset($data['place_of_birth']) ? $data['place_of_birth'] : null;
        $this->container['raw_text'] = isset($data['raw_text']) ? $data['raw_text'] : null;
        $this->container['surname'] = isset($data['surname']) ? $data['surname'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

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
     * Gets authority
     *
     * @return string|null
     */
    public function getAuthority()
    {
        return $this->container['authority'];
    }

    /**
     * Sets authority
     *
     * @param string|null $authority authority
     *
     * @return $this
     */
    public function setAuthority($authority)
    {
        $this->container['authority'] = $authority;

        return $this;
    }

    /**
     * Gets date_of_birth
     *
     * @return string|null
     */
    public function getDateOfBirth()
    {
        return $this->container['date_of_birth'];
    }

    /**
     * Sets date_of_birth
     *
     * @param string|null $date_of_birth date_of_birth
     *
     * @return $this
     */
    public function setDateOfBirth($date_of_birth)
    {
        $this->container['date_of_birth'] = $date_of_birth;

        return $this;
    }

    /**
     * Gets date_of_expiry
     *
     * @return string|null
     */
    public function getDateOfExpiry()
    {
        return $this->container['date_of_expiry'];
    }

    /**
     * Sets date_of_expiry
     *
     * @param string|null $date_of_expiry date_of_expiry
     *
     * @return $this
     */
    public function setDateOfExpiry($date_of_expiry)
    {
        $this->container['date_of_expiry'] = $date_of_expiry;

        return $this;
    }

    /**
     * Gets date_of_issue
     *
     * @return string|null
     */
    public function getDateOfIssue()
    {
        return $this->container['date_of_issue'];
    }

    /**
     * Sets date_of_issue
     *
     * @param string|null $date_of_issue date_of_issue
     *
     * @return $this
     */
    public function setDateOfIssue($date_of_issue)
    {
        $this->container['date_of_issue'] = $date_of_issue;

        return $this;
    }

    /**
     * Gets document_code
     *
     * @return string|null
     */
    public function getDocumentCode()
    {
        return $this->container['document_code'];
    }

    /**
     * Sets document_code
     *
     * @param string|null $document_code document_code
     *
     * @return $this
     */
    public function setDocumentCode($document_code)
    {
        $this->container['document_code'] = $document_code;

        return $this;
    }

    /**
     * Gets document_number
     *
     * @return string|null
     */
    public function getDocumentNumber()
    {
        return $this->container['document_number'];
    }

    /**
     * Sets document_number
     *
     * @param string|null $document_number document_number
     *
     * @return $this
     */
    public function setDocumentNumber($document_number)
    {
        $this->container['document_number'] = $document_number;

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
     * @param string|null $document_type European Passport.
     *
     * @return $this
     */
    public function setDocumentType($document_type)
    {
        $this->container['document_type'] = $document_type;

        return $this;
    }

    /**
     * Gets gender
     *
     * @return string|null
     */
    public function getGender()
    {
        return $this->container['gender'];
    }

    /**
     * Sets gender
     *
     * @param string|null $gender gender
     *
     * @return $this
     */
    public function setGender($gender)
    {
        $this->container['gender'] = $gender;

        return $this;
    }

    /**
     * Gets given_names
     *
     * @return string|null
     */
    public function getGivenNames()
    {
        return $this->container['given_names'];
    }

    /**
     * Sets given_names
     *
     * @param string|null $given_names given_names
     *
     * @return $this
     */
    public function setGivenNames($given_names)
    {
        $this->container['given_names'] = $given_names;

        return $this;
    }

    /**
     * Gets height
     *
     * @return string|null
     */
    public function getHeight()
    {
        return $this->container['height'];
    }

    /**
     * Sets height
     *
     * @param string|null $height height
     *
     * @return $this
     */
    public function setHeight($height)
    {
        $this->container['height'] = $height;

        return $this;
    }

    /**
     * Gets issuing_country
     *
     * @return string|null
     */
    public function getIssuingCountry()
    {
        return $this->container['issuing_country'];
    }

    /**
     * Sets issuing_country
     *
     * @param string|null $issuing_country issuing_country
     *
     * @return $this
     */
    public function setIssuingCountry($issuing_country)
    {
        $this->container['issuing_country'] = $issuing_country;

        return $this;
    }

    /**
     * Gets nationality
     *
     * @return string|null
     */
    public function getNationality()
    {
        return $this->container['nationality'];
    }

    /**
     * Sets nationality
     *
     * @param string|null $nationality nationality
     *
     * @return $this
     */
    public function setNationality($nationality)
    {
        $this->container['nationality'] = $nationality;

        return $this;
    }

    /**
     * Gets personal_number
     *
     * @return string|null
     */
    public function getPersonalNumber()
    {
        return $this->container['personal_number'];
    }

    /**
     * Sets personal_number
     *
     * @param string|null $personal_number personal_number
     *
     * @return $this
     */
    public function setPersonalNumber($personal_number)
    {
        $this->container['personal_number'] = $personal_number;

        return $this;
    }

    /**
     * Gets place_of_birth
     *
     * @return string|null
     */
    public function getPlaceOfBirth()
    {
        return $this->container['place_of_birth'];
    }

    /**
     * Sets place_of_birth
     *
     * @param string|null $place_of_birth place_of_birth
     *
     * @return $this
     */
    public function setPlaceOfBirth($place_of_birth)
    {
        $this->container['place_of_birth'] = $place_of_birth;

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
     * @param string|null $raw_text raw_text
     *
     * @return $this
     */
    public function setRawText($raw_text)
    {
        $this->container['raw_text'] = $raw_text;

        return $this;
    }

    /**
     * Gets surname
     *
     * @return string|null
     */
    public function getSurname()
    {
        return $this->container['surname'];
    }

    /**
     * Sets surname
     *
     * @param string|null $surname surname
     *
     * @return $this
     */
    public function setSurname($surname)
    {
        $this->container['surname'] = $surname;

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


