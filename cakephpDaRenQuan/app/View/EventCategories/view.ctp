<div class="eventCategories view">
<h2><?php echo __('Event Category'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($eventCategory['EventCategory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($eventCategory['EventCategory']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Createtime'); ?></dt>
		<dd>
			<?php echo h($eventCategory['EventCategory']['createtime']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ext1'); ?></dt>
		<dd>
			<?php echo h($eventCategory['EventCategory']['ext1']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Event Category'), array('action' => 'edit', $eventCategory['EventCategory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Event Category'), array('action' => 'delete', $eventCategory['EventCategory']['id']), array(), __('Are you sure you want to delete # %s?', $eventCategory['EventCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Event Categories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event Category'), array('action' => 'add')); ?> </li>
	</ul>
</div>
