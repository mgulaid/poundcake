<div class="row">
<div class="span3">
    <H3>Actions</H3>
    <div class="well well-large">
    <ul>
        <li><?php echo $this->MyHTML->linkIfAllowed(__('New Radio'), array('action' => 'add')); ?></li>
    </ul>
    </div>
    
    <H3>Search</H3>
    <?php
      echo $this->Form->create(
          'NetworkRadio',
          // calls the search function on the SitesController
          array('action'=>'search','class' => 'well')
      );
      echo $this->Form->input('name',array('escape' => true,'class' => 'span2'));
      ?>
    <span class="help-block">Use * to wildcard</span>
    <?php
        echo $this->Form->submit(__('Search', true), array('div' => false));
        echo $this->Form->end(); 
    ?>
</div><!-- /.span3 .sb-fixed -->

<div class="span9">
    <h2>Radios</h2>
    <table class="table table-condensed table-striped">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('name'); ?></th>
                <th><?php echo $this->Paginator->sort('site_id'); ?></th>
                <th><?php echo $this->Paginator->sort('radio_type_id'); ?></th>
                <th><?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
    <?php
    foreach ($networkradios as $networkradio): ?>
    <tr>
        <td><?php echo $this->Html->link(__($networkradio['NetworkRadio']['name']), array('action' => 'view', $networkradio['NetworkRadio']['id']))?></td>
        <td><?php echo $networkradio['Site']['site_vf'];?></td>
        <td><?php echo $networkradio['RadioType']['name'];?></td>
        <td>
            <?php echo $this->MyHTML->linkIfAllowed(__('Edit'), array('action' => 'edit', $networkradio['NetworkRadio']['id'])); ?>
            <?php echo $this->MyHTML->postLinkIfAllowed(__('Delete'), array('action' => 'delete', $networkradio['NetworkRadio']['id']), null, __('Are you sure you want to delete radio %s?', $networkradio['NetworkRadio']['name'])); ?>
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