    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $query = $this-><%= $currentModelName %>->find();
<% $belongsTo = $this->Bake->aliasExtractor($modelObj, 'BelongsTo'); %>
<% if ($belongsTo): %>
        $query->contain([<%= $this->Bake->stringifyList($belongsTo, ['indent' => false]) %>]);
<% endif; %>

        if (empty($this->request->getQuery('sort'))) {
            $query->order([$this-><%= $currentModelName %>->aliasField('modified') => 'desc']);
        }

        $this->set('<%= $pluralName %>', $this->paginate($query));
    }
