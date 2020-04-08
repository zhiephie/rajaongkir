<?php

use Zhiephie\Rajaongkir;
use PHPUnit\Framework\TestCase;

class RajaongkirTest extends TestCase
{
    protected $apiKey = 'fcc0bc782c738b33b3ea943ee7b5cbd7'; 
    
    /**
     * @test
     * @testdox Valid get courier list
     */
    public function test_valid_get_courier_list()
    {
        $response = new Rajaongkir($this->apiKey);
        $response = $response->getCouriersList();

        $this->assertContains('Jalur Nugraha Ekakurir (JNE)', $response);
    }

    /**
     * @test
     * @testdox Valid get list provinces
     */
    public function test_valid_get_provinces()
    {
        $response = new Rajaongkir($this->apiKey);
        $response = $response->getProvinces();

        foreach ($response as $value) {
            $this->assertArrayHasKey('province', $value);
        }
    }

    /**
     * @test
     * @testdox Valid get province by id
     */
    public function test_valid_get_province_by_id()
    {
        $response = new Rajaongkir($this->apiKey);
        $response = $response->getProvince(12);

        $this->assertContains('Kalimantan Barat', $response);
    }

    /**
     * @test
     * @testdox Valid get list cities
     */
    public function test_valid_get_cities()
    {
        $response = new Rajaongkir($this->apiKey);
        $response = $response->getCities();

        foreach ($response as $value) {
            $this->assertArrayHasKey('city_name', $value);
        }
    }

    /**
     * @test
     * @testdox Valid get city by id
     */
    public function test_valid_get_city_by_id()
    {
        $response = new Rajaongkir($this->apiKey);
        $response = $response->getCity(124);

        $this->assertContains('Fakfak', $response);
    }
}