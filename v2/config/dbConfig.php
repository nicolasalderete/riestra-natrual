<?php
    $dbconn = pg_connect($_ENV["DATABASE_URL"])
    or die('No se ha podido conectar: ' . pg_last_error());
/*
    // Realizando una consulta SQL
    $query = 'SELECT * FROM usuarios';
    $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

    // Imprimiendo los resultados en HTML
    echo "<table>\n";
    while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
    }
    echo "</table>\n";

    // Liberando el conjunto de resultados
    pg_free_result($result);

    // Cerrando la conexión
    pg_close($dbconn);
*/
?>