<?php
	echo $this->Form->create();
	echo $this->Form->input("login");
	echo $this->Form->input("passwd");
	echo $this->Form->submit();
	echo $this->Form->end();
?>