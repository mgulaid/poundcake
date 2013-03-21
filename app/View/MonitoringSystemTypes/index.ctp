<div class="row">
<div class="span3">
    <H3>Actions</H3>
    <div class="well"> <!-- was: well-large -->
    <ul>
        <li><?php echo $this->PoundcakeHTML->link('New Monitoring System Type', array('action' => 'add')); ?></li>
        <li><?php echo $this->PoundcakeHTML->link('Setup',array('controller'=>'admin','action' => 'setup')); ?></li>
    </ul>
    </div>
</div><!-- /.span3 .sb-fixed -->

<div class="span9">
	<h2>Monitor System Types</h2>
	<table class="table table-condensed table-striped table-hover">
            <thead>
                <tr>
                    <th class="index-item"><?php echo $this->Paginator->sort('name'); ?></th>
                    <th class="index-action"><?php echo 'Actions'; ?></th>
                </tr>
            </thead>
            <tbody>
	<?php
	foreach ($monitoringSystemTypes as $monitoringSystemType): ?>
	<tr>
            <td class="index-item"><?php echo $monitoringSystemType['MonitoringSystemType']['name'];?></td>
            <td class="index-action">
                <?php
                    echo $this->PoundcakeHTML->link('Edit', array('action' => 'edit', $monitoringSystemType['MonitoringSystemType']['id']));
                    echo '&nbsp;';
                    echo $this->PoundcakeHTML->postLinkIfAllowed('Delete',
                            array('controller'=>'monitoringsystemtypes','action'=>'delete', $monitoringSystemType['MonitoringSystemType']['id']),
                            array('method' => 'post','class'=>'confirm','data-dialog_msg'=>'Confirm delete of '.$monitoringSystemType['MonitoringSystemType']['name']),
                            null
                        );
                ?>
            </td>
	</tr>
        <?php endforeach; ?>
            </tbody>
        </table>

	
	<?php
            // include pagination
            echo $this->element('Common/pagination');
        ?>
</div> <!-- /.span9 -->
</div> <!-- /.row -->