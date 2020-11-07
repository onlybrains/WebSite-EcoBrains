const consultaCEP = async (cep) => {
  cep = cep.replace('-', '');

  if (cep && cep.length === 8) {
    const URL = `http://viacep.com.br/ws/${cep}/json`;
    const response = await axios.request(URL);
    let { logradouro, bairro, localidade, uf } = response.data;

    if (
      logradouro == undefined ||
      bairro == undefined ||
      localidade == undefined ||
      uf == undefined
    ) {
      return 'CEP Inválido';
    } else {
      return `${logradouro}, ${bairro} - ${localidade}/${uf}`;
    }
  } else {
    return 'CEP Inválido';
  }
};
