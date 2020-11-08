<?php

namespace App\Controllers;

use App\Models\EmpresaModel;
use App\Models\InteresseTopicoModel;
use App\Models\CoopModel;
use CodeIgniter\Email\Email;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\Response;

class EmpresaController extends BaseController
{
	public function empresas()
	{
		helper('auth');
		$topicoModel = new \App\Models\TopicoModel();

		$Empresa = getBasicUserInfo();

		$registros = $topicoModel
			->join('tb_empresas', 'tb_empresas.id_empresa = tb_topico.id_empresa')
			->join('tb_residuosTopico', 'tb_residuosTopico.id_topico = tb_topico.id_topico')
			->join('tb_tpResiduos', 'tb_tpResiduos.id_tpResiduo = tb_residuosTopico.id_tpResiduo')
			->where("dataLimite_topico >= CURRENT_DATE() AND tb_topico.id_empresa = '{$Empresa->id_empresa}'")
			->orderBy('dataLimite_topico')
			->findAll();

		$data['titulo'] = 'Pesquisar Cooperativas';
		$data['nome'] = $Empresa->razaoSoc_dados;
		$data['topicos'] = $registros;

		return view('empresas/index', $data);
	}

	public function viewCoop($id_coop)
	{
		//função para pegar info basica de login
		helper('auth');
		$empresa = getBasicUserInfo();

		$model = new CoopModel();
		$coop =  $model
			->join('tb_dados', 'tb_dados.id_dados = tb_cooperativas.id_dados')
			->join('tb_desc', 'tb_desc.id_desc = tb_cooperativas.id_desc')
			->where('id_coop', $id_coop)->first();

		$data['titulo'] = 'Pesquisar Cooperativas';
		$data['nome'] = $empresa->razaoSoc_dados;
		$data['user'] = $coop;


		return view('perfil/view-perfil/index', $data);
	}

	public function abrirTopico()
	{
		helper('auth');
		$tipoResiduosModel = new \App\Models\TipoResiduoModel();

		$Empresa = getBasicUserInfo();

		$data['titulo'] = 'Pesquisar Cooperativas';
		$data['nome'] = $Empresa->razaoSoc_dados;

		$residuos = $tipoResiduosModel->find();
		$data['tpResiduos'] = $residuos;

		if ($this->request->getMethod() === 'post') {
			$residuosTopicoModel = new \App\Models\ResiduosTopicoModel();
			$topicoModel = new \App\Models\TopicoModel();
			$modelEmpresa = new \App\Models\EmpresaModel();

			$Empresa = $modelEmpresa->where('id_login', session()->get('id_login'))->first();

			$topicoModel->set('titulo_topico', $this->request->getPost('titulo_topico'));
			$topicoModel->set('dataLimite_topico', $this->request->getPost('dataLimite_topico'));
			$topicoModel->set('id_empresa', $Empresa->id_empresa);

			$residuosTopicoModel->set('quant_residuo', $this->request->getPost('quant_residuo'));
			$residuosTopicoModel->set('id_tpResiduo', $this->request->getPost('id_tpResiduo'));

			if ($topicoModel->insert()) {
				$residuosTopicoModel->set('id_topico', $topicoModel->getInsertID());
				if ($residuosTopicoModel->insert()) {
					return redirect()->to('/empresas');
				} else {
					$data['errors'] = $residuosTopicoModel->errors();
					$topicoModel->delete($topicoModel->getInsertID());
				}
			} else {
				$data['errors'] = $topicoModel->errors();
			}
		}
		return view('empresas/abrir-topico/index', $data);
	}


	public function editarTopico($id_topico)
	{
		helper('auth');
		$topicoModel = new \App\Models\TopicoModel();
		$residuosTopicoModel = new \App\Models\ResiduosTopicoModel();
		$tipoResiduosModel = new \App\Models\TipoResiduoModel();

		$Empresa = getBasicUserInfo();

		$topicos = $topicoModel
			->join('tb_residuosTopico', 'tb_residuosTopico.id_topico = tb_topico.id_topico')
			->join('tb_tpResiduos', 'tb_tpResiduos.id_tpResiduo = tb_residuosTopico.id_tpResiduo')
			->where('tb_topico.id_topico', $id_topico)->first();

		$residuos = $tipoResiduosModel->find();

		$data['titulo'] = 'Pesquisar Cooperativas';
		$data['nome'] = $Empresa->razaoSoc_dados;
		$data['tpResiduos'] = $residuos;
		$data['topicos'] = $topicos;


		if ($this->request->getMethod() === 'post') {

			$topicoModel->set('titulo_topico', $this->request->getPost('titulo_topico'));
			$topicoModel->set('dataLimite_topico', $this->request->getPost('dataLimite_topico'));

			$residuosTopicoModel->set('quant_residuo', $this->request->getPost('quant_residuo'));
			$residuosTopicoModel->set('id_tpResiduo', $this->request->getPost('id_tpResiduo'));

			if ($topicoModel->update($id_topico)) {

				if ($residuosTopicoModel->update($topicos->id_residuo)) {
					return redirect()->to('/empresas');
				} else {
					$data['errors'] = $residuosTopicoModel->errors();
				}
			} else {
				$data['errors'] = $topicoModel->errors();
			}
		}
		return view('empresas/editar-topico/index', $data);
	}

	public function deletarTopico($id_topico)
	{
		$residuosTopicoModel = new \App\Models\ResiduosTopicoModel();
		$residuosTopicoModel
			->where('id_topico', $id_topico)
			->delete();

		$interesseTopicoModel = new \App\Models\InteresseTopicoModel();
		$interesseTopicoModel
			->where('id_topico', $id_topico)
			->delete();

		$topicoModel = new \App\Models\TopicoModel();
		$topicoModel
			->where('id_topico', $id_topico)
			->delete();

		return redirect()->to(base_url('empresas'));
	}

	public function viewTopico($id_topico)
	{
		helper('auth');
		$topicoModel = new \App\Models\TopicoModel();

		$Empresa = getBasicUserInfo();

		$topicosDadosEmpresa = $topicoModel
			->join('tb_residuosTopico', 'tb_residuosTopico.id_topico = tb_topico.id_topico')
			->join('tb_tpResiduos', 'tb_tpResiduos.id_tpResiduo = tb_residuosTopico.id_tpResiduo')
			->where('tb_topico.id_topico', $id_topico)->first();

		$registrosInteresseCooperativa = $topicoModel
			->join('tb_interesseTopico', 'tb_interesseTopico.id_topico = tb_topico.id_topico')
			->join('tb_residuosTopico', 'tb_residuosTopico.id_topico = tb_topico.id_topico')
			->join('tb_tpResiduos', 'tb_tpResiduos.id_tpResiduo = tb_residuosTopico.id_tpResiduo')
			->join('tb_cooperativas', 'tb_cooperativas.id_coop = tb_interesseTopico.id_coop')
			->join('tb_dados', 'tb_dados.id_dados = tb_cooperativas.id_dados')
			->where("tb_topico.id_topico= '{$id_topico}' AND aprov_interesseTopico = 0 ")
			->findAll();

		// echo '<pre>';
		// var_dump($registrosInteresseCooperativa);


		$data['titulo'] = 'Pesquisar Cooperativas';
		$data['nome'] = $Empresa->razaoSoc_dados;
		$data['registroEmpresa'] = $topicosDadosEmpresa;
		$data['registrosInteresseCooperativa'] = $registrosInteresseCooperativa;

		return view('empresas/view-topico/index', $data);
	}

	public function negarCooperativa($id_topico, $id_coop)
	{
		// UPDATE tb_interessetopico
		// SET aprov_interesseTopico = 2
		// WHERE id_topico = 1 AND id_coop = 2;


		$interesseModel = new \App\Models\InteresseTopicoModel();

		$interesseModel
			->where("id_topico = '{$id_topico}' AND id_coop = '{$id_coop}' ")
			->set(['aprov_interesseTopico' => 2])
			->update();

		return "<script>javascript:history.back()</script>";
	}

	public function aprovarCooperativa($id_topico, $id_coop)
	{
		// UPDATE tb_interessetopico
		// SET aprov_interesseTopico = 0
		// WHERE id_topico = 1 AND id_coop = 2;


		$interesseModel = new \App\Models\InteresseTopicoModel();

		$interesseModel
			->where("id_topico = '{$id_topico}' AND id_coop = '{$id_coop}' ")
			->set(['aprov_interesseTopico' => 1])
			->update();

		/* QUERY QUE ENVIA PARA A COOPERATIVA INTERESSADA OS DADOS DA EMPRESA */
		$cooperativasModel = new \App\Models\CoopModel();
		$dadosModel = new \App\Models\DadosModel();

		$registrosEmailCoop = $cooperativasModel
			->select('email_login')
			->join('tb_login', 'tb_login.id_login = tb_cooperativas.id_login')
			->where('id_coop = ' . $id_coop)
			->findAll();

		$registrosCooperativas = $dadosModel
			->select('titulo_topico, nomeFantasia_dados, tel_dados, whatsapp_dados, email_login, cep_dados, cnpj_dados')
			->join('tb_empresas', 'tb_empresas.id_dados = tb_dados.id_dados')
			->join('tb_login', 'tb_login.id_login = tb_empresas.id_login')
			->join('tb_topico', 'tb_topico.id_empresa = tb_empresas.id_empresa')
			->where('id_topico = ' . $id_topico)
			->findAll();

		$email = \Config\Services::email();

		$config['SMTPHost'] = env('SMTP_HOST');
		$config['SMTPUser'] = env('SMTP_USER');
		$config['SMTPPass'] = env('SMTP_PASS');

		$email->initialize($config);

		foreach ($registrosCooperativas as $registroCooperativas) :

			$email->setFrom('ecobrains@ecobrains.com', "EcoBrains — {$registroCooperativas->titulo_topico}");
		endforeach;

		foreach ($registrosEmailCoop as $registroEmailCooperativa) :

			$email->setTo($registroEmailCooperativa->email_login);

		endforeach;

		foreach ($registrosCooperativas as $registroCooperativas) :
			$email->setSubject("♻️ Informações da empresa responsável pelo: {$registroCooperativas->titulo_topico}  ♻️");
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
																			<h3 style='color: #07401b'><strong> Olá!</strong></h3>
																		</td>
																	</tr>
																	<tr>
																		<td class='es-p15t'>
																			<p style='color: #07401b;text-align: justify'>Seu interesse pelo tópico de negociação <strong>'{$registroCooperativas->titulo_topico}'</strong> foi <strong style='color: #07401b;'>aceito</strong>!&nbsp;Seguem as informações da empresa responsável pelo tópico.<br/><br/>
																			<strong>Nome: </strong>{$registroCooperativas->nomeFantasia_dados}<br/>
																			<strong>Telefone: </strong>{$registroCooperativas->tel_dados}<br/>
																			<strong>Whatsapp: </strong>{$registroCooperativas->whatsapp_dados}<br/>
																			<strong>Email: </strong>{$registroCooperativas->email_login}<br/>
																			<strong>CEP: </strong> <a target='_blank' href='https://www.google.com/maps/dir//{$registroCooperativas->cep_dados}'>Clique aqui e veja a localização da empresa</a><br/>
																			<strong>CNPJ: </strong>{$registroCooperativas->cnpj_dados}<br/>
																			<br>Obrigado pelo seu tempo,&nbsp;EcoBrains — Um novo
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

		return "<script>javascript:history.back()</script>";
	}

	public function pesquisaCooperativas()
	{
		helper(['auth', 'maps']);
		$modelCooperativas = new \App\Models\CoopModel();

		$empresa = getBasicUserInfo();

		$data['titulo'] = 'Pesquisar Cooperativas';
		$data['nome'] = $empresa->razaoSoc_dados;

		$registros = $modelCooperativas
			->join('tb_dados', 'tb_dados.id_dados = tb_cooperativas.id_dados')
			->join('tb_desc', 'tb_desc.id_desc = tb_cooperativas.id_desc')
			->find();

		$data['cooperativas'] = $registros;

		$TipoResiduoModel = new \App\Models\TipoResiduoModel();
		$registrosTipos = $TipoResiduoModel->findAll();

		foreach ($registros as $registro) {
			$registro->distancematrix = verifyDistance($empresa->cep_dados, $registro->cep_dados);
		}

		$data['cooperativas'] = $registros;
		$data['tipos'] = $registrosTipos;

		return view('empresas/pesquisarcoop/index', $data);
	}

	public function solicitarContato($id_coop)
	{
		helper('auth');
		$empresa = getBasicUserInfo();
		$modelEmpresa = new \App\Models\EmpresaModel();

		$empresaEmail = $modelEmpresa
			->select('nomeFantasia_dados, email_login')
			->join('tb_dados', 'tb_dados.id_dados = tb_empresas.id_dados')
			->join('tb_login', 'tb_login.id_login = tb_empresas.id_login')
			->where('id_empresa =' . $empresa->id_empresa)
			->findAll();


		$coopDados = new \App\Models\CoopModel();
		$registros = $coopDados
			->join('tb_dados', 'tb_dados.id_dados = tb_cooperativas.id_dados')
			->join('tb_login', 'tb_login.id_login = tb_cooperativas.id_login')
			->where('id_coop = ' . $id_coop)
			->findAll();

		$email = \Config\Services::email();

		$config['SMTPHost'] = env('SMTP_HOST');
		$config['SMTPUser'] = env('SMTP_USER');
		$config['SMTPPass'] = env('SMTP_PASS');

		$email->initialize($config);

		foreach ($registros as $registro) :

			$email->setFrom('ecobrains@ecobrains.com', "EcoBrains — {$registro->nomeFantasia_dados}");

		endforeach;

		foreach ($empresaEmail as $emailEmpresa) :

			$email->setTo($emailEmpresa->email_login);

		endforeach;

		foreach ($registros as $registro) :

			$email->setSubject("♻️ Aqui estão as informações de contato da Cooperativa: {$registro->nomeFantasia_dados}  ♻️");
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
																			<h3 style='color: #07401b'>Olá<strong> {$emailEmpresa->nomeFantasia_dados}</strong>,</h3>
																		</td>
																	</tr>
																	<tr>
																		<td class='es-p15t'>
																			<p style='color: #07401b;text-align: justify'>Você demonstrou interesse por uma cooperativa registrada em nossa plataforma e portanto enviamos a você os meios de contato da cooperativa <strong>{$registro->nomeFantasia_dados}</strong>.<br/>
																			<strong>CNPJ: </strong>" . substr($registro->cnpj_dados, 0, 2) . '.' . substr($registro->cnpj_dados, 2, 3) . '.' . substr($registro->cnpj_dados, 5, 3) . '/' . substr($registro->cnpj_dados, 8, 4) . '-' . substr($registro->cnpj_dados, -2) . "<br/>
																			<strong>CEP: </strong>  <a target='_blank' href='https://www.google.com/maps/dir//{$registro->cep_dados}'>Clique aqui e veja a localização da cooperativa</a><br/>
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
																			<p style='color: #999999'>Matheus Franciscone.</p>
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

		return redirect()->to(base_url('empresas'));
	}
}
