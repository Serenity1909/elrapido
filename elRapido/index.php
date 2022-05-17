<?php
    session_start();
    require_once 'ReUsedCode/config.php';
    $title = 'El Rapîdo';
    require 'ReUsedCode/header.php';

    // Select all players in DB and order by their rank (+ -> -)
    $score = 'SELECT ranked,pseudo,lose,totalParty FROM player ORDER BY ranked DESC';
    $result = $bdd->query($score);
?>

<!-- Tablescore -->
<table>
    <thead>
        <tr>
            <th colspan="5"> The Scoreboard</th>
        </tr>
    </thead>
    <tbody>
        <tr style="color:white;">
            <td>Ranking</td>
            <td>Rank</td>
            <td>Pseudo</td>
            <td>Lose</td>
            <td>Total party</td>
        </tr>
        <?php
            $Ranking = 0;

            // fetch the first five player row in variable $result
            while(($row =$result->fetch(PDO::FETCH_NUM)) && ($Ranking < 5))
            {
                echo "<tr>";

                $Ranking = $Ranking + 1;
                echo"<td style='font-size:1em;'>$Ranking</td>";

                foreach ($row as $value) {
                    echo "<td style='font-size:1em;'>$value</td>";
                }
                
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

<?php
    $result->closeCursor();

    require 'ReUsedCode/login.php';

    require 'ReUsedCode/footer.php';
?>