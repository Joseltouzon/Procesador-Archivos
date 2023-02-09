<?php

$file = $_FILES['file']['name'];

$destino = 'archivos_rend_rev/' . $file;

move_uploaded_file($_FILES['file']['tmp_name'], $destino);

$fileContenido = file_get_contents($destino);
$fileRows = explode("\n", $fileContenido);
$totalTrans = count($fileRows);


?>

<div style="float: left;">

    <h2 style="text-align: center;">Resultados</h2>

    <table>
        <thead>
            <tr>
                <th style="text-align: center;"><b>Identificador del Cliente</b></th>
                <th style="text-align: center;"><b>Monto</b></th>
                <th style="text-align: center;"><b>Fecha de Pago</b></th>
                

            </tr>
        </thead>

        <tbody>
            <?php
            $archivo = fopen($destino, 'r');
            while (!feof($archivo)) {
                $linea = fgets($archivo);
                $saltolinea = nl2br($linea);

                $colum1 = substr($saltolinea, 4, 22);
                $colum2 = substr($saltolinea, 77, -269);
                $colum3 = substr($saltolinea, 67, -283);
                

                $totalMonto += $colum2;
            ?>
                <tr>
                    <td style="text-align: center;"><?= $colum1 ?></td>
                    <td style="text-align: center;"><?= $colum2 ?></td>
                    <td style="text-align: center;"><?= $colum3 ?></td>
                    

                </tr>

            <?php
            }

            fclose($archivo);
            ?>
        </tbody>
    </table>
</div>
<div style="float: right;">
    <h2 style="text-align: center;">Totales</h2>
    <br>
    <h4 style="text-align: center;">Total Transacciones: <?= $totalTrans ?></h4>
    <br>
    <h4 style="text-align: center;">Monto Total Cobrado: <?= $totalMonto ?></h4>
</div>