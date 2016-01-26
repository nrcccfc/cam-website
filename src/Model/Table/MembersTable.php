<?php
// src/Model/Table/MembersTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;

class MembersTable extends AppTable {

    public function initialize(array $config){
        parent::initialize($config);
        $this->displayField('full_name');

        //Assignments
        $this->hasOne('PrestigeLogs', [
            'dependant' => true,
            'cascadeCallbacks' => true,
        ]);        
        $this->hasMany('Assignments', [
            'dependant' => true,
            'cascadeCallbacks' => true,
        ]);
        $this->belongsTo('Domains', [
            'className' => 'Domains',
        ]);


    }

    public function validationDefault(Validator $validator) {
        return $validator
            //->requirePresence('email')
            ->notEmpty('email', 'An email is required')
            ->add('email', [
                'validFormat' => [
                    'rule' => 'email',
                    'message' => 'E-Mail must be valid.',
                    'last' => true
                ],
                'unique' => [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message' => 'E-Mail must be unique.'
                ],
                'maxLength' => [
                    'rule' => ['maxLength', 50],
                    'message' => 'E-Mail must be less than 50 characters.'
                ]
            ])
            //->requirePresence('username')
            ->allowEmpty('username')
            ->add('username', [
                'unique' => [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message' => 'Username must be unique.'
                ],
                'length' => [
                    'rule' => ['lengthBetween', 3, 20],
                    'message' => 'Username must be between 3 and 20 characters long.'
                ]
            ])
            //->requirePresence('first_name')
            ->notEmpty('first_name', 'A first name is required')
            ->add('first_name', [
                'length' => [
                    'rule' => ['lengthBetween', 2, 20],
                    'message' => 'First name must be between 2 and 20 characters long.'
                ]
            ])
            //->requirePresence('last_name')
            ->notEmpty('last_name', 'A last name is required')
            ->add('last_name', [
                'length' => [
                    'rule' => ['lengthBetween', 2, 20],
                    'message' => 'Last name must be between 2 and 20 characters long.'
                ]
            ])
            //->requirePresence('password')
            ->notEmpty('password', 'A password is required')
            ->allowEmpty('password', function($context){
                //debug($context);
                if(!empty($context['data']) && isset($context['data']['ignorePassword'])) {
                    return !$context['data']['ignorePassword'];
                }
                return true;
            })
            ->add('password', [
                'minLength' => [
                    'rule' => ['minLength', 6],
                    'message' => 'Password must be at least 6 characters long.'
                ],
            ])
            //->requirePresence('password_confirm', 'create')
            ->notEmpty('password_confirm', 'A confirmation password is required')
            ->add('password_confirm', [
                'match' => [
                    'rule' => function($value, $context){
                        //return (new DefaultPasswordHasher)->check($context['data']['password_confirm'], $context['data']['password']);
                        return $context['data']['password_confirm'] == $context['data']['password'];
                    },
                    'message' => 'Password Confirm must match Password.'
                ]
            ])
            ->notEmpty('new_password', 'A new password is required')
            ->add('new_password', [
                'minLength' => [
                    'rule' => ['minLength', 6],
                    'message' => 'New password must be at least 6 characters long.'
                ],
            ])
            ->notEmpty('new_password_confirm', 'A confirmation password is required')
            ->add('new_password_confirm', [
                'match' => [
                    'rule' => function($value, $context){
                        //return (new DefaultPasswordHasher)->check($context['data']['new_password_confirm'], $context['data']['new_password']);
                        return $context['data']['new_password_confirm'] === $context['data']['new_password'];
                    },
                    'message' => 'New Password Confirm must match New Password.'
                ]
            ])
            ->notEmpty('old_password', 'Your old password is required')
            ->add('old_password', [
                'match' => [
                    'rule' => function($value, $context){
                        return (new DefaultPasswordHasher)->check($context['data']['old_password'], $context['data']['current_password']);
                    },
                    'message' => 'Old Password must match Current Password.'
                ]
            ])
            ->notEmpty('email_password', 'Your password is required')
            ->add('email_password', [
                'match' => [
                    'rule' => function($value, $context){
                        return (new DefaultPasswordHasher)->check($context['data']['email_password'], $context['data']['current_password']);
                    },
                    'message' => 'Password must match Current Password.'
                ]
            ])
            ->allowEmpty('email_temp', 'An email is required')
            ->add('email_temp', [
                'validFormat' => [
                    'rule' => 'email',
                    'message' => 'E-Mail must be valid.',
                    'last' => true
                ],
                'unique' => [
                    'rule' => function($value, $context){
                        return $context['data']['email_unique'] == 0;
                    },
                    'message' => 'E-Mail must be unique.'
                ],
                'maxLength' => [
                    'rule' => ['maxLength', 50],
                    'message' => 'E-Mail must be less than 50 characters.'
                ]
            ])
            //->requirePresence('is_active', 'create')
            ->add('is_active', [
                'boolean' => [
                    'rule' => 'boolean',
                    'message' => 'is_active must be a boolean'
                ],
            ])
            ->requirePresence('is_proxy', 'create')
            ->add('is_proxy', [
                'boolean' => [
                    'rule' => 'boolean',
                    'message' => 'is_proxy must be a boolean'
                ],
            ])
            ;
    }
}
?>