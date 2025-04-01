<?php
	class Message{
		public $header;
		public $message;

		public function __construct($header,$message)
		{
			$this->header=$header;
			$this->message=$message;
		}

		public function getMessage()
		{
			echo
			'<div class="toast show fixed-bottom">
			  <div class="toast-header">
			    <strong class="me-auto">'.$this->header.'</strong>
			    <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
			  </div>
			  <div class="toast-body">
			    <p>'.$this->message.'</p>
			  </div>
			</div>';
		}
	} 
 ?>