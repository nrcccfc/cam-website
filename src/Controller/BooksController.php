<?php
// src/Controller/BooksController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;


class BooksController extends AppController {

    //public $helpers = ['Url'];
    //public $components = ['Random'];

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        //$this->Auth->allow([]);
    }

        
     public function index() {
        $books = $this->Books->find('all')->contain(['Publishers', 'Games']);
        $this->set(compact('books'));
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid book'));
        }

        $book = $this->Books
            ->find()
            ->where(['Books.id' => $id])
            ->contain(['Publishers', 'Games'])
            ->first();
        $this->set(compact('book'));
    }

    public function add() {
        $book = $this->Books->newEntity($this->request->data);
        if($this->request->is('post')){
            if($result = $this->Books->save($book)){
                $this->Flash->success(__('The book has been created.'));
                return $this->redirect(['action' => 'view', $result->id]);
            }
            $this->Flash->error(__('Unable to create the book.'));
        }
        $games = $this->Books->Games->find('list')->toArray();
        $publishers = $this->Books->Publishers->find('list')->toArray();
        $this->set(compact('book', 'publishers', 'games'));
    }

    public function edit($id=null){
        $book = $this->Books
            ->find()
            ->where(['Books.id' => $id])
            ->contain(['Publishers', 'Games'])
            ->first();
        if ($this->request->is(['post', 'put'])) {
            //Update the object with request data.
            $this->Books->patchEntity($book, $this->request->data());
            if ($result = $this->Books->save($book)) {
                $this->Flash->success(__('The book has been updated.'));
                return $this->redirect(['action' => 'view', $book->id]);
            }
            $this->Flash->error(__('Unable to update the book.'));
        }
        $publishers = $this->Books->Publishers->find('list')->toArray();
        $games = $this->Books->Games->getGamesList();
        $this->set(compact('book', 'publishers', 'games'));
    }

    public function delete($id) {
        $this->request->allowMethod(['post', 'delete']);

        $book = $this->Books->get($id);
        if ($this->Books->delete($book)) {
            $this->Flash->success(__('The {0} Book (Id:{1}) has been deleted.', [h($book->name), h($book->id)]));
            return $this->redirect(['action' => 'index']);
        }
    }

}
?>