<?php

namespace App\Controllers;

use App\Models\DescModel;
use App\Models\DadosModel;

class PerfilController extends BaseController
{

  public function viewPerfil()
  {
    helper(['auth', 'validation']);
    $uri = new \CodeIgniter\HTTP\URI(current_url());
    $user = getBasicUserInfo();

    $data['user'] = $user;
    $data['titulo'] = $uri->getSegment(1) === 'cooperativas' ? 'Pesquisar Tópicos' : 'Pesquisar Cooperativas';
    $data['nome'] = $user->nomeFantasia_dados;
    return view('perfil/view-perfil/index', $data);
  }

  public function editarPerfil()
  {
    helper(['form', 'auth', 'validation']);
    $user = getBasicUserInfo();
    $uri = new \CodeIgniter\HTTP\URI(current_url());

    $dadosModel = new DadosModel();
    $descModel = new DescModel();


    if ($this->request->getMethod() == 'post') {

      // $dadosModel->set('cnpj_dados', onlyNumbers($this->request->getPost('inputCNPJ')));
      $dadosModel->set('nomeFantasia_dados', $this->request->getPost('inputFantasia'));
      $dadosModel->set('razaoSoc_dados', $this->request->getPost('inputRazao'));
      $dadosModel->set('cep_dados', onlyNumbers($this->request->getPost('inputCEP')));
      $dadosModel->set('numEnd_dados', $this->request->getPost('inputNumEnd'));
      $dadosModel->set('complemento_dados', $this->request->getPost('inputComplemento'));
      $dadosModel->set('inputEnd', $this->request->getPost('inputEnd'));
      $dadosModel->set('tel_dados', onlyNumbers($this->request->getPost('inputTel')));
      $dadosModel->set('whatsapp_dados', onlyNumbers($this->request->getPost('inputWhats')));

      $dataDesc = [
        'info_desc' => $this->request->getPost('inputTxtArea'),
        'logo_desc' => $this->request->getFile('inputLogo'),
        'banner_desc' => $this->request->getFile('inputBanner'),
        'tempoMercado_desc' => $this->request->getPost('inputTempMercado'),
        'site_desc' => $this->request->getPost('inputSite'),
      ];

      if ($this->request->getPost('inputTempMercado') === '')
        unset($dataDesc['tempoMercado_desc']);
      if ($this->request->getPost('inputSite') === '')
        unset($dataDesc['site_desc']);

      if ($dadosModel->update($user->id_dados))
        if ($descModel->update($user->id_desc, $dataDesc))
          return redirect()->to('/' . $uri->getSegment(1) . '/perfil');
        else
          $data['errors'] = $descModel->errors();
      else
        $data['errors'] = $dadosModel->errors();
    }

    $data['user'] = $user;
    $data['titulo'] = $uri->getSegment(1) === 'cooperativas' ? 'Pesquisar Tópicos' : 'Pesquisar Cooperativas';
    $data['nome'] = $user->nomeFantasia_dados;

    return view('perfil/editar-perfil/index', $data);
  }
}
