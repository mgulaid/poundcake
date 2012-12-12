<div class="row">
<div class="span3">
    <H3>Actions</H3>
    <div class="well well-large">
    <ul>
        <li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('PowerType.id')), null, __('Are you sure you want to delete power type %s?', $this->Form->value('PowerType.name'))); ?></li>
        <li><?php echo $this->Html->link(__('List Power Types'), array('action' => 'index')); ?></li>
    </ul>
    </div>
</div><!-- /.span3 .sb-fixed -->

<div class="span9">
    <?php echo $this->Form->create('PowerType'); ?>
    <h2>Edit Power Type</h2>
    <?php
            echo $this->Form->input('id');
            echo $this->Form->input('name');
            echo $this->Form->input('volts');            
    ?>
    </fieldset>
    <?php
        echo $this->Form->submit('Save', array('div' => false,'class'=>'btn'));
        echo $this->Form->end(); 
    ?>
</div> <!-- /.span9 -->
</div> <!-- /.row -->
