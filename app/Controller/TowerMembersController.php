<?php
/**
 * Controller for tower members.
 *
 * This is a very basic controller to add/view/update/delete tower members.
 * These tasks would typically be performed by a user with administrative level
 * permissions within Poundcake.
 *
 * Developed against CakePHP 2.2.3 and PHP 5.4.4.
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
 * @package       app.Controller
 * @since         AntennaTypesController precedes Poundcake v2.2.1
 * @license       XYZ License
 */

App::uses('AppController', 'Controller');

class TowerMembersController extends AppController {

    public function index() {
        $this->TowerMember->recursive = 0;
        $this->set('towermembers', $this->paginate());
    }

    public function view($id = null) {
        $this->TowerMember->id = $id;
        if (!$this->TowerMember->exists()) {
                throw new NotFoundException(__('Invalid tower member'));
        }
        $this->set('towermember', $this->TowerMember->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->TowerMember->create();
            if ($this->TowerMember->save($this->request->data)) {
                $this->Session->setFlash('The tower member has been saved.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Error!  The tower member could not be saved. Please, try again.');
            }
        }
    }

    public function edit($id = null) {
        $this->TowerMember->id = $id;
        if (!$this->TowerMember->exists()) {
                throw new NotFoundException(__('Invalid tower member'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->TowerMember->save($this->request->data)) {
                $this->Session->setFlash('The tower member has been saved.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Error!  The tower member could not be saved. Please, try again.');
            }
        } else {
                $this->request->data = $this->TowerMember->read(null, $id);
        }
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->TowerMember->id = $id;
        if (!$this->TowerMember->exists()) {
            throw new NotFoundException(__('Invalid tower member'));
        }
        if ($this->TowerMember->delete()) {
            $this->Session->setFlash('TowerMember deleted.');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Error!  TowerMember was not deleted.');
        $this->redirect(array('action' => 'index'));
    }
        
    /*
     * Uses Auth to check the ACL to see if the user is allowed to perform any
     * actions in this controller
     */
    public function isAuthorized($user) {
        return parent::isAuthorized($user);
    }
}
