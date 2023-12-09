<div class="content-wrapper py-3">
    <div class="container-fluid">
        <div class="row">
            <div class="h4 text-center col-sm-12" style="font-family: Marck Script;color:red;font-size: 35px;">
                <?php echo mb_strtolower('LISTE DES lecons ENSEIGNÉS') ?>
                <hr width="60%" style="margin: auto; margin-top: 10px">
            </div>
        </div>
        <div class="row" style="padding-left:40px;padding-top:40px;padding-bottom: 170px;">
            <table class="table table-bordered">
              <thead style="background-color: #add8e6; color:#1e90ff;font-family:Comic Sans MS;font-size: 17px;">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;code vague</th>
                  <th scope="col">&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;Lecon</th>
                </tr>
              </thead>
              <tbody style="font-family: Comic Sans MS;color: #444">
                <tr>
                    <?php 
                        $i = 1;
                        foreach ($list as $key) {
                            echo '<tr><td>'.$i++.'</td><td>'.$key['code_wave'].'</td><td>'.$key['label'].'</td><td>';
                        }
                    ?>     
                </tr>
              </tbody>
            </table>
        </div>

        