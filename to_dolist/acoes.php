<?php
session_start();
require_once('conexao.php');

if (isset($_POST['create_tarefa'])) {
    $nome = trim($_POST['txtNome']);
    $descricao = trim($_POST['txtDescricao']);
    $status = trim($_POST['txtStatus']);
    $data_final = trim($_POST['txtDataFinal']);

    
    $sql = "INSERT INTO tarefas (nome, descricao, data_limite) VALUES ('$nome', '$descricao', '$data_final')";

    mysqli_query($conn, $sql);

    header('Location: index.php');
    exit();
}

if (isset($_POST['edit_tarefas'])) {

    $tarefaID = mysqli_real_escape_string($conn, $_POST['tarefa_id']);
    $nome = mysqli_real_escape_string($conn, $_POST['txtNome']);
    $descricao = mysqli_real_escape_string($conn, $_POST['txtDescricao']);
    $data_final = mysqli_real_escape_string($conn, $_POST['txtData_final']);


    $sql = "UPDATE tarefas SET nome = '$nome', descricao = '$descricao', data_limite = '$data_final' WHERE id = '$tarefaID'";
    

    if (mysqli_query($conn, $sql) && mysqli_affected_rows($conn) > 0) {

        $_SESSION['message'] = "Tarefa editada com sucesso :) .";
        $_SESSION['type'] = 'success';
    } else {

        $_SESSION['message'] = "Erro ao editar tarefa ou nenhuma mudança feita hehe";
        $_SESSION['type'] = 'error';
    }


    header("Location: index.php");
    exit();
}

if (isset($_POST['delete_tarefa'])) {
    $tarefaID = mysqli_real_escape_string($conn, $_POST['delete_tarefa']);
    $sql = "DELETE FROM tarefas WHERE id = '$tarefaID'";

    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['message'] = "Usuário com ID {$tarefaID} excluído com sucesso!";
        $_SESSION['type'] = 'success';
    } else {
        $_SESSION['message'] = "Ops! Não foi possível excluir o usuário";
        $_SESSION['type'] = 'error';
    }

    header('Location: index.php');
    exit;
}

?>