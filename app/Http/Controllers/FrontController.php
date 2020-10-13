<?php

namespace App\Http\Controllers;

use App\User;
use Geocoder\Laravel\Facades\Geocoder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FrontController extends Controller
{

    protected $bx24url = 'https://dispatchexperts.bitrix24.ru';
    protected $bx24webhook = 'https://dispatchexperts.bitrix24.ru/rest/13/q2v2oopjbzlkyc9b/';

    /**
     * @param $auth_id
     * @return mixed
     */
    public function Auth($auth_id)
    {
        $res = Http::get($this->bx24url . '/rest/user.current', array("auth" => $auth_id)  );
        return $res['result'];
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getLeadbyId($id)
    {
        $res =  Http::get($this->bx24webhook . 'crm.lead.get', array('ID' => $id));
        return $res['result'];
    }

    /**
     * @param array $filter
     * @return \Illuminate\Http\Client\Response
     */
    public function getLeadList($filter = array())
    {
        $params = array(
            'order' => array('ID' => 'DESC'),
            'filter' => $filter,
            'select' => array('ID', 'TITLE', 'STATUS_ID', 'PHONE')
        );
        return Http::get($this->bx24webhook . 'crm.lead.list', $params);
    }

    /**
     * @param $id
     * @param array $fields
     * @return false|\Illuminate\Http\Client\Response
     */
    public function leadUpdate($id, $fields = array())
    {
        if (intval($id) > 0) {
            return Http::post(
                $this->bx24webhook . 'crm.lead.update',
                array(
                    'ID' => $id,
                    "fields" => $fields,
                    //'params' => ['REGISTER_SONET_EVENT' => 'Y']
                )
            );
        }

        return false;
    }

    /**
     * @param array $arParams
     * @return \Illuminate\Http\Client\Response
     */
    public function getDealList($arParams=array())
    {
        $params['select'] = array("*", "UF_*");
        $params['order'] = array('ID' => 'DESC');

        if( !empty($arParams['FILTER']) ){
            $params['filter'] = $arParams['FILTER'];
        }

        $response = Http::get($this->bx24webhook . 'crm.deal.list', $params);
        return $response;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Client\Response
     */
    public function getDealByID($id)
    {
        $response =  Http::get($this->bx24webhook .'crm.deal.get', array(
            'id' => $id
        ));
        return $response;
    }

    /**
     * @param array $params
     * @return \Illuminate\Http\Client\Response
     */
    public function DealAdd($params = array())
    {
        $response = Http::post($this->bx24webhook .'crm.deal.add', $params);
        return $response;
    }

    /**
     * @param $id
     * @param array $params
     * @return false|\Illuminate\Http\Client\Response
     */
    public function DealUpdate($id, $params = array())
    {
        if($id > 0){
            $response = Http::post(
                $this->bx24webhook .'crm.deal.update',
                array(
                    'id' => $id,
                    'fields' => $params,
                    //'params' => ['REGISTER_SONET_EVENT' => 'Y']
                )
            );
            return $response;
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function getGeocode() {
        return Geocoder::geocode(getRealIP())->get();
    }

    /**
     * @return mixed
     */
    public function getGeocodeCountryCode() {
        return Geocoder::geocode(getRealIP())->get()->first()->getCountry()->getCode();
    }
}
