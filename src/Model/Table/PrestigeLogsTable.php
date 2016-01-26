<?php
// src/Model/Table/prestigeLogsTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class PrestigeLogsTable extends AppTable {

	public function initialize(array $config){
        parent::initialize($config);

        $this->displayField('name');

        //Associations
        //$this->belongsTo('PrestigeCategories');
        $this->belongsTo('Members');
        $this->hasMany('PrestigeLogsItems', [
            'dependant' => true,
            'cascadeCallbacks' => true,
            'foreignKey' => 'prestige_log_id',
        ]);
        //$this->belongsToMany('PrestigeItems', [
        //    'through'=>'PrestigeLogsItems',
        //    'foreignKey' => 'prestige_log_id',
        //    'targetForeignKey' => 'prestige_item_id',
        //]);

	}

    public function validationDefault(Validator $validator) {

        return $validator
            ->notEmpty('member_id', 'A member_id is required')
            ->add('member_id', [
                'unique' => [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message' => 'That member already has a Prestige Log!'
                ],
            ])
            ;
    }

    //This is used to get the record owners id to for security reasons
    public function getOwnerId($record_id){
        
        return null;
    }

    public function calculatePrestige($prestigeLog){
        //debug("It Starts...");


        //Sort the items by Year and month.
        $sortedItems = [];
        foreach($prestigeLog->prestige_logs_items as $item){
            if($item->status===2){
                //Make sure the year array is setup.
                if(!isset($sortedItems[$item->locked->year])){
                    $sortedItems[$item->locked->year] = [];
                }

                //Make sure the month array is setup
                if(!isset($sortedItems[$item->locked->year][$item->locked->month])){
                    $sortedItems[$item->locked->year][$item->locked->month] = [];
                }

                //Now append the item to the year/month array.
                array_push($sortedItems[$item->locked->year][$item->locked->month], $item);
                
                //debug($item->locked->year);
            }
        }

        //Now that we have things sorted into Year/Month, lets calculate the amount of valid prestige.
        $prestigeTotal = ['Total'=>[0,0,0]];

        //debug($sortedItems);

        foreach($sortedItems as $year=>$months){

            //Make sure we have the year array set.
            if(!isset($prestigeTotal[$year]) ){
                $prestigeTotal[$year] = [];
            }

            foreach($months as $month=>$items){
                //debug($year);
                //debug($month);

                //Make sure we have the month array set.  
                if(!isset($prestigeTotal[$year][$month]) ){
                    $prestigeTotal[$year][$month] = [0, 0, 0];
                }


                //
                //NOTE: We really should catch any overages to show the user why and where their prestige went over the cap.
                //


                //Add the amount to the item's up to its monthly total.
                $monthlyItemsTotals = [];
                foreach($items as $item){
                    $itemId = $item->prestige_item->id;
                    $itemLimit = $item->prestige_item->monthly_limit;
                    if(!isset($monthlyItemsTotals[$itemId]) ){
                        $monthlyItemsTotals[$itemId] = 0;
                    }
                    
                    if($itemLimit>0){
                        $monthlyItemsTotals[$itemId] = min( ($item->amount+$monthlyItemsTotals[$itemId]), $itemLimit );
                    }else{
                        $monthlyItemsTotals[$itemId] += $item->amount;
                    }
                }

                //Add the items monthly totals to the monthly category totals
                $calclatedItemIds = [];
                $monthlyCategoriesTotals = [];
                foreach($items as $item){
                    $itemId = $item->prestige_item->id;

                    //If item Id is not set, then we have not proccessed this item type.
                    if(!isset($calclatedItemIds[$itemId])){

                        //Add this item to the calculatedItemIds array.
                        $calclatedItemIds[$itemId] = True;

                        $itemMonthlyAmount = $monthlyItemsTotals[$itemId];
                        $categoryId = $item->prestige_item->prestige_category->id;
                        $categoryLimit = $item->prestige_item->prestige_category->monthly_limit;

                        //Now add this item's monthly total to the category total.
                        if(!isset($monthlyCategoriesTotals[$categoryId]) ){
                            $monthlyCategoriesTotals[$categoryId] = 0;
                        }

                        if($categoryLimit>0){
                            $monthlyCategoriesTotals[$categoryId] = min( ($itemMonthlyAmount+$monthlyCategoriesTotals[$categoryId]), $categoryLimit );
                        }else{
                            $monthlyCategoriesTotals[$categoryId] += $itemMonthlyAmount;
                        }
                    }
                }

                foreach($monthlyCategoriesTotals as $categoryTotal){

                    //This needs to actually handle different types of prestige.

                    $prestigeTotal[$year][$month][0] += $categoryTotal;
                    $prestigeTotal['Total'][0] += $categoryTotal;

                }
            }
        }

        //debug($prestigeTotal);


        return $prestigeTotal;
    }

}
?>