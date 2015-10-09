<?php $this->Html->docType();?>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title><?php echo $this->fetch('title');?></title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->fetch('meta');

        echo $this->Html->css(array(
            '//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css',
            '//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css',
            'nice-admin'
        ));
		echo $this->fetch('css');
	?>
</head>
<body>
    <?php echo $this->element('NiceAdminBakeTheme.top-navigation');?>

    <div class="container-fluid admin">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                <?php echo $this->element('NiceAdminBakeTheme.navigation');?>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <?php echo $this->Flash->render();?>
                <?php echo $this->fetch('content');?>
                <footer><p>Copyright &copy; <?php echo date('Y');?> My Company</p></footer>
            </div>
        </div>
    </div>

    <?php
    echo $this->Html->script(array(
        '//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js',
        '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js',
        '//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js',
        'https://www.google.com/jsapi',
        'common'
    ));
    echo $this->fetch('script');
    ?>
</body>
</html>
