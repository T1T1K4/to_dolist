<?php
session_start();
require_once("conexao.php");

$sql = "SELECT * FROM tarefas";
$tarefas = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="conteiner mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Lista de Tarefas <i class="bi bi-bookmark"></i>
                            <a href="createUser.php" class="btn btn-primary float-end">Adiconar Tarefas</a>
                        </h4> 
                    </div>
                    <div class="card-body ">
                    <?php include('mensagem.php'); ?>
                        <table class="table table-bordered table-striped text-center ">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Status</th>
                                    <th>Data Limite</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tarefas as $tarefa): ?>
                                    <tr>
                                        <td><?php echo $tarefa['id']; ?></td>
                                        <td><?php echo $tarefa['nome']; ?></td>
                                        <td><?php echo $tarefa['descricao']; ?></td>
                                        <td>
                                            <select name="txtStatus" id="txtStatus">
                                                <option value="pendente">pendente</option>
                                                <option value="andamento">andamento</option>
                                                <option value="concluido">concluido</option>
                                            </select>
                                        </td>
                                        <td><?php echo date('d/m/Y', strtotime($tarefa['data_limite'])); ?></td>
                                        <td>
                                            <a href="editarTarefa.php?id=<?=$tarefa['id']?>" class="btn btn-secondary btn-sm"><i class="bi bi-pencil-fill"></i></a>


                                            <form action="acoes.php" method="POST" class="d-inline">
                                                <button onclick="return confirm('Você tem certeza que gostaria de excluir essa tarefa?!')" name="delete_tarefa" type="submit" value="<?=$tarefa['id']?>" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>