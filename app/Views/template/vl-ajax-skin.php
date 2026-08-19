<?php
/**
 * Skin dark-only dos parciais AJAX (tokens do mockup).
 * Não altera IDs, classes de gancho nem data-* usados pelo JS.
 */
?>
<style>
	.vl-ajax {
		color: var(--vl-text);
		font-family: var(--vl-font-body);
	}

	.vl-ajax a:not(.btn):not(.page-link) {
		color: var(--vl-brand);
	}

	.vl-ajax a:not(.btn):not(.page-link):hover {
		color: var(--vl-brand-hover);
	}

	.vl-ajax .text-muted,
	.vl-ajax .text-secondary,
	.vl-ajax .text-body-secondary,
	.vl-ajax .small.text-muted {
		color: var(--vl-muted-2) !important;
	}

	.vl-ajax .text-body {
		color: var(--vl-text) !important;
	}

	.vl-ajax .table {
		color: var(--vl-text);
		--bs-table-bg: transparent;
		--bs-table-striped-bg: rgba(255, 255, 255, 0.03);
		--bs-table-hover-bg: rgba(255, 255, 255, 0.04);
		--bs-table-border-color: rgba(255, 255, 255, 0.06);
		--bs-table-color: var(--vl-text);
	}

	.vl-ajax .table thead.listagem-site-thead th,
	.vl-ajax .table thead th,
	.vl-ajax .table thead.table-dark th {
		background-color: var(--vl-surface) !important;
		color: var(--vl-muted-2);
		font-weight: 700;
		font-size: 0.7rem;
		letter-spacing: 0.04em;
		text-transform: uppercase;
		border-bottom: 1px solid var(--vl-border) !important;
		box-shadow: none;
		vertical-align: middle;
	}

	.vl-ajax .table tbody tr {
		border-bottom: 1px solid rgba(255, 255, 255, 0.06);
	}

	.vl-ajax .table tbody td,
	.vl-ajax .table tbody th {
		color: var(--vl-text);
		vertical-align: middle;
		background: transparent;
	}

	.vl-ajax .table tbody tr.table-primary,
	.vl-ajax .table tbody tr.table-primary > * {
		--bs-table-bg: rgba(var(--vl-brand-rgb), 0.08);
		--bs-table-bg-state: rgba(var(--vl-brand-rgb), 0.08);
		color: var(--vl-text);
	}

	.vl-ajax .table tbody tr.table-danger,
	.vl-ajax .table tbody tr.table-danger > * {
		--bs-table-bg: rgba(229, 72, 77, 0.08);
		--bs-table-bg-state: rgba(229, 72, 77, 0.08);
		color: var(--vl-text);
	}

	.vl-ajax-pager {
		border-top: 1px solid var(--vl-border);
		background: transparent;
	}

	.vl-ajax .btn-light,
	.vl-ajax .btn-outline-primary,
	.vl-ajax .btn-outline-info,
	.vl-ajax .btn-outline-success,
	.vl-ajax .btn-secondary,
	.vl-ajax .btn-default {
		background: transparent !important;
		border: 1px solid rgba(255, 255, 255, 0.18) !important;
		color: var(--vl-text) !important;
		font-weight: 600;
		border-radius: var(--vl-radius);
	}

	.vl-ajax .btn-primary {
		background: var(--vl-brand) !important;
		border-color: var(--vl-brand) !important;
		color: var(--vl-brand-text) !important;
		font-weight: 700;
		border-radius: var(--vl-radius);
	}

	.vl-ajax .btn-danger,
	.vl-ajax .btn-outline-danger {
		background: transparent !important;
		border: 1px solid var(--vl-danger) !important;
		color: var(--vl-danger) !important;
		font-weight: 600;
		border-radius: var(--vl-radius);
	}

	.vl-ajax .btn-success {
		background: var(--vl-brand) !important;
		border-color: var(--vl-brand) !important;
		color: var(--vl-brand-text) !important;
		font-weight: 700;
		border-radius: var(--vl-radius);
	}

	.vl-ajax .btn-warning {
		background: transparent !important;
		border: 1px solid rgba(255, 255, 255, 0.18) !important;
		color: var(--vl-text) !important;
		font-weight: 600;
		border-radius: var(--vl-radius);
	}

	.vl-ajax .btn-link {
		color: var(--vl-brand);
		font-weight: 600;
	}

	.vl-ajax .btn-link.text-danger {
		color: var(--vl-danger) !important;
	}

	.vl-ajax .form-control,
	.vl-ajax .form-select,
	.vl-ajax .form-check-input {
		background: var(--vl-bg);
		border: 1px solid var(--vl-border-strong);
		color: var(--vl-text);
		border-radius: var(--vl-radius);
	}

	.vl-ajax .form-control::placeholder {
		color: var(--vl-muted-2);
	}

	.vl-ajax .form-control:focus,
	.vl-ajax .form-select:focus {
		background: var(--vl-bg);
		border-color: var(--vl-brand);
		color: var(--vl-text);
		box-shadow: 0 0 0 0.2rem rgba(var(--vl-brand-rgb), 0.25);
	}

	.vl-ajax .form-check-input:checked {
		background-color: var(--vl-brand);
		border-color: var(--vl-brand);
	}

	.vl-ajax .badge.bg-secondary-subtle,
	.vl-ajax .badge.bg-secondary {
		background: rgba(255, 255, 255, 0.08) !important;
		color: var(--vl-muted) !important;
		border-color: var(--vl-border) !important;
	}

	.vl-ajax .badge.text-bg-primary {
		background: rgba(var(--vl-brand-rgb), 0.14) !important;
		color: var(--vl-brand) !important;
	}

	.vl-ajax .img-thumbnail {
		background: var(--vl-bg);
		border-color: var(--vl-border);
	}

	.vl-ajax .media.vl-card {
		padding: 12px 14px;
		margin-left: 0;
		margin-right: 0;
	}

	.vl-ajax .vl-badge-papel,
	.vl-ajax .badge.vl-badge-papel {
		background: rgba(var(--vl-brand-rgb), 0.14) !important;
		color: var(--vl-brand) !important;
		border: none;
		font-size: 11px;
		font-weight: 700;
		padding: 4px 9px;
		border-radius: 999px;
	}

	.vl-ajax .list-group-item {
		background: var(--vl-surface);
		color: var(--vl-text);
		border-color: var(--vl-border);
	}

	.vl-ajax .card,
	.vl-ajax .vl-card {
		background: var(--vl-surface);
		border: 1px solid var(--vl-border);
		border-radius: 10px;
		color: var(--vl-text);
		box-shadow: none;
	}

	.vl-ajax h5 {
		font-family: var(--vl-font-title);
		font-weight: 700;
		color: var(--vl-text);
		font-size: 16px;
	}

	.vl-ajax .card-body {
		color: var(--vl-text);
	}

	.vl-ajax .card-text {
		color: var(--vl-text);
	}

	.vl-ajax-empty {
		color: var(--vl-muted-2);
		text-align: center;
		padding: 2.5rem 1rem;
	}

	.vl-ajax-empty .fw-semibold,
	.vl-ajax-empty .text-body {
		color: var(--vl-text) !important;
	}

	/* Kanban (hooks kanban-producao-* preservados) */
	.kanban-producao-wrap {
		background: var(--vl-bg);
		border: 1px solid var(--vl-border);
		border-radius: 10px;
	}

	.kanban-producao-col {
		background: var(--vl-surface);
		border: 1px solid var(--vl-border);
		border-radius: 10px;
	}

	.kanban-producao-col-head {
		background: transparent;
		border-bottom: 1px solid var(--vl-border);
		color: var(--vl-muted-2);
	}

	.kanban-producao-col-head .text-uppercase {
		color: var(--vl-muted-2);
		font-weight: 700;
		letter-spacing: 0.04em;
	}

	.kanban-producao-col .card {
		background: var(--vl-bg);
		border: 1px solid var(--vl-border);
		border-radius: 8px;
		box-shadow: none;
		color: var(--vl-text);
	}

	.kanban-card-titulo {
		color: var(--vl-text) !important;
	}

	.kanban-card-titulo:hover {
		color: var(--vl-brand) !important;
	}

	/* Modal de comentários da pauta */
	#modalComentariosPauta .modal-content {
		background: var(--vl-surface);
		border: 1px solid var(--vl-border);
		border-radius: 14px;
		color: var(--vl-text);
	}

	#modalComentariosPauta .modal-header,
	#modalComentariosPauta .modal-footer {
		border-color: var(--vl-border);
	}

	#modalComentariosPauta .modal-title {
		font-family: var(--vl-font-title);
		font-weight: 700;
		color: var(--vl-text);
	}

	#modalComentariosPauta .btn-close {
		filter: invert(1) grayscale(1);
		opacity: 0.65;
	}

	#modalComentariosPauta .form-label {
		color: var(--vl-muted);
		font-size: 13px;
	}

	#modalComentariosPauta #btn-comentarios {
		background: transparent;
		border: 1px solid rgba(255, 255, 255, 0.18);
		color: var(--vl-text);
		font-weight: 600;
		border-radius: var(--vl-radius);
	}

	#modalComentariosPauta #enviar-comentario {
		background: var(--vl-brand);
		border-color: var(--vl-brand);
		color: var(--vl-brand-text);
		font-weight: 700;
	}

	#modalComentariosPauta .btn-reset,
	#modalComentariosPauta .btn-secondary {
		background: transparent;
		border: 1px solid rgba(255, 255, 255, 0.18);
		color: var(--vl-text);
		font-weight: 600;
	}

	#modalComentariosPauta .form-control {
		background: var(--vl-bg);
		border: 1px solid var(--vl-border-strong);
		color: var(--vl-text);
		border-radius: var(--vl-radius);
	}

	#modalComentariosPauta .form-control:focus {
		border-color: var(--vl-brand);
		box-shadow: 0 0 0 0.2rem rgba(var(--vl-brand-rgb), 0.25);
		background: var(--vl-bg);
		color: var(--vl-text);
	}

	#modalComentariosPauta .vl-card,
	#modalComentariosPauta .div-list-comentarios {
		background: var(--vl-bg);
		border: 1px solid var(--vl-border);
		color: var(--vl-text);
	}

	/* Paginação (hooks .pagination / .page-link / .next_page) */
	.pagination .page-link {
		background: transparent;
		border: 1px solid rgba(255, 255, 255, 0.18);
		color: var(--vl-text);
		font-weight: 600;
		font-family: var(--vl-font-body);
		border-radius: var(--vl-radius);
		padding: 7px 12px;
	}

	.pagination .page-link:hover,
	.pagination .page-link:focus {
		background: rgba(var(--vl-brand-rgb), 0.14);
		border-color: var(--vl-brand);
		color: var(--vl-brand);
		box-shadow: none;
	}

	.pagination .page-item + .page-item {
		margin-left: 0.35rem;
	}
</style>
