<div class="row">
<div class="span3">
    <H3>Actions</H3>
    <div class="well well-large">
    <ul>
        <li><?php echo $this->Html->link('List Projects', array('action' => 'index')); ?>
        <li><?php echo $this->Html->link('Setup',array('controller'=>'admin','action' => 'setup')); ?></li>
    </ul>
    </div>
    <?php
        echo $this->element('Common/date_format');
        echo $this->element('Common/zoom_level');
    ?>
</div><!-- /.span3 .sb-fixed -->

<div class="span9">
    <?php echo $this->Form->create('Project'); ?>
    <h2>Add Project</h2>
    <?php
        echo $this->Form->input('name');
        echo $this->Form->input('default_lat', array( 'label' => 'Default Latitude' ));
        echo $this->Form->input('default_lon', array( 'label' => 'Default Longitude' ));
        echo $this->Form->input('workorder_title', array( 'label' => 'Title for Workorder' ));
        echo $this->Form->input('datetime_format', array( 'label' => 'Datetime Format (PHP compatible)', 'value' => 'd/m/Y'));       
        echo $this->Form->input('snmp_type_id', array('type'=>'select','options' => $snmptypes, 'label' => 'SNMP Version', 'empty' => true));
        echo $this->Form->input('snmp_community_name', array( 'label' => 'SNMP Community Name' ));
        echo $this->Form->input('monitoring_system_type_id', array('type'=>'select','options' => $monitoringSystemTypes, 'label' => 'Monitoring System Type', 'empty' => true));
        echo $this->Form->input('monitoring_system_username', array( 'label' => 'Monitoring System Username' ));
        echo $this->Form->input('monitoring_system_password', array( 'type'=>'password', 'label' => 'Monitoring System Password' ));
        echo $this->Form->input('monitoring_system_url', array( 'label' => 'Complete URL to ReST API','placeholder' => '' ));
    ?>
    
    </fieldset>
    <?php
        echo $this->Form->submit('Save', array('div' => false,'class'=>'btn btn-primary'));
        echo $this->Form->end(); 
    ?>
</div> <!-- /.span9 -->
</div> <!-- /.row -->
