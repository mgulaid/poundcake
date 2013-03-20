<div class="row">
<div class="span3">
    <H3>Actions</H3>
    <div class="well"> <!-- was: well-large -->
    <ul>
        <li><?php echo $this->PoundcakeHTML->link('List Organizations', array('action' => 'index')); ?>
    </ul>
    </div>
</div><!-- /.span3 .sb-fixed -->

<div class="span9">
    <h2>View Organization</h2>
    <dl>
    <dt>Name</dt>
    <dd><?php echo $organization['Organization']['name']; ?></dd>
    <dt>Contacts</dt>
        <?php
            //echo print_r($organization);
            //echo "<pre>";
            //echo print_r($organization);
            //echo "</pre>";
            $c = count($organization['Contact']);
            //echo "c is".$c;
            if ($c == 0) {
                echo "None";
            } else {
                foreach ($organization['Contact'] as $contact) {
                    echo "<dd>";
                    echo $this->Html->link($contact['name_vf'], array(
                        'controller' => 'contacts',
                        'action' => 'view',
                        $contact['id']));
                    echo "</dd>";
                }
            }
        ?>
    </dl>
</div> <!-- /.span9 -->
</div> <!-- /.row -->

