<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('../inc/head.php'); ?>

    <?php 
        head();
    ?>
    <?php include('../inc/menu.php'); ?>
    <?php include('../inc/footer.php'); ?>
    <?php include('../inc/conexion.php'); ?>




    
</head>
<body >
    
    <?php 
        menu();

        $resultado = pg_query("SELECT * FROM productos");
    ?>
        
    <main class="container mt-5">
        <h1 class="text-center">Nueva oferta</h1>
        <hr>
        <form action="/apis/ofertas.php" method="POST">
            <input type="hidden" name="dispatch" id="exampleFormControlInput1" value="create">
            <div class="form-group">
                <label for="exampleFormControlInput1">Nombre de la oferta</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="nombre">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Descripción</label>
                <textarea class="form-control" name="descripcion" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect2">Seleccione los productos de la oferta</label>
                <select id="distriList" name="distriList" multiple="multiple" class="form-control" >
                    <?php 
                        while ($fila = pg_fetch_assoc($resultado)) {
                            echo "<option value='".$fila['id']."'>".$fila['nombre']."</option>";
                        }
                        ?>
                </select>
                <a href="javascript:void(0);" id="addPop">Agregar</a>
                <select id="selectDistriList" name="productos[]" multiple="multiple" class="form-control" >
                    
                </select>
                <a href="javascript:void(0);" id="removePop">Suprimir</a>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Precio</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="precio" >
            </div>
            <div class="form-group">
                <label for="estadoCategoria">Estado</label>
                <select name="estado" id="estado" class="form-control">
                    <option value="HA" selected>Habilitada</option>
                    <option value="DH">Deshabilitada</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Nombre de la imagen</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="imagen" >
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><i class="fas fa-plus-circle"></i> Agregar</button>
                <a href="/admin/ofertas.php" class="btn btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i> Volver</a>
            </div>
        </form>
    </main>

    <?php 
        footer();
    ?>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

    <script>
        $('#addPop').click(function () {
          if ($('#distriList option:selected').val() != null) {
              var tempSelect = $('#distriList option:selected').val();
              $('#distriList option:selected').remove().appendTo('#selectDistriList');
              $("#distriList").attr('selectedIndex', '-1').find("option:selected").removeAttr("selected");
              //$("#selectDistriList").attr('selectedIndex', '-1').find("option:selected").removeAttr("selected");
              $("#selectDistriList").val(tempSelect);
              tempSelect = '';
          } else {
              alert("Before add please select any position.");
          }
      });

      $('#removePop').click(function () {
          if ($('#selectDistriList option:selected').val() != null) {
              var tempSelect = $('#selectDistriList option:selected').val();
              $('#selectDistriList option:selected').remove().appendTo('#distriList');
              $("#selectDistriList").attr('selectedIndex', '-1').find("option:selected").removeAttr("selected");
              $("#distriList").attr('selectedIndex', '-1').find("option:selected").removeAttr("selected");
              $("#distriList").val(tempSelect);
              tempSelect = '';
          } else {
              alert("Before remove please select any position.");
          }
      });
    
    
    
    </script>
</body>
</html>