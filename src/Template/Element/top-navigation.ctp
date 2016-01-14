<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Your project name</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li <?php echo ($this->request->controller == 'Dashboards')? "class='active'" : '';?>>
                    <?php echo $this->Html->link('<i class="glyphicon glyphicon-home"></i> Dashboard', ['controller' => 'Dashboards', 'action' => 'home', 'plugin' => false], ['escape' => false]); ?>
                </li>
                <li <?php echo (isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == 'help')? "class='active'" : '';?>>
                    <?php echo $this->Html->link('<i class="glyphicon glyphicon-question-sign"></i> Help', ['controller' => 'Pages', 'action' => 'display', 'help', 'prefix' => 'admin', 'plugin' => false], ['escape' => false]); ?>
                </li>
                <li>
                    <?php echo $this->Html->link('<i class="glyphicon glyphicon-off"></i> Logout', ['controller' => 'Users', 'action' => 'logout', 'plugin' => false, 'prefix' => false], ['escape' => false]); ?>
                </li>
            </ul>
        </div>
    </div>
</nav>