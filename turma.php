<?php
    session_start();
    if(!isset($_SESSION["logado"]))
        header("location:index.php");
    include "cabecalho.html";
    
?>

    <table class="table table-striped">
        <tr>
            <th>Foto</th>
            <th>Nome</th>
            <th> </th>
        </tr>
        <?php
            include "Conexao.php";
            $idProfessor = $_SESSION["idProf"];
            $idCurso = $_GET["curso"];
            $idTurma = $_GET["turma"];
            $idPeriodo = $_GET["periodo"];
            $idDisciplina = $_GET["disciplina"];
                                            

            $sql="SELECT *
            FROM cursoturmaperiodoaluno ctpa
            INNER JOIN aluno a
            ON a.idAluno = ctpa.Aluno_idAluno
            WHERE ctpa.CursoTurmaPeriodo_Curso_idCurso = $idCurso 
            AND ctpa.CursoTurmaPeriodo_Turma_idTurma = $idTurma;";

            $resultado = $conexao->query($sql);
            
            while($linha = $resultado->fetch_array()){                
        ?>
        <tr>
                <td><img src="<?php echo $linha["Imagem"]; ?>" class="img-thumbnail imagem tamanho-img"></td>
                <td><?php echo $linha["Nome"]; ?></td>
                <td><a href="<?php echo "aluno.php?curso=".$idCurso."&turma=".$idTurma."&periodo=".$idPeriodo."&disciplina=".$idDisciplina."&aluno=".$linha["idAluno"] ?>" class="btn btn-success">Apontamentos</a></td>
        </tr>
<?php
            }
    echo "</table>";
    include "rodape.html";
?>

