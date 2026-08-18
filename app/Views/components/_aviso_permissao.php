<?php
$avisoPermissao = \Config\Services::session()->getFlashdata('aviso_permissao');
$permissoesSessao = $_SESSION['colaboradores']['permissoes'] ?? [];
$permissoesSessao = array_values(array_map('strval', (array) $permissoesSessao));
?>
<script>
	window.VL_PERMISSOES = <?= json_encode($permissoesSessao, JSON_UNESCAPED_UNICODE); ?>;
	window.VL_AVISO_PERMISSAO = <?= json_encode(
		($avisoPermissao !== null && $avisoPermissao !== '') ? (string) $avisoPermissao : null,
		JSON_UNESCAPED_UNICODE
	); ?>;
</script>
<script defer src="<?= site_url('public/js/aviso-permissao.js'); ?>"></script>
