<div class="row">
<div class="span3">
<!--    <H3>Actions</H3>-->
<!--    <ul>
        <li></li>
    </ul>-->
&nbsp;
</div><!-- /.span3 .sb-fixed -->
<div class="span9">
    <H2>Setup</H2>

    <div class="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Caution!</strong> Many items in Tower DB are configurable by an administrator, and some of these may have system or project-wide impacts.
    </div>
    
    <div class="row">
        <div class="span4">
            <H3>Projects, Roles, Users</H3>
            <UL>
                <li><?php echo $this->Html->link('Projects', '/admin/projects/index'); ?></li>
                <li><?php echo $this->Html->link('Roles', '/admin/roles/index'); ?></li>
                <li><?php echo $this->Html->link('Users', '/admin/users/index'); ?></li>            
            </UL>
        </div>
        
        <div class="span4">
            <H3>Monitoring</H3>
            <UL>    
                <li><?php echo $this->Html->link('Monitoring System Types', '/admin/monitoringSystemTypes/index'); ?></li>
                <li><?php echo $this->Html->link('Network Services', '/admin/networkServices/index'); ?></li>        
                <li><?php echo $this->Html->link('SNMP Versions', '/admin/snmpTypes/index'); ?></li>        
            </UL>            
        </div> <!-- /.span4 -->    
    </div>
    
    <div class="row">
        <div class="span4">
            <H3>Sites</H3>
            <UL>
                <li><?php echo $this->Html->link('Equipment Spaces', '/admin/equipmentSpaces/index'); ?></li>
                <li><?php echo $this->Html->link('Organizations', '/admin/organizations/index'); ?></li>    
                <li><?php echo $this->Html->link('Power Types', '/admin/powerTypes/index'); ?></li>
                <li><?php echo $this->Html->link('Tower Members', '/admin/towerMembers/index'); ?></li>    
                <li><?php echo $this->Html->link('Tower Mounts', '/admin/towerMounts/index'); ?></li>            
                <li><?php echo $this->Html->link('Tower Type', '/admin/towerTypes/index'); ?></li>            
            </UL>
        </div> <!-- /.span4 -->
        
        <div class="span4">
            <H3>Network Equipment</H3>
            <UL>
                <li><?php echo $this->Html->link('Antenna Types', '/admin/antennaTypes/index'); ?></li>
                <li><?php echo $this->Html->link('Radio Modes', '/admin/radioModes/index'); ?> </li>
                <li><?php echo $this->Html->link('Radio Types', '/admin/radioTypes/index'); ?> </li>
                <li><?php echo $this->Html->link('Router Types', '/admin/routerTypes/index'); ?> </li>
                <li><?php echo $this->Html->link('Switch Types', '/admin/switchTypes/index'); ?> </li>
            </UL>
        </div>
    </div>
    
    <div class="row">
        <div class="span4">
            <H3>Miscellaneous</H3>
            <UL>    
                <li><?php echo $this->Html->link('Build Items', '/admin/buildItems/index'); ?></li>
                <li><?php echo $this->Html->link('Contact Types', '/admin/contactTypes/index'); ?></li>
                <li><?php echo $this->Html->link('Install Teams', '/admin/installTeams/index'); ?></li>        
                <li><?php echo $this->Html->link('Notification (System Banner)', '/admin/notifications/edit'); ?></li>
                <li><?php echo $this->Html->link('Site States', '/admin/siteStates/index'); ?></li>
                <li><?php echo $this->Html->link('Zones', '/admin/zones/index'); ?></li>
            </UL>
        </div> <!-- /.span4 -->   
    </div> <!-- /.row -->
</div> <!-- /.span9 -->
</div> <!-- /.row -->