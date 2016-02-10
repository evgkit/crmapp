<?php
/**
 * @Author: e 09.02.2016
 */

namespace app\controllers;

use \yii\web\Controller;

/**
 * Class SiteController
 * @package app\controllers
 */
class SiteController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        return 'Our CRM';
    }
}