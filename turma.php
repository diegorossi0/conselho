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
                <td>
                  <button type="button" class="btn btn-link btn-xs" data-toggle="modal" data-target="#exibeImagem" data-caminho="<?php echo $linha["Imagem"]; ?>">
                    <img src="<?php echo $linha["Imagem"]; ?>" class="imagem tamanho-img"></td>
                  </button>
                <td><?php echo $linha["Nome"]; ?></td>
                <td><a href="<?php echo "aluno.php?curso=".$idCurso."&turma=".$idTurma."&periodo=".$idPeriodo."&disciplina=".$idDisciplina."&aluno=".$linha["idAluno"] ?>" class="btn btn-success">Apontamentos</a></td>
        </tr>
<?php
            }
    echo "</table>";
    
?>

<!-- Modal -->
<div class="modal fade" id="exibeImagem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
          
      </div>
    </div>
  </div>
</div>




<?php
    include "rodape.html";
?>

<script>
  $('#exibeImagem').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); //Capturar o botão que disparou o evento
    var recipient = button.data('caminho'); //Extrair o valor do data-caminho
    var modal = $(this);
    modal.find('.modal-body').html("<center><img src='"+recipient+"'></center>");
  })
</script>