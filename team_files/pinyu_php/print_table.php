<?php

    function print_data($result){

        echo "<table border = '2'><tr align='center'>";
        while ($meta = mysqli_fetch_field($result)) {
            echo "<td> $meta->name </td>";
        }
        echo "</tr>";
        while ($row = mysqli_fetch_row($result)) {

            echo "<tr>";
            for ($j = 0; $j < mysqli_num_fields($result); $j++) {
                echo "<td>$row[$j]</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

?>
