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
    ?>
    <form method="POST" enctype="multipart/form-data">
        <label>Ano: </label><br>
        <input type="text" name="txtAno" class="form-control"><br>
        <label>Período: </label><br>
        <input type="text" name="txtPeriodo" class="form-control"><br>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="cbAtivo"> Ativo
            </label>
        </div>
        <input type="submit" value="Gravar" name="btGravar" class="btn btn-success pull-right"><br><br><br>
    </form>

        <?php
            
            if(isset($_POST["btGravar"])) {           
                $Ano = $_POST["txtAno"];
                $Periodo = $_POST["txtPeriodo"];
                $Ativo = $_POST["cbAtivo"];

                //inserir o problema
                $sql = "INSERT INTO `periodo`( `Ano`, `Periodo`, `ativo` ) VALUES ($Ano, $Periodo, $Ativo)";

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
        <table class="table table-striped">
        <tr>
            <th>Ano</th>
            <th>Período</th>
        </tr>
        <?php
            $sql="SELECT * FROM periodo ORDER BY ano, periodo;";

            $resultado = $conexao->query($sql);
            
            while($linha = $resultado->fetch_array()){                
        ?>
        <tr>
                <td><?php echo $linha["Nome"]; ?></td>
        </tr>
<?php
        }
    echo "</table>";
    include "rodape.html";
?>