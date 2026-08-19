<?php
/**
 * Visual do painel interno (tokens dark-only do mockup).
 * Escopo: .vl-painel — não altera IDs nem ganchos de JS.
 */
?>
<style>
	.vl-painel {
		padding: 32px 0 56px;
	}

	.vl-painel-title,
	.vl-painel h1 {
		font-family: var(--vl-font-title);
		font-size: 24px;
		font-weight: 700;
		margin: 0 0 4px;
		color: var(--vl-text);
		line-height: 1.2;
	}

	.vl-painel h1.h2,
	.vl-painel h1.h3,
	.vl-painel h1.display-5 {
		font-size: 24px;
	}

	.vl-painel-lead,
	.vl-painel .vl-painel-lead {
		color: var(--vl-muted-2);
		font-size: 14px;
		margin: 0;
	}

	.vl-painel h2,
	.vl-painel .h5 {
		font-family: var(--vl-font-title);
		font-weight: 700;
		color: var(--vl-text);
	}

	.vl-painel h2.h5,
	.vl-painel h3.h6 {
		font-size: 16px;
	}

	.vl-painel .text-muted,
	.vl-painel .text-secondary,
	.vl-painel .text-body-secondary,
	.vl-painel .small.text-muted {
		color: var(--vl-muted-2) !important;
	}

	.vl-painel .card,
	.vl-painel .vl-card {
		background: var(--vl-surface);
		border: 1px solid var(--vl-border);
		border-radius: 10px;
		color: var(--vl-text);
		box-shadow: none;
	}

	.vl-painel .card.shadow-sm,
	.vl-painel .card.border-0 {
		box-shadow: none !important;
	}

	.vl-painel .card-header {
		background: transparent;
		border-bottom: 1px solid var(--vl-border);
		color: var(--vl-text);
	}

	.vl-painel .card-header.bg-body-secondary {
		background: transparent !important;
	}

	.vl-stat,
	.vl-painel .meus-artigos-kpi-card,
	.vl-painel .metricas-colaborador .card {
		background: var(--vl-surface);
		border: 1px solid var(--vl-border);
		border-radius: 10px;
		padding: 16px;
		color: var(--vl-text);
		box-shadow: none;
	}

	.vl-stat-value,
	.vl-painel .meus-artigos-kpi-card .display-6,
	.vl-painel .metricas-colaborador h2 {
		font-family: var(--vl-font-title);
		font-size: 24px;
		font-weight: 700;
		margin-bottom: 4px;
		color: var(--vl-text);
	}

	.vl-stat-label,
	.vl-painel .meus-artigos-kpi-card .h6,
	.vl-painel .metricas-colaborador h6 {
		font-size: 12px;
		color: var(--vl-muted-2);
		font-weight: 600;
	}

	.vl-painel .listagem-site-filtros,
	.vl-filtros {
		background: var(--vl-bg);
		border: 1px solid var(--vl-border-strong);
		border-radius: 10px;
	}

	.vl-painel .listagem-site-filtros.bg-body-secondary {
		background: var(--vl-bg) !important;
	}

	.vl-painel .form-label,
	.vl-painel label.form-label {
		display: block;
		font-size: 13px;
		color: var(--vl-muted);
		margin-bottom: 6px;
	}

	.vl-painel .form-control,
	.vl-painel .form-select,
	.vl-painel .input-group-text {
		background: var(--vl-bg);
		border: 1px solid var(--vl-border-strong);
		border-radius: var(--vl-radius);
		color: var(--vl-text);
		font-family: var(--vl-font-body);
		font-size: 14px;
	}

	.vl-painel .form-control::placeholder {
		color: var(--vl-muted-2);
	}

	.vl-painel .form-control:focus,
	.vl-painel .form-select:focus {
		background: var(--vl-bg);
		border-color: var(--vl-brand);
		color: var(--vl-text);
		box-shadow: 0 0 0 0.2rem rgba(var(--vl-brand-rgb), 0.25);
	}

	.vl-painel .form-text,
	.vl-painel small,
	.vl-painel .form-control + small {
		color: var(--vl-muted-2);
	}

	.vl-btn-ghost,
	.vl-painel .btn-outline-primary,
	.vl-painel .btn-outline,
	.vl-painel .btn-light,
	.vl-painel .btn-default,
	.vl-painel .btn-secondary:not(.btn-primary) {
		background: transparent !important;
		border: 1px solid rgba(255, 255, 255, 0.18) !important;
		color: var(--vl-text) !important;
		font-weight: 600;
		border-radius: var(--vl-radius);
	}

	.vl-btn-ghost:hover,
	.vl-painel .btn-outline-primary:hover,
	.vl-painel .btn-light:hover,
	.vl-painel .btn-default:hover {
		background: rgba(255, 255, 255, 0.04) !important;
		color: var(--vl-text) !important;
	}

	.vl-painel .btn-primary {
		background: var(--vl-brand) !important;
		border-color: var(--vl-brand) !important;
		color: var(--vl-brand-text) !important;
		font-weight: 700;
		border-radius: var(--vl-radius);
	}

	.vl-btn-danger,
	.vl-painel .btn-outline-danger {
		background: transparent !important;
		border: 1px solid var(--vl-danger) !important;
		color: var(--vl-danger) !important;
		font-weight: 600;
		border-radius: var(--vl-radius);
	}

	.vl-painel .btn-danger {
		background: transparent !important;
		border: 1px solid var(--vl-danger) !important;
		color: var(--vl-danger) !important;
		font-weight: 600;
	}

	.vl-painel .listagem-site-table-wrap,
	.vl-painel .table-responsive.rounded,
	.vl-list-card {
		background: var(--vl-surface);
		border: 1px solid var(--vl-border);
		border-radius: 10px;
		overflow: hidden;
	}

	.vl-painel .listagem-site-table-wrap .table thead.listagem-site-thead th,
	.vl-painel .table thead th {
		background-color: var(--vl-surface) !important;
		color: var(--vl-muted-2);
		font-weight: 700;
		font-size: 0.7rem;
		letter-spacing: 0.04em;
		text-transform: uppercase;
		border-bottom: 1px solid var(--vl-border) !important;
		box-shadow: none;
	}

	.vl-painel .table {
		color: var(--vl-text);
		--bs-table-bg: transparent;
		--bs-table-striped-bg: rgba(255, 255, 255, 0.03);
		--bs-table-border-color: rgba(255, 255, 255, 0.06);
	}

	.vl-painel .table tbody tr {
		border-bottom: 1px solid rgba(255, 255, 255, 0.06);
	}

	.vl-painel .table tbody td,
	.vl-painel .table tbody th {
		color: var(--vl-text);
		vertical-align: middle;
	}

	.vl-painel .accordion-item {
		background: var(--vl-surface);
		border-color: var(--vl-border);
		color: var(--vl-text);
	}

	.vl-painel .accordion-button {
		background: var(--vl-surface);
		color: var(--vl-text);
		font-family: var(--vl-font-title);
		font-weight: 700;
		font-size: 14px;
	}

	.vl-painel .accordion-button:not(.collapsed) {
		background: var(--vl-surface);
		color: var(--vl-text);
		box-shadow: none;
	}

	.vl-painel .accordion-button:focus {
		box-shadow: 0 0 0 0.2rem rgba(var(--vl-brand-rgb), 0.25);
		border-color: var(--vl-brand);
	}

	.vl-painel .accordion-body {
		background: var(--vl-surface);
		color: var(--vl-text);
	}

	.vl-painel .list-group-item {
		background: transparent;
		color: var(--vl-text);
		border-color: var(--vl-border);
	}

	.vl-painel .modal-content {
		background: var(--vl-surface);
		border: 1px solid var(--vl-border);
		border-radius: 14px;
		color: var(--vl-text);
	}

	.vl-painel .modal-header,
	.vl-painel .modal-footer {
		border-color: var(--vl-border);
	}

	.vl-painel .badge {
		font-weight: 700;
		border-radius: 999px;
		padding: 4px 9px;
		font-size: 11px;
	}

	.vl-badge-fase {
		background: rgba(96, 165, 250, 0.14);
		color: #60a5fa;
		font-size: 12px;
		font-weight: 700;
		padding: 5px 10px;
		border-radius: 999px;
		white-space: nowrap;
	}

	.vl-badge-papel {
		background: rgba(var(--vl-brand-rgb), 0.14);
		color: var(--vl-brand);
		font-size: 11px;
		font-weight: 700;
		padding: 4px 9px;
		border-radius: 999px;
	}

	.vl-painel .progress {
		background: var(--vl-surface);
		border-radius: 999px;
		height: 8px;
		overflow: hidden;
	}

	.vl-painel .progress-bar {
		background: var(--vl-brand);
	}

	.vl-perfil-tabs {
		display: flex;
		gap: 4px;
		border-bottom: 1px solid rgba(255, 255, 255, 0.1);
		margin-bottom: 24px;
		flex-wrap: wrap;
		padding-left: 0;
		list-style: none;
	}

	.vl-perfil-tabs .nav-link {
		background: none;
		border: none;
		color: var(--vl-muted);
		font-weight: 500;
		font-size: 14px;
		padding: 10px 14px;
		border-radius: 0;
		border-bottom: 2px solid transparent;
		font-family: var(--vl-font-body);
	}

	.vl-perfil-tabs .nav-link:hover,
	.vl-perfil-tabs .nav-link.active {
		color: var(--vl-brand);
		font-weight: 700;
		background: none;
		border-bottom-color: var(--vl-brand);
	}

	.vl-recado {
		background: var(--vl-surface);
		border: 1px solid var(--vl-border);
		border-left: 3px solid var(--vl-brand);
		border-radius: 10px;
		padding: 16px;
	}

	.vl-recado.recado-nao-lido,
	.vl-painel .recado-nao-lido {
		border-left-color: var(--vl-brand);
	}

	.vl-painel .recado-item {
		background: var(--vl-surface);
		border: 1px solid var(--vl-border);
		border-left: 3px solid rgba(255, 255, 255, 0.14);
		border-radius: 10px;
		padding: 0;
		overflow: hidden;
	}

	.vl-painel .recado-item.recado-nao-lido {
		border-left-color: var(--vl-brand);
	}

	.vl-zona-risco {
		border: 1px solid rgba(229, 72, 77, 0.3);
		border-radius: 10px;
		padding: 18px;
	}

	.vl-zona-risco h4,
	.vl-zona-risco h5 {
		color: var(--vl-danger);
		font-family: var(--vl-font-title);
		font-size: 15px;
		margin: 0 0 8px;
	}

	.vl-painel .ql-toolbar.ql-snow,
	.vl-painel .ql-container.ql-snow {
		border-color: var(--vl-border-strong);
		background: var(--vl-bg);
		color: var(--vl-text);
	}

	.vl-painel .ql-toolbar.ql-snow {
		border-radius: 8px 8px 0 0;
	}

	.vl-painel .ql-container.ql-snow {
		border-radius: 0 0 8px 8px;
	}

	.vl-painel .ql-editor {
		color: var(--vl-text);
		font-family: var(--vl-font-body);
	}

	.vl-painel .ql-editor.ql-blank::before {
		color: var(--vl-muted-2);
		font-style: normal;
	}

	.vl-painel .ql-snow .ql-stroke {
		stroke: var(--vl-muted);
	}

	.vl-painel .ql-snow .ql-fill {
		fill: var(--vl-muted);
	}

	.vl-painel .colab-fase-label {
		border-radius: var(--vl-radius);
		border: 1px solid transparent;
	}

	.vl-painel .colab-fase-label:hover {
		background-color: var(--vl-bg);
		border-color: var(--vl-border-strong);
	}

	.vl-painel .btn-check:checked + .colab-fase-label {
		background-color: rgba(var(--vl-brand-rgb), 0.14);
		border-color: var(--vl-brand);
		box-shadow: none;
		color: var(--vl-text);
	}

	.vl-painel .pipeline-fase-link:hover {
		background-color: var(--vl-bg);
		border-color: var(--vl-border-strong) !important;
	}

	.vl-painel .pipeline-fase-link:focus-visible,
	.vl-painel .btn-check:focus-visible + .colab-fase-label {
		outline: 2px solid var(--vl-brand);
		outline-offset: 2px;
	}

	.vl-painel .alert {
		background: var(--vl-surface);
		border: 1px solid var(--vl-border);
		color: var(--vl-text);
		border-radius: 10px;
	}

	.vl-painel .alert-danger {
		border-color: rgba(229, 72, 77, 0.35);
		color: var(--vl-text);
	}

	.vl-painel .alert-warning {
		border-color: rgba(243, 201, 33, 0.35);
	}

	.vl-painel .bg-body-secondary,
	.vl-painel .bg-light {
		background-color: var(--vl-bg) !important;
		color: var(--vl-text);
	}

	.vl-colaborar-row {
		display: flex;
		justify-content: space-between;
		align-items: center;
		gap: 16px;
		background: var(--vl-surface);
		border: 1px solid var(--vl-border);
		border-radius: 10px;
		padding: 16px 18px;
	}

	.vl-historico-item {
		font-size: 13px;
		color: var(--vl-muted);
		border-left: 2px solid rgba(255, 255, 255, 0.14);
		padding-left: 12px;
	}

	.vl-eyebrow {
		font-size: 13px;
		text-transform: uppercase;
		letter-spacing: 0.04em;
		color: var(--vl-muted-2);
		margin: 0 0 10px;
		font-weight: 700;
	}

	@media (max-width: 767.98px) {
		.vl-painel {
			padding: 20px 0 40px;
		}

		.vl-painel-title,
		.vl-painel h1 {
			font-size: 22px;
		}
	}
</style>
