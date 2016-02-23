<?php
/**
 * @var $records []
 *
 * @Author: e 22.02.2016
 */

echo \yii\widgets\ListView::widget(
    [
        'options' => [
            'class' => 'list-view',
            'id' => 'search_results'
        ],
        'itemView' => '_customer',
        'dataProvider' => $records
    ]
);