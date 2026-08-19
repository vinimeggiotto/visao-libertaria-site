<?php

namespace App\Models;

use CodeIgniter\Model;

class PaginasEstaticasModel extends Model
{
	protected $DBGroup = 'default';
	protected $table = 'paginas_estaticas';
	protected $primaryKey = 'id';
	protected $useAutoIncrement = false;
	protected $returnType = 'array';
	protected $useSoftDeletes = false;
	protected $protectFields = false;
	protected $allowedFields = [];

	// // Dates
	// protected $useTimestamps = false;
	protected $dateFormat = 'datetime';
	protected $createdField = 'criado';
	protected $updatedField = 'atualizado';
	// protected $deletedField = 'excluido';

	// // Validation
	// protected $validationRules      = [];
	// protected $validationMessages   = [];
	// protected $skipValidation       = false;
	// protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks = true;
	// protected $beforeInsert   = [];
	// protected $afterInsert = ['cadastraHistoricoUsuarioInserir'];
	// protected $beforeUpdate   = [];
	// protected $afterUpdate = ['cadastraHistoricoUsuarioAlterar'];
	// protected $beforeFind     = [];
	// protected $afterFind      = [];
	// protected $beforeDelete   = [];
	// protected $afterDelete = ['cadastraHistoricoUsuarioExcluir'];

	public function getNovaUUID()
	{
		return app_uuid();
	}

	public function getNow()
	{
		return app_now();
	}

}