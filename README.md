# RajaOngkir

## Fitur

- Support seluruh tipe akun RajaOngkir (Starter, Basic, Pro).

- Daftar semua provinsi.
  
- Ambil provinsi berdasarkan ID.
  
- Daftar semua kota/kabupaten.

- Daftar kota/kabupaten berdasarkan ID provinsinya.

- Ambil kota/kabupaten berdasarkan ID.

- Ambil biaya pengiriman (ongkos kirim/ongkir)
  
- Cek pengiriman berdasarkan Nomor Resi
  
- Ambil data Currency

- Ambil data Subdistrict
  
## Instalasi

Gunakan [composer](https://getcomposer.org/) untuk menginstal

`composer require zhiephie/rajaongkir`

Anda juga bisa menambahkan dependensi ke `composer.json`

```json
{
    "require": {
        "zhiephie/rajaongkir": "1.0"
    }
}
```

## Penggunaan

### Provinsi

Untuk mendapatkan daftar provinsi, gunakan metode `getProvinces()`

```php
use Zhiephie\Rajaongkir;

$apiKey = 'change-me';

$rajaOngkir = new Rajaongkir($apiKey); // Secara default tipe akun yang digunakan starter
# $rajaOngkir = new Rajaongkir($apiKey, 'pro'); // Cara merubah tipe akun yang digunakan

$provinsi = $rajaOngkir->getProvinces();
```

### Ambil provinsi berdasarkan ID

Untuk mendapatkan provinsi berdasarkan ID, gunakan metode `getProvince(int|string $id)`

```php
use Zhiephie\Rajaongkir;

$apiKey = 'change-me';

$rajaOngkir = new Rajaongkir($apiKey); // Secara default tipe akun yang digunakan starter
# $rajaOngkir = new Rajaongkir($apiKey, 'pro'); // Cara merubah tipe akun yang digunakan

$provinsi = $rajaOngkir->getProvince(1);
```

## Kota/Kabupaten

### Daftar kota/kabupaten

Untuk mendapatkan daftar kota/kabupaten, gunakan metode `getCities()`

```php
use Zhiephie\Rajaongkir;

$apiKey = 'change-me';

$rajaOngkir = new Rajaongkir($apiKey); // Secara default tipe akun yang digunakan starter
# $rajaOngkir = new Rajaongkir($apiKey, 'pro'); // Cara merubah tipe akun yang digunakan

$kota = $rajaOngkir->getCities();
```

### Ambil kota/kabupaten berdasarkan ID

Untuk mendapatkan kota/kabupaten berdasarkan ID, gunakan metode `getCity(int|string $id)`

```php
use Zhiephie\Rajaongkir;

$apiKey = 'change-me';

$rajaOngkir = new Rajaongkir($apiKey); // Secara default tipe akun yang digunakan starter
# $rajaOngkir = new Rajaongkir($apiKey, 'pro'); // Cara merubah tipe akun yang digunakan

$kota = $rajaOngkir->getCity(12);
```

## Pencarian biaya pengiriman

Untuk mengambil biaya pengiriman, gunakan metode `getCost(array $payload)`

```php
use Zhiephie\Rajaongkir;

$apiKey = 'change-me';

$rajaOngkir = new Rajaongkir($apiKey); // Secara default tipe akun yang digunakan starter
# $rajaOngkir = new Rajaongkir($apiKey, 'pro'); // Cara merubah tipe akun yang digunakan

$payload = [
    'origin' => 501,
    'destination' => 114,
    'weight' => 1700,
    'courier' => 'jne'
];

$cost = $rajaOngkir->getCost($payload);
```

## Currency

Untuk mengambil currency, gunakan metode `getCurrency()`

```php
use Zhiephie\Rajaongkir;

$apiKey = 'change-me';

$rajaOngkir = new Rajaongkir($apiKey); // Secara default tipe akun yang digunakan starter
# $rajaOngkir = new Rajaongkir($apiKey, 'pro'); // Cara merubah tipe akun yang digunakan

$currency = $rajaOngkir->getCurrency();
```

## Melacak Status Pengiriman

Untuk melacak pengiriman, gunakan metode `getWayBill(string $resi, string $kurir)`

> Fitur ini hanya bisa digunakan pada akun basic dan pro

```php
use Zhiephie\Rajaongkir;

$apiKey = 'change-me';

$rajaOngkir = new Rajaongkir($apiKey, 'pro');

$resi = '1212';
$kurir = 'jne';

$statusPengiriman = $rajaOngkir->getWayBill($resi, $kurir);
```

## Subdistrict

Untuk mendapatkan daftar kecamatan yang ada di Indonesia `getSubdistrict(int|string $idCity)`

```php
use Zhiephie\Rajaongkir;

$apiKey = 'change-me';

$rajaOngkir = new Rajaongkir($apiKey, 'pro');

$kecamatan = $rajaOngkir->getSubdistrict(['city' => '12']);
```

## Pengujian

Jalankan pengujian dengan perintah berikut.

`./vendor/bin/phpunit --testdox tests`

## Referensi

Untuk mengetahui lebih lanjut mengenai RajaOngkir API, lihat di [Dokumentasi RajaOngkir](https://rajaongkir.com/dokumentasi)
