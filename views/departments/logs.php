<?php

use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Logs;

$this->title = 'Department Logs';
$this->params['breadcrumbs'][] = ['label' => 'Employee', 'url' => ['/dashboard/index']];
$this->params['breadcrumbs'][] = ['label' => 'Masters', 'url' => ['/masters/index']];
$this->params['breadcrumbs'][] = ['label' => 'Departments', 'url' => ['/departments/index']];
$this->params['breadcrumbs'][] = Html::encode($this->title);

$this->registerCSS("

.col.navbar-nav.me-auto.mb-2.mb-md-0{
    padding:0 !important;
    margin:0 !important;
}
.breadcrumb{
    padding:0 !important;
    margin:0 !important;
}

.col, .navbar-nav { 
    padding:0 !important;
    margin:0 !important;
}


");

?>
    <div class="card p-5">
        <div class="profile-view">
            <ul class="updtlst">
                <?php if (count($data) > 0) { ?>
                    <?php
                    foreach ($data as $index => $activityVal) {
                        ?>
                        <li>
                            <div class="updtim">
                                <?= date('Y-m-d H:i:s', $activityVal->created_at) ?></div>
                            <div class="updtinf0 uupdt">
                                <h3>
                                        <span>
                                        <?php echo ucwords(\app\models\User::findIdentity($activityVal->created_by)->username); ?></span>
                                    <?=
                                    isset($activityVal->log_type) ? $activityVal->log_type : null; ?>
                                    <br>
                                </h3>
                                <p style="font-size: 1.2rem; font-weight: bold">
                                    <?=  isset($activityVal->section_name) ? $activityVal->section_name : null;?>
                                </p>
                                <div class="flx-bx">
                                    <?php
                                    if (
                                        $activityVal->log_type == Logs::TYPE_CREATED ||
                                        $activityVal->log_type == Logs::TYPE_DELETED
                                    ) {
                                        echo Logs::createdFieldsLog($activityVal->id, $activityVal->values);
                                    } elseif ($activityVal->log_type == Logs::TYPE_UPDATED) {
                                        echo Logs::get_field_changes_list($activityVal->id, $activityVal->values);
                                    }
                                    ?>
                                </div>
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                    <?php
                } ?>
            </ul>
        </div>
    </div>

<?php

$this->registerCss(


    "ul {
    display: block;
    list-style-type: disc;
    margin-block-start: 1em;
    margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    padding-inline-start: 40px;
} 
.updtim {
    max-width: 250px;
    position: absolute;
    left: 0;
    top: 6px;
}

.updtinf0 {
    border-left: dashed 1px #c4c4c4;
    padding: 5px 0 10px 50px;
    position: relative;
}

.flx-bx {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -1%;
}
.flx-itm {
    width: 23%;
    margin: 10px 1%;
}
h3 {
    display: block;
    font-size: 1.17em;
    margin-block-start: 1em;
    margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    font-weight: bold;
}
.updtlst li {
    position: relative;
    padding: 0 0 0 250px;
}

.updtlst{padding:0}
.updtlst li{position:relative; padding:0 0 0 250px}
.updtlst li:last-child .updtinf0{border:0}
.updtim{max-width:250px; position:absolute; left:0; top:6px}
.updtinf0{border-left:dashed 1px #c4c4c4; padding:5px 0 10px 50px; position:relative}
.updtinf0 h3{font-size:17px; margin:3px 0 13px}
.updtinf0 h3 span{color:#c2382e}
.updtinf0 p{margin:0}
.updtinf0 span{color:#2b82b8}
.updtinf0:before, .updtinf0:after{display:block; position:absolute}
.updtinf0:before{width:36px; height:36px; border-radius:50%; left:-18px; top:0}
.updtinf0.lupdt:before{background:#28ac60}
.updtinf0.uupdt:before{background:#c2382e}
.updtinf0.prupdt:before{background:#2b82b8}
.updtinf0.payupdt:before{background:#17a086}
.updtinf0.setupdt:before{background:#f29c15}
.updtinf0.tktupdt:before{background:#8e44ad}
.updtinf0.lstupdt:before{background:#2c3e50}
.updtinf0:after{width:27px; height:27px; background-image:url(img/sprite.png); background-repeat:no-repeat; top:4px; left:-13px}
.updtinf0.lupdt:after{background-position:-232px -61px}
.updtinf0.uupdt:after{background-position:-231px -153px}
.updtinf0.prupdt:after{background-position:-236px -88px}
.updtinf0.payupdt:after{background-position:-229px -120px}
.updtinf0.setupdt:after{background-position:-230px -192px}
.updtinf0.tktupdt:after{background-position:-230px -229px}
.updtinf0.lstupdt:after{background-position:-232px -264px}
");
?>