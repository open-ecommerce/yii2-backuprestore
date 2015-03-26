<?php

use yii\helpers\Html;

//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Url;


echo GridView::widget([
    'id' => 'install-grid',
    'dataProvider' => $dataProvider,
    'columns' => array(
        'name',
        'size:size',
        'create_time',
        'modified_time:relativeTime',
        [
            'class' => 'kartik\grid\ActionColumn',
            'template' => '{restore_action}',
            'header' => 'Restore DB',
            'buttons' => [
                'restore_action' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-import"></span>', $url, [
                                'title' => Yii::t('app', 'Restore this backup'),
                    ]);
                }
                    ],
                    'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'restore_action') {
                    $url = Yii::$app->urlManager->createUrl(array('backup/default/restore', ['filename' => $model['name']]));
                    return $url;
                }
            }
                ],
        [
            'class' => 'kartik\grid\ActionColumn',
            'template' => '{delete_action}',
            'header' => 'Delete file',
            'buttons' => [
                'delete_action' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                'title' => Yii::t('app', 'Delete this backup'),
                    ]);
                }
                    ],
                    'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'delete_action') {
                    $url = Yii::$app->urlManager->createUrl(array('backup/default/delete', ['filename' => $model['name']]));
                    return $url;
                }
            }
                ],        
    ),
]);
?>