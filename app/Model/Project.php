<?php
/**
 * Model for project.
 *
 * Developed against CakePHP 2.2.3 and PHP 5.4.x.
 *
 * Copyright 2012, Inveneo, Inc. (http://www.inveneo.org)
 *
 * Licensed under XYZ License.
 * 
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2012, Inveneo, Inc. (http://www.inveneo.org)
 * @author        Clark Ritchie <clark@inveneo.org>
 * @link          http://www.inveneo.org
 * @package       app.Model
 * @since         Project precedes Poundcake v2.2.1
 * @license       XYZ License
 */


App::uses('AppModel', 'Model');

class Project extends AppModel {

    /*
     * Display field for select lists
     */
    public $displayField = 'name';
    
    /*
     * Relations
     */
    // public $hasAndBelongsToMany = array('User');
    /*
    public $hasAndBelongsToMany = array(
        'User' => 
            array('className'    => 'User', 
                  'joinTable'    => 'projects_users', 
                  'foreignKey'   => 'project_id', 
                  'associationForeignKey'=> 'user_id', 
                  //'conditions'   => 'group by user_id',
                  //'conditions'   => '(1=1) group by user_id',
                  'order'        => '', 
                  'limit'        => '', 
                  'unique'       => true, 
                  'finderQuery'  => '', 
                  'deleteQuery'  => '', 
            ), 
//        'Role' => 
//           array('className'    => 'Role', 
//                 'joinTable'    => 'projects_users', 
//                 'foreignKey'   => 'project_id', 
//                 'associationForeignKey'=> 'role_id', 
//                 //'conditions'   => '(1=1) group by role_id', 
//                 //'conditions'   => 'group by role_id', 
//                 'order'        => '', 
//                 'limit'        => '', 
//                 'unique'       => true, 
//                 'finderQuery'  => '', 
//                 'deleteQuery'  => '', 
//           ) 
    );
    */
    
    /*
     * Relations
     */
    public $belongsTo = array(
        'SnmpType',
        'MonitoringSystemType'
    );
    
    /*
     * Relations
     */
    public $hasMany = array(
        'SiteStates',
        'TowerTypes',
        'InstallTeams',
        'ProjectMembership', // NOTE:  this is a "hasMany through" relation, similar to HABTM
        'IpAddress',
        'IpSpace'
    );
    
    /*
     * Default sort order
     */
    var $order = 'Project.name ASC';
    
    /*
     * CakePHP behavior to handle encrypting/decrypting sensitive fields when
     * readingor writing to the database.
     * 
     * @see http://bakery.cakephp.org/articles/utoxin/2009/08/01/cryptable-behavior
     */
    var $actsAs = array( 
        'Cryptable' => array( 
            'fields' => array( 
                'monitoring_system_password',
                'snmp_community_name'
            ) 
        ) 
    ); 
   
    /*
     * Field-level validation rules
     */
    public $validate = array(
        'name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'This field cannot be blank.',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            )
        ),
        'default_lat' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'This field cannot be blank.'
            ),
            'format' => array(
                'rule' => '/^-?\d{1,3}\.\d{1,14}$/',
                'message' => 'Expecting XX.XXXXX or -XX.XXXXX'
            )
        ),
        'default_lon' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'This field cannot be blank.'
            ),
            'format' => array(
                'rule' => '/^-?\d{1,3}\.\d{1,14}$/',
                'message' => 'Expecting XX.XXXXX or -XX.XXXXX'
            )
        ),
    );
    
    /*
     * Standard call back function -- if there are Sites that match this
     * project's id, return false to prevent the delete.
     */
    public function beforeDelete($cascade = true) {
        // loadModel returning an error here
       $i = ClassRegistry::init('Site')->findByProjectId( $this->id );      
       if ( !is_null( $i['Site'] ) ) {
            return false;
       } else {
           return parent::beforeDelete($cascade);
       }
    }
    
    
    /*
     * Standard call back function -- automatically give admins
     * (or users with roleid of 1) access to the project, called
     * on both add and edit.
     */
//    PC-390 makes this irrelevant now that we don't have a HABTM relation
//    keeping this commented out for now
//    
//    public function beforeSave($options = array()) {
//        // find all the admins
//        $admins = ClassRegistry::init('User')->findAllByAdmin( 1 );
//        $admin_ids = array();
//        foreach ( $admins as $admin ) {
//            array_push($admin_ids, $admin['User']['id'] );
//        }
//        $this->recursive = 2;
//        debug( $this->data );
//        die;
//        $this->data['User']['User'] = $admin_ids;
//        /*
//         * manually verify that admins have access to this following the save:
//         * 
//         * select users.id,users.username,projects.name
//         * from users,projects,projects_users
//         * where users.role_id=1 and
//         * users.id = projects_users.user_id
//         * and projects.id = projects_users.project_id;
//        */
//        return true;
//    }
    
}
