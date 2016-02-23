<?php
/**
 * @Author: e 09.02.2016
 */

namespace app\controllers;

use app\models\customer\Customer;
use app\models\customer\CustomerRecord;
use app\models\customer\Phone;
use app\models\customer\PhoneRecord;
use yii\data\ArrayDataProvider;
use \yii\web\Controller;

/**
 * Class CustomersController
 * @package app\controllers
 */
class CustomersController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $records = $this->findRecordsByQuery();
        return $this->render('index', compact('records'));
    }

    /**
     * @return string
     */
    public function actionAdd()
    {
        $customer = new CustomerRecord();
        $phone = new PhoneRecord();

        if ($this->load($customer, $phone, $_POST)) {
            $this->store($this->makeCustomer($customer, $phone));
            return $this->redirect('/customers');
        }

        // магия состояний: и $customer и $phone прошли валидацию к этому моменту
        return $this->render('add', compact('customer', 'phone'));
    }

    /**
     * @return string
     */
    public function actionQuery()
    {
        return $this->render('query');
    }

    /**
     * @return ArrayDataProvider
     */
    private function findRecordsByQuery()
    {
        if ($number = \Yii::$app->request->get('phone_number')) {
            $records = $this->getRecordsByPhoneNumber($number);
        } else {
            $records = $this->getAllRecords();
        }
        $dataProvider = $this->wrapIntoDataProvider($records);
        return $dataProvider;
    }

    /**
     * @param $number
     * @return array
     */
    private function getRecordsByPhoneNumber($number)
    {
        /** @var $phone_record PhoneRecord */
        $phone_record = PhoneRecord::findOne(['number' => $number]);
        if (!$phone_record) {
            return [];
        }

        /** @var $customer_record CustomerRecord */
        $customer_record = CustomerRecord::findOne($phone_record->customer_id);
        if (!$customer_record) {
            return [];
        }

        return [$this->makeCustomer($customer_record, $phone_record)];
    }

    /**
     * @return array
     */
    private function getAllRecords()
    {
        $customer_records = CustomerRecord::find()->all();
        if (!$customer_records) {
            return [];
        }

        $customers = [];
        /** @var CustomerRecord $customer_record */
        foreach ($customer_records as $customer_record) {
            $phone_records = PhoneRecord::find()
                                        ->where(['customer_id' => $customer_record->id])
                                        ->one();
            if ($phone_records) {
                $customers[] = $this->makeCustomer($customer_record, $phone_records);
            }
        }

        return $customers;
    }

    /**
     * @param $data
     * @return ArrayDataProvider
     */
    private function wrapIntoDataProvider($data)
    {
        return new ArrayDataProvider([
            'allModels'  => $data,
            'pagination' => false
        ]);
    }

    /**
     * @param Customer $customer
     */
    private function store(Customer $customer)
    {
        $customer_record = new CustomerRecord();

        $customer_record->name = $customer->name;
        $customer_record->birth_date = $customer->birth_date->format('Y-m-d');
        $customer_record->notes = $customer->notes;

        $customer_record->save();

        foreach ($customer->phones as $phone) {
            $phone_record = new PhoneRecord();

            $phone_record->number = $phone->number;
            $phone_record->customer_id = $customer_record->id;

            $phone_record->save();
        }
    }

    /**
     * @param CustomerRecord $customer_record
     * @param PhoneRecord $phone_record
     * @return Customer
     */
    private function makeCustomer(
        CustomerRecord $customer_record,
        PhoneRecord $phone_record
    ) {
        $name = $customer_record->name;
        $birth_date = new \DateTime($customer_record->birth_date);

        $customer = new Customer($name, $birth_date);
        $customer->notes = $customer_record->notes;
        $customer->phones[] = new Phone($phone_record->number);
//        foreach ($phone_records as $phone_record) {
//            $customer->phones[] = new Phone($phone_record->number);
//        }

        return $customer;
    }

    /**
     * @param CustomerRecord $customer
     * @param PhoneRecord $phone
     * @param array $post
     * @return bool
     */
    private function load(
        CustomerRecord $customer,
        PhoneRecord $phone,
        array $post
    ) {
        return $customer->load($post)
            && $phone->load($post)
            && $customer->validate()
            && $phone->validate(['numerical']);
    }
}

