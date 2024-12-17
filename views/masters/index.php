<?php

use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Masters';

$this->params['breadcrumbs'][] = ['label' => 'Employee', 'url' => ['/employee/dashboard/index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">

    <div class="col-md-12">

        <div class="card">

            <div class="card-header">
                <h3>
                    <?php echo Html::encode($this->title) ?>
                </h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <?php echo GridView::widget([
                        'dataProvider' => new ArrayDataProvider([
                            'allModels' => $items,
                        ]),
                        'summary' => "",
                        'columns' => [
                            'name',
                            ['attribute' => 'link',
                                'label' => 'Action',
                                'format' => 'raw',
                                'value' => function ($data) {
                                    return Html::a("<span class='fa fa-cog'></span>", [$data['link']], ['class' => "btn btn-secondary"]);
                                }
                            ]
                        ]
                    ]);
                    ?>
                </div>

            </div>

        </div>

    </div>

</div>