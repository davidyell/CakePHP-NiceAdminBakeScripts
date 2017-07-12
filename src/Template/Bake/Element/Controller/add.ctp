<%
$compact = ["'" . $singularName . "'"];
%>

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $<%= $singularName %> = $this-><%= $currentModelName %>->newEntity();
        if ($this->request->is('post')) {
            $<%= $singularName %> = $this-><%= $currentModelName %>->patchEntity($<%= $singularName %>, $this->request->data);
            if ($this-><%= $currentModelName; %>->save($<%= $singularName %>)) {
                $this->Flash->success(__('The <%= strtolower($singularHumanName) %> has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The <%= strtolower($singularHumanName) %> could not be saved. Please, try again.'));
            }
        }

<%
        $associations = array_merge(
            $this->Bake->aliasExtractor($modelObj, 'BelongsTo'),
            $this->Bake->aliasExtractor($modelObj, 'BelongsToMany')
        );
        foreach ($associations as $assoc):
            $association = $modelObj->association($assoc);
            $otherName = $association->target()->alias();
            $displayField = $association->target()->getDisplayField();
            $otherPlural = $this->_variableName($otherName);
%>
        $<%= $otherPlural %> = $this-><%= $currentModelName %>-><%= $otherName %>->find('list')->order(['<% echo $displayField %>' => 'asc']);
<%
            $compact[] = "'$otherPlural'";
        endforeach;
%>
        $this->set(compact(<%= join(', ', $compact) %>));
    }
