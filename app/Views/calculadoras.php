<?= $this->extend('layouts/_main'); ?>

<?= $this->section('content'); ?>

<style>
	.vl-site-calculadoras .vl-calc-tabs {
		display: flex;
		flex-wrap: wrap;
		gap: 8px 20px;
		border-bottom: 1px solid rgba(255, 255, 255, 0.08);
		margin: 0 0 24px;
		padding: 0;
		list-style: none;
	}
	.vl-site-calculadoras .vl-calc-tab {
		border: none;
		border-bottom: 2px solid transparent;
		background: transparent;
		color: var(--vl-muted-2);
		font-weight: 600;
		font-size: 14px;
		padding: 0 4px 10px;
		margin-bottom: -1px;
		cursor: pointer;
		font-family: var(--vl-font-body);
	}
	.vl-site-calculadoras .vl-calc-tab.active,
	.vl-site-calculadoras .vl-calc-tab[aria-selected="true"] {
		color: var(--vl-text);
		border-bottom-color: var(--vl-brand);
	}
	.vl-site-calculadoras .vl-calc-note {
		color: var(--vl-muted);
		font-size: 13px;
		line-height: 1.6;
		margin: 0 0 20px;
	}
	.vl-site-calculadoras .vl-calc-field {
		margin-bottom: 16px;
	}
	.vl-site-calculadoras .vl-calc-field label {
		display: block;
		font-size: 13px;
		color: var(--vl-muted);
		margin-bottom: 6px;
	}
	.vl-site-calculadoras .vl-calc-suffix {
		display: flex;
		align-items: center;
		gap: 8px;
	}
	.vl-site-calculadoras .vl-calc-suffix span {
		color: var(--vl-muted);
		font-size: 14px;
		flex: 0 0 auto;
	}
	.vl-site-calculadoras .vl-calc-results {
		margin-top: 8px;
	}
	.vl-site-calculadoras .vl-calc-result {
		display: flex;
		justify-content: space-between;
		align-items: center;
		gap: 16px;
		padding: 12px 0;
		border-bottom: 1px solid rgba(255, 255, 255, 0.08);
		font-size: 14px;
		color: var(--vl-muted);
	}
	.vl-site-calculadoras .vl-calc-result:last-child {
		border-bottom: none;
		color: var(--vl-text);
		font-weight: 600;
	}
	.vl-site-calculadoras .vl-calc-result [id] {
		color: var(--vl-brand);
		font-weight: 700;
		font-size: 13px;
		font-family: var(--vl-font-title);
		white-space: nowrap;
	}
</style>

<div class="vl-container vl-site-calculadoras" style="max-width: 900px; padding-top: 56px; padding-bottom: 64px;">
	<h1 style="font-family: var(--vl-font-title); font-size: 30px; font-weight: 700; margin: 0 0 8px;">Calculadoras</h1>
	<p style="color: var(--vl-muted); font-size: 15px; margin: 0 0 28px;">Ferramentas rápidas para colaboradores e leitores.</p>
	<div class="vl-card" style="border-radius: 12px; padding: 22px;">
		<h2 style="font-family: var(--vl-font-title); font-size: 16px; font-weight: 700; margin: 0 0 20px;">Acesse as calculadoras de descontos</h2>

		<ul class="vl-calc-tabs" id="myTab" role="tablist">
			<li role="presentation">
				<button class="vl-calc-tab active" id="calc1-tab" data-bs-toggle="tab" data-bs-target="#calc1" type="button"
					role="tab" aria-controls="calc1" aria-selected="true">Custo do funcionário para a empresa</button>
			</li>
			<li role="presentation">
				<button class="vl-calc-tab" id="calc2-tab" data-bs-toggle="tab" data-bs-target="#calc2" type="button"
					role="tab" aria-controls="calc2" aria-selected="false">Calcule seu salário líquido</button>
			</li>
			<li role="presentation">
				<button class="vl-calc-tab" id="calc3-tab" data-bs-toggle="tab" data-bs-target="#calc3" type="button"
					role="tab" aria-controls="calc3" aria-selected="false">Quanto um PJ ganharia se fosse CLT</button>
			</li>
		</ul>

		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade show active" id="calc1" role="tabpanel" aria-labelledby="calc1-tab">
				<form id="form-calc1">
					<p class="vl-calc-note">Por conta das divergências dos valores da contribuição sindical não
						posso incluí-la no cálculo, mas fique atento, ela custa de 1 dia de trabalho até 12% do seu
						salário</p>
					<div class="vl-calc-field">
						<label for="calc1_net-salary">Salário Líquido</label>
						<input type="number" class="form-control" id="calc1_net-salary" />
					</div>
					<div class="vl-calc-field">
						<label for="calc1_voucher-value">Vales sobre salário bruto</label>
						<div class="vl-calc-suffix">
							<input type="number" class="form-control" id="calc1_voucher-value" />
							<span>%</span>
						</div>
					</div>
				</form>
				<div class="vl-calc-results">
					<div class="vl-calc-result">Salário Bruto <span id="calc1_gross"></span></div>
					<div class="vl-calc-result">Desconto do FGTS <span id="calc1_fgts"></span></div>
					<div class="vl-calc-result">Desconto do INSS <span id="calc1_inss"></span></div>
					<div class="vl-calc-result">Desconto do IR <span id="calc1_ir"></span></div>
					<div class="vl-calc-result">Desconto do Voucher <span id="calc1_theVoucherValue"></span></div>
					<div class="vl-calc-result">Desconto do INSS Patronal <span id="calc1_inssPatronal"></span></div>
					<div class="vl-calc-result">Custo do seu décimo terceiro <span id="calc1_decimoTerceiro"></span></div>
					<div class="vl-calc-result">Custo das suas férias <span id="calc1_vacations"></span></div>
					<div class="vl-calc-result">O seu custo para o patrão é <span id="calc1_bossCost"></span></div>
				</div>
			</div>

			<div class="tab-pane fade" id="calc2" role="tabpanel" aria-labelledby="calc2-tab">
				<form id="form-calc2">
					<p class="vl-calc-note">Por conta das divergências dos valores da contribuição sindical não
						posso incluí-la no cálculo, mas fique atento, ela custa de 1 dia de trabalho até 12% do seu
						salário</p>
					<div class="vl-calc-field">
						<label for="calc2_gross-salary">Salário Bruto</label>
						<input type="number" class="form-control" id="calc2_gross-salary" />
					</div>
				</form>
				<div class="vl-calc-results">
					<div class="vl-calc-result">Salário Líquido <span id="calc2_net"></span></div>
					<div class="vl-calc-result">Desconto do FGTS <span id="calc2_fgts"></span></div>
					<div class="vl-calc-result">Desconto do INSS <span id="calc2_inss"></span></div>
					<div class="vl-calc-result">Desconto do IR <span id="calc2_ir"></span></div>
					<div class="vl-calc-result">Desconto do INSS Patronal <span id="calc2_inssPatronal"></span></div>
					<div class="vl-calc-result">Custo do seu décimo terceiro <span id="calc2_decimoTerceiro"></span></div>
					<div class="vl-calc-result">Custo das suas férias <span id="calc2_vacations"></span></div>
					<div class="vl-calc-result">O seu custo para o patrão é <span id="calc2_bossCost"></span></div>
				</div>
			</div>

			<div class="tab-pane fade" id="calc3" role="tabpanel" aria-labelledby="calc3-tab">
				<form id="form-calc3">
					<p class="vl-calc-note">Por conta das divergências dos valores da contribuição sindical não
						posso incluí-la no cálculo, mas fique atento, ela custa de 1 dia de trabalho até 12% do seu
						salário</p>
					<div class="vl-calc-field">
						<label for="calc3_boss-cost">Salário PJ</label>
						<input type="number" class="form-control" id="calc3_boss-cost" />
					</div>
				</form>
				<div class="vl-calc-results">
					<div class="vl-calc-result">Salário Líquido <span id="calc3_net"></span></div>
					<div class="vl-calc-result">Salário Bruto <span id="calc3_gross"></span></div>
					<div class="vl-calc-result">Desconto do FGTS <span id="calc3_fgts"></span></div>
					<div class="vl-calc-result">Desconto do INSS <span id="calc3_inss"></span></div>
					<div class="vl-calc-result">Desconto do IR <span id="calc3_ir"></span></div>
					<div class="vl-calc-result">Desconto do INSS Patronal <span id="calc3_inssPatronal"></span></div>
					<div class="vl-calc-result">Custo do seu décimo terceiro <span id="calc3_decimoTerceiro"></span></div>
					<div class="vl-calc-result">Custo das suas férias <span id="calc3_vacations"></span></div>
					<div class="vl-calc-result">O seu custo para o patrão <span id="calc3_bossCost"></span></div>
				</div>
			</div>
		</div>

		<div style="text-align: center; margin: 20px 0 0;"><small style="color: var(--vl-muted-2);">Calculadora feita por <a href="https://github.com/izaqueIsrael/clt-vs-pj" target="_blank" rel="noopener noreferrer">Isaac</a></small></div>
	</div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function () {
		const calc1_initialState = {
			calc1_voucherValue: 0,
			calc1_voucher: 0,
			calc1_grossSalary: null,
			calc1_netSalary: null,
			calc1_FGTS: null,
			calc1_INSS: null,
			calc1_IR: null,
			calc1_INSSPatronal: null,
			calc1_bossCost: null,
			calc1_thirteenSalary: 0,
			calc1_vacations: 0,
		};

		const calc1_getINSSDetails = (net) => {
			if (net <= 1221.00) return { INSSaliquot: 0.075, INSSDeduction: 0 };
			if (net <= 2341.10) return { INSSaliquot: 0.09, INSSDeduction: 19.80 };
			if (net <= 3029.23) return { INSSaliquot: 0.12, INSSDeduction: 96.94 };
			if (net <= 5091.49) return { INSSaliquot: 0.14, INSSDeduction: 174.08 };
			throw new Error("Salário bruto fora do intervalo válido");
		};

		const calc1_getIRDetails = (net) => {
			if (net <= 1941.72) return { IRaliquot: 0.0, IRDeduction: 0 };
			if (net <= 2548.96) return { IRaliquot: 0.075, IRDeduction: 158.40 };
			if (net <= 3258.59) return { IRaliquot: 0.15, IRDeduction: 370.40 };
			if (net <= 3895.65) return { IRaliquot: 0.225, IRDeduction: 651.73 };
			return { IRaliquot: 0.275, IRDeduction: 884.96 };
		};

		const calc1_voucherPercent = (voucherValueToConvert) => {
			if (typeof voucherValueToConvert === "number") {
				return voucherValueToConvert / 100;
			}
			return 0;
		};

		const calc1_calculateGrossSalary = () => {
			if (calc1_initialState.calc1_netSalary === null || typeof calc1_initialState.calc1_netSalary !== "number") return;
			const voucherAliquot = calc1_voucherPercent(calc1_initialState.calc1_voucherValue);
			const { IRaliquot, IRDeduction } = calc1_getIRDetails(calc1_initialState.calc1_netSalary);
			let calc1_INSS;
			let gross = 0;
			if (calc1_initialState.calc1_netSalary <= 5091.49) {
				const { INSSaliquot, INSSDeduction } = calc1_getINSSDetails(calc1_initialState.calc1_netSalary);
				gross =
					(calc1_initialState.calc1_netSalary - INSSDeduction + INSSDeduction * IRaliquot - IRDeduction) /
					(1 - 0.08 - INSSaliquot - IRaliquot + INSSaliquot * IRaliquot + voucherAliquot * IRaliquot - voucherAliquot);
				calc1_INSS = gross * INSSaliquot - INSSDeduction;
			}
			if (calc1_initialState.calc1_netSalary > 5091.49) {
				gross = (calc1_initialState.calc1_netSalary + 876.97 - 876.97 * IRaliquot - IRDeduction) /
					(1 - 0.08 - IRaliquot + voucherAliquot * IRaliquot - voucherAliquot);
				calc1_INSS = 876.97;
			}
			calc1_initialState.calc1_voucher = gross * voucherAliquot;
			calc1_initialState.calc1_INSS = calc1_INSS;
			calc1_initialState.calc1_grossSalary = gross;
			calc1_initialState.calc1_FGTS = gross * 0.08;
			calc1_initialState.calc1_IR = ((gross - (calc1_INSS || 0) - (gross * voucherAliquot)) * IRaliquot) - IRDeduction;
			calc1_initialState.calc1_INSSPatronal = gross * 0.2;
			calc1_initialState.calc1_thirteenSalary = gross / 11;
			calc1_initialState.calc1_vacations = gross / 11;
			calc1_initialState.calc1_bossCost = gross * 1.2 + (gross * 2) / 11;
		};

		const netSalaryInput = document.querySelector("#calc1_net-salary");
		const voucherValueInput = document.querySelector("#calc1_voucher-value");

		netSalaryInput.addEventListener("input", function (e) {
			calc1_initialState.calc1_netSalary = Number(e.target.value);
			calc1_calculateGrossSalary();
			calc1_updateUI();
		});

		voucherValueInput.addEventListener("input", function (e) {
			calc1_initialState.calc1_voucherValue = Number(e.target.value);
			calc1_calculateGrossSalary();
			calc1_updateUI();
		});

		const calc1_updateUI = () => {

			if (calc1_initialState.calc1_grossSalary !== null) {
				const grossSalaryValue = document.querySelector("#calc1_gross");
				const fgtsValue = document.querySelector("#calc1_fgts");
				const inssValue = document.querySelector("#calc1_inss");
				const IRValue = document.querySelector("#calc1_ir");
				const inssPatronalValue = document.querySelector("#calc1_inssPatronal");
				const decimoTerceiroValue = document.querySelector("#calc1_decimoTerceiro");
				const bossCostValue = document.querySelector("#calc1_bossCost");
				const vacationsValue = document.querySelector("#calc1_vacations");
				const theVoucherValue = document.querySelector("#calc1_theVoucherValue");

				grossSalaryValue.textContent = `R$ ${calc1_initialState.calc1_grossSalary.toFixed(2)}`;
				fgtsValue.textContent = `R$ ${calc1_initialState.calc1_FGTS.toFixed(2)}`;
				inssValue.textContent = `R$ ${calc1_initialState.calc1_INSS.toFixed(2)}`;
				IRValue.textContent = `R$ ${calc1_initialState.calc1_IR.toFixed(2)}`;
				inssPatronalValue.textContent = `R$ ${calc1_initialState.calc1_INSSPatronal.toFixed(2)}`;
				decimoTerceiroValue.textContent = `R$ ${calc1_initialState.calc1_thirteenSalary.toFixed(2)}`;
				vacationsValue.textContent = `R$ ${calc1_initialState.calc1_vacations.toFixed(2)}`;
				bossCostValue.textContent = `R$ ${calc1_initialState.calc1_bossCost.toFixed(2)}`;
				theVoucherValue.textContent = `R$ ${calc1_initialState.calc1_voucher.toFixed(2)}`;
			} else {
				grossSalaryValue.textContent = `0`;
				fgtsValue.textContent = `0`;
				inssValue.textContent = `0`;
				IRValue.textContent = `0`;
				inssPatronalValue.textContent = `0`;
				decimoTerceiroValue.textContent = `0`;
				vacationsValue.textContent = `0`;
				bossCostValue.textContent = `0`;
				theVoucherValue = `0`;
			}
		};
	});

	const calc2_initialState = {
		grossSalary: null,
		netSalary: null,
		FGTS: null,
		INSS: null,
		IR: null,
		INSSPatronal: null,
		bossCost: null,
	};

	const calc2_getINSSDetails = (gross) => {
		if (gross <= 1320.00) return { INSSaliquot: 0.075, INSSDeduction: 0 };
		if (gross <= 2571.29) return { INSSaliquot: 0.09, INSSDeduction: 19.80 };
		if (gross <= 3856.94) return { INSSaliquot: 0.12, INSSDeduction: 96.94 };
		if (gross <= 7507.49) return { INSSaliquot: 0.14, INSSDeduction: 174.08 };
		throw new Error("Salário bruto fora do intervalo válido");
	};

	const calc2_getIRDetails = (gross, INSSvalue) => {
		const base = gross - INSSvalue;
		if (base <= 2112.00) return { IRaliquot: 0.0, IRDeduction: 0 };
		if (base <= 2826.65) return { IRaliquot: 0.075, IRDeduction: 158.40 };
		if (base <= 3751.06) return { IRaliquot: 0.15, IRDeduction: 370.40 };
		if (base <= 4664.68) return { IRaliquot: 0.225, IRDeduction: 651.73 };
		return { IRaliquot: 0.275, IRDeduction: 884.96 };
	};

	const calc2_calculateNetSalary = () => {
		if (calc2_initialState.grossSalary === null || typeof calc2_initialState.grossSalary !== "number") return;

		let INSSvalue = 0;
		if (calc2_initialState.grossSalary > 7507.49) {
			const { INSSaliquot, INSSDeduction } = calc2_getINSSDetails(7507.49);
			INSSvalue = 7507.49 * INSSaliquot - INSSDeduction;
		} else {
			const { INSSaliquot, INSSDeduction } = calc2_getINSSDetails(calc2_initialState.grossSalary);
			INSSvalue = calc2_initialState.grossSalary * INSSaliquot - INSSDeduction;
		}

		const { IRaliquot, IRDeduction } = calc2_getIRDetails(calc2_initialState.grossSalary, INSSvalue);
		const IRvalue = (calc2_initialState.grossSalary - INSSvalue) * IRaliquot - IRDeduction;

		const FGTSvalue = calc2_initialState.grossSalary * 0.08;

		const netSalary = calc2_initialState.grossSalary - INSSvalue - IRvalue - FGTSvalue;
		calc2_initialState.netSalary = netSalary;
		calc2_initialState.FGTS = FGTSvalue;
		calc2_initialState.INSS = INSSvalue;
		calc2_initialState.IR = IRvalue;
		calc2_initialState.INSSPatronal = calc2_initialState.grossSalary * 0.2;
		calc2_initialState.bossCost = calc2_initialState.grossSalary * 1.2;

		calc2_updateUI();
	};

	const grossSalaryInput = document.querySelector("#calc2_gross-salary");

	grossSalaryInput.addEventListener("input", function (e) {
		calc2_initialState.grossSalary = Number(e.target.value);
	});

	const calc2_updateUI = () => {
		const calc2_netSalaryValue = document.querySelector("#calc2_net");
		const calc2_fgtsValue = document.querySelector("#calc2_fgts");
		const calc2_inssValue = document.querySelector("#calc2_inss");
		const calc2_IRValue = document.querySelector("#calc2_ir");
		const calc2_inssPatronalValue = document.querySelector("#calc2_inssPatronal");
		const calc2_bossCostValue = document.querySelector("#calc2_bossCost");
		const calc2_decimoTerceiroValue = document.querySelector("#calc2_decimoTerceiro");
		const calc2_vacationsValue = document.querySelector("#calc2_vacations");

		if (calc2_initialState.netSalary !== null) {
			calc2_netSalaryValue.textContent = `R$ ${calc2_initialState.netSalary.toFixed(2)}`;
			calc2_fgtsValue.textContent = `R$ ${calc2_initialState.FGTS.toFixed(2)}`;
			calc2_inssValue.textContent = `R$ ${calc2_initialState.INSS.toFixed(2)}`;
			calc2_IRValue.textContent = `R$ ${calc2_initialState.IR.toFixed(2)}`;
			calc2_inssPatronalValue.textContent = `R$ ${calc2_initialState.INSSPatronal.toFixed(2)}`;
			calc2_decimoTerceiroValue.textContent = `R$ ${Number(calc2_initialState.bossCost / 11).toFixed(2)}`;
			calc2_vacationsValue.textContent = `R$ ${Number(calc2_initialState.bossCost / 11).toFixed(2)}`;
			calc2_bossCostValue.textContent = `R$ ${Number(calc2_initialState.bossCost + calc2_initialState.bossCost * 2 / 11).toFixed(2)}`
		} else {
			calc2_netSalaryValue.textContent = `0`;
			calc2_fgtsValue.textContent = `0`;
			calc2_inssValue.textContent = `0`;
			calc2_IRValue.textContent = `0`;
			calc2_inssPatronalValue.textContent = `0`;
			calc2_decimoTerceiroValue.textContent = `0`;
			calc2_vacationsValue.textContent = `0`;
			calc2_bossCostValue.textContent = `0`;
		}
	};

	const form = document.getElementById("calc2_gross-salary");
	form.addEventListener("input", function (e) {
		calc2_calculateNetSalary();
	});

	const calc3_initialState = {
		grossSalary: null,
		netSalary: null,
		FGTS: null,
		INSS: null,
		IR: null,
		INSSPatronal: null,
		bossCost: null,
		thirteenSalary: 0,
		vacations: 0,
	};

	const calc3_getINSSDetails = (gross) => {
		if (gross <= 1320.00) return { INSSaliquot: 0.075, INSSDeduction: 0 };
		if (gross <= 2571.29) return { INSSaliquot: 0.09, INSSDeduction: 19.80 };
		if (gross <= 3856.94) return { INSSaliquot: 0.12, INSSDeduction: 96.94 };
		if (gross <= 7507.49) return { INSSaliquot: 0.14, INSSDeduction: 174.08 };
		throw new Error("Salário bruto fora do intervalo válido");
	};

	const calc3_getIRDetails = (gross, INSSvalue) => {
		const base = gross - INSSvalue;
		if (base <= 2112.00) return { IRaliquot: 0.0, IRDeduction: 0 };
		if (base <= 2826.65) return { IRaliquot: 0.075, IRDeduction: 158.40 };
		if (base <= 3751.06) return { IRaliquot: 0.15, IRDeduction: 370.40 };
		if (base <= 4664.68) return { IRaliquot: 0.225, IRDeduction: 651.73 };
		return { IRaliquot: 0.275, IRDeduction: 884.96 };
	};

	const calc3_calculateCLTsalary = () => {
		if (calc3_initialState.bossCost === null || typeof calc3_initialState.bossCost !== "number") return;

		let gross;
		gross = calc3_initialState.bossCost / (1 + 0.2 + 2 / 11);
		let INSSvalue = 0;

		if (gross > 7507.49) {
			const { INSSaliquot, INSSDeduction } = calc3_getINSSDetails(7507.49);
			INSSvalue = 7507.49 * INSSaliquot - INSSDeduction;
		} else {
			const { INSSaliquot, INSSDeduction } = calc3_getINSSDetails(gross);
			INSSvalue = gross * INSSaliquot - INSSDeduction;
		}

		const { IRaliquot, IRDeduction } = calc3_getIRDetails(gross, INSSvalue);
		const IRvalue = (gross - INSSvalue) * IRaliquot - IRDeduction;

		const FGTSvalue = gross * 0.08;

		const netSalary = gross - INSSvalue - IRvalue - FGTSvalue;
		calc3_initialState.netSalary = netSalary;
		calc3_initialState.FGTS = FGTSvalue;
		calc3_initialState.INSS = INSSvalue;
		calc3_initialState.IR = IRvalue;
		calc3_initialState.INSSPatronal = gross * 0.2;
		calc3_initialState.thirteenSalary = gross / 11;
		calc3_initialState.vacations = gross / 11;
		calc3_initialState.grossSalary = gross * 1.2;

		calc3_updateUI();
	};

	const calc3_bossCostInput = document.querySelector("#calc3_boss-cost");

	calc3_bossCostInput.addEventListener("input", function (e) {
		calc3_initialState.bossCost = Number(e.target.value);
	});

	const calc3_updateUI = () => {

		if (calc3_initialState.netSalary !== null) {
			const netSalaryValue = document.querySelector("#calc3_net");
			const grossSalaryValue = document.querySelector("#calc3_gross");
			const fgtsValue = document.querySelector("#calc3_fgts");
			const inssValue = document.querySelector("#calc3_inss");
			const IRValue = document.querySelector("#calc3_ir");
			const inssPatronalValue = document.querySelector("#calc3_inssPatronal");
			const decimoTerceiroValue = document.querySelector("#calc3_decimoTerceiro");
			const bossCostValue = document.querySelector("#calc3_bossCost");
			const vacationsValue = document.querySelector("#calc3_vacations");

			netSalaryValue.textContent = `R$ ${calc3_initialState.netSalary.toFixed(2)}`;
			grossSalaryValue.textContent = `R$ ${calc3_initialState.grossSalary.toFixed(2)}`;
			fgtsValue.textContent = `R$ ${calc3_initialState.FGTS.toFixed(2)}`;
			inssValue.textContent = `R$ ${calc3_initialState.INSS.toFixed(2)}`;
			IRValue.textContent = `R$ ${calc3_initialState.IR.toFixed(2)}`;
			inssPatronalValue.textContent = `R$ ${calc3_initialState.INSSPatronal.toFixed(2)}`;
			decimoTerceiroValue.textContent = `R$ ${calc3_initialState.thirteenSalary.toFixed(2)}`;
			vacationsValue.textContent = `R$ ${calc3_initialState.vacations.toFixed(2)}`;
			bossCostValue.textContent = `R$ ${calc3_initialState.bossCost.toFixed(2)}`

		} else {
			netSalaryValue.textContent = `0`;
			grossSalaryValue.textContent = `0`;
			fgtsValue.textContent = `0`;
			inssValue.textContent = `0`;
			IRValue.textContent = `0`;
			inssPatronalValue.textContent = `0`;
			decimoTerceiroValue.textContent = `0`;
			vacationsValue.textContent = `0`;
			bossCostValue.textContent = `0`;
		}
	};

	const calc3_form = document.querySelector("#calc3_boss-cost");
	calc3_form.addEventListener("input", function (e) {
		calc3_calculateCLTsalary();
	});
</script>
<?= $this->endSection(); ?>

