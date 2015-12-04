<html>
    <head>
        <meta charset="utf-8"/>
    </head>
    <body text="#000000" bgColor="#ffffff" topMargin="0" rightMargin="0">
        <?php
        $this->pageTitle = '';
        Yii::app()->clientScript->reset();
        Yii::app()->clientScript->registerPackage('yii-boleto');

        echo $content;
        ?>
    </body>
</html>