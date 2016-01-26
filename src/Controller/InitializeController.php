<?php
// src/Controller/DomainsController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

class InitializeController extends AppController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['initializeDb']);
    }

        
    public function initializeDb() {
        $initResults = [];
        $tableNames = [
            'Publishers',
            'DomainTypes',
            'Domains',
            'Resources',
        ];
        
        //Loop through the tables to init.
        foreach($tableNames as $tableName){
            $table = TableRegistry::get($tableName);
            $initResults[$tableName] = $table->initializeDb($table->init());            
        }

        //Format the results
        $finalResults = [];
        foreach($initResults as $k=>$v){
            $record['table'] = $k;
            if(is_array($v)){
                $record['count'] = count($v);
            } else {
                $record['count'] = 0;
            }
            array_push($finalResults, $record);
        }

        $this->set(compact('finalResults'));
    }

    public listTables()
    {
        #This will show how to list all the tables in the database.
        //$tables = ConnectionManager::get('default')->schemaCollection()->listTables();


    }
}
?>