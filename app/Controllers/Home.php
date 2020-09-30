<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return view('home/index');
	}

	public function sobre()
	{
		return view('sobre/index');
	}

	public function pevs()
	{
		return view('pevs/index');
	}

	public function planos()
	{
		return view('planos/index');
	}	
		
	public function empresas()
	{
		return view('empresas/index');
	}

	public function cooperativas()
	{
		return view('cooperativas/index');
	}	

	public function pesquisartopicos()
	{
		return view('pesquisartopicos/index');
	}	
}
