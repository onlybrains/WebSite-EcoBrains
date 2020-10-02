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

	public function signUp()
	{
		return view('sign-up/index');
	}

	public function viewEmpresas()
	{
		return view('view-empresas/index');
	}

	public function abrirTopico()
	{
		return view('abrir-topico/index');
	}

	public function editarTopico(){
		return view('editar-topico/index.php');
	}

	public function pesquisa()
	{
		return view('pesquisa/index.php');
	}

	public function viewTopico()
	{
		return view('view-topico/index.php');
	}

	public function premium()
	{
		return view ('premium/index.php');
	}
}
