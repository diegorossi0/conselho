<?php
    session_start();
    if(!isset($_SESSION["logado"]))
        header("location:index.php");
    include "cabecalho.html";
    
?>
    
            <?php
            include "Conexao.php";
            $idProfessor = $_SESSION["idProf"];
            $idCurso = $_GET["curso"];
            $idTurma = $_GET["turma"];
            $idPeriodo = $_GET["periodo"];

            $sql="SELECT *, a.nome as nomealuno, p.nome as nomeprofessor
            FROM cursoturmaperiodoalunoproblemas ctpap
            INNER JOIN aluno a
            ON a.idAluno = ctpap.CursoTurmaPeriodoAluno_Aluno_idAluno
            INNER JOIN professor p 
            ON p.idProfessor = ctpap.DisciplinaCursoTurmaPeriodo_Professor_idProfessor
            INNER JOIN problemas pr
            ON pr.idProblemas = ctpap.Problemas_idProblemas
            INNER JOIN disciplina d
            ON d.idDisciplina = ctpap.DisciplinaCursoTurmaPeriodo_Disciplina_idDisciplina
            WHERE ctpap.DisciplinaCursoTurmaPeriodo_CursoTurmaPeriodo_Curso_idCurso = $idCurso AND
            ctpap.DisciplinaCursoTurmaPeriodo_CursoTurmaPeriodo_Turma_idTurma = $idTurma AND ctpap.DisciplinaCursoTurmaPeriodo_Professor_idProfessor = $idPeriodo ORDER BY a.nome;";

            $resultado = $conexao->query($sql);
            $nome = "";
            if($resultado->num_rows==0){
                echo "<div class='well well-sm'>";
                echo "Não existe apontamento para essa turma.";
                echo "</div>";
            }


            while($linha = $resultado->fetch_array()){                
                if($nome != $linha["nomealuno"]){
                    if($nome!="")
                        echo "</div>";

                    echo "<div class='well well-sm'>";
                    echo "<h3>".$linha["nomealuno"]."</h3><br>";
                    $nome = $linha["nomealuno"];
                }
        ?>
            <div class="alert alert-danger"><?php echo $linha["Descricao"]; ?> - <?php echo $linha["Disciplina"]; ?>(<?php echo $linha["nomeprofessor"]; ?>)<br>
            <small><?php echo $linha["Observacao"]; ?></small><br></div>
<?php
            }
    echo "</div>";
    include "rodape.html";
?>

