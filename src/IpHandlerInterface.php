<?php


namespace PhpCpm\IpAddress;


interface IpHandlerInterface
{

    /**
     * @param $ip
     * @return boolean
     */
    public function init($ip);

    /**
     * @param $db
     * @return boolean
     */
    public function loaddb($db);

    /**
     * @return array
     */
    public function getMap();

    /**
     * @return string
     */
    public function getCountry();

    /**
     * @return string
     */
    public function getProvince();

    /**
     * @return string
     */
    public function getCity();

    /**
     * @return string
     */
    public function getISP();

}