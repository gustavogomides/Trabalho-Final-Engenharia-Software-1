<?php
//REFERENCIAR O ARQUIVO COM A CLASSE DE GERAÇÃO DE PDF
include 'pdf/mpdf.php';


$saida = 
        "<html>
            <body>
                

            </body>
        </html>
        ";

$arquivo = "RelatorioGeralSaldo.pdf";

$mpdf = new mPDF();
$mpdf->WriteHTML($saida);
/*
 * F - salva o arquivo NO SERVIDOR
 * I - abre no navegador E NÃO SALVA
 * D - chama o prompt E SALVA NO CLIENTE
 */

$mpdf->Output($arquivo, 'I');

echo "PDF GERADO COM SUCESSO";


?>


