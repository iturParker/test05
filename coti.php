<!--inicio del contenido-->
<?php
require_once 'vistas/parteSuperior.php';
 ?>
 <div class="container">
   <h1>Registro de Cotizaciones</h1>
   <?php
   include_once 'bd/conexion.php';
   $objeto = new Conexion();
   $conexion = $objeto->Conectar();

   $consulta = "SELECT * FROM coti";
   $resultado = $conexion->prepare($consulta);
   $resultado->execute();
   $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
   ?>

   <div class="container"> <?php // IDEA: Boton Nuevo ?>
       <div class="row">
           <div class="col-lg-12">
           <button id="btnNuevoC" type="button" class="btn btn-success" data-toggle="modal">Nueva Cotizacion</button>
           </div>
       </div>
   </div>
   <br>
   <div class="container"> <?php // IDEA: Tabla ?>
       <div class="row">
               <div class="col-lg-12">
                   <div class="table-responsive">
                       <table id="tablaCoti" class="table table-striped table-bordered table-condensed" style="width:100%">
                       <thead class="text-center">
                           <tr>
                               <th>Id</th>
                               <th>Nombre del Cliente</th>
                               <th>no.Cliente</th>
                               <th>Nombre del Servicio</th>
                               <th>Area del Servicio</th>
                               <th>Descripcion del Servicio</th>
                               <th>Norma Aplicada</th>
                               <th>Tiempo de entrega</th>
                               <th>Acreditaciones</th>
                               <th>Observaciones</th>
                               <th>Costo Unitario</th>
                               <th>Cantidad</th>
                               <th>Costo Total</th>
                           </tr>
                       </thead>
                       <tbody>
                           <?php
                           foreach($data as $dat) {
                           ?>
                           <tr>
                               <td><?php echo $dat['id'] ?></td>
                               <td><?php echo $dat['nameClient'] ?></td>
                               <td><?php echo $dat['noClient'] ?></td>
                               <td><?php echo $dat['nameS'] ?></td>
                               <td><?php echo $dat['area'] ?></td>
                               <td><?php echo $dat['descripS'] ?></td>
                               <td><?php echo $dat['normS'] ?></td>
                               <td><?php echo $dat['timeS'] ?></td>
                               <td><?php echo $dat['accredS'] ?></td>
                               <td><?php echo $dat['obsS'] ?></td>
                               <td><?php echo $dat['costU'] ?></td>
                               <td><?php echo $dat['cant'] ?></td>
                               <td><?php echo $dat['costT'] ?></td>
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

   <div class="modal fade bd-example-modal-lg" id="modalCrudC" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"> <?php // IDEA: Modal y Formulario ?>
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel"></h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <form id="formCoti">
                 <div class="modal-body">
                   <div class="form-group"> <?php // IDEA: Clientes ?>
                     <?php
                     $consulta = "SELECT * FROM client";
                     $resultado = $conexion->prepare($consulta);
                     $resultado->execute();
                     $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                     ?>
                     <p for="">Nombre:
                       <select class="" name="" id=nameClient>
                         <?php foreach ($data as $dat): ?>
                           <option value="<?php echo $dat['nombreDelCliente']; ?>">
                             <?php echo $dat['nombreDelCliente']; ?>
                           </option>
                         <?php endforeach; ?>
                       </select>
                     </p>
                     <p for="">Numero del Client:
                       <select class="" name="" id=noClient>
                         <?php foreach ($data as $dat): ?>
                           <option value="<?php echo $dat['id']; ?>">
                             <?php echo $dat['id']; ?>
                           </option>
                         <?php endforeach; ?>
                       </select>
                     </p>

                   </div>

                   <div class="form-group"> <?php // IDEA: Servicios ?>
                     <?php
                     $consulta = "SELECT * FROM services";
                     $resultado = $conexion->prepare($consulta);
                     $resultado->execute();
                     $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                     ?>
                     <p for="">Nombre del Servicio:
                       <select class="" name="" id=nameS>
                         <?php foreach ($data as $dat): ?>
                           <option value="<?php echo $dat['nombreS']; ?>">
                             <?php echo $dat['nombreS']; ?>
                           </option>
                         <?php endforeach; ?>
                       </select>
                     </p>
                     <p for="">Area del Servicio:
                       <select class="" name="" id=area>
                         <?php foreach ($data as $dat): ?>
                           <option value="<?php echo $dat['service']; ?>">
                             <?php echo $dat['service']; ?>
                           </option>
                         <?php endforeach; ?>
                       </select>
                     </p>
                     <p for="">Descripcion del Servicio:
                       <select class="" name="" id=descripS>
                         <?php foreach ($data as $dat): ?>
                           <option value="<?php echo $dat['descripS']; ?>">
                             <?php echo $dat['descripS']; ?>
                           </option>
                         <?php endforeach; ?>
                       </select>
                     </p>
                     <p for="">Norma aplicada:
                       <select class="" name="" id=normS>
                         <?php foreach ($data as $dat): ?>
                           <option value="<?php echo $dat['normS']; ?>">
                             <?php echo $dat['normS']; ?>
                           </option>
                         <?php endforeach; ?>
                       </select>
                     </p>
                     <p for="">Tiempo de entrega:
                       <select class="" name="" id=timeS>
                         <?php foreach ($data as $dat): ?>
                           <option value="<?php echo $dat['timeS']; ?>">
                             <?php echo $dat['timeS']; ?>
                           </option>
                         <?php endforeach; ?>
                       </select>
                     </p>
                     <p for="">Acreditaciones:
                       <select class="" name="" id=accredS>
                         <?php foreach ($data as $dat): ?>
                           <option value="<?php echo $dat['accredS']; ?>">
                             <?php echo $dat['accredS']; ?>
                           </option>
                         <?php endforeach; ?>
                       </select>
                     </p>
                     <p for="">Observaciones:
                       <select class="" name="" id=obsS>
                         <?php foreach ($data as $dat): ?>
                           <option value="<?php echo $dat['obsS']; ?>">
                             <?php echo $dat['obsS']; ?>
                           </option>
                         <?php endforeach; ?>
                       </select>
                     </p>
                     <p for="">Costo Unitario:
                       <select class="" name="" id=costU>
                         <?php foreach ($data as $dat): ?>
                           <option value="<?php echo $dat['costU']; ?>">
                             <?php echo $dat['costU']; ?>
                           </option>
                         <?php endforeach; ?>
                       </select>
                     </p>

                   </div>

                   <div class="form-group">
                     <label for="cant" class="col-form-label">Cantidad:</label>
                     <input type="number" class="form-control" id="cant">
                   </div>
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
