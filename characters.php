<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="http://images4.fanpop.com/image/photos/23100000/Conan-conan-edogawa-23141762-200-186.jpg">
    <title>أنيمي المحقق كونان</title>

    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-material-design.min.css" rel="stylesheet">
    <link href="css/ripples.min.css" rel="stylesheet">
    <link href="css/bootstrap-rtl.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<?php
require_once 'core.php';
?>
<h3>قائمة أفضل الشخصيات</h3>

<?php 
$api = new api();
$chars = $api->getTopChars(1000);

echo '<row>';
foreach ($chars as $char):
?>
<div class="col-md-6" style="height:200px">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<?= $char->name?>
		</div>
		<div class="panel-body">
			<img style="float:right" src="<?= $char->img?>"/><?= $char->desc?><br/><a href="http://animeposts.com/?char=<?= $char->id?>">ﻉﺮﺿ ﻢﻨﺷﻭﺭﺎﺗ <?= $char->name ?></a>
		</div>
	</div>
</div>
<?php
endforeach;
echo '</row>';
?>



