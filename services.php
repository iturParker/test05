<!--inicio del contenido-->
<?php
require_once 'vistas/parteSuperior.php';
 ?>

 <?php // IDEA: Contenido Principal ?>
 <div class="container">
   <h1>Registro de Servicios Ofrecidos</h1>
   <?php
   include_once 'bd/conexion.php';
   $objeto = new Conexion();
   $conexion = $objeto->Conectar();

   $consulta = "SELECT * FROM services";
   $resultado = $conexion->prepare($consulta);
   $resultado->execute();
   $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
   ?>

   <div class="container">
       <div class="row">
           <div class="col-lg-12">
           <button id="btnNuevoS" type="button" class="btn btn-success" data-toggle="modal">Agregar Servicio</button>
           </div>
       </div>
   </div>
   <br>
   <div class="container">
       <div class="row">
               <div class="col-lg-12">
                   <div class="table-responsive">
                       <table id="tablaService" class="table table-striped table-bordered table-condensed" style="width:100%">
                       <thead>
                           <tr>
                               <th>ID</th>
                               <th>Area del Servicio</th>
                               <th>Gerente del area</th>
                               <th>Asistente del area</th>
                               <th>Nombre del Servicio</th>
                               <th>Descripcion del Servicio</th>
                               <th>Norma Correspondiente</th>
                               <th>Tiempo de Entrega</th>
                               <th>Acreditaciones</th>
                               <th>Observaciones del Producto</th>
                               <th>Costo Unitario</th>
                               <th>Acciones</th>
                           </tr>
                       </thead>
                       <tbody>
                           <?php
                           foreach($data as $dat) {
                           ?>
                           <tr>
                               <td><?php echo $dat['id'] ?></td>
                               <td><?php echo $dat['service'] ?></td>
                               <td><?php echo $dat['manager'] ?></td>
                               <td><?php echo $dat['assistant'] ?></td>
                               <td><?php echo $dat['nombreS'] ?></td>
                               <td><?php echo $dat['descripS'] ?></td>
                               <td><?php echo $dat['normS'] ?></td>
                               <td><?php echo $dat['timeS'] ?></td>
                               <td><?php echo $dat['accredS'] ?></td>
                               <td><?php echo $dat['obsS'] ?></td>
                               <td><?php echo $dat['costU'] ?></td>
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


   <div class="modal fade bd-example-modal-lg" id="modalCrudS" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel"></h5>
               </div>
           <form id="formService">
               <div class="modal-body">
                 <p>Area del Servicio: <select id="service">
                   <option>Laboratorio de analisis Fisicos</option>
                   <option>Laboratorio de analisis Analiticos</option>
                   <option>Unidad de Verificacion Ambiental</option>
                   <option>Gestion de Seguridad</option>
                   <option>Sistemas de Gestion</option>
                   <option>Cursos</option>
                   <option>Productos y Materiales</option>
                   <option>Otros</option>
                 </select>
                 </p>
                 <p>Gerente del Area: <select id="manager">
                   <option>Gerente de Laboratorio de analisis Fisicos</option>
                   <option>Gerente de Laboratorio de analisis Analiticos</option>
                   <option>Gerente de Unidad de Verificacion Ambiental</option>
                   <option>Gerente de Gestion de Seguridad</option>
                   <option>Gerente de Sistemas de Gestion</option>
                   <option>Gerente de Cursos</option>
                   <option>Gerente de Productos y Materiales</option>
                   <option>Gerente de Otros</option>
                 </select>
                 </p>
                 <p>Asistente del Area: <select id="assistant">
                   <option>Asistente de Laboratorio de analisis Fisicos</option>
                   <option>Asistente de Laboratorio de analisis Analiticos</option>
                   <option>Asistente de Unidad de Verificacion Ambiental</option>
                   <option>Asistente de Gestion de Seguridad</option>
                   <option>Asistente de Sistemas de Gestion</option>
                   <option>Asistente de Cursos</option>
                   <option>Asistente de Productos y Materiales</option>
                   <option>Asistente de Otros</option>
                 </select>
                 </p>
                 <div class="form-group">
                 <label for="nombreS" class="col-form-label">Nombre del Servicio:</label>
                 <input type="text" class="form-control" id="nombreS">
                 </div>

                 <div class="form-group">
                 <label for="descripS" class="col-form-label">Descripcion del Servicio</label>
                 <input type="texts" class="form-control" id="descripS">
                 </div>
                 <div class="form-group">
                 <label for="normS" class="col-form-label">Norma Correspondiente</label>
                 <input type="texts" class="form-control" id="normS">
                 </div>
                 <div class="form-group">
                 <label for="timeS" class="col-form-label">Tiempo de Entrega</label>
                 <input type="texts" class="form-control" id="timeS">
                 </div>
                 <p>Acreditaciones: <select id="accredS">
                   <option>Acreditado</option>
                   <option>Aprobado</option>
                   <option>Acreditado y Aprobado</option>
                   <option>No Aplica</option>
                 </select> </p>
                 <div class="form-group">
                 <label for="obsS" class="col-form-label">Observaciones</label>
                 <input type="texts" class="form-control" id="obsS">
                 </div>
                 <div class="form-group">
                 <label for="costU" class="col-form-label">Costo Unitario</label>
                 <input type="number" class="form-control" id="costU">
                 </div>


                 <!--<p>Nombre del Podructo o Servicio: <input type="text" name="" value="" size="50"></p>
                 <p>Descripcion del Podructo o Servicio: <input type="text" name="" value="" size="50"></p>
                 <p>Norma Correspndiente: <input type="text" name="" value="" size="50"></p>
                 <p>Tiempo de Entrega: <input type="text" name="" value="" size="30"></p>
                 <p>Acreditaciones: <select id="">
                   <option value="">Acreditado</option>
                   <option value="">Aprobado</option>
                   <option value="">Acreditado y Aprobado</option>
                   <option value="">No Aplica</option>
                 </select> </p>
                 <p>Observaciones del Producto o Servicio: <input type="text" name="" value=""></p>
                 <p>Costo Unitario: <input type="int" name="" value=""></p><br>-->
               </div>
               <div class="modal-footer">
                   <button type="reset" class="btn btn-light">Borrar</button>
                   <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
               </div>
           </form>
           </div>
       </div>
   </div>
   </form>

 </div>
<!--final del cintenido-->
<?php
require_once 'vistas/parteInferior.php';
?>
