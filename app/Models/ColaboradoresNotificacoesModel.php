<?php

namespace App\Models;

use CodeIgniter\Model;

class ColaboradoresNotificacoesModel extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'colaboradores_notificacoes';
	protected $returnType       = 'array';
	protected $protectFields    = false;
	protected $allowCallbacks = true;
	public function getNovaUUID()
	{
		return app_uuid();
	}

	public function getNow()
	{
		return app_now();
	}
}
