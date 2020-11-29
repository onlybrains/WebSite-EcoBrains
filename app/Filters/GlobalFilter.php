<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class GlobalFilter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    helper('auth');
    if (isEmpresaOrCoop() != 'dados')
      return redirect()->to('/sign-up');
  }

  //--------------------------------------------------------------------

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
  }
}
