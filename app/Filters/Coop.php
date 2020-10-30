<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Coop implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    helper('auth');
    if (isEmpresaOrCoop() != 'coop') {
      return redirect()->to('/login');
    }
  }

  //--------------------------------------------------------------------

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
  }
}
