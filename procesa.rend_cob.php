<?php

$file = $_FILES['file']['name'];

$destino = 'archivos/' . $file;

move_uploaded_file($_FILES['file']['tmp_name'], $destino);
?>

<div>

    <h2 style="text-align: center;">Resultados</h2>

    <table>
        <thead>
            <tr>
                <th><b>Colum1</b></th>
                <th><b>Colum2</b></th>
                <th><b>Colum3</b></th>

            </tr>
        </thead>

        <tbody>
            <?php
            $archivo = fopen($destino, 'r');
            while (!feof($archivo)) {
                $linea = fgets($archivo);
                $saltolinea = nl2br($linea);

                $colum1 = substr($saltolinea, 0, 24);
                $colum2 = substr($saltolinea, 134, -212);
                $colum3 = substr($saltolinea, 284, -65);

            ?>
                <tr>
                    <td><?= $colum1 ?></td>
                    <td><?= $colum2 ?></td>
                    <td><?= $colum3 ?></td>

                </tr>

            <?php
            }
            fclose($archivo);
            ?>
        </tbody>
    </table>

</div>