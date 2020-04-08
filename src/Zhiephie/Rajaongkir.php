<?php
namespace Zhiephie;

use Zttp\Zttp as Http;

class Rajaongkir implements RajaongkirInterface {

    /**
     * Constant Account Type
     *
     * @access  public
     * @type    string
     */
    const ACCOUNT_STARTER = 'starter';
    const ACCOUNT_BASIC = 'basic';
    const ACCOUNT_PRO = 'pro';

    /**
     * Rajaongkir::$accountType
     *
     * Rajaongkir Account Type.
     *
     * @access  protected
     * @type    string
     */
    protected $accountType = 'starter';

    /**
     * Rajaongkir::$apiKey
     *
     * Rajaongkir API key.
     *
     * @access  protected
     * @type    string
     */
    protected $apiKey = null;

    /**
     * Rajaongkir::$apiUrl
     *
     * Rajaongkir End Point.
     *
     * @access  protected
     * @type    string
     */
    protected $apiUrl = 'https://api.rajaongkir.com/';

    /**
     * List of Supported Account Types
     *
     * @access  protected
     * @type    array
     */
    protected $supportedAccountTypes = [
        'starter',
        'basic',
        'pro',
    ];

    /**
     * Supported Couriers
     *
     * @access  protected
     * @type    array
     */
    protected $supportedCouriers = [
        'starter' => [
            'jne',
            'pos',
            'tiki',
        ],
        'basic' => [
            'jne',
            'pos',
            'tiki',
            'pcp',
            'esl',
            'rpx',
        ],
        'pro' => [
            'jne',
            'pos',
            'tiki',
            'rpx',
            'esl',
            'pcp',
            'pandu',
            'wahana',
            'sicepat',
            'jnt',
            'pahala',
            'cahaya',
            'sap',
            'jet',
            'indah',
            'slis',
            'expedito*',
            'dse',
            'first',
            'ncs',
            'star',
            'lion',
            'ninja-express',
            'idl',
            'rex',
        ],
    ];

    /**
     * Rajaongkir::$supportedWaybills
     *
     * Rajaongkir supported couriers waybills.
     *
     * @access  protected
     * @type    array
     */
    protected $supportedWayBills = [
        'starter' => [],
        'basic' => [
            'jne',
        ],
        'pro' => [
            'jne',
            'pos',
            'tiki',
            'pcp',
            'rpx',
            'wahana',
            'sicepat',
            'j&t',
            'sap',
            'jet',
            'dse',
            'first',
        ],
    ];

    /**
     * Rajaongkir::$couriersList
     *
     * Rajaongkir courier list.
     *
     * @access  protected
     * @type array
     */
    protected $couriersList = [
        'jne'       => 'Jalur Nugraha Ekakurir (JNE)',
        'pos'       => 'POS Indonesia (POS)',
        'tiki'      => 'Citra Van Titipan Kilat (TIKI)',
        'pcp'       => 'Priority Cargo and Package (PCP)',
        'esl'       => 'Eka Sari Lorena (ESL)',
        'rpx'       => 'RPX Holding (RPX)',
        'pandu'     => 'Pandu Logistics (PANDU)',
        'wahana'    => 'Wahana Prestasi Logistik (WAHANA)',
        'sicepat'   => 'SiCepat Express (SICEPAT)',
        'j&t'       => 'J&T Express (J&T)',
        'pahala'    => 'Pahala Kencana Express (PAHALA)',
        'cahaya'    => 'Cahaya Logistik (CAHAYA)',
        'sap'       => 'SAP Express (SAP)',
        'jet'       => 'JET Express (JET)',
        'indah'     => 'Indah Logistic (INDAH)',
        'slis'      => 'Solusi Express (SLIS)',
        'expedito*' => 'Expedito*',
        'dse'       => '21 Express (DSE)',
        'first'     => 'First Logistics (FIRST)',
        'ncs'       => 'Nusantara Card Semesta (NCS)',
        'star'      => 'Star Cargo (STAR)',
    ];

     /**
     * Rajaongkir::__construct
     *
     * @access  public
     * @throws  InvalidException
     */
    public function __construct(string $apiKey = null, string $accountType = null)
    {
        $this->setKey($apiKey);
        if ($accountType) {
            $this->setAccountType($accountType);
        }
    }

    /**
     * @param string $url
     * @return string
     */
    public function url($url): string
    {
        return $url;
    }

    /**
     * @param string $apiKey
     * @return self
     */
    public function setKey($apiKey): void
    {
        if (empty($apiKey)) {
            throw InvalidException::apiKey($apiKey);
        }

        $this->apiKey = $apiKey;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @param string $accountType
     * @return self
     */
    public function setAccountType($accountType): void
    {
        $accountType = strtolower($accountType);

        if (in_array($accountType, $this->supportedAccountTypes)) {
            $this->accountType = $accountType;
        } else {
            throw InvalidException::accountType($accountType);
        }
    }

    /**
     * @return string
     */
    public function getAccountType(): string
    {
        return $this->accountType;
    }

    public function request(string $path, $param = [], $type = 'GET')
    {
        switch ($this->accountType) {
            case 'basic':
                $path = $this->apiUrl . 'basic/' . $path;
                break;
            case 'pro':
                $this->apiUrl = 'https://pro.rajaongkir.com/';
                $path = $this->apiUrl . 'api/' . $path;
                break;
            default:
                $path = $this->apiUrl . 'starter/' . $path;
        }

        switch(strtoupper($type)) {
            case 'POST':
                $response = Http::asFormParams()
                ->withHeaders(['key' => $this->apiKey])
                ->post($this->url($path), $param);
            break;
            default:
                $response = Http::withHeaders(['key' => $this->apiKey])
                ->get($this->url($path), $param);
        }

        $response = $response->json()['rajaongkir'];

        return $response['results'];
    }

    /**
     * Rajaongkir::getCouriersList
     *
     * Get list of supported couriers.
     *
     * @access  public
     * @return  array|bool Returns FALSE if failed.
     */
    public function getCouriersList(): array
    {
        return $this->couriersList;
    }

    /**
     * Rajaongkir::getProvinces
     *
     * Get list of provinces.
     *
     * @access  public
     * @return  array|bool Returns FALSE if failed.
     */
    public function getProvinces()
    {
        return $this->request('province');
    }

    /**
     * Rajaongkir::getProvince
     *
     * Get detail of single province.
     *
     * @param int $idProvince Province ID
     *
     * @access  public
     * @return  array|bool Returns FALSE if failed.
     */
    public function getProvince($idProvince = null)
    {
        if ($idProvince) {
            return $this->request('province', ['id' => $idProvince]);
        }

        throw InvalidException::argumentRequired('province');
    }

    /**
     * Rajaongkir::getCities
     *
     * Get list of province cities.
     *
     * @param int $idProvince Province ID
     *
     * @access  public
     * @return  array|bool Returns FALSE if failed.
     */
    public function getCities()
    {
        return $this->request('city');
    }

    /**
     * Rajaongkir::getCity
     *
     * Get detail of single city.
     *
     * @param int $idCity City ID
     *
     * @access  public
     * @return  array|bool Returns FALSE if failed.
     */
    public function getCity($idCity = null)
    {
        if ($idCity) {
            return $this->request('city', ['id' => $idCity]);
        }

        throw InvalidException::argumentRequired('city');
    }

    /**
     * Rajaongkir::getCost
     *
     * Get Cost.
     *
     * @param array $payload
     *
     * @access  public
     * @return  array|bool Returns FALSE if failed.
     */
    public function getCost(array $payload)
    {
        if ($payload) {
            return $this->request('cost', $payload, 'POST');
        }

        throw InvalidException::argumentRequired('cost');
    }

    /**
     * Rajaongkir::getCurrency
     *
     * Get Currency.
     *
     * @access  public
     * @return  array|bool Returns FALSE if failed.
     */
    public function getCurrency()
    {
        return $this->request('currency');
    }

    /**
     * Rajaongkir::getWayBill
     *
     * Get Way Bill.
     * @param string $waybill
     * @param string $courier
     *
     * @access  public
     * @return  array|bool Returns FALSE if failed.
     */
    public function getWayBill(string $waybill, string $courier)
    {
        if (in_array($courier, $this->supportedWayBills[$this->accountType])) {
            return $this->request('waybill', [
                'waybill' => $waybill,
                'courier' => $courier,
            ], 'POST');
        }

        throw InvalidException::unsupported($this->accountType);
    }

    /**
     * Rajaongkir::getSubdistrict
     *
     * Get Subdistrict.
     * @param array $payload
     *
     * @access  public
     * @return  array|bool Returns FALSE if failed.
     */
    public function getSubdistrict(array $payload)
    {
        if ($this->accountType === 'pro') {
            return $this->request('subdistrict', $payload);
        }

        throw InvalidException::unsupported($this->accountType);
    }

}