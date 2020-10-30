<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class User implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    helper('auth');
    if (isEmpresaOrCoop() == 'empresa')
      return redirect()->to('empresas');
    elseif (isEmpresaOrCoop() == 'coop')
      return redirect()->to('cooperativas');
    elseif (isEmpresaOrCoop() == 'dados')
      return redirect()->to('/sign-up/dados');
  }

  //--------------------------------------------------------------------

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
  }
}
