$(document).ready(function () {
  $('#listar-usuario').DataTable({
    processing: true,
    serverSide: true,
    ajax: 'listar_usuario.php',
    language: {
      url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/pt-PT.json'
    }
  })
})

const formNewUsuario = document.getElementById('form-cad-usuario')
const fecharModalCad = new bootstrap.Modal(
  document.getElementById('cadUsuarioModal')
)

if (formNewUsuario) {
  formNewUsuario.addEventListener('submit', async e => {
    e.preventDefault()
    const dadosForm = new FormData(formNewUsuario)

    const dados = await fetch('cadastrar_usuario.php', {
      method: 'POST',
      body: dadosForm
    })
    const resposta = await dados.json()

    if (resposta['status']) {
      document.getElementById('msgAlertErroCad').innerHTML = ''
      document.getElementById('msgAlerta').innerHTML = resposta['msg']
      formNewUsuario.reset()
      fecharModalCad.hide()
      listarDataTables = $('#listar-usuario').DataTable()
      listarDataTables.draw()
    } else {
      document.getElementById('msgAlertErroCad').innerHTML = resposta['msg']
    }
  })
}

async function visUsuario(id) {
  const dados = await fetch('visualizar_usuario.php?id=' + id)
  const resposta = await dados.json()

  if (resposta['status']) {
    const visModal = new bootstrap.Modal(
      document.getElementById('visUsuarioModal')
    )
    visModal.show()

    document.getElementById('id').innerHTML = resposta['dados'].id
    document.getElementById('nomesUsuario').innerHTML = resposta['dados'].nome
    document.getElementById('emailUsuarios').innerHTML = resposta['dados'].email
    document.getElementById('dataNascimento').innerHTML =
      resposta['dados'].data_nascimento
    document.getElementById('cpfUsuario').innerHTML = resposta['dados'].cpf
    document.getElementById('cargoUsuario').innerHTML = resposta['dados'].cargo
    document.getElementById('cepUsuario').innerHTML = resposta['dados'].cep
    document.getElementById('estadoUsuario').innerHTML =
      resposta['dados'].estado
    document.getElementById('cidadeUsuario').innerHTML =
      resposta['dados'].cidade


    document.getElementById('msgAlerta').innerHTML = ''
  } else {
    document.getElementById('msgAlerta').innerHTML = resposta['msg']
  }
}

const editModal = new bootstrap.Modal(
  document.getElementById('editUsuarioModal')
)
async function editUsuario(id) {
  const dados = await fetch('visualizar_usuario.php?id=' + id)
  const resposta = await dados.json()

  if (resposta['status']) {
    //Manter janela modal aberta
    document.getElementById('msgAlertErroEdit').innerHTML = ''
    document.getElementById('msgAlerta').innerHTML = ''
    editModal.show()

    document.getElementById('editIdUsuario').value = resposta['dados'].id
    document.getElementById('editNomeUsuario').value = resposta['dados'].nome
    document.getElementById('editEmailUsuario').value = resposta['dados'].email
    document.getElementById('editDataNascimento').value =
      resposta['dados'].data_nascimento
    document.getElementById('editCpf').value = resposta['dados'].cpf
    document.getElementById('editCargoUsuario').value = resposta['dados'].cargo
    document.getElementById('editCep').value = resposta['dados'].cep
    document.getElementById('editEstado').value = resposta['dados'].estado
    document.getElementById('editCidade').value = resposta['dados'].cidade



  } else {
    document.getElementById('msgAlerta').innerHTML = resposta['msg']
  }
}

const formEditUsuario = document.getElementById('form-edit-usuario')
if (formEditUsuario) {
  formEditUsuario.addEventListener('submit', async e => {
    e.preventDefault()
    const dadosForm = new FormData(formEditUsuario)
    const dados = await fetch('editar_usuario.php', {
      method: 'POST',
      body: dadosForm
    })

    const resposta = await dados.json()

    if (resposta['status']) {
      document.getElementById('msgAlerta').innerHTML = resposta['msg']

      //Fechar a janela modal
      editModal.hide()

      //Limpar o formulario
      formEditUsuario.reset()

      //Atualizar a lista de registros
      listarDataTables = $('#listar-usuario').DataTable()
      listarDataTables.draw()
    } else {
      document.getElementById('msgAlertErroEdit').innerHTML = resposta['msg']
    }
  })
}

async function apagarUsuario(id) {
  var confirmar = confirm(
    'Tem certeza que deseja excluir o usuário selecionado?'
  )
  if (confirmar) {
    const dados = await fetch('apagar_usuario.php?id=' + id)
    const resposta = await dados.json()

    if (resposta['status']) {
      document.getElementById('msgAlerta').innerHTML = resposta['msg']
      //Atualizar a lista de registros
      listarDataTables = $('#listar-usuario').DataTable()
      listarDataTables.draw()
    } else {
      document.getElementById('msgAlerta').innerHTML = resposta['msg']
    }
  } else {
  }
}
