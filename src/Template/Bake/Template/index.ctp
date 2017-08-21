<%
use Cake\Utility\Inflector;

$fields = collection($fields)
    ->filter(function($field) use ($schema) {
        return !in_array($schema->columnType($field), ['binary', 'text']);
    })
    ->take(7);
%>
<h1><?= $this->request->controller?></h1>

<div class="buttons">
    <?= $this->Html->link('<span class=\'glyphicon glyphicon-plus\'></span> Add new', ['action' => 'add'], ['class' => 'btn btn-primary', 'escape' => false]);?>
</div>

<div class="search">
    <?php
    echo $this->Form->create(null, ['class' => 'form-inline']);
    echo $this->Form->control('title');
    echo $this->Form->button('<span class=\'glyphicon glyphicon-search\'></span> Filter',['type' => 'submit', 'class' => 'btn btn-success']);
    echo $this->Html->link('Reset', ['action' => 'index'], ['class' => 'btn btn-default']);
    echo $this->Form->end();
    ?>
</div>

<div class="<%= $pluralVar %> index">
    <table cellpadding="0" cellspacing="0" class="table table-hover table-striped">
    <thead>
        <tr>
    <% foreach ($fields as $field):
            $class = '';
            if (in_array($schema->columnType($field), ['integer', 'biginteger', 'decimal', 'float'])) {
                $class = ' class="number"';
            } elseif (in_array($schema->columnType($field), ['date', 'datetime', 'timestamp', 'time'])) {
                $class = ' class="time"';
            } elseif (in_array($schema->columnType($field), ['boolean'])) {
            $class = ' class="boolean"';
            }
            %>
        <th<%= $class %>><?= $this->Paginator->sort('<%= $field %>') ?></th>
    <% endforeach; %>
        <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($<%= $pluralVar %> as $<%= $singularVar %>): ?>
        <tr>
<%        foreach ($fields as $field) {
            $isKey = false;
            if (!empty($associations['BelongsTo'])) {
                foreach ($associations['BelongsTo'] as $alias => $details) {
                    if ($field === $details['foreignKey']) {
                        $isKey = true;
%>
            <td>
                <?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->link($<%= $singularVar %>->get('<%= $details['property'] %>')->get('<%= $details['displayField'] %>'), ['controller' => '<%= $details['controller'] %>', 'action' => 'view', $<%= $singularVar %>->get('<%= $details['property'] %>')->get('<%= $details['primaryKey'][0] %>')]) : '' ?>
            </td>
<%
                        break;
                    }
                }
            }
            if ($isKey !== true) {
                if (in_array($schema->columnType($field), ['integer', 'biginteger', 'decimal', 'float'])) {
%>
            <td class="number"><?= $this->Number->format($<%= $singularVar %>->get('<%= $field %>')) ?></td>
<%
                } elseif (in_array($schema->columnType($field), ['date', 'datetime', 'timestamp', 'time'])) {
%>
            <td class="time"><?= $this->Time->timeAgoInWords($<%= $singularVar %>->get('<%= $field %>')) ?></td>
<%
                } elseif (in_array($schema->columnType($field), ['boolean'])) {
%>
            <td class="boolean"><?php
                if ($<%= $singularVar %>->get('<%= $field %>')) {
                    echo "<span class='glyphicon glyphicon-ok bool-true'></span>";
                } else {
                    echo "<span class='glyphicon glyphicon-remove bool-false'></span>";
                }
            ?></td>
<%
                } else {
%>
            <td><?= h($<%= $singularVar %>->get('<%= $field %>'))?></td>
<%
                }
            }
        }

        $pk = '$' . $singularVar . '->' . $primaryKey[0];
%>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', <%= $pk %>], ['class' => 'btn btn-default btn-sm']) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', <%= $pk %>], ['class' => 'btn btn-default btn-sm']) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', <%= $pk %>], ['confirm' => __('Are you sure you want to delete # {0}?', <%= $pk %>), 'class' => 'btn btn-sm btn-danger']) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>

    <?= $this->Paginator->numbers() ?>
</div>
