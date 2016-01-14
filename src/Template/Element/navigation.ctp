<div class="user">
    <?php
    $hash = md5(strtolower(trim($this->request->session()->read('Auth.User.email'))));
    echo "<img class='$class' src='http://www.gravatar.com/avatar/$hash?s=$size&d=mm'>";
    ?>
    <p>
        <?= $this->request->session()->read('Auth.User.first_name') . ' ' . $this->request->session()->read('Auth.User.last_name')?><br>
        <span class="status online"><i class="glyphicon glyphicon-ok-sign"></i></span> Online
    </p>
</div>

<nav id="accordion">
    <h3><i class="glyphicon glyphicon-flag"></i> First item <i class="glyphicon glyphicon-chevron-left"></i></h3>
    <div>
        <ul>
            <li <?php echo ($this->request->controller == 'Examples')? 'class="active"' : '' ?>><?php echo $this->Html->link('Examples', ['controller' => 'Examples', 'action' => 'index', 'plugin' => false], ['escape' => false]); ?></li>
            <li <?php echo ($this->request->controller == 'Placeholders')? 'class="active"' : '' ?>><?php echo $this->Html->link('Placeholders', ['controller' => 'Placeholders', 'action' => 'index', 'plugin' => false]); ?></li>
        </ul>
    </div>

    <h3><i class="glyphicon glyphicon-list-alt"></i> Second item <i class="glyphicon glyphicon-chevron-left"></i></h3>
    <div>
        <ul>
            <li <?php echo ($this->request->controller == 'Examples')? 'class="active"' : '' ?>><?php echo $this->Html->link('Examples', ['controller' => 'Examples', 'action' => 'index', 'plugin' => false], ['escape' => false]); ?></li>
            <li <?php echo ($this->request->controller == 'Placeholders')? 'class="active"' : '' ?>><?php echo $this->Html->link('Placeholders', ['controller' => 'Placeholders', 'action' => 'index', 'plugin' => false]); ?></li>
        </ul>
    </div>

</nav>