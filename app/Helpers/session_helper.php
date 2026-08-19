<?php

if (! function_exists('app_session')) {
	/**
	 * Sessão do request: chama start() só se a sessão PHP ainda não estiver ativa.
	 *
	 * @return \CodeIgniter\Session\Session
	 */
	function app_session()
	{
		$session = \Config\Services::session();
		if (session_status() !== PHP_SESSION_ACTIVE) {
			$session->start();
		}

		return $session;
	}
}
