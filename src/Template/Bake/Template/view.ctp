<%
use Cake\Utility\Inflector;

$associations += ['BelongsTo' => [], 'HasOne' => [], 'HasMany' => [], 'BelongsToMany' => []];
$immediateAssociations = $associations['BelongsTo'] + $associations['HasOne'];
$associationFields = collection($fields)
    ->map(function($field) use ($immediateAssociations) {
        foreach ($immediateAssociations as $alias => $details) {
            if ($field === $details['foreignKey']) {
                return [$field => $details];
            }
        }
    })
    ->filter()
    ->reduce(function($fields, $value) {
        return $fields + $value;
    }, []);

$groupedFields = collection($fields)
    ->filter(function($field) use ($schema) {
        return $schema->columnType($field) !== 'binary';
    })
    ->groupBy(function($field) use ($schema, $associationFields) {
        $type = $schema->columnType($field);
        if (isset($associationFields[$field])) {
            return 'string';
        }
        if (in_array($type, ['integer', 'float', 'decimal', 'biginteger'])) {
            return 'number';
        }
        if (in_array($type, ['date', 'time', 'datetime', 'timestamp'])) {
            return 'date';
        }
        return in_array($type, ['text', 'boolean']) ? $type : 'string';
    })
    ->toArray();

$groupedFields += ['number' => [], 'string' => [], 'boolean' => [], 'date' => [], 'text' => []];
$pk = "\$$singularVar->{$primaryKey[0]}";
%>
<div class="<%= $pluralVar %> view">
    <h2><?= h($<%= $singularVar %>->get('<%= $displayField %>')) ?></h2>
    <div class="non-text">
<% if ($groupedFields['string']) : %>
        <div class="strings">
<% foreach ($groupedFields['string'] as $field) : %>
<% if (isset($associationFields[$field])) :
            $details = $associationFields[$field];
%>
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title"><?= __('<%= Inflector::humanize($details['property']) %>') ?></h3></div>
                <div class="panel-body"><?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->link($<%= $singularVar %>->get('<%= $details['property'] %>')->get('<%= $details['displayField'] %>'), ['controller' => '<%= $details['controller'] %>', 'action' => 'view', $<%= $singularVar %>->get('<%= $details['property'] %>')->get('<%= $details['primaryKey'][0] %>')]) : '' ?></div>
            </div>
<% else : %>
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title"><?= __('<%= Inflector::humanize($field) %>') ?></h3></div>
                <div class="panel-body"><?= h($<%= $singularVar %>->get('<%= $field %>')) ?></div>
            </div>
<% endif; %>
<% endforeach; %>
        </div>
<% endif; %>
<% if ($groupedFields['number']) : %>
        <div class="numbers">
<% foreach ($groupedFields['number'] as $field) : %>
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title"><?= __('<%= Inflector::humanize($field) %>') ?></h3></div>
                <div class="panel-body"><?= $this->Number->format($<%= $singularVar %>->get('<%= $field %>')) ?></div>
            </div>
<% endforeach; %>
        </div>
<% endif; %>
<% if ($groupedFields['date']) : %>
        <div class="dates">
<% foreach ($groupedFields['date'] as $field) : %>
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title"><%= "<%= __('" . Inflector::humanize($field) . "') %>" %></h3></div>
                <div class="panel-body"><?= $this->Time->timeAgoInWords($<%= $singularVar %>->get('<%= $field %>')) ?></div>
            </div>
<% endforeach; %>
        </div>
<% endif; %>
<% if ($groupedFields['boolean']) : %>
        <div class="booleans">
<% foreach ($groupedFields['boolean'] as $field) : %>
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title"><?= __('<%= Inflector::humanize($field) %>') ?></h3></div>
                <div class="panel-body"><?= $<%= $singularVar %>->get('<%= $field %>') ? __('Yes') : __('No'); ?></div>
            </div>
<% endforeach; %>
        </div>
<% endif; %>
    </div>
<% if ($groupedFields['text']) : %>
    <div class="texts">
<% foreach ($groupedFields['text'] as $field) : %>
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title"><?= __('<%= Inflector::humanize($field) %>') ?></h3></div>
            <div class="panel-body"><?= $this->Text->autoParagraph(h($<%= $singularVar %>->get('<%= $field %>'))) ?></div>
        </div>
<% endforeach; %>
    </div>
<% endif; %>
</div>
<%
$relations = $associations['HasMany'] + $associations['BelongsToMany'];
foreach ($relations as $alias => $details):
    $otherSingularVar = Inflector::variable($alias);
    $otherPluralHumanName = Inflector::humanize($details['controller']);
    %>
<div class="related row">
    <div class="col-md-12">
    <h4 class="subheader"><?= __('Related <%= $otherPluralHumanName %>') ?></h4>
    <?php if (!empty($<%= $singularVar %>->get('<%= $details['property'] %>'))): ?>
        <table cellpadding="0" cellspacing="0" class="table table-condensed table-striped">
            <tr>
                <% foreach ($details['fields'] as $field): %>
                    <th><?= __('<%= Inflector::humanize($field) %>') ?></th>
                <% endforeach; %>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($<%= $singularVar %>->get('<%= $details['property'] %>') as $<%= $otherSingularVar %>): ?>
            <tr>
                <%- foreach ($details['fields'] as $field): %>
                    <% if (in_array($field, ['created', 'modified', 'updated'])): %>
                <td><?= $this->Time->timeAgoInWords($<%= $otherSingularVar %>->get('<%= $field %>')) ?></td>
                    <% else: %>
                <td><?= h($<%= $otherSingularVar %>->get('<%= $field %>')) ?></td>
                    <% endif; %>
                <%- endforeach; %>

                <%- $otherPk = "\${$otherSingularVar}->{$details['primaryKey'][0]}"; %>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => '<%= $details['controller'] %>', 'action' => 'view', <%= $otherPk %>], ['class' => 'btn btn-xs btn-default']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => '<%= $details['controller'] %>', 'action' => 'edit', <%= $otherPk %>], ['class' => 'btn btn-xs btn-default']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => '<%= $details['controller'] %>', 'action' => 'delete', <%= $otherPk %>], ['confirm' => __('Are you sure you want to delete # {0}?', <%= $otherPk %>), 'class' => 'btn btn-xs btn-danger']) ?>
                </td>
            </tr>

            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <div class="alert alert-warning">No related records found.</div>
    <?php endif;?>
    </div>
</div>
<% endforeach; %>
