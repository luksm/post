<div class="posts index">
	<h2><?php echo __('Posts'); ?></h2>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('slug'); ?></th>
			<th><?php echo $this->Paginator->sort('keywords'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($posts as $post): ?>
		<tr>
			<td><?php echo h($post['Post']['title']); ?>&nbsp;</td>
			<td><?php echo h($post['Post']['slug']); ?>&nbsp;</td>
			<td><?php echo h($post['Post']['keywords']); ?>&nbsp;</td>
			<td><?php echo String::truncate($post['Post']['description']); ?>&nbsp;</td>
			<td class="actions">
				<?php
					if ($post['Post']['published']) {
			            echo $this->Html->link(__('Published'), array('action' => 'select', $post['Post']['id']));
			        } else {
			            echo $this->Html->link(__('Unpublished'), array('action' => 'select', $post['Post']['id']));
			        }

				?>
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $post['Post']['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $post['Post']['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $post['Post']['id']), null, __('Are you sure you want to delete # %s?', $post['Post']['id'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Post'), array('action' => 'add')); ?></li>
	</ul>
</div>
