<div class="posts form">
	<h2><?php echo __('Add Post'); ?></h2>
<?php echo $this->Form->create('Post'); ?>
	<fieldset>
	<?php
	
		echo $this->Form->input('title');
		echo $this->Form->input('keywords');
		echo $this->Form->input('description');
		echo $this->Form->input('content');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Posts'), array('action' => 'index')); ?></li>
	</ul>
</div>
