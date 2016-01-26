<?php
// src/Model/Table/AffiliatesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class AffiliatesTable extends AppTable {

	public function initialize(array $config){
        parent::initialize($config);

        $this->displayField('name');

        $this->hasMany('DomainTypes');
        $this->hasMany('Roles');
        $this->hasMany('PrestigeCategories');
	}

    public function validationDefault(Validator $validator) {

        return $validator
            ->notEmpty('name', 'An name is required')
            ->add('name', [
                'unique' => [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message' => 'Affiliate name must be unique.'
                ],
                'length' => [
                    'rule' => ['lengthBetween', 3, 32],
                    'message' => 'Name must be between 3 and 32 characters long.'
                ]
            ])
            ->notEmpty('abbreviation', 'An abbriviation is required')
            ->add('abbreviation', [
                'unique' => [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message' => 'Affiliate abbreviation must be unique.'
                ],
                'length' => [
                    'rule' => ['lengthBetween', 2, 6],
                    'message' => 'Abbreviation must be between 2 and 6 characters long.'
                ]
            ])
            ->notEmpty('description', 'An description for this affiliate is required');
    }

        //Get a list of the names with the affiliaite abbreviation in it.
    public function getAffiliateIdByDomainId($domainId) {
        //debug($domainId);
        $domain = $this->DomainTypes->Domains
            ->find()
            ->contain(['DomainTypes.Affiliates'])
            ->where(['Domains.id' => $domainId])
            ->first();
        //debug($domain);
        return $domain->domain_type->affiliate_id;
        //return $domain->;
    }
}
?>