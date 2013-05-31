<div class="row">
<div class="span3">
    <H3>Actions</H3>
    <div class="well">
    <ul>
        <li><?php echo $this->PoundcakeHTML->link('List Switch Types', array('action' => 'index')); ?>
    </ul>
    </div>
</div><!-- /.span3 .sb-fixed -->

<div class="span9">
    <?php echo $this->Form->create('SwitchType'); ?>
    <h2>Add Switch Type</h2>
    <?php
        echo $this->Form->input('name');
        echo $this->Form->input('ports');
        echo $this->Form->input('manufacturer');
        echo $this->Form->input('model');
        echo $this->Form->input('watts',array('value'=>'0'));
        echo $this->Form->input('value',array('value'=>'0.00'));
    ?>
    </fieldset>
    <?php
        echo $this->Form->submit('Save', array('div' => false,'class'=>'btn btn-primary'));
        echo $this->Form->submit('Cancel', array('name' => 'cancel','div' => false,'class'=>'btn btn-cancel'));
        echo $this->Form->end(); 
    ?>
</div> <!-- /.span9 -->
</div> <!-- /.row -->