<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="weida">
	<meta name="author" content="weida">

    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link href="libs/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .body{
            background:#000;
        }
		.navbar{
			margin-bottom:2px;
		}
	.fullblock{
		/*padding:0;
		magrin:0;
		width:100%;
		*/
	}
    </style>
</head>
<body>
<div class="container-fluid">
    <?php echo $__env->make('header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldContent('contents'); ?>
</div>
<script src="libs/js/jquery.min.js"></script>
<script src="libs/js/bootstrap.min.js"></script>
<script src="libs/js/unslider.min.js"></script>
</body>
</html>