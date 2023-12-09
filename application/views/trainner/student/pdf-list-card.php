<style>

    table.carte {
        border-collapse: collapse;
    }
    .ecoleTd{
        padding-right: 65px;
    }
    table.carte td{
        border-collapse: collapse;
    }
    .carte{
        background: white;
    }
    *{
        font-size: 12px;
        font-family: Arial, sans-serif;
    }
    .header{
        background:#004455;
        color: white;
    }.footer{
         background:#004455;
         color: white;
     }
    .footer td{
        padding: 10px;
    }
    .content td{
        padding: 5px;
    }
    .ecole{
        font-size: 16px;
        font-weight: bold;
    }
    .titre{
        font-size: 13px;
        font-weight: bold;
    }
    small{
        font-size: 10px;
    }
    td.single{
        width: 380px;
    }
*</style>
<page format="A4" orientation="P">
    <table cellspacing="2mm" class="liste">


        <?php


            //var_dump($student); die(0);
            //$total = 5;
            $total = count($student);
            $i = 0;
            $cpt = 0; //$j = ($i%2 == 0) ? $i/2 : $i+1/2;
            echo "<tr>";
            while($i < $total) {
                $dateBirth = date_create($student[$i]->birth_date);


                echo "<td class='single'>";
                include "single-card.php";
                echo "</td>";
                if($i%2==1){
                    echo "</tr><tr>";
                }
                 //$j - 1;
                $i++;

            }
            echo "</tr>";
        ?>

    </table>

</page>
