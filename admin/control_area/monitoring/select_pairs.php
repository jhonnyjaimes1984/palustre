<?php 
include_once "../../../conf/Config.php"; 

require_once BASE_URL . "/paginas/cabecera_tercer_nivel.php"; 
?>

<main role="main" class="content-wrapper">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Monitoring For Pairs</h1>
  </div>

  <?php
// Conexión a la base de datos
  $sentencia = $base_de_datos->query("SELECT * FROM pairs where finish_pairing_date is null ");
  $parejas = $sentencia->fetchAll(PDO::FETCH_OBJ);
  ?> 

  <div class="content-header">
    <div class="container-fluid">
      <div class="col-xs-12">
        <div class="card">
          <div class="card-body">
            <center>
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                  <tr>
                   <th><center>Id Pair</center></th> 
                   <th><center>Date</center></th>
                   <th><center>Pair</center></th>
                   <th><center>Facility</center></th> 
                   <th><center>Notes</center></th>
                    <th><center>Insert</center></th>
                   <th><center>View</center></th>
                   <th><center>Update</center></th>
                   <th><center>Delete</center></th>
                 </tr>
               </thead>
               <tbody>
                <?php foreach($parejas as $individual_cop){ ?>
                  <tr> 
                    <td><center><?php echo $individual_cop->pair_id; ?></center></td>
                    <td width="10%"><center><?php echo $individual_cop->pairing_date; ?></center></td>
                    <td width="30%"><?php

                    $male_individual1 = $base_de_datos->prepare("SELECT * FROM individuals WHERE id_individual = ?;");
                    $male_individual1->execute([$individual_cop->male_individual1]);
                    $male_1 = $male_individual1->fetch(PDO::FETCH_OBJ);

                    $male_individual2 = $base_de_datos->prepare("SELECT * FROM individuals WHERE id_individual = ?;");
                    $male_individual2->execute([$individual_cop->male_individual2]);
                    $male_2 = $male_individual2->fetch(PDO::FETCH_OBJ);

                    $male_individual3 = $base_de_datos->prepare("SELECT * FROM individuals WHERE id_individual = ?;");
                    $male_individual3->execute([$individual_cop->male_individual3]);
                    $male_3 = $male_individual3->fetch(PDO::FETCH_OBJ);

                    $female_individual1 = $base_de_datos->prepare("SELECT * FROM individuals WHERE id_individual = ?;");
                    $female_individual1->execute([$individual_cop->female_individual1]);
                    $fame_1 = $female_individual1->fetch(PDO::FETCH_OBJ);

                    $female_individual2 = $base_de_datos->prepare("SELECT * FROM individuals WHERE id_individual = ?;");
                    $female_individual2->execute([$individual_cop->female_individual2]);
                    $fame_2 = $female_individual2->fetch(PDO::FETCH_OBJ);

                    $female_individual3 = $base_de_datos->prepare("SELECT * FROM individuals WHERE id_individual = ?;");
                    $female_individual3->execute([$individual_cop->female_individual3]);
                    $fame_3 = $female_individual3->fetch(PDO::FETCH_OBJ);



                    if ($individual_cop->male_individual1 != 0){?>
                      <div class="row"> 
                        <div class="col-5" style="background-color:<?php echo $male_1->left_ring_color ?> ; border: 1px solid #000000">
                          <center>
                            <font color="<?php echo $male_1->left_letter_color ?>"><?php echo $male_1->left_ring_numer ?></font>
                          </center>
                        </div>
                        <div class="col-2"><center><?php echo $male_1->id_individual ?></center></div>
                        <div class="col-5" style="background-color:<?php echo $male_1->right_ring_color ?> ; border: 1px solid #000000">
                          <center>
                            <font color="<?php echo $male_1->right_letter_color ?>"><?php echo $male_1->right_ring_numer ?></font>
                          </center>
                        </div>
                      </div>
                      <div class="w-100"><br></div>
                    <?php }else{ ?>
                      <div class="row"> 
                        <div class="col-5"></div>
                        <div class="col-2"></div>
                        <div class="col-5"></div>
                      </div>
                      <div class="w-100"><br></div>
                    <?php } 
                    if ($individual_cop->male_individual2 != 0){?>
                      <div class="row"> 
                        <div class="col-5" style="background-color:<?php echo $male_2->left_ring_color ?> ; border: 1px solid #000000">
                          <center>
                            <font color="<?php echo $male_2->left_letter_color ?>"><?php echo $male_2->left_ring_numer ?></font>
                          </center>
                        </div>
                        <div class="col-2"><center><?php echo $male_2->id_individual ?></center></div>
                        <div class="col-5" style="background-color:<?php echo $male_2->right_ring_color ?> ; border: 1px solid #000000">
                          <center>
                            <font color="<?php echo $male_2->right_letter_color ?>"><?php echo $male_2->right_ring_numer ?></font>
                          </center>
                        </div>
                      </div>
                      <div class="w-100"><br></div>
                    <?php }else{ ?>
                      <div class="row"> 
                        <div class="col-5"></div>
                        <div class="col-2"></div>
                        <div class="col-5"></div>
                      </div>
                      <div class="w-100"><br></div>
                    <?php } 
                    if ($individual_cop->male_individual3 != 0){?>
                      <div class="row"> 
                        <div class="col-5" style="background-color:<?php echo $male_3->left_ring_color ?> ; border: 1px solid #000000">
                          <center>
                            <font color="<?php echo $male_3->left_letter_color ?>"><?php echo $male_3->left_ring_numer ?></font>
                          </center>
                        </div>
                        <div class="col-2"><center><?php echo $male_3->id_individual ?></center></div>
                        <div class="col-5" style="background-color:<?php echo $male_3->right_ring_color ?> ; border: 1px solid #000000">
                          <center>
                            <font color="<?php echo $male_3->right_letter_color ?>"><?php echo $male_3->right_ring_numer ?></font>
                          </center>
                        </div>
                      </div>
                      <div class="w-100"><br></div>
                    <?php }else{ ?>
                      <div class="row"> 
                        <div class="col-5"></div>
                        <div class="col-2"></div>
                        <div class="col-5" ></div>
                      </div>
                      <div class="w-100"><br></div>
                    <?php }
                    if ($individual_cop->female_individual1 != 0){?>
                      <div class="row"> 
                        <div class="col-5" style="background-color:<?php echo $fame_1->left_ring_color ?> ; border: 1px solid #000000">
                          <center>
                            <font color="<?php echo $fame_1->left_letter_color ?>"><?php echo $fame_1->left_ring_numer ?></font>
                          </center>
                        </div>
                        <div class="col-2"><center><?php echo $fame_1->id_individual ?></center></div>
                        <div class="col-5" style="background-color:<?php echo $fame_1->right_ring_color ?> ; border: 1px solid #000000">
                          <center>
                            <font color="<?php echo $fame_1->right_letter_color ?>"><?php echo $fame_1->right_ring_numer ?></font>
                          </center>
                        </div>
                      </div>
                      <div class="w-100"><br></div>
                    <?php }else{ ?>
                      <div class="row"> 
                        <div class="col-5"></div>
                        <div class="col-2"></div>
                        <div class="col-5"></div>
                      </div>
                      <div class="w-100"><br></div>
                    <?php }
                    if ($individual_cop->female_individual2 != 0){?>
                      <div class="row">
                        <div class="col-5" style="background-color:<?php echo $fame_2->left_ring_color ?> ; border: 1px solid #000000">
                          <center>
                            <font color="<?php echo $fame_2->left_letter_color ?>"><?php echo $fame_2->left_ring_numer ?></font>
                          </center>
                        </div>
                        <div class="col-2"><center><?php echo $fame_2->id_individual ?></center></div>
                        <div class="col-5" style="background-color:<?php echo $fame_2->right_ring_color ?> ; border: 1px solid #000000">
                          <center>
                            <font color="<?php echo $fame_2->right_letter_color ?>"><?php echo $fame_2->right_ring_numer ?></font>
                          </center>
                        </div>
                      </div>
                      <div class="w-100"><br></div>

                    <?php }else{ ?>
                      <div class="row"> 
                        <div class="col-5"></div>
                        <div class="col-2"></div>
                        <div class="col-5"></div>
                      </div>
                      <div class="w-100"><br></div>
                    <?php }  
                    if ($individual_cop->female_individual3 != 0){?>
                      <div class="row"> 
                        <div class="col-5" style="background-color:<?php echo $fame_3->left_ring_color ?> ; border: 1px solid #000000">
                          <center>
                            <font color="<?php echo $fame_3->left_letter_color ?>"><?php echo $fame_3->left_ring_numer ?></font>
                          </center>
                        </div>
                        <div class="col-2"><center><?php echo $fame_3->id_individual ?></center></div>
                        <div class="col-5" style="background-color:<?php echo $fame_3->right_ring_color ?> ; border: 1px solid #000000">
                          <center
                          ><font color="<?php echo $fame_3->right_letter_color ?>"><?php echo $fame_3->right_ring_numer ?></font>
                        </center>
                      </div>
                    </div>
                    <div class="w-100"><br></div>
                  <?php }else{ ?>
                    <div class="row"> 
                      <div class="col-5"></div>
                      <div class="col-2"></div>
                      <div class="col-5"></div>
                    </div>
                    <div class="w-100"><br></div> 
                  <?php } ?>
                </td>
                <td width="20%"><center>
                  <?php 
                  $sentencia_fac = $base_de_datos->prepare("SELECT * FROM facilities WHERE id_facility  = ?;");
                  $sentencia_fac->execute([$individual_cop->id_facility_assignment]);
                  $fac = $sentencia_fac->fetch(PDO::FETCH_OBJ); 
                  echo $fac->name_facility.' - '.$fac->type_facility.' - '.$fac->location.'<br><strong>Notes:</strong> '.$fac->notes ;?> 
                </center></td>
                <td width="30%"><center><?php echo $individual_cop->notes; ?> </center></td> 
                <td>
             <center>
                <a class="btn btn-success btn-sm" href="<?php echo "insert_monitoring.php?id=" .  $individual_cop->pair_id?>"><span data-feather="save"></span></a></center>
              </td>
               <td>
            <center><a class="btn btn-info btn-sm" href="<?php echo "../admin/select_all.php?id=" .  $individual_cop->pair_id?>"><span data-feather="eye"></span></a></center>
          </td>
           <td>
            <center><a class="btn btn-warning btn-sm" href="<?php echo "../admin/select_all.php?id=" .  $individual_cop->pair_id?>"><span data-feather="edit"></span></a></center>
          </td>
           <td>
            <center><a class="btn btn-danger btn-sm" href="<?php echo "../admin/select_all.php?id=" .  $individual_cop->pair_id?>"><span data-feather="trash"></span></a></center>
          </td>
              </tr>
            <?php } ?>
          </tbody> 
        </table>
      </center>
    </div>
  </div>
</div>
</div>
</div>
</main>
<?php  include_once BASE_URL . "/paginas/pie_3.php";   ?>