<?php

use yii\helpers\Html;

//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Url;


echo GridView::widget([
    'id' => 'install-grid',
    'export' => false,
    'dataProvider' => $dataProvider,
    'resizableColumns' => false,
    'showPageSummary' => false,
    'headerRowOptions' => ['class' => 'kartik-sheet-style'],
    'filterRowOptions' => ['class' => 'kartik-sheet-style'],
    'responsive' => true,
    'hover' => true,
    'panel' => [
        'heading' => '<h3 class="panel-title"> Database backup files</h3>',
        'type' => 'primary',
        'showFooter' => false
    ],
    // set your toolbar
    'toolbar' => [
        ['content' =>
            Html::a('<i class="glyphicon glyphicon-plus"></i>  Create Backup', ['create'], ['class' => 'btn btn-success create-backup']). ' '.
            Html::a('<i class="glyphicon glyphicon-plus"></i>  Upload Backup File', ['upload'], ['class' => 'btn btn-success']),
        ],
    ],
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
                    $url = Yii::$app->urlManager->createUrl(['backuprestore/default/restore', 'filename' => $model['name']]);
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
                    $url = Yii::$app->urlManager->createUrl(array('backuprestore/default/delete', ['filename' => $model['name']]));
                    return $url;
                }
            }
                ],
    ),
]);
?>
