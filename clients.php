<!--inicio del contenido-->
<?php
require_once 'vistas/parteSuperior.php';
 ?>

 <?php // IDEA: CONTENIDO  ?>
 <div class="container">
   <h1>Registro de Clientes</h1>

   <?php
   include_once 'bd/conexion.php';
   $objeto = new Conexion();
   $conexion = $objeto->Conectar();

   $consulta = "SELECT * FROM client";
   $resultado = $conexion->prepare($consulta);
   $resultado->execute();
   $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
   ?>

       <div class="container">
           <div class="row">
               <div class="col-lg-12">
               <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Agregar Cliente</button>
               </div>
           </div>
       </div>
       <br>
       <div class="container">
           <div class="row">
                   <div class="col-lg-12">
                       <div class="table-responsive">
                           <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                           <thead>
                               <tr>
                                   <th>ID</th>
                                   <th>Nombre Del Cliente</th>
                                   <th>RFC</th>
                                   <th>Direccion Fiscal</th>
                                   <th>Direccion Fisica</th>
                                   <th>Nombre de Contacto 1</th>
                                   <th>Nombre de Contacto 2</th>
                                   <th>Puesto de Contacto 1</th>
                                   <th>Puesto de Contacto 2</th>
                                   <th>Telefono de Contacto 1</th>
                                   <th>Telefono de Contacto 2</th>
                                   <th>Correo de Contacto 1</th>
                                   <th>Correo de Contacto 2</th>
                                   <th>Terminos de Pago</th>
                                   <th>Plazo de gracia</th>
                                   <th>Acciones</th>
                               </tr>
                           </thead>
                           <tbody>
                               <?php
                               foreach($data as $dat) {
                               ?>
                               <tr>
                                   <td><?php echo $dat['id'] ?></td>
                                   <td><?php echo $dat['nombreDelCliente'] ?></td>
                                   <td><?php echo $dat['rfc'] ?></td>
                                   <td><?php echo $dat['dirFis'] ?></td>
                                   <td><?php echo $dat['dirFi'] ?></td>
                                   <td><?php echo $dat['nCon1'] ?></td>
                                   <td><?php echo $dat['nCon2'] ?></td>
                                   <td><?php echo $dat['pCon1'] ?></td>
                                   <td><?php echo $dat['pCon2'] ?></td>
                                   <td><?php echo $dat['tCon1'] ?></td>
                                   <td><?php echo $dat['tCon2'] ?></td>
                                   <td><?php echo $dat['mCon1'] ?></td>
                                   <td><?php echo $dat['mCon2'] ?></td>
                                   <td><?php echo $dat['tPago'] ?></td>
                                   <td><?php echo $dat['pPago'] ?></td>
                                   <td></td>
                               </tr>
                               <?php
                                   }
                               ?>
                           </tbody>
                          </table>
                       </div>
                   </div>
           </div>
       </div>

       <div class="modal fade bd-example-modal-lg" id="modalRead" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg" role="document">
           <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel"></h5>
             </div>
             <div class="modal-body">
               <p>Nombre de al cliente:</p>
               <p>RFC:</p>
               <p>Direccion Fiscal:</p>

             </div>
           </div>
         </div>
       </div>


   <!--Modal para CRUD-->
   <div class="modal fade bd-example-modal-lg" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel"></h5>
               </div>
           <form id="formPersonas">
               <div class="modal-body">
                   <div class="form-group">
                   <label for="nombreDelCliente" class="col-form-label">Nombre:</label>
                   <input type="text" class="form-control" id="nombreDelCliente">
                   </div>
                   <div class="form-group">
                   <label for="rfc" class="col-form-label">RFC:</label>
                   <input type="text" class="form-control" id="rfc">
                   </div>
                   <div class="form-group">
                   <label for="dirFis" class="col-form-label">Direccion Fiscal:</label>
                   <input type="texts" class="form-control" id="dirFis">
                   </div>
                   <div class="form-group">
                   <label for="dirFi" class="col-form-label">Direccion Fisica:</label>
                   <input type="texts" class="form-control" id="dirFi">
                   </div>
                   <p>Contactos: <br><br>
                     <input type="text" id="nCon1" size="40" placeholder="Nombre de Contacto 1">
                     <input type="text" id="nCon2" size="40" placeholder="Nombre de Contacto 2"><br><br>
                     <input type="text" id="pCon1" size="40" placeholder="Puesto de Contacto 1">
                     <input type="text" id="pCon2" size="40" placeholder="Puesto de Contacto 2"><br><br>
                     <input type="tel" id="tCon1" size="40" placeholder="Telefono de Contacto 1">
                     <input type="tel" id="tCon2" size="40" placeholder="Telefono de Contacto 2"><br><br>
                     <input type="email" id="mCon1" size="40" placeholder="Correo de Contacto 1">
                     <input type="email" id="mCon2" size="40" placeholder="Correo de Contacto 2"><br><br>
                   </p>
                   <p>Terminos de Pago: <select id="tPago">
                         <option>7 Dias</option>
                         <option>15 Dias</option>
                         <option>30 Dias</option>
                         <option>45 Dias</option>
                         <option>60 Dias</option>
                         <option>90 Dias</option>
                         <option>120 Dias</option>
                   </select></p>
                   <p>Plazo de gracia de Terminos de Pago: <select id="pPago">
                         <option>7 Dias</option>
                         <option>10 Dias</option>
                         <option>15 Dias</option>
                         <option>21 Dias</option>
                         <option>30 Dias</option>
                   </select></p>

               </div>
               <div class="modal-footer">
                   <button type="reset" class="btn btn-light">Borrar</button>
                   <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
               </div>
           </form>
           </div>
       </div>
   </div>


 </div>
<!--final del cintenido-->
 <?php
require_once 'vistas/parteInferior.php';
  ?>
