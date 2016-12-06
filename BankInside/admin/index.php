<?php 
    
    ob_start(); // Inicializa o buffer e bloqueia qualquer saída para o navegador
    
    include_once 'header.php';

    sec_session_start(); 
    
    if(login_check($mysqli) == true) {

        foreach ($_REQUEST as $___opt => $___val) {
            $$___opt = $___val;
        }

        if(empty($topicos)) {
            include("pages/blank.php");
        }elseif(substr($topicos, 0, 4)=='http' or substr($topicos, 0, 1)=="/" or substr($topicos, 0, 1)==".") {
            echo '<br><font face=arial size=11px><br><b>A página não existe.</b><br>Por favor selecione uma página a partir do Menu Principal.</font>'; 
        } else {
            include($topicos.".php");
        }

    } else { 
         header('Location: ../erro_autenticacao.php');
    }

    include_once 'footer.php'
?>