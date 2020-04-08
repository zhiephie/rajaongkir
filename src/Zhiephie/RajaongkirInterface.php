<?php
namespace Zhiephie;

interface RajaongkirInterface
{
    public function setKey(string $apiKey);
    public function getKey();
    public function setAccountType(string $accountType);
    public function getAccountType();
    public function request(string $path, $request = [], $type);
    public function getCouriersList();
    public function getProvinces();
    public function getProvince($idProvince);
    public function getCities();
    public function getCity($idCity = null);
    public function getCost(array $payload);
    public function getCurrency();
    public function getWayBill(string $waybill, string $courier);
    public function getSubdistrict(array $payload);
}