$(document).ready(function () {
    $('#listar-cliente').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'listar_cliente.php',
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.13.1/i18n/pt-PT.json"
        }
    });
});

const formNewCliente = document.getElementById("form-cad-cliente");
const fecharModalCad = new bootstrap.Modal(document.getElementById("cadClienteModal"));

if (formNewCliente) {
    formNewCliente.addEventListener("submit", async (e) => {
        e.preventDefault();
        const dadosForm = new FormData(formNewCliente);

        const dados = await fetch("cadastrar_cliente.php", {
            method: "POST",
            body: dadosForm
        });
        const resposta = await dados.json();


        if (resposta['status']) {
            document.getElementById("msgAlertErroCad").innerHTML = "";
            document.getElementById("msgAlerta").innerHTML = resposta['msg'];
            formNewCliente.reset();
            fecharModalCad.hide();
            listarDataTables = $('#listar-cliente').DataTable();
            listarDataTables.draw();
        } else {
            document.getElementById("msgAlertErroCad").innerHTML = resposta['msg'];
        }
    });
}

async function visCliente(idCliente) {
    const dados = await fetch('visualizar_cliente.php?idCliente=' + idCliente);
    const resposta = await dados.json();

    if (resposta['status']) {
        const visModal = new bootstrap.Modal(document.getElementById("visClienteModal"));
        visModal.show();

        document.getElementById("idCliente").innerHTML = resposta['dados'].idCliente;
        document.getElementById("nomesCliente").innerHTML = resposta['dados'].nomeCliente;
        document.getElementById("generoCliente").innerHTML = resposta['dados'].genero;
        document.getElementById("cpfCliente").innerHTML = resposta['dados'].cpf;
        document.getElementById("emailClientes").innerHTML = resposta['dados'].emailCliente;
        document.getElementById("telefoneCliente").innerHTML = resposta['dados'].telefone_cliente;
        document.getElementById("dataNascimento").innerHTML = resposta['dados'].data_nascimento;
        document.getElementById("cepCliente").innerHTML = resposta['dados'].cep;
        document.getElementById("estadoCliente").innerHTML = resposta['dados'].estado;
        document.getElementById("cidadeCliente").innerHTML = resposta['dados'].cidade;
        document.getElementById("ruaCliente").innerHTML = resposta['dados'].rua;
        document.getElementById("numeroCliente").innerHTML = resposta['dados'].numero;

        document.getElementById("msgAlerta").innerHTML = "";
    } else {
        document.getElementById("msgAlerta").innerHTML = resposta['msg'];
    }
}

const editModal = new bootstrap.Modal(document.getElementById("editClienteModal"));
async function editCliente(idCliente) {

    const dados = await fetch('visualizar_cliente.php?idCliente=' + idCliente);
    const resposta = await dados.json();

    if (resposta['status']) {
        //Manter janela modal aberta
        document.getElementById("msgAlertErroEdit").innerHTML = "";
        document.getElementById("msgAlerta").innerHTML = "";
        editModal.show();

        document.getElementById("editIdCliente").value = resposta['dados'].idCliente;
        document.getElementById("editNomeCliente").value = resposta['dados'].nomeCliente;
        document.getElementById("editGenero").value = resposta['dados'].genero;
        document.getElementById("editCpf").value = resposta['dados'].cpf;
        document.getElementById("editEmailCliente").value = resposta['dados'].emailCliente;
        document.getElementById("edit_telefone_cliente").value = resposta['dados'].telefone_cliente;
        document.getElementById("edit_data_nascimento").value = resposta['dados'].data_nascimento;
        document.getElementById("editCep").value = resposta['dados'].cep;
        document.getElementById("editEstado").value = resposta['dados'].estado;
        document.getElementById("editCidade").value = resposta['dados'].cidade;
        document.getElementById("editRua").value = resposta['dados'].rua;
        document.getElementById("editNumero").value = resposta['dados'].numero;
    } else {
        document.getElementById("msgAlerta").innerHTML = resposta['msg'];
    }
}

const formEditCliente = document.getElementById("form-edit-cliente")
if (formEditCliente) {
    formEditCliente.addEventListener("submit", async (e) => {
        e.preventDefault();
        const dadosForm = new FormData(formEditCliente);
        const dados = await fetch("editar_cliente.php", {
            method: "POST",
            body: dadosForm
        });

        const resposta = await dados.json();

        if (resposta['status']) {
            document.getElementById("msgAlerta").innerHTML = resposta['msg'];

            //Fechar a janela modal
            editModal.hide();

            //Limpar o formulario
            formEditCliente.reset();


            //Atualizar a lista de registros
            listarDataTables = $('#listar-cliente').DataTable();
            listarDataTables.draw();
        } else {
            document.getElementById("msgAlertErroEdit").innerHTML = resposta['msg'];
        }
    });

}

async function apagarCliente(idCliente) {
    var confirmar = confirm("Tem certeza que deseja excluir o cliente selecionado")
    if (confirmar) {
        const dados = await fetch("apagar_cliente.php?idCliente=" + idCliente);
        const resposta = await dados.json();

        if (resposta['status']) {
            document.getElementById("msgAlerta").innerHTML = resposta['msg'];
            //Atualizar a lista de registros
            listarDataTables = $('#listar-cliente').DataTable();
            listarDataTables.draw();
        } else {
            document.getElementById("msgAlerta").innerHTML = resposta['msg'];
        }
    } else {

    }
}