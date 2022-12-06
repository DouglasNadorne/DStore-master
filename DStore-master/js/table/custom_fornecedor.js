$(document).ready(function () {
  $('#listar-fornecedor').DataTable({
    processing: true,
    serverSide: true,
    ajax: 'listar_fornecedor.php',
    language: {
      url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/pt-PT.json'
    }
  })
})

const formNewFornecedor = document.getElementById('form-cad-fornecedor')
const fecharModalCad = new bootstrap.Modal(
  document.getElementById('cadFornecedorModal')
)

if (formNewFornecedor) {
  formNewFornecedor.addEventListener('submit', async e => {
    e.preventDefault()
    const dadosForm = new FormData(formNewFornecedor)

    const dados = await fetch('cadastrar_fornecedor.php', {
      method: 'POST',
      body: dadosForm
    })
    const resposta = await dados.json()

    if (resposta['status']) {
      document.getElementById('msgAlertErroCad').innerHTML = ''
      document.getElementById('msgAlerta').innerHTML = resposta['msg']
      formNewFornecedor.reset()
      fecharModalCad.hide()
      listarDataTables = $('#listar-fornecedor').DataTable()
      listarDataTables.draw()
    } else {
      document.getElementById('msgAlertErroCad').innerHTML = resposta['msg']
    }
  })
}

async function visFornecedor(idFornecedor) {
  const dados = await fetch(
    'visualizar_fornecedor.php?idFornecedor=' + idFornecedor
  )
  const resposta = await dados.json()

  if (resposta['status']) {
    const visModal = new bootstrap.Modal(
      document.getElementById('visFornecedorModal')
    )
    visModal.show()

    document.getElementById('idFornecedor').innerHTML =
      resposta['dados'].idFornecedor

    document.getElementById('nomeFornecedor').innerHTML =
      resposta['dados'].nomeFornecedor

    document.getElementById('cnpj').innerHTML = resposta['dados'].cnpj

    document.getElementById('telefoneFornecedor').innerHTML =
      resposta['dados'].telefoneFornecedor

    document.getElementById('emailFornecedor').innerHTML =
      resposta['dados'].emailFornecedor

    document.getElementById('cepFornecedor').innerHTML = resposta['dados'].cep

    document.getElementById('estadoFornecedor').innerHTML =
      resposta['dados'].estado

    document.getElementById('cidadeFornecedor').innerHTML =
      resposta['dados'].cidade

    document.getElementById('msgAlerta').innerHTML = ''
  } else {
    document.getElementById('msgAlerta').innerHTML = resposta['msg']
  }
}

const editModal = new bootstrap.Modal(
  document.getElementById('editFornecedorModal')
)
async function editFornecedor(idFornecedor) {
  const dados = await fetch(
    'visualizar_fornecedor.php?idFornecedor=' + idFornecedor
  )
  const resposta = await dados.json()
  console.log(resposta)

  if (resposta['status']) {
    document.getElementById('msgAlertErroEdit').innerHTML = ''
    document.getElementById('msgAlerta').innerHTML = ''
    editModal.show()

    document.getElementById('editIdFornecedor').value =
      resposta['dados'].idFornecedor
    document.getElementById('editNomeFornecedor').value =
      resposta['dados'].nomeFornecedor
    document.getElementById('editCnpj').value = resposta['dados'].cnpj
    document.getElementById('editTelefoneFornecedor').value =
      resposta['dados'].telefoneFornecedor
    document.getElementById('editEmailFornecedor').value =
      resposta['dados'].emailFornecedor
    document.getElementById('editCep').value = resposta['dados'].cep
    document.getElementById('editEstado').value = resposta['dados'].estado
    document.getElementById('editCidade').value = resposta['dados'].cidade
  } else {
    document.getElementById('msgAlerta').innerHTML = resposta['msg']
  }
}

const formEditFornecedor = document.getElementById('form-edit-fornecedor')
if (formEditFornecedor) {
  formEditFornecedor.addEventListener('submit', async e => {
    e.preventDefault()
    const dadosForm = new FormData(formEditFornecedor)
    const dados = await fetch('editar_fornecedor.php', {
      method: 'POST',
      body: dadosForm
    })

    const resposta = await dados.json()

    if (resposta['status']) {
      document.getElementById('msgAlerta').innerHTML = resposta['msg']

      //Fechar a janela modal
      editModal.hide()

      //Limpar o formulario
      formEditFornecedor.reset()

      //Atualizar a lista de registros
      listarDataTables = $('#listar-fornecedor').DataTable()
      listarDataTables.draw()
    } else {
      document.getElementById('msgAlertErroEdit').innerHTML = resposta['msg']
    }
  })
}

async function apagarFornecedor(idFornecedor) {
  var confirmar = confirm(
    'Tem certeza que deseja excluir o fornecedor selecionado?'
  )
  if (confirmar) {
    const dados = await fetch(
      'apagar_fornecedor.php?idFornecedor=' + idFornecedor
    )
    const resposta = await dados.json()

    if (resposta['status']) {
      document.getElementById('msgAlerta').innerHTML = resposta['msg']
      //Atualizar a lista de registros
      listarDataTables = $('#listar-fornecedor').DataTable()
      listarDataTables.draw()
    } else {
      document.getElementById('msgAlerta').innerHTML = resposta['msg']
    }
  } else {
  }
}
