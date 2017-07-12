<%
use Cake\Utility\Inflector;

$fields = collection($fields)
    ->filter(function($field) use ($schema) {
        return $schema->columnType($field) !== 'binary';
    });
%>
<div class="<%= $pluralVar %> form">
    <?= $this->Form->create($<%= $singularVar %>) ?>
    <fieldset>
        <legend><?= __('<%= Inflector::humanize($action) %> <%= $singularHumanName %>') ?></legend>
        <?php
<%
        foreach ($fields as $field) {
            if (in_array($field, $primaryKey)) {
                continue;
            }
            if (isset($keyFields[$field])) {
                $fieldData = $schema->column($field);
                if (!empty($fieldData['null'])) {
%>
        echo $this->Form->control('<%= $field %>', ['options' => $<%= $keyFields[$field] %>, 'empty' => true]);
<%
                } else {
%>
        echo $this->Form->control('<%= $field %>', ['options' => $<%= $keyFields[$field] %>]);
<%
                }
                continue;
            }
            if (!in_array($field, ['created', 'modified', 'updated'])) {
                $fieldData = $schema->column($field);
                if (($fieldData['type'] === 'date') && (!empty($fieldData['null']))) {
%>
        echo $this->Form->control('<%= $field %>', ['empty' => true, 'default' => '']);
<%
                } else {
                    if (empty($fieldData['null'])) {
%>
        echo $this->Form->control('<%= $field %>'); <% // Required fields %>
<%
                    } else {
%>
        echo $this->Form->control('<%= $field %>');
<%
                    }

                }
            }
        }
        if (!empty($associations['BelongsToMany'])) {
            foreach ($associations['BelongsToMany'] as $assocName => $assocData) {
%>
        echo $this->Form->control('<%= $assocData['property'] %>._ids', ['options' => $<%= $assocData['variable'] %>]);
<%
            }
        }
%>
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
    <?= $this->Html->link('Cancel', ['action' => 'index'], ['class' => 'btn btn-default'])?>
    <?= $this->Form->end() ?>
</div>
