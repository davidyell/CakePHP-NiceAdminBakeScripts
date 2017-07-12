<div class="dashboards home">
    <h1>My administration dashboard</h1>

    <div class="search">
        <?php
        echo $this->Form->create(null, ['class' => 'form-inline', 'url' => ['controller' => 'Examples', 'action' => 'index']]);
        echo $this->Form->control('example_id');
        echo $this->Form->button(__('Search examples'), ['class' => 'btn btn-sm btn-primary']);
        echo $this->Form->end();
        ?>
    </div>
    <div class="clearfix"><!-- blank --></div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel blue"><!-- You can put a graph here perhaps --></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="recent panel green">
                <h3>Recent stuff</h3>
                <?php foreach ($examples as $example): ?>
                    <div class="item">
                        <img src="">
                        <span class="label">Example</span>
                        <span class="modified">DateTime</span>
                    </div>
                <?php endforeach?>

                <p><?= $this->Html->link('View all things', ['controller' => 'Things', 'action' => 'index']);?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="recent panel orange">
                <h3>Recent stuff</h3>

                <p><?= $this->Html->link('View all things', ['controller' => 'Things', 'action' => 'index']);?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="recent-prices panel purple">
                <h3>Recent stuff</h3>

                <p><?= $this->Html->link('View all things', ['controller' => 'Things', 'action' => 'index']);?></p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="latestLogins panel">
                <h3>Last logins</h3>
                <ul>
                    <?php
                    foreach ($lastUsersLogin as $user) {
                        ?><li>
                        <?= $this->Gravatar->avatar($user->email, 70);?>
                        <p><?= $user->get('FullName');?></p>
                        <p class="last-login"><?= $this->Time->timeAgoInWords($user->get('last_login'));?></p>
                        </li><?php
                    }
                    ?>
                </ul>
                <div class="clearfix"><!-- blank --></div>
                <p><?= $this->Html->link('View all users', ['controller' => 'Users', 'action' => 'index']);?></p>
            </div>
        </div>
    </div>
</div>




<?php $this->append('script');?>
<script type="text/javascript">
    // Add your graph javascript
</script>
<?php $this->end();?>