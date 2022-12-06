$(document).ready(function () {
  $('#listar-produto').DataTable({
    processing: true,
    serverSide: true,
    ajax: 'listar_produto.php',
    language: {
      url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/pt-PT.json'
    }
  })
})

const formNewProduto = document.getElementById('form-cad-produto')
const fecharModalCad = new bootstrap.Modal(
  document.getElementById('cadProdutoModal')
)

if (formNewProduto) {
  formNewProduto.addEventListener('submit', async e => {
    e.preventDefault()
    const dadosForm = new FormData(formNewProduto)

    const dados = await fetch('cadastrar_produto.php', {
      method: 'POST',
      body: dadosForm
    })
    const resposta = await dados.json()

    if (resposta['status']) {
      document.getElementById('msgAlertErroCad').innerHTML = ''
      document.getElementById('msgAlerta').innerHTML = resposta['msg']
      formNewProduto.reset()
      fecharModalCad.hide()
      listarDataTables = $('#listar-produto').DataTable()
      listarDataTables.draw()
    } else {
      document.getElementById('msgAlertErroCad').innerHTML = resposta['msg']
    }
  })
}

async function visProduto(idProduto) {
  const dados = await fetch('visualizar_produto.php?idProduto=' + idProduto)
  const resposta = await dados.json()

  if (resposta['status']) {
    const visModal = new bootstrap.Modal(
      document.getElementById('visProdutoModal')
    )
    visModal.show()

    document.getElementById('idProduto').innerHTML = resposta['dados'].idProduto
    document.getElementById('nomesProduto').innerHTML =
      resposta['dados'].nomeProduto
    document.getElementById('precoProdutos').innerHTML =
      resposta['dados'].precoProduto
    document.getElementById('descricaoProdutos').innerHTML =
      resposta['dados'].descricaoProduto
    document.getElementById('fornecedorProdutos').innerHTML =
      resposta['dados'].idFornecedor
    document.getElementById('categoriaProdutos').innerHTML =
      resposta['dados'].idCategoria
    document.getElementById('dataFabricacaos').innerHTML =
      resposta['dados'].dataFabricacao
    document.getElementById('qtdeProdutos').innerHTML =
      resposta['dados'].qtdeProduto

    document.getElementById('msgAlerta').innerHTML = ''
  } else {
    document.getElementById('msgAlerta').innerHTML = resposta['msg']
  }
}

const editModal = new bootstrap.Modal(
  document.getElementById('editProdutoModal')
)
async function editProduto(idProduto) {
  const dados = await fetch('visualizar_produto.php?idProduto=' + idProduto)
  const resposta = await dados.json()

  if (resposta['status']) {
    //Manter janela modal aberta
    document.getElementById('msgAlertErroEdit').innerHTML = ''
    document.getElementById('msgAlerta').innerHTML = ''
    editModal.show()

    document.getElementById('editIdProduto').value = resposta['dados'].idProduto
    document.getElementById('editNomesProduto').value =
      resposta['dados'].nomeProduto
    document.getElementById('editDescricaoProdutos').value =
      resposta['dados'].descricaoProduto
    document.getElementById('editPrecoProdutos').value =
      resposta['dados'].precoProduto
    document.getElementById('editFornecedorProdutos').value =
      resposta['dados'].idFornecedor
    document.getElementById('editCategoriaProdutos').value =
      resposta['dados'].idCategoria
    document.getElementById('editDataFabricacaos').value =
      resposta['dados'].dataFabricacao
    document.getElementById('editQtdeProdutos').value =
      resposta['dados'].qtdeProduto
    document.getElementById('editImagemProdutos').value =
      resposta['dados'].imagemProduto
  } else {
    document.getElementById('msgAlerta').innerHTML = resposta['msg']
  }
}

const formEditProduto = document.getElementById('form-edit-produto')
if (formEditProduto) {
  formEditProduto.addEventListener('submit', async e => {
    e.preventDefault()
    const dadosForm = new FormData(formEditProduto)
    const dados = await fetch('editar_produto.php', {
      method: 'POST',
      body: dadosForm
    })

    const resposta = await dados.json()

    if (resposta['status']) {
      document.getElementById('msgAlerta').innerHTML = resposta['msg']

      //Fechar a janela modal
      editModal.hide()

      //Limpar o formulario
      formEditProduto.reset()

      //Atualizar a lista de registros
      listarDataTables = $('#listar-produto').DataTable()
      listarDataTables.draw()
    } else {
      document.getElementById('msgAlertErroEdit').innerHTML = resposta['msg']
    }
  })
}

async function apagarProduto(idProduto) {
  var confirmar = confirm(
    'Tem certeza que deseja excluir o produto selecionado?'
  )
  if (confirmar) {
    const dados = await fetch('apagar_produto.php?idProduto=' + idProduto)
    const resposta = await dados.json()

    if (resposta['status']) {
      document.getElementById('msgAlerta').innerHTML = resposta['msg']
      //Atualizar a lista de registros
      listarDataTables = $('#listar-produto').DataTable()
      listarDataTables.draw()
    } else {
      document.getElementById('msgAlerta').innerHTML = resposta['msg']
    }
  } else {
  }
}

const situacao = document.getElementById('idFornecedor')
if (situacao) {
  listarFornecedor()
}

async function listarFornecedor() {
  const dados = await fetch('listar_situacao.php')
  const resposta = await dados.json()
  if (resposta['status']) {
    document.getElementById('msgAlerta').innerHTML = ''
    for (var i = 0; i < resposta.dados.length; i++) {
      situacao.innerHTML =
        situacao.innerHTML +
        '<option value="' +
        resposta.dados[i]['idFornecedor'] +
        '">' +
        resposta.dados[i]['nomeFornecedor'] +
        '</option>'
    }
  } else {
    document.getElementById('msgAlerta').innerHTML = resposta['msg']
  }
}

const editarSituacao = document.getElementById('editFornecedorProdutos')
if (editarSituacao) {
  editarFornecedor()
}

async function editarFornecedor() {
  const dados = await fetch('listar_situacao.php')
  const resposta = await dados.json()
  console.log(resposta)
  if (resposta['status']) {
    document.getElementById('msgAlerta').innerHTML = ''

    for (var i = 0; i < resposta.dados.length; i++) {
      editarSituacao.innerHTML =
        editarSituacao.innerHTML +
        '<option class="edit" value="' +
        resposta.dados[i]['idFornecedor'] +
        '">' +
        resposta.dados[i]['nomeFornecedor'] +
        ' </option>'
    }
  } else {
    document.getElementById('msgAlerta').innerHTML = resposta['msg']
  }
}
