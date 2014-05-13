<h1>Chat System</h1>
<?php echo $this->Html->link(
'Add Post',
array('controller' => 'threads', 'action' => 'add')
); 
echo "<br>";
echo $this->Html->link( "Logout",   array('controller'=> 'users','action'=>'logout') ); 
?>


<table>
	<tr>
		<th>Id</th>
		<th>Name</th>
		<th>The Created Date</th>
		<th>Created by</th>
	</tr>
	<!-- Here is where we loop through our $posts array, printing out post info -->
	<?php foreach ($threads as $thread): ?>
	<tr>
		<td><?php echo $thread['Thread']['id']; ?></td>
		<td>
			<?php echo $this->Html->link($thread['Thread']['name'],
array('controller' => 'threads', 'action' => 'view', $thread['Thread']['id'])); ?>
		<td><?php echo $thread['Thread']['created']; ?></td>
		<td><?php echo $thread['Thread']['user_id']; ?> </td>
	</tr>
	<?php endforeach; ?>
	<?php unset($thread); ?>
</table>