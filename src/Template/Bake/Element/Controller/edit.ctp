<%
$belongsTo = $this->Bake->aliasExtractor($modelObj, 'BelongsTo');
$belongsToMany = $this->Bake->aliasExtractor($modelObj, 'BelongsToMany');
$allAssociations = array_merge($belongsTo, $belongsToMany);

$compact = ["'" . $singularName . "'"];
%>

    /**
     * Edit method
     *
     * @param string|int $id <%= $singularHumanName %> id.
     *
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     *
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When there is no record.
     * @throws \Cake\Datasource\Exception\InvalidPrimaryKeyException When $primaryKey has an
     *      incorrect number of elements.
     */
    public function edit($id)
    {
        $<%= $singularName %> = $this-><%= $currentModelName %>->get($id, [
            'contain' => [
        <% foreach ($allAssociations as $association): %>
        '<% echo $association %>',
        <% endforeach; %>
    ]
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $<%= $singularName %> = $this-><%= $currentModelName %>->patchEntity($<%= $singularName %>, $this->request->getData());
            if ($this-><%= $currentModelName; %>->save($<%= $singularName %>)) {
                $this->Flash->success(__('The <%= strtolower($singularHumanName) %> has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The <%= strtolower($singularHumanName) %> could not be saved. Please, try again.'));
            }
        }

<%
        foreach (array_merge($belongsTo, $belongsToMany) as $assoc):
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
