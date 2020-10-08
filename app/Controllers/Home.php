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
		return view('home/pevs/index');
	}

	public function planos()
	{
		return view('home/planos/index');
	}	

}
