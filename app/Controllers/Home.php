<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return view('home/home/index');
	}

	public function sobre()
	{
		return view('home/sobre/index');
	}

	public function pevs()
	{
		$coletaSeletivaController = new \App\Models\ColetaSeletivaModel();
		$ColetaSeletiva1 = $coletaSeletivaController->where('id_coletaSeletiva = 1')->findAll();
		$ColetaSeletiva2 = $coletaSeletivaController->where('id_coletaSeletiva = 2')->findAll();
		$ColetaSeletiva3 = $coletaSeletivaController->where('id_coletaSeletiva = 3')->findAll();
		$ColetaSeletiva4 = $coletaSeletivaController->where('id_coletaSeletiva = 4')->findAll();
		$ColetaSeletiva5 = $coletaSeletivaController->where('id_coletaSeletiva = 5')->findAll();
		$ColetaSeletiva6 = $coletaSeletivaController->where('id_coletaSeletiva = 6')->findAll();
		$ColetaSeletiva7 = $coletaSeletivaController->where('id_coletaSeletiva = 7')->findAll();
		$ColetaSeletiva8 = $coletaSeletivaController->where('id_coletaSeletiva = 8')->findAll();
		$ColetaSeletiva9 = $coletaSeletivaController->where('id_coletaSeletiva = 9')->findAll();
		$ColetaSeletiva10 = $coletaSeletivaController->where('id_coletaSeletiva = 10')->findAll();
		$ColetaSeletiva11 = $coletaSeletivaController->where('id_coletaSeletiva = 11')->findAll();
		$ColetaSeletiva12 = $coletaSeletivaController->where('id_coletaSeletiva = 12')->findAll();
		$ColetaSeletiva13 = $coletaSeletivaController->where('id_coletaSeletiva = 13')->findAll();
		$ColetaSeletiva14 = $coletaSeletivaController->where('id_coletaSeletiva = 14')->findAll();

		$data['bairros1'] = $ColetaSeletiva1;
		$data['bairros2'] = $ColetaSeletiva2;
		$data['bairros3'] = $ColetaSeletiva3;
		$data['bairros4'] = $ColetaSeletiva4;
		$data['bairros5'] = $ColetaSeletiva5;
		$data['bairros6'] = $ColetaSeletiva6;
		$data['bairros7'] = $ColetaSeletiva7;
		$data['bairros8'] = $ColetaSeletiva8;
		$data['bairros9'] = $ColetaSeletiva9;
		$data['bairros10'] = $ColetaSeletiva10;
		$data['bairros11'] = $ColetaSeletiva11;
		$data['bairros12'] = $ColetaSeletiva12;
		$data['bairros13'] = $ColetaSeletiva13;
		$data['bairros14'] = $ColetaSeletiva14;

		return view('home/pevs/index', $data);
	}

	public function planos()
	{
		return view('home/planos/index');
	}
}
