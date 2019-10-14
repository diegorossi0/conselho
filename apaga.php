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
            $idDisciplina = $_GET["disciplina"];
            $idAluno = $_GET["aluno"];
            $idProblema = $_GET["problema"];

            
            $sql="DELETE FROM cursoturmaperiodoalunoproblemas
            WHERE DisciplinaCursoTurmaPeriodo_Disciplina_idDisciplina = $idDisciplina 
            AND CursoTurmaPeriodoAluno_CursoTurmaPeriodo_Curso_idCurso = $idCurso 
            AND CursoTurmaPeriodoAluno_CursoTurmaPeriodo_Turma_idTurma = $idTurma 
            AND DisciplinaCursoTurmaPeriodo_Professor_idProfessor = $idProfessor 
            AND idPeriodo = $idPeriodo 
            AND CursoTurmaPeriodoAluno_Aluno_idAluno = $idAluno 
            AND Problemas_idProblemas = $idProblema;";

            $conexao->query($sql);                

            header("location:aluno.php?curso=$idCurso&turma=$idTurma&periodo=$idPeriodo&disciplina=$idDisciplina&aluno=$idAluno");
        ?>
<?php
    include "rodape.html";
?>

