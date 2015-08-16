<?php
App::uses('AppController', 'Controller');
/**
 * EventCategories Controller
 *
 * @property EventCategory $EventCategory
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class EventCategoriesController extends AppController {

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Event');

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->EventCategory->recursive = 0;
		$this->set('eventCategories', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->EventCategory->exists($id)) {
			throw new NotFoundException(__('Invalid event category'));
		}
		$options = array('conditions' => array('EventCategory.' . $this->EventCategory->primaryKey => $id));
		$this->set('eventCategory', $this->EventCategory->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->EventCategory->create();
			if ($this->EventCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The event category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event category could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->EventCategory->exists($id)) {
			throw new NotFoundException(__('Invalid event category'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->EventCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The event category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('EventCategory.' . $this->EventCategory->primaryKey => $id));
			$this->request->data = $this->EventCategory->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->EventCategory->id = $id;
		if (!$this->EventCategory->exists()) {
			throw new NotFoundException(__('Invalid event category'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->EventCategory->delete()) {
			$this->Session->setFlash(__('The event category has been deleted.'));
		} else {
			$this->Session->setFlash(__('The event category could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
