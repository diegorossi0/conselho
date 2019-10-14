<?php
    session_start();
    if(!isset($_SESSION["logado"]))
        header("location:index.php");
    include "cabecalho.html";
    include "Conexao.php";
?>
    <br><br>
    <form method="POST">
        <!-- Mudar x5 -->
        <label>Curso: </label><br>
        <select name="txtCurso" class="form-control">
        <?php
            

            $sql="SELECT * FROM curso;";

            $resultado = $conexao->query($sql);
            
            while($linha = $resultado->fetch_array()){  
        ?>
            <option value="<?php echo $linha["idCurso"] ?>"><?php echo $linha["Nome"] ?></option>
         <?php } ?>
        </select><br>
        <!-- Fim -->
        
        <input type="submit" value="Gravar" name="btGravar" class="btn btn-success pull-right"><br><br><br>
    </form>
    
<?php
    if(isset($_POST["btGravar"])) {           
        //Capturar valor dos combobox
        $idCurso = $_POST["txtCurso"];
        

        //inserir o problema
        $sql = "INSERT INTO disciplinacursoturmaperiodo(Disciplina_idDisciplina, CursoTurmaPeriodo_Curso_idCurso, 
        CursoTurmaPeriodo_Turma_idTurma, Professor_idProfessor, CursoTurmaPeriodo_Periodo_idPeriodo)
        VALUES ($idDisciplina, $idCurso, $idTurma, $idProfessor, $idPeriodo);";

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

    include "rodape.html";
?>

