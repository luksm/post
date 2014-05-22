<?php
App::uses('PostAppController', 'Post.Controller');
/**
 * Posts Controller
 *
 */
class PostsController extends PostAppController
{

    /**
     * Components
     *
     * @var array
     */
	public $components = array('Paginator', 'Session');

	/**
	 * Sets the default pagination settings up
	 *
	 * Override this method or the index() action directly if you want to change
	 * pagination settings. admin_index()
	 *
	 * @return void
	 */
    protected function _setupAdminPagination() {
        $this->Paginator->settings = array(
            'limit' => 20,
            'order' => array(
                $this->modelClass . '.created' => 'desc'
            )
        );
    }

    /**
     * admin_index method
     *
     * @return void
     */
    public function index()
    {
    	$this->_setupAdminPagination();
        $this->Paginator->settings[$this->modelClass]['recursive'] = 0;
        $this->Paginator->settings[$this->modelClass]['findType'] = 'published';
		$this->set('posts', $this->Paginator->paginate());
    }

    /**
     * admin_view method
     *
     * @param string $slug Post Slug
     *
     * @throws NotFoundException
     * @return void
     */
    public function view($slug = null)
    {
        if (!$this->Post->slugExists($slug)) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('post', $this->Post->findBySlug($slug));
    }

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index()
    {
    	$this->_setupAdminPagination();
        $this->Paginator->settings[$this->modelClass]['recursive'] = 0;

        $this->set('posts', $this->Paginator->paginate());
    }

    /**
     * admin_view method
     *
     * @param string $id Post ID
     *
     * @throws NotFoundException
     * @return void
     */
    public function admin_view($id = null)
    {
        if (!$this->Post->exists($id)) {
            throw new NotFoundException(__('Invalid post'));
        }
        $options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
        $this->set('post', $this->Post->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post')) {
            $this->Post->create();
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash(__('The post has been saved.'));
                return $this->redirect(array('action' => 'view', $this->Post->id));
            } else {
                $this->Session->setFlash(__('The post could not be saved. Please, try again.'));
            }
        }
    }

    /**
     * admin_select method
     *
     * @param string $id Post ID
     *
     * @throws NotFoundException
     * @return void
     */
    public function admin_select($id = null)
    {
        if (!$this->Post->exists($id)) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->Post->toggle($id, 'published')) {
            $this->Session->setFlash(__('The post has been published.'));
        } else {
            $this->Session->setFlash(__('The post has been unpublished.'));
        }
        return $this->redirect($this->referer());
    }

    /**
     * admin_edit method
     *
     * @param string $id Post ID
     *
     * @throws NotFoundException
     * @return void
     */
    public function admin_edit($id = null)
    {
        if (!$this->Post->exists($id)) {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->Post->set($this->request->data);
            if ($this->Post->validates()) {
                if ($this->Post->save($this->request->data)) {
                    $this->Session->setFlash(__('The post has been saved.'));
                    return $this->redirect(array('action' => 'view', $id));
                } else {
                    $this->Session->setFlash(__('The post could not be saved. Please, try again.'));
                }
            } else {
                $this->Session->setFlash(__('The post could not be saved. Please, try again.'));
            }

        } else {
            $options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
            $this->request->data = $this->Post->find('first', $options);
        }
    }

    /**
     * admin_delete method
     *
     * @param string $id Post ID
     *
     * @throws NotFoundException
     * @return void
     */
    public function admin_delete($id = null)
    {
        $this->Post->id = $id;
        if (!$this->Post->exists()) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Post->saveField('removed', true)) {
            $this->Session->setFlash(__('The post has been deleted.'));
        } else {
            $this->Session->setFlash(__('The post could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
