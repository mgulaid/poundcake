<?php

// maybe we'll need this?
//App::uses('Sanitize','Utility');

class SitesController extends AppController
{
    // AjaxMultiUpload is used for the file upload plugin
    // AltGoogleMapV3 is the Marc Fernandez Google Map helper, just renamed
    // AutoCompleteHelper removed -- not used
    var $helpers = array('AjaxMultiUpload.Upload','AltGoogleMapV3');
    
    public $components = array('AjaxMultiUpload.Upload'); //,'DebugKit.Toolbar'
    
    public $presetVars = array(
        // field names for the form itself , 'model' => 'Site'
        array('field' => 'site_name', 'type' => 'value'),
        //?? revisit:  array('field' => 'district', 'type' => 'lookup', 'formField' => 'district_input', 'modelField' => 'district', 'model' => 'Site'),
    );
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('site_name', $this->Site->site_name);
    }
    
    /*
    public $paginate = array(
        'fields' => array('Site.site_code', 'Site.site_name'),
        'limit' => 25,
        'order' => array(
            'Site.site_code' => 'asc'
        )
    );
    */
    function about() {
        // show the about page
    }
    
    function index($id = null) {
        
        $conditions = "";
        $site_code_arg = "";
        $site_name_arg = "";
        //echo $this->passedArgs['Site.site_code'];
        
        if (isset($this->passedArgs['Site.site_code'])) {
            $site_code_arg = str_replace('*','%',$this->passedArgs['Site.site_code']);
        }
        
        if (isset($this->passedArgs['Site.site_name'])) {
            $site_name_arg = str_replace('*','%',$this->passedArgs['Site.site_name']);
        }
        
        // if neither argument was passed, default to a wildcard
        if ($site_code_arg == "") {
            $site_code_arg = '%';
        }
        if ($site_name_arg == "") {
            $site_name_arg = '%';
        }
        
        //echo "Site code 2:<pre>".$this->passedArgs['Site.site_code']."</pre>";            
        $conditions = array(
            'AND' => array(
                'Site.site_code LIKE' => $site_code_arg,
                'Site.site_name LIKE' => $site_name_arg,
            )
        );
        //echo "Conditions: ".print_r($conditions);
        
        $this->paginate = array(
            'Site' => array(
                // limit is the number per page 
                'limit' => 20,
                'conditions' => $conditions,
                'order' => array(
                    'Site.site_code' => 'asc',
                    'Site.site_name' => 'asc',
                ),
            ));
        
        $data = $this->paginate('Site');
        $this->set('sites',$data);
    }
 
    public function overview() {
        // find('all') would return all sites, no matter what
        //$sites = $this->Site->find('all');
        
        // filter out ones w/o a location (since we can't display them on the
        // map without coordinates)
        
        // get all the sites for display on the map, and deal with their lat/lon
        
        // skip any that don't have coordinates in the db
        $conditions = array ("NOT" => array ("Site.lat" => null));
        $sites = $this->Site->find('all', array('conditions' => $conditions));
        /*
        for($i = 0; $i < sizeof($sites); ++$i) {
            // for each site, decode the lat/lon and save it back to the
            // array of sites
            //echo "<pre> Site ID = ".$sites[$i]['Site']['id']."</pre>";
            // we're actually overwriting the Site's "location" field (which
            // comes back as a binary object) with the decoded lat/lon
            $sites[$i]['Site']['location'] = $this->getLatLon( $sites[$i]['Site']['id'], 'sites' );
        }
        */
        $this->set('sites', $sites);
    }
    
    function getSitesNearby($id = null, $max_sites = 5) {
        // return the nearest sites using the MySQL stored procedure
        // sp_nearby
        if ($id != null && $max_sites != null) {
            $query = 'call sp_nearby('.$id.','.$max_sites.')';
            $nearby = $this->Site->query( $query );
            /* not really sure why the distance comes back in its own array here,
             example:
             
                [2] => Array
                    (
                        [sites] => Array
                            (
                                [id] => 2
                                [site_name] => CHITANDI
                            )

                        [0] => Array
                            (
                                [distance] => 5.8482689198309625
                            )

                    )

             */
            $this->set('nearby', $nearby);
        }
    }
    
    function view($id = null) {
        $this->Site->id = $id;
        $this->getSitesNearby($id,5);
        if (!$this->Site->exists()) {
            throw new NotFoundException(__('Invalid site'));
        }
        $this->set('site', $this->Site->read(null, $id));
        
    }
    
    function getZones() {
        // return a list of zones (which will be put into a drop-down menu
        // on the add/edit forms)
        $this->set('zones',$this->Site->Zone->find('list'));
    }
    
    function getConnectivityTypes() {
        // identical to getZones
        $this->set('connectivitytypes',$this->Site->ConnectivityType->find('list'));
    }
    
    function getTowerOwners() {
        // identical to getZones
        $this->set('towerowners',$this->Site->TowerOwner->find('list'));
    }
    
    function getSiteStates() {
        // identical to getZones
        $this->set('sitestates',$this->Site->SiteState->find('list'));
    }
    
    function getPowerTypes() {
        // identical to getZones
        $this->set('powertypes',$this->Site->PowerType->find('list'));
    }
    
    function getRoadTypes() {
        // identical to getZones
        $this->set('roadtypes',$this->Site->RoadType->find('list'));
    }
    
    function getNetworkSwitches() {
        // identical to getZones
        $this->set('networkswitches',$this->Site->NetworkSwitch->find('list'));
    }
    
    function getNetworkRadios() {
        // identical to getZones
        $this->set('networkradios',$this->Site->NetworkSwitch->find('list'));
    }
    
    function add() {
        // Note prior to adding the belongsTo relationship (site belongs to
        // region) I had this if in advance of actually calling the save method
        // -- this failed after I added belongsTo and I'm not sure why
        // commenting out for now
        // if ($this->request->is('site')) {
        $this->Site->create();

        // get a list of regions, link and intervention types
        // the Site may belong to
        // Catchments/Areas/Districts now handled by Ajax due to their new
        // relationships
        //$this->getConnectivityTypes();
        $this->getTowerOwners();
        $this->getSiteStates();
        $this->getPowerTypes();
        //$this->getRoadTypes();
        $this->getNetworkSwitches();
        $this->getNetworkRadios();
        
        /*
        // return all areas that match the default catchment
        $areas = $this->Site->District->Area->find(
                        'list',
                        array(
                            'conditions' => array('Area.catchment_id' => 1)
                        )
                );
        // return all districts that match the default area
        $districts = $this->Site->District->find(
                        'list',
                        array(
                            'conditions' => array('District.area_id' => 1)
                        )
                );
        */
        
        // get all Zones
        $zones = $this->Site->Zone->find('list');
        
        $this->set(compact('zones'));
                
        // should I wrap all the following with?
        // if ($this->request->is('post')) {        

        if ( $this->request->data != null ) {
            $this->set('lat',$this->request->data['Site']['lat']);
            $this->set('lon',$this->request->data['Site']['lon']);
        }

        // store the currently logged in user as a reference for the created site
        // The user() function provided by the component returns any column from
        // the currently logged in user.  We used this method to add the data into
        // the request info that is saved.
        //$this->request->data['Site']['user_id'] = $this->Auth->user('id');

        if ($this->Site->save($this->request->data)) {
            $this->Session->setFlash(__('The site has been saved'));
            $this->redirect(array('action' => 'index'));
        }
        // as above, before adding the belongsTo this caluse was in here, but this
        // no longer works -- this gets called on opening the add view
        // commenting out for now
        /*
        else {
            //$this->Session->setFlash(__('The site could not be saved. [Error 001]'));
        }
        */
    }
    
    function delete($id) {
        // this came from one of the search examples, not sure why it's here
        // if (!$this->request->is('post')) {
        //      throw new MethodNotAllowedException();
        //}
        $this->Site->id = $id;
        if (!$this->Site->exists()) {
            throw new NotFoundException(__('Invalid site'));
        }
        
        if ($this->Site->delete()) {
            // now cleanup any files associated with this site
            $this->Upload->deleteAll('Site', $id);
            $this->Session->setFlash(__('Site deleted'));
            $this->redirect(array('action' => 'index'));
        } else {
            $this->Session->setFlash(__('Site was not deleted'));
            $this->redirect(array('action' => 'index'));
        }
    }

    function edit($id = null) {
        $this->Site->id = $id;
        
        // get a list of regions, link and installation types
        // the Site may belong to
        $this->getZones();
        //$this->getConnectivityTypes();
        $this->getTowerOwners();
        $this->getSiteStates();
        $this->getPowerTypes();
        //$this->getRoadTypes();
        $this->getNetworkSwitches();
        $this->getNetworkRadios();
        
        if (!$this->Site->exists()) {
            throw new NotFoundException(__('Invalid site'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Site->save($this->request->data)) {
                $this->Session->setFlash(__('The site has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The site could not be saved. [Error 002]'));
            }
        } else {
            // show edit page
            $this->request->data = $this->Site->read(null, $id);
        }
    }
    
    public function isAuthorized($user) {
        // everyone can see the list and view individual Sites
        if ($this->action === 'index' || $this->action === 'view' || $this->action === 'overview' || $this->action === 'about') {
            return true;
        }
        // allow users with the rolealias of "edit" to add/edit/delete
        if ($this->action === 'add' || $this->action === 'edit' || $this->action === 'delete') {
            if (isset($user['Role']['rolealias']) && $user['Role']['rolealias'] === 'edit') {
                return true;
            }
        }
        
        return parent::isAuthorized($user);
    }
    
//    function auto_complete() {
//        $sites = $this->Site->find('all', array( 
//            'conditions' => array( 
//                'Site.site_name LIKE' => $this->params['url']['autoCompleteText'].'%' 
//            ), 
//            'fields' => array('site_name'), 
//            'limit' => 3, 
//            'recursive'=>-1, 
//        )); 
//        $sites = Set::Extract($sites,'{n}.Site.site_name'); 
//        $this->set('sites', $sites); 
//        $this->layout = 'ajax';     
//    }

    
}

?>
