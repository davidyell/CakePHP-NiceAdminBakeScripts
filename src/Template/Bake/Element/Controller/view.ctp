<%
$allAssociations = array_merge(
    $this->Bake->aliasExtractor($modelObj, 'BelongsTo'),
    $this->Bake->aliasExtractor($modelObj, 'BelongsToMany'),
    $this->Bake->aliasExtractor($modelObj, 'HasOne'),
    $this->Bake->aliasExtractor($modelObj, 'HasMany')
);
%>

    /**
     * View method
     *
     * @param string|int $id <%= $singularHumanName %> id.
     *
     * @return void
     *
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When there is no record.
     * @throws \Cake\Datasource\Exception\InvalidPrimaryKeyException When $primaryKey has an
     *      incorrect number of elements.
     */
    public function view($id)
    {
        $<%= $singularName%> = $this-><%= $currentModelName %>->get($id, [
            'contain' => [
                <% foreach ($allAssociations as $association): %>
'<% echo $association %>',
                <% endforeach; %>
]
        ]);

        $this->set('<%= $singularName %>', $<%= $singularName %>);
    }
