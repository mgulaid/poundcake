<div class="districts form">
<?php echo $this->Form->create('District'); ?>
	<fieldset>
		<legend><?php echo __('Edit District'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('region_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('District.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('District.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Districts'), array('action' => 'index')); ?></li>
	</ul>
</div>
