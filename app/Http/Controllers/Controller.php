<?php

namespace App\Http\Controllers;

use App\User;
use Geocoder\Laravel\Facades\Geocoder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $bx24url = 'https://bitrix.gaudeamus.am';
    protected $bx24webhook = 'https://bitrix.gaudeamus.am/rest/1/yrxspwrfkilm1447/';

    /**
     * @return |null
     */
    public function user() {
        if (\Auth::check()) {
            return User::find(\Auth::user()->id);
        }

        return null;
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
        return json_decode($response->getBody()->getContents(), true);
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
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param array $params
     * @return \Illuminate\Http\Client\Response
     */
    public function DealAdd($params = array())
    {
        $response = Http::post($this->bx24webhook .'crm.deal.add', $params);
        return json_decode($response->getBody()->getContents(), true);
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
            return json_decode($response->getBody()->getContents(), true);
        }

        return false;
    }

    /**
     * @param array $params
     * @return false|\Illuminate\Http\Client\Response
     */
    public function productAdd($params = [])
    {
        if (!empty($params)) {
            $response = Http::post(
                $this->bx24webhook .'crm.product.add',
                [
                    'fields' => $params
                ]
            );

            return json_decode($response->getBody()->getContents(), true);
        } else {
            return false;
        }
    }

    /**
     * Обновляет товар
     * @param  int|string $productId ID товара
     * @param  array $fields Список полей товара
     * @return int
     */
    public function productUpdate($productId, array $fields = [])
    {
        if (!empty($productId) && !empty($fields)) {
            $response = Http::post(
                $this->bx24webhook .'crm.product.update',
                [
                    'id' => $productId,
                    'fields' => $fields
                ]
            );

            return json_decode($response->getBody()->getContents(), true);
        } else {
            return false;
        }
    }

    /**
     * Удаляет товар по ID
     * @param  string|int $productId ID товара
     * @return array
     */
    public function productDelete($productId)
    {
        $result = Http::post(
            'crm.product.delete',
            [ 'id' => $productId ]
        );

        return json_decode($result->getBody()->getContents(), true);
    }

    /**
     * @param $id
     * @return false|mixed
     */
    public function productGet($id)
    {
        if (!empty($id)) {
            $response = Http::post(
                $this->bx24webhook .'crm.product.get',
                [
                    'id' => $id
                ]
            );

            return json_decode($response->getBody()->getContents(), true);
        } else {
            return false;
        }
    }

    /**
     * @param $dealId
     * @param array $fields
     * @return false|mixed
     */
    public function productRowsSet($dealId, array $fields = [])
    {
        if (!empty($dealId) && !empty($fields)) {
            $response = Http::post(
                $this->bx24webhook .'crm.deal.productrows.set',
                [
                    'id' => $dealId,
                    'rows' => [
                        $fields
                    ]
                ]
            );

            return json_decode($response->getBody()->getContents(), true);
        } else {
            return false;
        }
    }

    /**
     * @param $id
     * @param $data
     * @return mixed|null
     */
    public function diskStorageAddFolder($id, $data)
    {
        if (!empty($id) && !empty($data)) {
            $response = Http::post(
                $this->bx24webhook . 'disk.storage.addfolder',
                [
                    'id' => $id,
                    'data' => $data
                ]
            );

            return json_decode($response->getBody()->getContents(), true);
        } else {
            return null;
        }
    }

    /**
     * @param $id
     * @param $data
     * @return mixed|null
     */
    public function diskStorageDeleteFolderTree($id)
    {
        if (!empty($id)) {
            $response = Http::post(
                $this->bx24webhook . 'disk.folder.deletetree',
                [
                    'id' => $id
                ]
            );

            return json_decode($response->getBody()->getContents(), true);
        } else {
            return null;
        }
    }

    /**
     * @param $id
     * @return mixed|null
     */
    public function diskFolderGet($id)
    {
        if (!empty($id)) {
            $response = Http::post(
                $this->bx24webhook . 'disk.folder.get',
                [
                    'id' => $id,
                ]
            );

            return json_decode($response->getBody()->getContents(), true);
        } else {
            return null;
        }
    }

    /**
     * @param $id
     * @return mixed|null
     */
    public function diskStorageDeleteFile($id)
    {
        if (!empty($id)) {
            $response = Http::post(
                $this->bx24webhook . 'disk.file.delete',
                [
                    'id' => $id,
                ]
            );

            return json_decode($response->getBody()->getContents(), true);
        } else {
            return null;
        }
    }

    /**
     * @param $fileId
     * @return mixed
     */
    public function diskFileDelete($fileId)
    {
        $response = Http::post(
            $this->bx24webhook . 'disk.file.delete',
            [
                'id' => $fileId
            ]
        );

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Возвращает список файлов и папок, которые находятся непосредственно в корне хранилища
     * @param  int|string $storageId Id хранилища
     * @param  array  $filter Параметры фильтрации
     * @return array
     */
    public function getDiskStorageChildren($storageId, array $filter = [])
    {
        $response = Http::post(
            $this->bx24webhook . 'disk.storage.getchildren',
            [
                'id'     => $storageId,
                'filter' => $filter
            ]
        );

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Загружает новый файл в указанную папку на Диск
     * @param int|string $folderId Id папки
     * @param string $fileContent Raw данные файла
     * @param array $data Массив параметров, описывающих файл (обязательное поле NAME - имя нового файла)
     * @param bool $isBase64FileData Raw данные файла закодированны base64?
     * @return mixed
     * @see https://dev.1c-bitrix.ru/rest_help/disk/folder/disk_folder_uploadfile.php
     */
    public function uploadfileDiskFolder(
        $folderId,
        string $fileContent,
        array $data,
        bool $isBase64FileData = true
    ) {

        if (! $isBase64FileData) {
            $fileContent = base64_encode($fileContent);
        }

        $response = Http::post(
            $this->bx24webhook . 'disk.folder.uploadfile',
            [
                'id'          => $folderId,
                'fileContent' => $fileContent,
                'data'        => $data
            ]
        );

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param $file
     * @param false $base64
     * @return |null
     */
    protected function makeFileArray($file, $base64 = false){

        if(!empty($file)) {
            if($base64 == true) {
                $fileContent = base64_encode(file_get_contents($file->path()));
            } else {
                $fileContent = file_get_contents($file->path());
            }

            $fileData['fileData'] = [
                $file->getClientOriginalName(),
                $fileContent
            ];

            return $fileData;
        }

        return null;
    }

    /**
     * Get list of company items.
     * @link http://www.bitrixsoft.com/rest_help/crm/company/crm_company_list.php
     * @param array $order - order of task items
     * @param array $filter - filter array
     * @param array $select - array of collumns to select
     * @param integer $start - entity number to start from (usually returned in 'next' field of previous 'crm.company.list' API call)
     * @return array
     */
    public function getCompanyList($order = array(), $filter = array(), $select = array(), $start = 0)
    {
        $fullResult = Http::post(
            $this->bx24webhook . 'crm.company.list',
            [
                'order' => $order,
                'filter'=> $filter,
                'select'=> $select,
                'start'	=> $start
            ]
        );

        return json_decode($fullResult->getBody()->getContents(), true);
    }

    /**
     * Add a new company to CRM
     * @param array $fields array of fields
     * @link http://www.bitrixsoft.com/rest_help/crm/company/crm_company_add.php
     * @return array
     *
     */
    public function companyAdd($fields = array())
    {
        $fullResult = Http::post(
            $this->bx24webhook . 'crm.company.add',
            ['fields' => $fields]
        );

        return json_decode($fullResult->getBody()->getContents(), true);
    }

    /**
     * Updates the specified (existing) company.
     * @param array $bitrix24CompanyId integer
     * @param array $fields array of fields
     * @link http://www.bitrixsoft.com/rest_help/crm/company/crm_company_add.php
     * @return array
     *
     */
    public function companyUpdate($bitrix24CompanyId, $fields = array())
    {
        $fullResult = Http::post(
            $this->bx24webhook . 'crm.company.update',
            [
                'id' => $bitrix24CompanyId,
                'fields' => $fields,
            ]
        );

        return json_decode($fullResult->getBody()->getContents(), true);
    }

    /**
     * Returns a company associated with the specified company ID.
     * @link http://www.bitrixsoft.com/rest_help/crm/company/crm_company_get.php
     * @param integer $bitrix24CompanyId company identifier
     * @return array
     */
    public function companyGet($bitrix24CompanyId)
    {
        $fullResult = Http::post(
            $this->bx24webhook . 'crm.company.get',
            ['id' => $bitrix24CompanyId]
        );

        return json_decode($fullResult->getBody()->getContents(), true);
    }

    /**
     * Deletes the specified company and all the associated objects.
     * @link http://www.bitrixsoft.com/rest_help/crm/company/crm_company_delete.php
     * @param integer $bitrix24CompanyId company identifier
     * @return array
     */
    public function companyDelete($bitrix24CompanyId)
    {
        $fullResult = Http::post(
            $this->bx24webhook . 'crm.company.delete',
            ['id' => $bitrix24CompanyId]
        );

        return json_decode($fullResult->getBody()->getContents(), true);
    }

    /**
     * Get list of contact items.
     * @link http://dev.1c-bitrix.ru/rest_help/crm/contacts/crm_contact_list.php
     * @param array $order - order of task items
     * @param array $filter - filter array
     * @param array $select - array of collumns to select
     * @param integer $start - entity number to start from (usually returned in 'next' field of previous 'crm.contact.list' API call)
     * @return array
     *
     */
    public function getContactList($order = array(), $filter = array(), $select = array(), $start = 0)
    {
        $fullResult = Http::post(
            $this->bx24webhook . 'crm.contact.list',
            [
                'order' => $order,
                'filter'=> $filter,
                'select'=> $select,
                'start'	=> $start
            ]
        );

        return json_decode($fullResult->getBody()->getContents(), true);
    }

    /**
     * Add a new contact to CRM
     * @param array $fields array of fields
     * @param array $params array of params
     * @link http://dev.1c-bitrix.ru/rest_help/crm/contacts/crm_contact_add.php
     * @return array
     */
    public function contactAdd($fields = array(), $params = array())
    {
        $fullResult = Http::post(
            $this->bx24webhook . 'crm.contact.add',
            [
                'fields' => $fields,
                'params' => $params
            ]
        );

        return json_decode($fullResult->getBody()->getContents(), true);
    }

    /**
     * Get contact by identifier
     * @link http://dev.1c-bitrix.ru/rest_help/crm/contacts/crm_contact_get.php
     * @param integer $bitrix24UserId contact identifier
     * @return array
     */
    public function contactGet($bitrix24UserId)
    {
        $fullResult = Http::post(
            $this->bx24webhook . 'crm.contact.get',
            ['id' => $bitrix24UserId]
        );

        return json_decode($fullResult->getBody()->getContents(), true);
    }

    /**
     * Deletes the specified contact
     * @link http://dev.1c-bitrix.ru/rest_help/crm/contacts/crm_contact_delete.php
     * @param integer $bitrix24UserId contact identifier
     * @return array
     */
    public function contactDelete($bitrix24UserId)
    {
        $fullResult = Http::post(
            $this->bx24webhook . 'crm.contact.delete',
            ['id' => $bitrix24UserId]
        );

        return json_decode($fullResult->getBody()->getContents(), true);
    }
}
