<?= $this->extend('layouts/_main'); ?>

<?= $this->section('content'); ?>

<?php
$gruposLinks = [
	[
		'nome' => 'Canais principais do YouTube',
		'links' => [
			['href' => 'https://www.youtube.com/channel/UCLTWPE7XrHEe8m_xAmNbQ-Q', 'label' => 'ANCAPSU'],
			['href' => 'https://www.youtube.com/channel/UC54AQb7XNGeby0a9uE5eRKg', 'label' => 'ANCAPSU Classic'],
			['href' => 'https://www.youtube.com/channel/UC9ycYMBQqlnE0h4dSyrdv0A', 'label' => 'Mundo em Revolução'],
			['href' => 'https://www.youtube.com/channel/UCSyG9ph5BJSmPRyzc_eGC4g', 'label' => 'Visão Libertária'],
		],
	],
	[
		'nome' => 'Outros temas',
		'links' => [
			['href' => 'https://www.youtube.com/channel/UCWFmlmegFcu6lvAmeBtV3cg', 'label' => 'SafeSrc'],
			['href' => 'https://www.youtube.com/channel/UCnVU5PE5WVWRKMWNi1E1KxQ', 'label' => 'Tomate na Mão'],
		],
	],
	[
		'nome' => 'Canais pessoais do Peter Turguniev',
		'links' => [
			['href' => 'https://www.youtube.com/channel/UCer2dai4fdkruJeq9vVKWKA', 'label' => 'Peter Turguniev'],
			['href' => 'https://www.youtube.com/channel/UCAvIp-okEqNNIrISZEm5rag', 'label' => 'Gordão Fitness'],
			['href' => 'https://www.youtube.com/channel/UCnVU5PE5WVWRKMWNi1E1KxQ', 'label' => 'Tomate na mão'],
		],
	],
	[
		'nome' => 'Odysee',
		'links' => [
			['href' => 'https://odysee.com/@opinionfreemarket:4', 'label' => 'Opinion Free Market'],
			['href' => 'https://odysee.com/@ancapsu:be', 'label' => 'ANCAPSU'],
			['href' => 'https://odysee.com/@ancapsu:c', 'label' => 'Visão Libertária'],
			['href' => 'https://odysee.com/@wrevolving:1', 'label' => 'Mundo em Revolução'],
			['href' => 'https://odysee.com/@diariosdaquarentena:0', 'label' => 'Peter Turguniev'],
		],
	],
	[
		'nome' => 'X (Twitter)',
		'links' => [
			['href' => 'https://x.com/ancapsu', 'label' => '@ancapsu'],
			['href' => 'https://x.com/Peter_ancapsu', 'label' => '@Peter_ancapsu'],
			['href' => 'https://x.com/MundoEmRevo', 'label' => '@MundoEmRevo'],
			['href' => 'https://x.com/ralbuque', 'label' => '@ralbuque'],
		],
	],
	[
		'nome' => 'Outras redes',
		'links' => [
			['href' => 'https://www.instagram.com/ancap.su/', 'label' => 'Instagram @ancap.su'],
			['href' => 'https://tiktok.com/@ancapsu', 'label' => 'TikTok @ancapsu'],
			['href' => 'https://www.facebook.com/ancapsufb', 'label' => 'Facebook ancapsufb'],
			['href' => 'https://t.me/ancap_su', 'label' => 'Telegram @ancap_su'],
		],
	],
];
?>

<div class="vl-container" style="max-width: 1000px; padding-top: 56px; padding-bottom: 64px;">
	<h1 style="font-family: var(--vl-font-title); font-size: 30px; font-weight: 700; margin: 0 0 28px;">Todos os projetos</h1>
	<div class="row g-4">
		<?php foreach ($gruposLinks as $grupo): ?>
			<div class="col-12 col-sm-6 col-lg-4">
				<div class="vl-card h-100" style="border-radius: 12px; padding: 22px;">
					<h2 style="font-family: var(--vl-font-title); font-size: 16px; font-weight: 700; margin: 0 0 12px;"><?= esc($grupo['nome']); ?></h2>
					<div class="d-flex flex-column" style="gap: 6px; font-size: 14px;">
						<?php foreach ($grupo['links'] as $link): ?>
							<a href="<?= esc($link['href'], 'attr'); ?>" target="_blank" rel="noopener noreferrer"><?= esc($link['label']); ?></a>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>

<?= $this->endSection(); ?>
