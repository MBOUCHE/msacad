 <?php
                    if(isset($query) And is_array($query) and !empty($query))
                    {
                        //var_dump(count($query));
                        //var_dump($query);
                        $k = 0;
                        //var_dump($query);
                        for($i = 1; $i <= count($query); $i++)
                        {
                            $state = $query[$i-1]->state;
                            $bgcolor = ($state == -1)? 'red':($state == 0)? 'green':'grey';
                            echo '<tr><td><span class="text-center '.$bgcolor.' text-white" style="padding: 7px">' . ++$k . '</span></td>';
                            echo isset($query[$i-1]->photo) ? '<td class="text-center"><img src="' . base_url().$query[$i-1]->photo . '" class="responsive-img" height="50"></td>' :
                                '<td class="text-center"><img src="' . img_url('/logo/logo.png') . '" class="responsive-img" height="50"></td>';
                            echo '<td>' . $query[$i-1]->number_id . '</td>';
                            echo '<td>' . strtoupper($query[$i-1]->lastname) . ' ' . ucfirst($query[$i-1]->firstname) . '</td>';
                            echo '<td>' . $query[$i-1]->phone .'<br>'. $query[$i-1]->mail . '</td>';
                            echo '<td>
                                    <a href="'.base_url('student/profile').'/'.$query[$i-1]->id.'" data-toggle="tooltip" data-title="Profil"><i class="w3-btn fa fa-fw fa-2x fa-user text-info" aria-hidden="true"></i></a>


                                    <a href="'.base_url('student/log').'/'.$query[$i-1]->id.'"><i class="w3-btn fa fa-fw fa-2x fa-bookmark text-info red-tooltip" aria-hidden="true" style="cursor: pointer;" data-toggle="tooltip" data-title="Log"></i></td></tr></a>;

                                    </td></tr>';
                        }
                    }
                    else
                    {
                        echo '<tr><td colspan="10"  class="h3 text-center"><a href="'.base_url('student/save').'" class="text-warning">Aucun apprenant enregistré pour le moment ...</a><td></tr>';
                    }
                    ?>