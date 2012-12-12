<div class="row">
<div class="span3">
    <H3>Actions</H3>
    <div class="well well-large">
    <ul>
        <li><?php echo $this->Html->link('New Radio Mode', array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link('Admin',array('controller'=>'admin','action' => 'setup')); ?></li>
    </ul>
    </div>
</div><!-- /.span3 .sb-fixed -->

<div class="span9">
	<h2>Radio Mode</h2>
	<table class="table table-condensed table-striped">
            <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('name'); ?></th>
                    <th><?php echo $this->Paginator->sort('inverse_mode_name'); ?></th>
                    <th><?php echo 'Actions'; ?></th>
                </tr>
            </thead>
            <tbody>
	<?php
	foreach ($radiomodes as $radiomode): ?>
	<tr>
            <td><?php echo $radiomode['RadioMode']['name'];?></td>
            <td><?php echo $radiomode['RadioMode']['inverse_mode_name'];?></td>
            <td>
                <?php echo $this->Html->link('Edit', array('action' => 'edit', $radiomode['RadioMode']['id'])); ?>
                <?php echo $this->Form->postLink('Delete', array('action' => 'delete', $radiomode['RadioMode']['id']), null, __('Are you sure you want to delete radio mode %s?', $radiomode['RadioMode']['name'])); ?>
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