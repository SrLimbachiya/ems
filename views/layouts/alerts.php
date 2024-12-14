<?php
if (Yii::$app->session->hasFlash('message')) {
    ?>

    <div class="alert alert-primary alert-dismissible fade show p-4" role="alert">
        <strong>
            <div class="d-inline-block mr-1">
            <span class="mdi mdi-info-outline">
            </span>
            </div>
            Info!
        </strong>
        <br>
        <div class="mt-2 pt-1 opacity-75">
            <?= Yii::$app->session->getFlash('message') ?>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
    </div>

<?php } ?>

<?php

if (Yii::$app->session->hasFlash('success')) {
    ?>

    <div class="alert alert-primary alert-dismissible fade show p-4" role="alert">
        <strong>
            <div class="d-inline-block mr-1">
            <span class="mdi mdi-info-outline">
            </span>
            </div>
            Success!
        </strong>
        <br>
        <div class="mt-2 pt-1 opacity-75">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
    </div>

<?php } ?>

<?php
if (Yii::$app->session->hasFlash('warning')) {
    ?>

    <div class="alert alert-warning alert-dismissible fade show p-4" role="alert">
        <strong>
            <div class="d-inline-block mr-1">
            <span class="mdi mdi-info-outline">
            </span>
            </div>
            Warning!
        </strong>
        <br>
        <div class="mt-2 pt-1 opacity-75">
            <?= Yii::$app->session->getFlash('warning') ?>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
    </div>

<?php } ?>

<?php

if (Yii::$app->session->hasFlash('danger')) {
    ?>

    <div class="alert alert-danger alert-dismissible fade show p-4" role="alert">
        <strong>
            <div class="d-inline-block mr-1">
            <span class="mdi mdi-info-outline">
            </span>
            </div>
            Warning!
        </strong>
        <br>
        <div class="mt-2 pt-1 opacity-75">
            <?= Yii::$app->session->getFlash('danger') ?>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
    </div>

<?php } ?>
