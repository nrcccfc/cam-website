<?php
namespace App\Controller;

use Cake\Network\Exception\NotFoundException;

class AnnouncementsController extends AppController {
	public $components = ['Flash'];

	public $helpers = ['Ajax'];


	public $paginate = [
	        'fields' => ['Announcements.id', 'Announcements.title', 'Announcements.created'],
	        'limit' => 3,
	        'order' => [
	            'Announcements.title' => 'asc'
	        ],
	        'sortWhitelist' => [
	        	'id', 'title', 'created',
	        ],
	    ];



	public function isAuthorized($user) {
	    // All registered users can add announcements
	    if ($this->request->action === 'add') {
	        return true;
	    }

	    // The owner of an announcement can edit and delete i
	    if (in_array($this->request->action, ['edit', 'delete'])) {
	        $announcementId = (int)$this->request->params['pass'][0];
	        if ($this->Announcements->isOwnedBy($announcementId, $user['id'])) {
	            return true;
	        }
	    }

	    return parent::isAuthorized($user);
	}

	public function index() {
		$this->PrgPattern->redirect();
		$this->PrgPattern->decode();

		//Init vars
		$count = 3;
		$conditions = [];

		//debug($this->request->data);
		if (!empty($this->request->query)) {
			if(!empty($this->request->data['Announcements']['titleId']) && !empty($this->request->data['Announcements']['title'])){
				$conditions['Announcements.id']  = $this->request->data['Announcements']['titleId'];
			} else {
				if(!empty($this->request->data['Announcements']['title'])){
					$conditions['Announcements.title LIKE']  = '%'.$this->request->data['Announcements']['title'].'%';
				}
			}

			if(!empty($this->request->data['count'])){
				$count = $this->request->data['count'];
			}

	        $query = $this->Announcements->find('all')->where($conditions);
	        //debug($query);

			$this->paginate['limit'] = $count;
	        $announcements = $this->paginate($query)->toArray();
	        
			if($this->request->data['auto_view'] && count($announcements) === 1){
				$this->redirect(array('action' => 'view', $announcements[0]->id));
			}

	        $this->set(compact('announcements'));
		}


    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid announcement'));
        }
        //$announcement = $this->Announcements->get($id);

		$announcement= $this->Announcements
		    ->find()
		    ->where(['Announcements.id' => $id])
		    ->contain(['Domains'])
		    ->first();
        $this->set(compact('announcement'));
    }

    public function add() {
        $announcement = $this->Announcements->newEntity($this->request->data);
        if ($this->request->is('post')) {
        	$announcement->user_id = $this->Auth->user('id');
            if ($this->Announcements->save($announcement)) {
                $this->Flash->success(__('Your announcement has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your announcement.'));
        }
        $this->set('announcement', $announcement);
    }

	public function edit($id = null) {
	    if (!$id) {
	        throw new NotFoundException(__('Invalid announcement'));
	    }

	    $announcement = $this->Announcements->get($id);
	    if ($this->request->is(['post', 'put'])) {
	        $this->Announcements->patchEntity($announcement, $this->request->data);
	        if ($this->Announcements->save($announcement)) {
	            $this->Flash->success(__('Your announcement has been updated.'));
	            return $this->redirect(['action' => 'index']);
	        }
	        $this->Flash->error(__('Unable to update your announcement.'));
	    }

	    $this->set('announcement', $announcement);
	}

	public function delete($id) {
	    $this->request->allowMethod(['post', 'delete']);

	    $announcement = $this->Announcements->get($id);
	    if ($this->Announcements->delete($announcement)) {
	        $this->Flash->success(__('The announcement with id: {0} has been deleted.', h($id)));
	        return $this->redirect(['action' => 'index']);
	    }
	}

}
?>