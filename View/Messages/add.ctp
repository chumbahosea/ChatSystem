<h1>Add your message</h1>
<?php
echo $this->Form->create('Message');
echo $this->Form->input('content');
echo $this->Form->end('Save Message');
?>