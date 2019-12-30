<?php
    session_start();
    if(!isset($_SESSION["logado"]))
        header("location:index.php");
    include "cabecalho.html";
    
?>
    <?php
        include "Conexao.php";
        echo "<script>alert('A sua senha é a padrão, favor atualizá-la');</script>";
    ?>
        <div id="login">
            <form method="POST">
                <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-lg-offset-4 col-lg-4">
                    <label>Senha:</label>
                    <input type="password" name="txtSenha" class="campo form-control">
                    <br><label>Confirma senha:</label>
                    <input type="password" name="txtConfirma" class="campo form-control"><br>
                    <input type="submit" value="Entrar" name="btGravar" class="btn btn-primary" >
                    <br><br><br>
                </div>  
            </form>
        </div>
        <?php
            if(isset($_POST["btGravar"])){
                $idProfessor = $_SESSION["idProf"];
                $confirma=$_POST["txtConfirma"];
                $senha=$_POST["txtSenha"];
            
                if($senha == $confirma){
                    $sql="UPDATE professor SET senha = '$senha' WHERE idProfessor=$idProfessor";
                    if($conexao->query($sql)){
                        header("location: selecao.php");
                    }else{
                        echo "<script>alert('Usuário e/ou senha incorreto');</script>";
                    }
                }else{
                    echo "<script>alert('Senha não confere.');</script>";
                }
            }
        ?>
    
<?php
    include "rodape.html";
?>