<?php
    session_start();
    if(!isset($_SESSION["logado"]))
        header("location:index.php");
    include "cabecalho.html";
    include "Conexao.php";
?>
    <br><br>
    <?php
            $idProfessor = $_SESSION["idProf"];
            $idCurso = $_GET["curso"];
            $idTurma = $_GET["turma"];
            $idPeriodo = $_GET["periodo"];
            $idDisciplina = $_GET["disciplina"];
            $idAluno = $_GET["aluno"];
            echo "<div class='row'>";
            echo "<a href='turma.php?curso=$idCurso&turma=$idTurma&periodo=$idPeriodo&disciplina=$idDisciplina' class='btn btn-primary'>Voltar</a>";
            echo "</div><br>";
    ?>
    <form method="POST">
        <label>Apontamento: </label><br>
        <select name="txtProblema" class="form-control">
        <?php
            

            $sql="SELECT * FROM problemas;";

            $resultado = $conexao->query($sql);
            
            while($linha = $resultado->fetch_array()){  
        ?>
            <option value="<?php echo $linha["idProblemas"] ?>"><?php echo $linha["Descricao"] ?></option>
         <?php } ?>
        </select><br>
        <label>Observação: </label><br>
        <textarea name="txtObservacao" class="form-control"></textarea><br><br>
        <input type="submit" value="Gravar" name="btGravar" class="btn btn-success pull-right"><br><br><br>
    </form>
    <table class="table table-striped">
        <tr>
            <th>Sigla</th>
            <th>Apontamento</th>
            <th>Observação</th>
            <th> </th>
        </tr>
        <?php
            
            if(isset($_POST["btGravar"])) {           
                $idProblemas = $_POST["txtProblema"];
                $observacao = $_POST["txtObservacao"];

            //inserir o problema
            $sql = "INSERT INTO `cursoturmaperiodoalunoproblemas`
            (`CursoTurmaPeriodoAluno_CursoTurmaPeriodo_Curso_idCurso`,
            `CursoTurmaPeriodoAluno_CursoTurmaPeriodo_Turma_idTurma`,
            `CursoTurmaPeriodoAluno_Aluno_idAluno`,
            `Problemas_idProblemas`,
            `DisciplinaCursoTurmaPeriodo_Disciplina_idDisciplina`,
            `DisciplinaCursoTurmaPeriodo_CursoTurmaPeriodo_Curso_idCurso`,
            `DisciplinaCursoTurmaPeriodo_CursoTurmaPeriodo_Turma_idTurma`,
            `DisciplinaCursoTurmaPeriodo_Professor_idProfessor`,
            `Observacao`,
            `idPeriodo`) VALUES ($idCurso, $idTurma, $idAluno, 
            $idProblemas, $idDisciplina, $idCurso, $idTurma, $idProfessor, '$observacao', $idPeriodo );";

                if($conexao->query($sql)){
                    echo "<div class='alert alert-success'>Operação efetuada com sucesso!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Fechar'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
                }else{
                    echo "<div class='alert alert-danger'>ERRO - Operação não efetuada!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Fechar'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
                }
            }
        ?>

        <?php
            $sql="SELECT *
            FROM cursoturmaperiodoalunoproblemas ctpap
            INNER JOIN problemas p
            ON p.idProblemas = ctpap.Problemas_idProblemas
            WHERE ctpap.DisciplinaCursoTurmaPeriodo_Disciplina_idDisciplina = $idDisciplina AND 
            ctpap.CursoTurmaPeriodoAluno_CursoTurmaPeriodo_Curso_idCurso = $idCurso AND
            ctpap.CursoTurmaPeriodoAluno_CursoTurmaPeriodo_Turma_idTurma = $idTurma AND 
            ctpap.DisciplinaCursoTurmaPeriodo_Professor_idProfessor = $idProfessor AND 
            ctpap.idPeriodo = $idPeriodo 
            AND ctpap.CursoTurmaPeriodoAluno_Aluno_idAluno = $idAluno;";

            $resultado = $conexao->query($sql);
            
            while($linha = $resultado->fetch_array()){                
        ?>
        <tr>
                <td><?php echo $linha["Sigla"]; ?></td>
                <td><?php echo $linha["Descricao"]; ?></td>
                <td><?php echo $linha["Observacao"]; ?></td>
                <td><a href="<?php echo "apaga.php?curso=".$linha["CursoTurmaPeriodoAluno_CursoTurmaPeriodo_Curso_idCurso"]."&turma=".$linha["CursoTurmaPeriodoAluno_CursoTurmaPeriodo_Turma_idTurma"].
                                            "&periodo=".$linha["idPeriodo"]."&disciplina=".
                                            $linha["DisciplinaCursoTurmaPeriodo_Disciplina_idDisciplina"].
                                            "&aluno={$linha['CursoTurmaPeriodoAluno_Aluno_idAluno']}&problema={$linha['Problemas_idProblemas']}" ?>">Apagar</a></td>
        </tr>
<?php
            }
    echo "</table>";
    include "rodape.html";
?>

