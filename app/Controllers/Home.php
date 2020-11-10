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
		$data['registros'] = $coletaSeletivaController->find();

		return view('home/pevs/index', $data);
	}

	public function planos()
	{
		return view('home/planos/index');
	}
}
