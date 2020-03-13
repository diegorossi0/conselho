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
        <label>Nome: </label><br>
        <input type="text" name="txtNome" class="form-control"><br>
        <input type="submit" value="Gravar" name="btGravar" class="btn btn-success pull-right"><br><br><br>
    </form>

    <?php
            
            if(isset($_POST["btGravar"])) {           
                $Nome = $_POST["txtNome"];

                //Upload do arquivo
                date_default_timezone_set("Brazil/East");
               
                $new_name = $Nome . date("Y.m.d-H.i.s") . $ext;
               
                

                //inserir o problema
                $sql = "INSERT INTO `professor`( `Nome`) VALUES ('$Nome')";

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
            <th>Nome</th>
        </tr>
        <?php
            $sql="SELECT * FROM professor;";

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