<?php

namespace App\Controllers;

use App\Models\CoopModel;
use CodeIgniter\Email\Email;
use CodeIgniter\HTTP\RequestInterface;

class CoopController extends BaseController
{
	public function cooperativas()
	{
		$modelCooperativas = new \App\Models\CoopModel();
		$Cooperativa = $modelCooperativas
			->select('id_coop, nomeFantasia_dados, razaoSoc_dados')
			->join('tb_dados', 'tb_dados.id_dados = tb_cooperativas.id_dados')
			->where('id_login', session()->get('id_login'))->first();

		$topicoModel = new \App\Models\topicoModel();
		$topicosParticipantes = $topicoModel
			->join('tb_interessetopico', 'tb_interessetopico.id_topico = tb_topico.id_topico')
			->join('tb_residuosTopico', 'tb_residuosTopico.id_topico = tb_topico.id_topico')
			->join('tb_tpResiduos', 'tb_tpResiduos.id_tpResiduo = tb_residuosTopico.id_tpResiduo')
			->where('dataLimite_topico >= CURRENT_DATE() AND id_coop =' . $Cooperativa->id_coop)
			->findAll();

		$data['titulo'] = 'Pesquisar Tópicos';
		$data['nome'] = $Cooperativa->razaoSoc_dados;
		$data['topicos'] = $topicosParticipantes;

		return view('cooperativas/index', $data);
	}

	public function pesquisartopicos()
	{
		$modelCooperativas = new \App\Models\CoopModel();
		$Cooperativa = $modelCooperativas
			->select('id_coop, nomeFantasia_dados, razaoSoc_dados')
			->join('tb_dados', 'tb_dados.id_dados = tb_cooperativas.id_dados')
			->where('id_login', session()->get('id_login'))->first();

		$data['titulo'] = 'Pesquisar Empresas';
		$data['nome'] = $Cooperativa->razaoSoc_dados;

		$topicoModel = new \App\Models\TopicoModel();
		$registros = $topicoModel
			->join('tb_empresas', 'tb_empresas.id_empresa = tb_topico.id_empresa')
			->join('tb_dados', 'tb_dados.id_dados = tb_empresas.id_dados')
			->join('tb_residuosTopico', 'tb_residuosTopico.id_topico = tb_topico.id_topico')
			->join('tb_tpResiduos', 'tb_tpResiduos.id_tpResiduo = tb_residuosTopico.id_tpResiduo')
			->where('dataLimite_topico >= CURRENT_DATE()')
			->findAll();


		$coopController = new \App\Models\TipoResiduoModel();
		$registrosTipos = $coopController->findAll();

		$data['topicos'] = $registros;
		$data['tipos'] = $registrosTipos;

		//var_dump($registrosTipos);
		return view('cooperativas/pesquisartopicos/index', $data);
	}

	// ARRUMAR //
	public function interesseTopico($id_topico, $id_coop = 1)
	{
		$modelCooperativas = new \App\Models\CoopModel();
		$Cooperativa = $modelCooperativas
			->select('id_coop')
			->where('id_login', session()->get('id_login'))->first();

		/* INTERESSE MOSTRADO — Falta apenas colocar para a inserir o valor da cooperativa que está logada */
		$coopController = new \App\Models\InteresseTopicoModel();
		$validacao = $coopController
			->where("id_topico = '{$id_topico}' AND id_coop = '{$Cooperativa->id_coop}'")
			->first();

		if (!$validacao) {
			$coopController
				->set('aprov_interesseTopico', '1')
				->set('id_topico', $id_topico)
				->set('id_coop', $Cooperativa->id_coop)
				->insert();

			/* QUERY PARA ENVIAR PARA A EMPRESA QUE ALGUÉM DEMONSTROU INTERESSE */

			$topicoEmail = new \App\Models\TopicoModel();
			$registros = $topicoEmail
				->select('email_login, nomeFantasia_dados, titulo_topico')
				->join('tb_empresas', 'tb_empresas.id_empresa = tb_topico.id_empresa')
				->join('tb_dados', 'tb_dados.id_dados = tb_empresas.id_dados')
				->join('tb_login', 'tb_login.id_login = tb_empresas.id_login')
				->where('id_topico = ' . $id_topico)
				->findAll();

			$email = \Config\Services::email();

			foreach ($registros as $registro) :

				$email->setFrom('ecobrains@ecobrains.com', "EcoBrains — {$registro->titulo_topico}");

				$email->setTo($registro->email_login);
			endforeach;

			$email->setSubject("♻️ Uma cooperativa está interessada no seu tópico: {$registro->titulo_topico}  ♻️");
			$email->setMessage("
		<!doctype html>
		<html ⚡4email>
		
		<head>
			<meta charset='utf-8'>
			<style amp4email-boilerplate>
				body {
					visibility: hidden
				}
			</style>
			<script async src='https://cdn.ampproject.org/v0.js'></script>
		
			<style amp-custom>
				a[x-apple-data-detectors] {
					color: inherit;
					text-decoration: none;
					font-size: inherit;
					font-family: inherit;
					font-weight: inherit;
					line-height: inherit;
				}
		
				.es-desk-hidden {
					display: none;
					float: left;
					overflow: hidden;
					width: 0;
					max-height: 0;
					line-height: 0;
				}
		
				s {
					text-decoration: line-through;
				}
		
				body {
					width: 100%;
					font-family: arial, 'helvetica neue', helvetica, sans-serif;
				}
		
				table {
					border-collapse: collapse;
					border-spacing: 0px;
				}
		
				table td,
				html,
				body,
				.es-wrapper {
					padding: 0;
					Margin: 0;
				}
		
				.es-content,
				.es-header,
				.es-footer {
					table-layout: fixed;
					width: 100%;
				}
		
				p,
				hr {
					Margin: 0;
				}
		
				h1,
				h2,
				h3,
				h4,
				h5 {
					Margin: 0;
					line-height: 120%;
					font-family: arial, 'helvetica neue', helvetica, sans-serif;
				}
		
				.es-left {
					float: left;
				}
		
				.es-right {
					float: right;
				}
		
				.es-p5 {
					padding: 5px;
				}
		
				.es-p5t {
					padding-top: 5px;
				}
		
				.es-p5b {
					padding-bottom: 5px;
				}
		
				.es-p5l {
					padding-left: 5px;
				}
		
				.es-p5r {
					padding-right: 5px;
				}
		
				.es-p10 {
					padding: 10px;
				}
		
				.es-p10t {
					padding-top: 10px;
				}
		
				.es-p10b {
					padding-bottom: 10px;
				}
		
				.es-p10l {
					padding-left: 10px;
				}
		
				.es-p10r {
					padding-right: 10px;
				}
		
				.es-p15 {
					padding: 15px;
				}
		
				.es-p15t {
					padding-top: 15px;
				}
		
				.es-p15b {
					padding-bottom: 15px;
				}
		
				.es-p15l {
					padding-left: 15px;
				}
		
				.es-p15r {
					padding-right: 15px;
				}
		
				.es-p20 {
					padding: 20px;
				}
		
				.es-p20t {
					padding-top: 20px;
				}
		
				.es-p20b {
					padding-bottom: 20px;
				}
		
				.es-p20l {
					padding-left: 20px;
				}
		
				.es-p20r {
					padding-right: 20px;
				}
		
				.es-p25 {
					padding: 25px;
				}
		
				.es-p25t {
					padding-top: 25px;
				}
		
				.es-p25b {
					padding-bottom: 25px;
				}
		
				.es-p25l {
					padding-left: 25px;
				}
		
				.es-p25r {
					padding-right: 25px;
				}
		
				.es-p30 {
					padding: 30px;
				}
		
				.es-p30t {
					padding-top: 30px;
				}
		
				.es-p30b {
					padding-bottom: 30px;
				}
		
				.es-p30l {
					padding-left: 30px;
				}
		
				.es-p30r {
					padding-right: 30px;
				}
		
				.es-p35 {
					padding: 35px;
				}
		
				.es-p35t {
					padding-top: 35px;
				}
		
				.es-p35b {
					padding-bottom: 35px;
				}
		
				.es-p35l {
					padding-left: 35px;
				}
		
				.es-p35r {
					padding-right: 35px;
				}
		
				.es-p40 {
					padding: 40px;
				}
		
				.es-p40t {
					padding-top: 40px;
				}
		
				.es-p40b {
					padding-bottom: 40px;
				}
		
				.es-p40l {
					padding-left: 40px;
				}
		
				.es-p40r {
					padding-right: 40px;
				}
		
				.es-menu td {
					border: 0;
				}
		
				a {
					font-family: arial, 'helvetica neue', helvetica, sans-serif;
					font-size: 14px;
					text-decoration: none;
				}
		
				h1 {
					font-size: 30px;
					font-style: normal;
					font-weight: normal;
					color: #333333;
				}
		
				h1 a {
					font-size: 30px;
				}
		
				h2 {
					font-size: 24px;
					font-style: normal;
					font-weight: normal;
					color: #333333;
				}
		
				h2 a {
					font-size: 24px;
				}
		
				h3 {
					font-size: 20px;
					font-style: normal;
					font-weight: normal;
					color: #333333;
				}
		
				h3 a {
					font-size: 20px;
					text-align: center;
				}
		
				p,
				ul li,
				ol li {
					font-size: 14px;
					font-family: arial, 'helvetica neue', helvetica, sans-serif;
					line-height: 150%;
				}
		
				ul li,
				ol li {
					Margin-bottom: 15px;
				}
		
				.es-menu td a {
					text-decoration: none;
					display: block;
				}
		
				.es-menu amp-img,
				.es-button amp-img {
					vertical-align: middle;
				}
		
				.es-wrapper {
					width: 100%;
					height: 100%;
				}
		
				.es-wrapper-color {
					background-color: #EFEFEF;
				}
		
				.es-content-body {
					background-color: #FFFFFF;
				}
		
				.es-content-body p,
				.es-content-body ul li,
				.es-content-body ol li {
					color: #333333;
				}
		
				.es-content-body a {
					color: #3E8EB8;
				}
		
				.es-header {
					background-color: transparent;
				}
		
				.es-header-body {
					background-color: #E6EBEF;
				}
		
				.es-header-body p,
				.es-header-body ul li,
				.es-header-body ol li {
					color: #333333;
					font-size: 14px;
				}
		
				.es-header-body a {
					color: #677D9E;
					font-size: 14px;
				}
		
				.es-footer {
					background-color: transparent;
				}
		
				.es-footer-body {
					background-color: #E6EBEF;
				}
		
				.es-footer-body p,
				.es-footer-body ul li,
				.es-footer-body ol li {
					color: #999999;
					font-size: 13px;
				}
		
				.es-footer-body a {
					color: #999999;
					font-size: 13px;
				}
		
				.es-infoblock,
				.es-infoblock p,
				.es-infoblock ul li,
				.es-infoblock ol li {
					line-height: 120%;
					font-size: 12px;
					color: #CCCCCC;
				}
		
				.es-infoblock a {
					font-size: 12px;
					color: #CCCCCC;
				}
		
				a.es-button {
					border-style: solid;
					border-color: #8598B2;
					border-width: 10px 20px 10px 20px;
					display: inline-block;
					background: #8598B2;
					border-radius: 0px;
					font-size: 16px;
					font-family: arial, 'helvetica neue', helvetica, sans-serif;
					font-weight: normal;
					font-style: normal;
					line-height: 120%;
					color: #FFFFFF;
					text-decoration: none;
					width: auto;
					text-align: center;
				}
		
				.es-button-border {
					border-style: solid solid solid solid;
					border-color: transparent transparent transparent transparent;
					background: #2CB543;
					border-width: 0px 0px 0px 0px;
					display: inline-block;
					border-radius: 0px;
					width: auto;
				}
		
				.es-p-default {
					padding-top: 20px;
					padding-right: 30px;
					padding-bottom: 0px;
					padding-left: 30px;
				}
		
				.es-p-all-default {
					padding: 0px;
				}
		
				@media only screen and (max-width:600px) {
		
					p,
					ul li,
					ol li,
					a {
						font-size: 16px;
						line-height: 150%
					}
		
					h1 {
						font-size: 30px;
						text-align: left;
						line-height: 120%
					}
		
					h2 {
						font-size: 26px;
						text-align: left;
						line-height: 120%
					}
		
					h3 {
						font-size: 20px;
						text-align: left;
						line-height: 120%
					}
		
					h1 a {
						font-size: 30px;
						text-align: left
					}
		
					h2 a {
						font-size: 26px;
						text-align: left
					}
		
					h3 a {
						font-size: 20px;
						text-align: left
					}
		
					.es-menu td a {
						font-size: 14px
					}
		
					.es-header-body p,
					.es-header-body ul li,
					.es-header-body ol li,
					.es-header-body a {
						font-size: 14px
					}
		
					.es-footer-body p,
					.es-footer-body ul li,
					.es-footer-body ol li,
					.es-footer-body a {
						font-size: 14px
					}
		
					.es-infoblock p,
					.es-infoblock ul li,
					.es-infoblock ol li,
					.es-infoblock a {
						font-size: 12px
					}
		
					*[class='gmail-fix'] {
						display: none
					}
		
					.es-m-txt-c,
					.es-m-txt-c h1,
					.es-m-txt-c h2,
					.es-m-txt-c h3 {
						text-align: center
					}
		
					.es-m-txt-r,
					.es-m-txt-r h1,
					.es-m-txt-r h2,
					.es-m-txt-r h3 {
						text-align: right
					}
		
					.es-m-txt-l,
					.es-m-txt-l h1,
					.es-m-txt-l h2,
					.es-m-txt-l h3 {
						text-align: left
					}
		
					.es-m-txt-r amp-img {
						float: right
					}
		
					.es-m-txt-c amp-img {
						margin: 0 auto
					}
		
					.es-m-txt-l amp-img {
						float: left
					}
		
					.es-button-border {
						display: block
					}
		
					a.es-button {
						font-size: 20px;
						display: block;
						border-left-width: 0px;
						border-right-width: 0px
					}
		
					.es-btn-fw {
						border-width: 10px 0px;
						text-align: center
					}
		
					.es-adaptive table,
					.es-btn-fw,
					.es-btn-fw-brdr,
					.es-left,
					.es-right {
						width: 100%
					}
		
					.es-content table,
					.es-header table,
					.es-footer table,
					.es-content,
					.es-footer,
					.es-header {
						width: 100%;
						max-width: 600px
					}
		
					.es-adapt-td {
						display: block;
						width: 100%
					}
		
					.adapt-img {
						width: 100%;
						height: auto
					}
		
					td.es-m-p0 {
						padding: 0px
					}
		
					td.es-m-p0r {
						padding-right: 0px
					}
		
					td.es-m-p0l {
						padding-left: 0px
					}
		
					td.es-m-p0t {
						padding-top: 0px
					}
		
					td.es-m-p0b {
						padding-bottom: 0
					}
		
					td.es-m-p20b {
						padding-bottom: 20px
					}
		
					.es-mobile-hidden,
					.es-hidden {
						display: none
					}
		
					tr.es-desk-hidden,
					td.es-desk-hidden,
					table.es-desk-hidden {
						width: auto;
						overflow: visible;
						float: none;
						max-height: inherit;
						line-height: inherit
					}
		
					tr.es-desk-hidden {
						display: table-row
					}
		
					table.es-desk-hidden {
						display: table
					}
		
					td.es-desk-menu-hidden {
						display: table-cell
					}
		
					.es-menu td {
						width: 1%
					}
		
					table.es-table-not-adapt,
					.esd-block-html table {
						width: auto
					}
		
					table.es-social {
						display: inline-block
					}
		
					table.es-social td {
						display: inline-block
					}
				}
			</style>
		</head>
		
		<body>
			<div class='es-wrapper-color'>
				<table class='es-wrapper' width='100%' cellspacing='0' cellpadding='0'>
					<tr>
						<td valign='top'>
							<table cellpadding='0' cellspacing='0' class='es-content' align='center'>
								<tr>
									<td class='es-adaptive' align='center'>
										<table class='es-content-body' style='background-color: transparent' width='600' cellspacing='0'
											cellpadding='0' align='center'>
											<tr>
												<td class='es-p10' align='left'>
													<table class='es-left' cellspacing='0' cellpadding='0' align='left'>
														<tr>
															<td width='280' align='left'>
																<table width='100%' cellspacing='0' cellpadding='0' role='presentation'>
																	<tr>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
													<table class='es-right' cellspacing='0' cellpadding='0' align='right'>
														<tr>
															<td width='280' align='left'>
																<table width='100%' cellspacing='0' cellpadding='0' role='presentation'>
																	<tr>
																		<td align='right' class='es-infoblock es-m-txt-c'>
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							<table cellpadding='0' cellspacing='0' class='es-header' align='center'>
								<tr>
									<td align='center'>
										<table class='es-header-body' width='600' cellspacing='0' cellpadding='0' align='center'>
											<tr>
												<td class='es-p20' align='left' bgcolor='#07401b' style='background-color: #07401b'>
													<table width='100%' cellspacing='0' cellpadding='0'>
														<tr>
															<td width='560' valign='top' align='center'>
																<table width='100%' cellspacing='0' cellpadding='0' role='presentation'>
																	<tr>
																		<td align='center' style='font-size: 0px'>
																			<amp-img
																				src='https://nehyya.stripocdn.email/content/guids/caa78e3b-6acb-420b-8460-50c0d6415cbb/images/67901603994033864.png'
																				alt='Financial logo' title='Financial logo' width='134' style='display: block'
																				height='33'></amp-img>
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							<table class='es-content' cellspacing='0' cellpadding='0' align='center'>
								<tr>
									<td align='center'>
										<table class='es-content-body' width='600' cellspacing='0' cellpadding='0' bgcolor='#ffffff'
											align='center'>
											<tr>
												<td class='es-p40t es-p40b es-p30r es-p30l' align='left'>
													<table width='100%' cellspacing='0' cellpadding='0'>
														<tr>
															<td width='540' valign='top' align='center'>
																<table width='100%' cellspacing='0' cellpadding='0' role='presentation'>
																	<tr>
																		<td align='left'>
																			<h3 style='color: #07401b'>Olá<strong> {$registro->nomeFantasia_dados}</strong>,</h3>
																		</td>
																	</tr>
																	<tr>
																		<td class='es-p15t'>
																			<p style='color: #07401b;text-align: justify'>O seu tópico de negociação '{$registro->titulo_topico}' foi marcado como um tópico de interesse por uma cooperativa.&nbsp;Seu
																				e-mail, telefone e Whatsapp foram enviados para o e-mail dela.&nbsp;<br>Esperamos
																				que tudo dê certo e que tenham um negócio próspero afinal mentes ecológicas mudam o
																				mundo e é isso que precisamos.<br>Obrigado pelo seu tempo,&nbsp;EcoBrains — Um novo
																				jeito de ser ecológico usando apenas a mente!<br></p>
																		</td>
																	</tr>
																	<tr>
																		<td class='es-p15t' align='left'>
																			<p style='color: #999999'>Meus cumprimentos,</p>
																			<p style='color: #999999'>Luigi de Oliveira.</p>
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							<table class='es-content' cellspacing='0' cellpadding='0' align='center'>
								<tr>
									<td align='center'>
										<table class='es-content-body' style='background-color: transparent' width='600' cellspacing='0'
											cellpadding='0' align='center'>
											<tr>
												<td class='es-p30t es-p30b es-p20r es-p20l' align='left'>
													<table width='100%' cellspacing='0' cellpadding='0'>
														<tr>
															<td width='560' valign='top' align='center'>
																<table width='100%' cellspacing='0' cellpadding='0' role='presentation'>
																	<tr>
																		<td class='es-infoblock made_with' align='center' style='font-size: 0px'><a
																				target='_blank'
																				href=''>
																				<amp-img
																					src='tpsht://nehyya.stripocdn.email/content/guids/caa78e3b-6acb-420b-8460-50c0d6415cbb/images/11321603994286640.png'
																					alt width='125' style='display: block' height='120'></amp-img>
																				<amp-img
																					src='https://nehyya.stripocdn.email/content/guids/caa78e3b-6acb-420b-8460-50c0d6415cbb/images/98881603994045723.png'
																					alt='Financial logo' title='Financial logo' width='134' style='display: block'
																					height='33'></amp-img>
																			</a></td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
		</body>
		
		</html>
		");

			$email->send();
		}

		//var_dump($registros);

		return redirect()->to(base_url('cooperativas'));
	}

	// ARRUMAR A ROTA NA VIEW
	public function pesquisafiltro()
	{
		$tipoResiduo = $this->request->getPost("tpResiduoFiltro");
		$dataLimite = $this->request->getPost("dataLimiteFiltro");
		$pesoResiduo = $this->request->getPost("pesoFiltro");

		$modelCooperativas = new \App\Models\CoopModel();
		$Cooperativa = $modelCooperativas
			->select('id_coop, nomeFantasia_dados, razaoSoc_dados')
			->join('tb_dados', 'tb_dados.id_dados = tb_cooperativas.id_dados')
			->where('id_login', session()->get('id_login'))->first();

		$data['titulo'] = 'Pesquisar Empresas';
		$data['nome'] = $Cooperativa->razaoSoc_dados;

		$coopController = new \App\Models\TopicoModel();
		$registros = $coopController
			->join('tb_empresas', 'tb_empresas.id_empresa = tb_topico.id_empresa')
			->join('tb_dados', 'tb_dados.id_dados = tb_empresas.id_dados')
			->join('tb_residuosTopico', 'tb_residuosTopico.id_topico = tb_topico.id_topico')
			->join('tb_tpResiduos', 'tb_tpResiduos.id_tpResiduo = tb_residuosTopico.id_tpResiduo')
			->where("dataLimite_topico >= CURRENT_DATE() AND dataLimite_topico <='{$dataLimite}' AND nome_tpResiduo ='{$tipoResiduo}' AND quant_residuo <= '{$pesoResiduo}'")
			//" AND nome_tpResiduo = 'Madeira' AND quant_residuo <= '450'")
			->findAll();

		$coopController = new \App\Models\TipoResiduoModel();
		$registrosTipos = $coopController->findAll();

		$data['topicos'] = $registros;
		$data['tipos'] = $registrosTipos;

		//echo "<pre>";
		//var_dump($dataLimite, $pesoResiduo, $tipoResiduo);
		return view('cooperativas/pesquisartopicos/index', $data);
	}

	public function pesquisarempresas()
	{
		$modelCooperativas = new \App\Models\CoopModel();
		$Cooperativa = $modelCooperativas
			->select('id_coop, nomeFantasia_dados, razaoSoc_dados')
			->join('tb_dados', 'tb_dados.id_dados = tb_cooperativas.id_dados')
			->where('id_login', session()->get('id_login'))->first();

		$data['titulo'] = 'Pesquisar Tópicos';
		$data['nome'] = $Cooperativa->razaoSoc_dados;

		$coopController = new \App\Models\EmpresaModel();
		$registros = $coopController
			->join('tb_dados', 'tb_dados.id_dados = tb_empresas.id_dados')
			->find();

		$data['empresas'] = $registros;

		$TipoResiduoModel = new \App\Models\TipoResiduoModel();
		$registrosTipos = $TipoResiduoModel->findAll();

		$data['tipos'] = $registrosTipos;

		return view('cooperativas/pesquisarempresas/index', $data);
	}

	public function solicitarContato($id_empresa)
	{
		$modelCooperativas = new \App\Models\CoopModel();
		$Cooperativa = $modelCooperativas
			->select('id_coop')
			->where('id_login', session()->get('id_login'))->first();

		$coopEmail = $modelCooperativas
			->select('nomeFantasia_dados, email_login')
			->join('tb_dados', 'tb_dados.id_dados = tb_cooperativas.id_dados')
			->join('tb_login', 'tb_login.id_login = tb_cooperativas.id_login')
			->where('id_coop =' . $Cooperativa->id_coop)
			->findAll();


		$empresaDados = new \App\Models\EmpresaModel();
		$registros = $empresaDados
			->join('tb_dados', 'tb_dados.id_dados = tb_empresas.id_dados')
			->join('tb_login', 'tb_login.id_login = tb_empresas.id_login')
			->where('id_empresa = ' . $id_empresa)
			->findAll();

		$email = \Config\Services::email();

		foreach ($registros as $registro) :

			$email->setFrom('ecobrains@ecobrains.com', "EcoBrains — {$registro->nomeFantasia_dados}");

		endforeach;

		foreach ($coopEmail as $emailCoop) :

			$email->setTo($emailCoop->email_login);

		endforeach;

		foreach ($registros as $registro) :

			$email->setSubject("♻️ Aqui estão as informações de contato da empresa: {$registro->nomeFantasia_dados}  ♻️");
			$email->setMessage("
		<!doctype html>
		<html ⚡4email>
		
		<head>
			<meta charset='utf-8'>
			<style amp4email-boilerplate>
				body {
					visibility: hidden
				}
			</style>
			<script async src='https://cdn.ampproject.org/v0.js'></script>
		
			<style amp-custom>
				a[x-apple-data-detectors] {
					color: inherit;
					text-decoration: none;
					font-size: inherit;
					font-family: inherit;
					font-weight: inherit;
					line-height: inherit;
				}
		
				.es-desk-hidden {
					display: none;
					float: left;
					overflow: hidden;
					width: 0;
					max-height: 0;
					line-height: 0;
				}
		
				s {
					text-decoration: line-through;
				}
		
				body {
					width: 100%;
					font-family: arial, 'helvetica neue', helvetica, sans-serif;
				}
		
				table {
					border-collapse: collapse;
					border-spacing: 0px;
				}
		
				table td,
				html,
				body,
				.es-wrapper {
					padding: 0;
					Margin: 0;
				}
		
				.es-content,
				.es-header,
				.es-footer {
					table-layout: fixed;
					width: 100%;
				}
		
				p,
				hr {
					Margin: 0;
				}
		
				h1,
				h2,
				h3,
				h4,
				h5 {
					Margin: 0;
					line-height: 120%;
					font-family: arial, 'helvetica neue', helvetica, sans-serif;
				}
		
				.es-left {
					float: left;
				}
		
				.es-right {
					float: right;
				}
		
				.es-p5 {
					padding: 5px;
				}
		
				.es-p5t {
					padding-top: 5px;
				}
		
				.es-p5b {
					padding-bottom: 5px;
				}
		
				.es-p5l {
					padding-left: 5px;
				}
		
				.es-p5r {
					padding-right: 5px;
				}
		
				.es-p10 {
					padding: 10px;
				}
		
				.es-p10t {
					padding-top: 10px;
				}
		
				.es-p10b {
					padding-bottom: 10px;
				}
		
				.es-p10l {
					padding-left: 10px;
				}
		
				.es-p10r {
					padding-right: 10px;
				}
		
				.es-p15 {
					padding: 15px;
				}
		
				.es-p15t {
					padding-top: 15px;
				}
		
				.es-p15b {
					padding-bottom: 15px;
				}
		
				.es-p15l {
					padding-left: 15px;
				}
		
				.es-p15r {
					padding-right: 15px;
				}
		
				.es-p20 {
					padding: 20px;
				}
		
				.es-p20t {
					padding-top: 20px;
				}
		
				.es-p20b {
					padding-bottom: 20px;
				}
		
				.es-p20l {
					padding-left: 20px;
				}
		
				.es-p20r {
					padding-right: 20px;
				}
		
				.es-p25 {
					padding: 25px;
				}
		
				.es-p25t {
					padding-top: 25px;
				}
		
				.es-p25b {
					padding-bottom: 25px;
				}
		
				.es-p25l {
					padding-left: 25px;
				}
		
				.es-p25r {
					padding-right: 25px;
				}
		
				.es-p30 {
					padding: 30px;
				}
		
				.es-p30t {
					padding-top: 30px;
				}
		
				.es-p30b {
					padding-bottom: 30px;
				}
		
				.es-p30l {
					padding-left: 30px;
				}
		
				.es-p30r {
					padding-right: 30px;
				}
		
				.es-p35 {
					padding: 35px;
				}
		
				.es-p35t {
					padding-top: 35px;
				}
		
				.es-p35b {
					padding-bottom: 35px;
				}
		
				.es-p35l {
					padding-left: 35px;
				}
		
				.es-p35r {
					padding-right: 35px;
				}
		
				.es-p40 {
					padding: 40px;
				}
		
				.es-p40t {
					padding-top: 40px;
				}
		
				.es-p40b {
					padding-bottom: 40px;
				}
		
				.es-p40l {
					padding-left: 40px;
				}
		
				.es-p40r {
					padding-right: 40px;
				}
		
				.es-menu td {
					border: 0;
				}
		
				a {
					font-family: arial, 'helvetica neue', helvetica, sans-serif;
					font-size: 14px;
					text-decoration: none;
				}
		
				h1 {
					font-size: 30px;
					font-style: normal;
					font-weight: normal;
					color: #333333;
				}
		
				h1 a {
					font-size: 30px;
				}
		
				h2 {
					font-size: 24px;
					font-style: normal;
					font-weight: normal;
					color: #333333;
				}
		
				h2 a {
					font-size: 24px;
				}
		
				h3 {
					font-size: 20px;
					font-style: normal;
					font-weight: normal;
					color: #333333;
				}
		
				h3 a {
					font-size: 20px;
					text-align: center;
				}
		
				p,
				ul li,
				ol li {
					font-size: 14px;
					font-family: arial, 'helvetica neue', helvetica, sans-serif;
					line-height: 150%;
				}
		
				ul li,
				ol li {
					Margin-bottom: 15px;
				}
		
				.es-menu td a {
					text-decoration: none;
					display: block;
				}
		
				.es-menu amp-img,
				.es-button amp-img {
					vertical-align: middle;
				}
		
				.es-wrapper {
					width: 100%;
					height: 100%;
				}
		
				.es-wrapper-color {
					background-color: #EFEFEF;
				}
		
				.es-content-body {
					background-color: #FFFFFF;
				}
		
				.es-content-body p,
				.es-content-body ul li,
				.es-content-body ol li {
					color: #333333;
				}
		
				.es-content-body a {
					color: #3E8EB8;
				}
		
				.es-header {
					background-color: transparent;
				}
		
				.es-header-body {
					background-color: #E6EBEF;
				}
		
				.es-header-body p,
				.es-header-body ul li,
				.es-header-body ol li {
					color: #333333;
					font-size: 14px;
				}
		
				.es-header-body a {
					color: #677D9E;
					font-size: 14px;
				}
		
				.es-footer {
					background-color: transparent;
				}
		
				.es-footer-body {
					background-color: #E6EBEF;
				}
		
				.es-footer-body p,
				.es-footer-body ul li,
				.es-footer-body ol li {
					color: #999999;
					font-size: 13px;
				}
		
				.es-footer-body a {
					color: #999999;
					font-size: 13px;
				}
		
				.es-infoblock,
				.es-infoblock p,
				.es-infoblock ul li,
				.es-infoblock ol li {
					line-height: 120%;
					font-size: 12px;
					color: #CCCCCC;
				}
		
				.es-infoblock a {
					font-size: 12px;
					color: #CCCCCC;
				}
		
				a.es-button {
					border-style: solid;
					border-color: #8598B2;
					border-width: 10px 20px 10px 20px;
					display: inline-block;
					background: #8598B2;
					border-radius: 0px;
					font-size: 16px;
					font-family: arial, 'helvetica neue', helvetica, sans-serif;
					font-weight: normal;
					font-style: normal;
					line-height: 120%;
					color: #FFFFFF;
					text-decoration: none;
					width: auto;
					text-align: center;
				}
		
				.es-button-border {
					border-style: solid solid solid solid;
					border-color: transparent transparent transparent transparent;
					background: #2CB543;
					border-width: 0px 0px 0px 0px;
					display: inline-block;
					border-radius: 0px;
					width: auto;
				}
		
				.es-p-default {
					padding-top: 20px;
					padding-right: 30px;
					padding-bottom: 0px;
					padding-left: 30px;
				}
		
				.es-p-all-default {
					padding: 0px;
				}
		
				@media only screen and (max-width:600px) {
		
					p,
					ul li,
					ol li,
					a {
						font-size: 16px;
						line-height: 150%
					}
		
					h1 {
						font-size: 30px;
						text-align: left;
						line-height: 120%
					}
		
					h2 {
						font-size: 26px;
						text-align: left;
						line-height: 120%
					}
		
					h3 {
						font-size: 20px;
						text-align: left;
						line-height: 120%
					}
		
					h1 a {
						font-size: 30px;
						text-align: left
					}
		
					h2 a {
						font-size: 26px;
						text-align: left
					}
		
					h3 a {
						font-size: 20px;
						text-align: left
					}
		
					.es-menu td a {
						font-size: 14px
					}
		
					.es-header-body p,
					.es-header-body ul li,
					.es-header-body ol li,
					.es-header-body a {
						font-size: 14px
					}
		
					.es-footer-body p,
					.es-footer-body ul li,
					.es-footer-body ol li,
					.es-footer-body a {
						font-size: 14px
					}
		
					.es-infoblock p,
					.es-infoblock ul li,
					.es-infoblock ol li,
					.es-infoblock a {
						font-size: 12px
					}
		
					*[class='gmail-fix'] {
						display: none
					}
		
					.es-m-txt-c,
					.es-m-txt-c h1,
					.es-m-txt-c h2,
					.es-m-txt-c h3 {
						text-align: center
					}
		
					.es-m-txt-r,
					.es-m-txt-r h1,
					.es-m-txt-r h2,
					.es-m-txt-r h3 {
						text-align: right
					}
		
					.es-m-txt-l,
					.es-m-txt-l h1,
					.es-m-txt-l h2,
					.es-m-txt-l h3 {
						text-align: left
					}
		
					.es-m-txt-r amp-img {
						float: right
					}
		
					.es-m-txt-c amp-img {
						margin: 0 auto
					}
		
					.es-m-txt-l amp-img {
						float: left
					}
		
					.es-button-border {
						display: block
					}
		
					a.es-button {
						font-size: 20px;
						display: block;
						border-left-width: 0px;
						border-right-width: 0px
					}
		
					.es-btn-fw {
						border-width: 10px 0px;
						text-align: center
					}
		
					.es-adaptive table,
					.es-btn-fw,
					.es-btn-fw-brdr,
					.es-left,
					.es-right {
						width: 100%
					}
		
					.es-content table,
					.es-header table,
					.es-footer table,
					.es-content,
					.es-footer,
					.es-header {
						width: 100%;
						max-width: 600px
					}
		
					.es-adapt-td {
						display: block;
						width: 100%
					}
		
					.adapt-img {
						width: 100%;
						height: auto
					}
		
					td.es-m-p0 {
						padding: 0px
					}
		
					td.es-m-p0r {
						padding-right: 0px
					}
		
					td.es-m-p0l {
						padding-left: 0px
					}
		
					td.es-m-p0t {
						padding-top: 0px
					}
		
					td.es-m-p0b {
						padding-bottom: 0
					}
		
					td.es-m-p20b {
						padding-bottom: 20px
					}
		
					.es-mobile-hidden,
					.es-hidden {
						display: none
					}
		
					tr.es-desk-hidden,
					td.es-desk-hidden,
					table.es-desk-hidden {
						width: auto;
						overflow: visible;
						float: none;
						max-height: inherit;
						line-height: inherit
					}
		
					tr.es-desk-hidden {
						display: table-row
					}
		
					table.es-desk-hidden {
						display: table
					}
		
					td.es-desk-menu-hidden {
						display: table-cell
					}
		
					.es-menu td {
						width: 1%
					}
		
					table.es-table-not-adapt,
					.esd-block-html table {
						width: auto
					}
		
					table.es-social {
						display: inline-block
					}
		
					table.es-social td {
						display: inline-block
					}
				}
			</style>
		</head>
		
		<body>
			<div class='es-wrapper-color'>
				<table class='es-wrapper' width='100%' cellspacing='0' cellpadding='0'>
					<tr>
						<td valign='top'>
							<table cellpadding='0' cellspacing='0' class='es-content' align='center'>
								<tr>
									<td class='es-adaptive' align='center'>
										<table class='es-content-body' style='background-color: transparent' width='600' cellspacing='0'
											cellpadding='0' align='center'>
											<tr>
												<td class='es-p10' align='left'>
													<table class='es-left' cellspacing='0' cellpadding='0' align='left'>
														<tr>
															<td width='280' align='left'>
																<table width='100%' cellspacing='0' cellpadding='0' role='presentation'>
																	<tr>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
													<table class='es-right' cellspacing='0' cellpadding='0' align='right'>
														<tr>
															<td width='280' align='left'>
																<table width='100%' cellspacing='0' cellpadding='0' role='presentation'>
																	<tr>
																		<td align='right' class='es-infoblock es-m-txt-c'>
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							<table cellpadding='0' cellspacing='0' class='es-header' align='center'>
								<tr>
									<td align='center'>
										<table class='es-header-body' width='600' cellspacing='0' cellpadding='0' align='center'>
											<tr>
												<td class='es-p20' align='left' bgcolor='#07401b' style='background-color: #07401b'>
													<table width='100%' cellspacing='0' cellpadding='0'>
														<tr>
															<td width='560' valign='top' align='center'>
																<table width='100%' cellspacing='0' cellpadding='0' role='presentation'>
																	<tr>
																		<td align='center' style='font-size: 0px'>
																			<amp-img
																				src='https://nehyya.stripocdn.email/content/guids/caa78e3b-6acb-420b-8460-50c0d6415cbb/images/67901603994033864.png'
																				alt='Financial logo' title='Financial logo' width='134' style='display: block'
																				height='33'></amp-img>
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							<table class='es-content' cellspacing='0' cellpadding='0' align='center'>
								<tr>
									<td align='center'>
										<table class='es-content-body' width='600' cellspacing='0' cellpadding='0' bgcolor='#ffffff'
											align='center'>
											<tr>
												<td class='es-p40t es-p40b es-p30r es-p30l' align='left'>
													<table width='100%' cellspacing='0' cellpadding='0'>
														<tr>
															<td width='540' valign='top' align='center'>
																<table width='100%' cellspacing='0' cellpadding='0' role='presentation'>
																	<tr>
																		<td align='left'>
																			<h3 style='color: #07401b'>Olá<strong> {$emailCoop->nomeFantasia_dados}</strong>,</h3>
																		</td>
																	</tr>
																	<tr>
																		<td class='es-p15t'>
																			<p style='color: #07401b;text-align: justify'>Você demonstrou interesse por uma empresa registrada em nossa plataforma e portanto enviamos a você os meios de contato da empresa <strong>{$registro->nomeFantasia_dados}</strong>.<br/>
																			<strong>CNPJ: </strong>" . substr($registro->cnpj_dados, 0, 2) . '.' . substr($registro->cnpj_dados, 2, 3) . '.' . substr($registro->cnpj_dados, 5, 3) . '/' . substr($registro->cnpj_dados, 8, 4) . '-' . substr($registro->cnpj_dados, -2) . "<br/>
																			<strong>CEP: </strong>  <a target='_blank' href='https://www.google.com/maps/dir//{$registro->cep_dados}'>Clique aqui e veja a localização da empresa</a><br/>
																			<strong>Telefone: </strong>" . substr($registro->tel_dados, 0, 2) . ') ' . substr($registro->tel_dados, 2, 4) . '-' . substr($registro->tel_dados, 6) . "<br/>
																			<strong>Whatsapp: </strong>" . '(' . substr($registro->whatsapp_dados, 0, 2) . ') ' . substr($registro->whatsapp_dados, 2, 1) . ' ' . substr($registro->whatsapp_dados, 3, 4) . '-' . substr($registro->whatsapp_dados, 7) . "<br/>
																			<strong>Email: </strong> {$registro->email_login}
																			<br>Esperamos
																				que tudo dê certo e que tenham um negócio próspero afinal mentes ecológicas mudam o
																				mundo e é isso que precisamos.<br>Obrigado pelo seu tempo,&nbsp;EcoBrains — Um novo
																				jeito de ser ecológico usando apenas a mente!<br></p>
																		</td>
																	</tr>
																	<tr>
																		<td class='es-p15t' align='left'>
																			<p style='color: #999999'>Meus cumprimentos,</p>
																			<p style='color: #999999'>Luigi de Oliveira.</p>
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							<table class='es-content' cellspacing='0' cellpadding='0' align='center'>
								<tr>
									<td align='center'>
										<table class='es-content-body' style='background-color: transparent' width='600' cellspacing='0'
											cellpadding='0' align='center'>
											<tr>
												<td class='es-p30t es-p30b es-p20r es-p20l' align='left'>
													<table width='100%' cellspacing='0' cellpadding='0'>
														<tr>
															<td width='560' valign='top' align='center'>
																<table width='100%' cellspacing='0' cellpadding='0' role='presentation'>
																	<tr>
																		<td class='es-infoblock made_with' align='center' style='font-size: 0px'><a
																				target='_blank'
																				href=''>
																				<amp-img
																					src='tpsht://nehyya.stripocdn.email/content/guids/caa78e3b-6acb-420b-8460-50c0d6415cbb/images/11321603994286640.png'
																					alt width='125' style='display: block' height='120'></amp-img>
																				<amp-img
																					src='https://nehyya.stripocdn.email/content/guids/caa78e3b-6acb-420b-8460-50c0d6415cbb/images/98881603994045723.png'
																					alt='Financial logo' title='Financial logo' width='134' style='display: block'
																					height='33'></amp-img>
																			</a></td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
		</body>
		
		</html>
		");
		endforeach;

		$email->send();

		return redirect()->to(base_url('cooperativas'));
	}
}
