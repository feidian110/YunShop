<?php
use addons\YunShop\html5\assets\OrderAsset;

OrderAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="UTF-8">
    <title>确认订单</title>
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport"/>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
    <meta content="telephone=no" name="format-detection"/>
    <?php $this->head() ?>
</head>
<body style="background:#f7f7f7">
<?php $this->beginBody() ?>

<?=$content;?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>