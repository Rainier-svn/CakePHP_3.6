<?php

namespace App\Controller;

use Cake\Event\Event;

class RestController extends AppController {

	public function beforeFilter(Event $event) {
		if (in_array ( $this->request->action, [ 
				'rest_tests' 
		] )) {
			$this->eventManager ()->off ( $this->Csrf );
		}
	}

	protected function setJsonResponse() {
		$this->loadComponent ( 'RequestHandler' );
		$this->RequestHandler->renderAs ( $this, 'json' );
		$this->response->type ( 'application/json' );
	}

	public function restAlive() {
		if ($this->request->is ( 'get' )) {
			$response = array (
					'success' => 'Rest endpoint works!' 
			);
			
			return $this->response->withType ( "application/json" )->withStringBody ( json_encode ( $response ) );
		}
	}

	public function restTests() {
		if ($this->request->is ( 'get' )) {
			$response = array (
					'success' => 'Rest endpoint works!' 
			);
			$this->setJsonResponse ();
			$this->set ( [ 
					'result' => $response,
					'_serialize' => 'result' 
			] );
		} elseif ($this->request->is ( 'post' )) {
			$postData = $this->request->getData ();
			$this->setJsonResponse ();
			$this->set ( [ 
					'result' => $response,
					'_serialize' => 'result' 
			] );
		}
	}
}