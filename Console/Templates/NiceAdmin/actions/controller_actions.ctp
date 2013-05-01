/**
 * <?php echo $admin ?>index method
 *
 * @return void
 */
	public function <?php echo $admin ?>index() {
		$this-><?php echo $currentModelName ?>->recursive = 0;
		$this->set('<?php echo $pluralName ?>', $this->Paginator->paginate());
        $this->set('purgeable', $this-><?php echo $currentModelName; ?>->purgeDeletedCount());
        $this->set('deleted', $this-><?php echo $currentModelName ?>->find('count', array('conditions' => array('<?php echo $currentModelName; ?>.deleted' => true))));
	}

<?php $compact = array(); ?>
/**
 * <?php echo $admin ?>add method
 *
 * @return void
 */
	public function <?php echo $admin ?>add() {
		if ($this->request->is('post')) {
			$this-><?php echo $currentModelName; ?>->create();
			if ($this-><?php echo $currentModelName; ?>->save($this->request->data)) {
            <?php if ($wannaUseSession): ?>
				$this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> has been saved'), 'NiceAdmin.alert-box', array('class' => 'alert-success'));
				$this->redirect(array('action' => 'index'));
            <?php else: ?>
				$this->flash(__('<?php echo ucfirst(strtolower($currentModelName)); ?> saved.'), array('action' => 'index'));
            <?php endif; ?>
			} else {
            <?php if ($wannaUseSession): ?>
				$this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> could not be saved. Please, try again.'), 'NiceAdmin.alert-box', array('class' => 'alert-error'));
            <?php endif; ?>
			}
		}
<?php
	foreach (array('belongsTo', 'hasAndBelongsToMany') as $assoc):
		foreach ($modelObj->{$assoc} as $associationName => $relation):
			if (!empty($associationName)):
				$otherModelName = $this->_modelName($associationName);
				$otherPluralName = $this->_pluralName($associationName);
				echo "\t\t\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n";
				$compact[] = "'{$otherPluralName}'";
			endif;
		endforeach;
	endforeach;
	if (!empty($compact)):
		echo "\t\t\$this->set(compact(".join(', ', $compact)."));\n";
	endif;
?>
	}

<?php $compact = array(); ?>
/**
 * <?php echo $admin ?>edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function <?php echo $admin; ?>edit($id = null) {
		if (!$this-><?php echo $currentModelName; ?>->exists($id)) {
			throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this-><?php echo $currentModelName; ?>->save($this->request->data)) {
            <?php if ($wannaUseSession): ?>
				$this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> has been saved'), 'NiceAdmin.alert-box', array('class' => 'alert-success'));
				$this->redirect(array('action' => 'index'));
            <?php else: ?>
				$this->flash(__('The <?php echo strtolower($singularHumanName); ?> has been saved.'), array('action' => 'index'));
            <?php endif; ?>
			} else {
            <?php if ($wannaUseSession): ?>
				$this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> could not be saved. Please, try again.'), 'NiceAdmin.alert-box', array('class' => 'alert-error'));
            <?php endif; ?>
			}
		} else {
			$options = array('conditions' => array('<?php echo $currentModelName; ?>.' . $this-><?php echo $currentModelName; ?>->primaryKey => $id));
			$this->request->data = $this-><?php echo $currentModelName; ?>->find('first', $options);
		}
<?php
		foreach (array('belongsTo', 'hasAndBelongsToMany') as $assoc):
			foreach ($modelObj->{$assoc} as $associationName => $relation):
				if (!empty($associationName)):
					$otherModelName = $this->_modelName($associationName);
					$otherPluralName = $this->_pluralName($associationName);
					echo "\t\t\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n";
					$compact[] = "'{$otherPluralName}'";
				endif;
			endforeach;
		endforeach;
		if (!empty($compact)):
			echo "\t\t\$this->set(compact(".join(', ', $compact)."));\n";
		endif;
	?>
	}

/**
 * <?php echo $admin ?>delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function <?php echo $admin; ?>delete($id = null) {
		$this-><?php echo $currentModelName; ?>->id = $id;
		if (!$this-><?php echo $currentModelName; ?>->exists()) {
			throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this-><?php echo $currentModelName; ?>->delete()) {
        <?php if ($wannaUseSession): ?>
			$this->Session->setFlash(__('<?php echo ucfirst(strtolower($singularHumanName)); ?> deleted'), 'NiceAdmin.alert-box', array('class' => 'alert-success'));
			$this->redirect(array('action' => 'index'));
        <?php else: ?>
			$this->flash(__('<?php echo ucfirst(strtolower($singularHumanName)); ?> deleted'), array('action' => 'index'));
        <?php endif; ?>
		}
        <?php if ($wannaUseSession): ?>
            $this->Session->setFlash(__('<?php echo ucfirst(strtolower($singularHumanName)); ?> was not deleted'), 'NiceAdmin.alert-box', array('class' => 'alert-error'));
        <?php else: ?>
            $this->flash(__('<?php echo ucfirst(strtolower($singularHumanName)); ?> was not deleted'), array('action' => 'index'));
        <?php endif; ?>
        $this->redirect(array('action' => 'index'));
	}

/**
 * Permanently and irreversable assured destruction.
 */
    public function <?php echo $admin; ?>purge() {
        $this->request->onlyAllow('post', 'delete');
        if ($this-><?php echo $currentModelName; ?>->purgeDeleted()) {
            $this->Session->setFlash(__('<?php echo ucfirst(strtolower($singularHumanName)); ?> permanently deleted'), 'NiceAdmin.alert-box', array('class' => 'alert-success'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('<?php echo ucfirst(strtolower($singularHumanName)); ?> could not be purged'), 'NiceAdmin.alert-box', array('class' => 'alert-error'));
        $this->redirect(array('action' => 'index'));
    }

/**
 * Find and paginate the deleted items
 */
    public function <?php echo $admin;?>deleted() {
        $this->paginate = array(
            'conditions' => array(
                '<?php echo $currentModelName; ?>.deleted' => true
            )
        );
        $this->set('<?php echo $pluralName ?>', $this->Paginator->paginate());
    }

/**
 * Restore a deleted record
 *
 * @param int $id
 */
    public function <?php echo $admin;?>undelete($id) {
        if ($this-><?php echo $currentModelName; ?>->undelete($id)) {
            $this->Session->setFlash(__('Provider restored'), 'NiceAdmin.alert-box', array('class' => 'alert-success'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Provider could not be restored'), 'NiceAdmin.alert-box', array('class' => 'alert-error'));
        $this->redirect(array('action' => 'index'));
    }