<div class="row">
<div class="span3">
    <H3>Actions</H3>
    <div class="well well-large">
    <ul>
        <li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('TowerMember.id')), null, __('Are you sure you want to delete tower member %s?', $this->Form->value('TowerMember.name'))); ?></li>
        <li><?php echo $this->Html->link(__('List Tower Members'), array('action' => 'index')); ?></li>
    </ul>
    </div>
</div><!-- /.span3 .sb-fixed -->

<div class="span9">
    <?php echo $this->Form->create('TowerMember'); ?>
    <h2>Edit Role</h2>
    <?php
            echo $this->Form->input('id');
            echo $this->Form->input('name');
    ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div> <!-- /.span9 -->
</div> <!-- /.row -->