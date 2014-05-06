<?php
echo $this->Html->meta('keywords', $post['Post']['keywords']);
echo $this->Html->meta('description', $post['Post']['description']);
?><div class="posts view">
	<h2><?php echo h($post['Post']['title']); ?></h2>
	<p><?php echo $this->Time->niceShort($post['Post']['modified']); ?></p>
	<p><?php echo nl2br($post['Post']['content']); ?></p>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Posts'), array('action' => 'index')); ?> </li>
	</ul>
</div>
