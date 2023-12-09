<style>
    <!--
    table {
        margin : auto;
    }
    table.carte td{
        border-collapse: collapse;
        margin-left: 50px;
    }
    .carte{
        background: white;
    }
    *{
        font-size: 13px;
        font-family: arial, sans-serif;
    }
    .code{
        color: rgb(170, 0, 0);
    }
    .thead{
        width:60%;
    }
    .header{
        background:#004455;
        color: white;
    }.footer{
         background:green;
         color: white;
     }

    td.footer{
        padding: 10px;
    }
    .content td{
        padding: 5px;

    }
    .ecole{
        font-size: 18px;
        font-weight: bold;
    }
    .titre{
        font-size: 20px;
        font-weight: bold;
    }
    small{
        font-size: 12px;
    }
    .endHeader{
        border-bottom: 1px grey dotted;
    }
    .rub{
        font-weight: bold;
        border: 1px solid black;
        padding-bottom: 10px;
    }
    .nom{
        font-size: 30px;
        font-weight: bold;
    }
    hr{
        color: grey;
    }
    .alert{
        color: red;
    }

    .edt td{
        text-align: center;
        border-collapse : collapse;
        border: 1px solid black;
        width : 14.28%;
        font-size : 10px;
    }

    .edt td.hor{
        width: 3%;
    }

    table.edt{
        border-collapse: collapse;
    }
    -->
</style>
<page format="A4" orientation="paysage">
    <table style="width:100%;">
        <tr>
            <td align="center">
                <img src="<?php echo img_url('logo/logo.png') ?>" height="80">
            </td>
            <td align="center" class="thead">
                REPUBLIQUE DU CAMEROUN<br>
                Ministère de l'Emploi et de la Formation Professionnelle<br>
                <b>CENTRE DE FORMATION PROFESSIONNELLE</b><br>
                <span class="ecole">MULTISOFT ACADEMY</span><br>
                <i><small>Agrément ministériel N° 0124/MINEFOP/SE/DFOP/SDGSF/SACD du 11 AOUT 2010</small></i>
            </td>
        </tr>
        <tr><td colspan="2" class="endHeader"></td></tr>
        <tr>
            <td align="center" colspan="2">
                <b class="">EMPLOI DE TEMPS</b><br>
                <small>Semaine du <b class=""><?php echo $week['debut'] ?></b> au <b><?php echo $week['fin'] ?></b></small> |  <small><b>Vagues : </b><?php echo $promotion ?></small>
            </td>
        </tr>
    </table>

    <table class="edt" style="width: 100%;">
        <thead>
            <tr>
                <td class="hor"></td>
                <td>Lundi</td>
                <td>Mardi</td>
                <td>Mercredi</td>
                <td>Jeudi</td>
                <td>Vendredi</td>
                <td>Samedi</td>
            </tr>
        </thead>
        <?php
            $num = 0;
            foreach ($timetable as $time=>$val){
                //if($num==1) break;
                $num++;
                echo "<tr>";
                echo '<td class="hor">'.$time.'</td>';

                foreach ($val as $class)
                {
                    echo '<td>';
                        if($class) {
                            echo $class['content'];
                        }else
                        {
                            echo 'Libre';
                        }
                    echo '</td>';

                }

                echo "</tr>";
            }
        ?>
        <tr style="width:100%;">
            <td colspan="7" style="border: none;" align="right"><br><br><b>Fait à Ngaoundéré le .................</b></td>
        </tr>
    </table>

    <page_footer>
        <table class="page_footer" style="width: 100%;">
            <tr>
                <td class="" align="center" style="width: 100%;">
                    <p class="small">
                        Contacts : 655 81 19 16 – 690 98 36 73 – 697 96 96 96<br>
                        Site web: www.msacad.com<br>
                    </p>
                </td>
            </tr>
        </table>
    </page_footer>
</page>