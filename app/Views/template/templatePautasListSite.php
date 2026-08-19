<div class="pautas-list row">
	<?php foreach ($pautasList['pautas'] as $pauta): ?>
		<?= view_cell('\App\Libraries\Cards::cardsVerticaisSimplesPautas', $pauta, 300, 'card_pauta_' . ($pauta['id'] ?? '')); ?>
	<?php endforeach; ?>
</div>
<div class="d-none">
	<?php if ($pautasList['pager']): ?>
		<?= $pautasList['pager']->simpleLinks('noticias', 'default_template') ?>
	<?php endif; ?>
</div>
