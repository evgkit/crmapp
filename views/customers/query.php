<?php
use yii\helpers\Html;

/**
 * @Author: e 22.02.2016
 */
echo Html::beginForm(['/customers'], 'get');
echo Html::label('Phone Number to search:', 'phone_number');
echo Html::textInput('phone_number');
echo Html::submitButton('Search');
echo Html::endForm();
