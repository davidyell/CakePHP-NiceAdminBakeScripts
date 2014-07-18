<div class="<?php echo $pluralVar; ?> index">
    <h2><?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?></h2>
    <?php echo "<?php echo \$this->Html->link('New', array('action'=>'add'), array('title'=>'Add new','class'=>'btn add-button'));?>\n"; ?>

	<?php
		App::uses($modelClass, 'Model');
		$model = ClassRegistry::init($modelClass);

		if (in_array('SoftDelete', $model->Behaviors->loaded())) {
			echo "<?php echo \$this->Form->postLink(\"Purge (\$purgeable)\", array('action'=>'purge'), array('class' => 'btn btn-small btn-danger purge-button'), 'Are you sure you want to purge? This will remove records permanently!');?>\n";
			echo "<?php echo \$this->Html->link(\"Deleted (\$deleted)\", array('action'=>'deleted'), array('title'=>\"Deleted (\$deleted)\", 'class' => 'btn btn-small btn-primary deleted-button'));?>\n";
		}
	?>

    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
        <tr>
            <?php
            foreach ($fields as $field):
                if (!in_array($field, array('created', 'deleted', 'deleted_date'))) {
                    ?>
                    <th><?php echo "<?php echo \$this->Paginator->sort('{$field}'); ?>"; ?></th>
                    <?php
                }
            endforeach;
            ?>
            <th class="actions"><?php echo "<?php echo __('Actions'); ?>"; ?></th>
        </tr>
        <?php
        echo "<?php foreach (\${$pluralVar} as \${$singularVar}): ?>\n";
        echo "\t<tr>\n";
        foreach ($fields as $field) {
            if (!in_array($field, array('created', 'deleted', 'deleted_date'))) {
                $isKey = false;
                if (!empty($associations['belongsTo'])) {
                    foreach ($associations['belongsTo'] as $alias => $details) {
                        if ($field === $details['foreignKey']) {
                            $isKey = true;
                            if ($field == 'status_id') {
                                echo "\t\t<td><?php echo \$this->StatusLights->status(\${$singularVar}['{$alias}']['{$details['primaryKey']}']);?></td>\n";
                            } else {
                                echo "\t\t<td>\n\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'edit', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t</td>\n";
                            }
                            break;
                        }
                    }
                }
                if ($isKey !== true && $field == 'modified') {
                    echo "\t\t<td><?php echo \$this->Time->niceShort(\${$singularVar}['{$modelClass}']['{$field}']);?></td>\n";
                } elseif ($isKey !== true) {
                    echo "\t\t<td><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>&nbsp;</td>\n";
                }
            }
        }

        echo "\t\t<td class=\"actions\">\n";
        echo "\t\t\t<?php echo \$this->Actions->actions(\${$singularVar}['{$modelClass}']['{$primaryKey}'], array('e','d'));?>\n";
        echo "\t\t</td>\n";
        echo "\t</tr>\n";

        echo "<?php endforeach; ?>\n";
        ?>
    </table>
    <p>
        <?php echo "<?php
	echo \$this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>"; ?>
    </p>
    <div class="paging">
        <?php
        echo "<?php\n";
        echo "\t\techo \$this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));\n";
        echo "\t\techo \$this->Paginator->numbers(array('separator' => ''));\n";
        echo "\t\techo \$this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));\n";
        echo "\t?>\n";
        ?>
    </div>
</div>
