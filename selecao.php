<?php
    session_start();
    if(!isset($_SESSION["logado"]))
        header("location:index.php");
    include "cabecalho.html";
    
?>

    <table class="table table-striped">
        <tr>
            <th>Curso</th>
            <th>Turma</th>
            <th>Período</th>
            <th>Disciplina</th>
            <th> </th>
        </tr>
        <?php
            include "Conexao.php";
            $idProfessor = $_SESSION["idProf"];
            $sql="SELECT c.Nome, c.idCurso, t.idTurma, t.Turma, pe.idPeriodo, 
            concat(pe.Ano, '/', pe.Periodo) as Periodo, d.idDisciplina, d.Disciplina
            FROM professor p
            INNER JOIN disciplinacursoturmaperiodo dctp
            ON p.idprofessor = dctp.Professor_idprofessor
            INNER JOIN disciplina d
            ON d.iddisciplina = dctp.Disciplina_iddisciplina
            INNER JOIN cursoturmaperiodo ctp
            ON ctp.Curso_idcurso = dctp.CursoTurmaPeriodo_Curso_idCurso 
            AND ctp.Turma_idTurma = dctp.CursoTurmaPeriodo_Turma_idTurma
            AND ctp.Periodo_idperiodo = dctp.CursoTurmaPeriodo_Periodo_idPeriodo
            INNER JOIN turma t
            ON t.idTurma = ctp.Turma_idTurma
            INNER JOIN curso c
            ON c.idCurso = ctp.Curso_idCurso
            INNER JOIN periodo pe
            ON pe.idPeriodo = ctp.Periodo_idPeriodo
            WHERE p.idProfessor = $idProfessor AND pe.ativo = 1;";

            $resultado = $conexao->query($sql);
            
            while($linha = $resultado->fetch_array()){                
        ?>
        <tr>
                <td><?php echo $linha["Nome"]; ?></td>
                <td><?php echo $linha["Turma"]; ?></td>
                <td><?php echo $linha["Periodo"]; ?></td>
                <td><?php echo $linha["Disciplina"]; ?></td>
                <td><a href="<?php echo "turma.php?curso=".$linha["idCurso"]."&turma=".$linha["idTurma"].
                                            "&periodo=".$linha["idPeriodo"]."&disciplina=".$linha["idDisciplina"] ?>" class="btn btn-success">Ver</a></td>
        </tr>
<?php
            }
    echo "</table>";
    include "rodape.html";
?>

