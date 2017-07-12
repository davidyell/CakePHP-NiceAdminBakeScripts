
    /**
     * Delete method
     *
     * @param string|null $id <%= $singularHumanName %> id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $<%= $singularName %> = $this-><%= $currentModelName %>->get($id);

        if ($this-><%= $currentModelName; %>->delete($<%= $singularName %>)) {
            $this->Flash->success(__('The <%= strtolower($singularHumanName) %> has been deleted.'));
        } else {
            $this->Flash->error(__('The <%= strtolower($singularHumanName) %> could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
