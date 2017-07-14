<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use app\modules\blog\models;
?>


<?php
$url = Url::to(['bycategory', 'category_id' => $model->id]);
$class = strpos($_SERVER["REQUEST_URI"], $url) !== false ? " class='active'" : "";

?>


<div>
    <ul class="nav nav-pills">
        <li <?= $class;?>>
            <a href="<?= $url;?>">
                <?=$model->name?>
            </a>
        </li>

    </ul>
</div>