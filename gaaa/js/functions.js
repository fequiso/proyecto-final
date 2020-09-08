
$(document).ready(function(){

    //--------------------- SELECCIONAR FOTO PRODUCTO ---------------------
    $("#foto").on("change",function(){
    	var uploadFoto = document.getElementById("foto").value;
        var foto       = document.getElementById("foto").files;
        var nav = window.URL || window.webkitURL;
        var contactAlert = document.getElementById('form_alert');

            if(uploadFoto !='')
            {
                var type = foto[0].type;
                var name = foto[0].name;
                if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png')
                {
                    contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';
                    $("#img").remove();
                    $(".delPhoto").addClass('notBlock');
                    $('#foto').val('');
                    return false;
                }else{
                        contactAlert.innerHTML='';
                        $("#img").remove();
                        $(".delPhoto").removeClass('notBlock');
                        var objeto_url = nav.createObjectURL(this.files[0]);
                        $(".prevPhoto").append("<img id='img' src="+objeto_url+">");
                        $(".upimg label").remove();

                    }
              }else{
              	alert("No selecciono foto");
                $("#img").remove();
              }
    });

    $('.delPhoto').click(function(){
    	$('#foto').val('');
    	$(".delPhoto").addClass('notBlock');
    	$("#img").remove();

      if ($("#foto_actual") && $("#foto_remove")){
           $("#foto_remove").val('img_producto.png');
      }

    });
    // modal fomr add_product
    $('.add_product').click(function(e){
      e.preventDefault();
      var producto = $(this).attr('product');
      var action = 'infoProducto';


      $.ajax({
        url: 'ajax.php',
        type: 'POST',
        async: true,
        data: {action:action,producto:producto},

          success: function(response){
            if (response != 'error') {

              var info = JSON.parse(response);
             // $('#producto_id').val(info.codproducto);
              //$('.nameProducto').html(info.descripcion);

              $('.bodyModal').html('<form action="" method="post" name="form_add_product" id="form_add_product" onsubmit="event.preventDefault();sendDataProduct(); ">'+
                                      '<h1>agregar producto</h1>'+
                                      '<h2 class="nameProducto">'+info.descripcion+'</h2><br>'+
                                      '<input type="number" name="cantidad" id="txtCantidad" placeholder="cantidad del producto"'+
                                      'required><br>'+
                                      '<input type="text" name="precio" id="txtPrecio" placeholder="precio del producto" required>'+

                                      '<input type="hidden" name="producto_id" id="producto_id" value="'+info.codproducto+'" required>'+
                                      '<input type="hidden" name="action" value="addProduct" required>'+
                                      '<div class="alert alertAddProduct"></div>'+

                                      '<button type="submit" class="btn_new">agregar</button>'+
                                      '<a href="#" class="btn_ok closeModal" onclick="coloseModal();">cerrar</a>'+
                                    '</form>');

            }

          },

          error: function(error) {
            console.log(error);
          }
      });

      $('.modal').fadeIn();
    });

    // modal fomr delet_product
    $('.del_product').click(function(e){
      e.preventDefault();
      var producto = $(this).attr('product');
      var action = 'infoProducto';


      $.ajax({
        url: 'ajax.php',
        type: 'POST',
        async: true,
        data: {action:action,producto:producto},

          success: function(response){
            if (response != 'error') {

              var info = JSON.parse(response);
             // $('#producto_id').val(info.codproducto);
              //$('.nameProducto').html(info.descripcion);

              $('.bodyModal').html('<form action="" method="post" name="form_del_product" id="form_del_product" onsubmit="event.preventDefault();delProduct(); ">'+
                                      '<h1>eliminar producto</h1><br>'+
                                      '<p>¿Está serguro que quiere eliminar el producto?<p>'+
                                      '<h2 class="nameProducto">'+info.descripcion+'</h2><br>'+

                                      '<input type="hidden" name="producto_id" id="producto_id" value="'+info.codproducto+'" required>'+
                                      '<input type="hidden" name="action" value="delProduct" required>'+
                                      '<div class="alert alertAddProduct"></div>'+

                                      '<a href="#" class="btn_cancel" onclick="coloseModal();">Cerrar</a>'+
                                      '<button type="submit" class="btn_ok">Eliminar</button>'+
                                    '</form>');

            }

          },

          error: function(error) {
            console.log(error);
          }
      });

      $('.modal').fadeIn();
    });

    //
    $('#search_proveedor').change(function(e){
      e.preventDefault();
      var gaaa = getUrl(); //gaaa es el carpeta
      location.href = gaaa+'buscar_productos.php?proveedor='+$(this).val();
    });

    //Activa campos para registrar cliente
    $('.btn_new_cliente').click(function(e){
      e.preventDefault();
      $('#nom_cliente').removeAttr('disabled');
      $('#tel_cliente').removeAttr('disabled');
      $('#dir_cliente').removeAttr('disabled');

      $('#div_registro_cliente').slideDown();
    });

    //buscar cliente
    $('#nit_cliente').keyup(function(e){
      e.preventDefault();

      var cl = $(this).val();
      var action = 'searchCliente';
      $.ajax({
        url: 'ajax.php',
        type: "POST",
        async: true,
        data: {action:action,cliente:cl},

        success: function(response)
        {
          if (response == 0) {
            $('#idcliente').val('');
            $('#nom_cliente').val('');
            $('#tel_cliente').val('');
            $('#dir_cliente').val('');
            //mostrar boto agregar
            $('.btn_new_cliente').slideDown();
          }else {
            var data = $.parseJSON(response);
            $('#idcliente').val(data.idcliente);
            $('#nom_cliente').val(data.nombre);
            $('#tel_cliente').val(data.telefono);
            $('#dir_cliente').val(data.direccion);
            //ocultar boton agregar
            $('.btn_new_cliente').slideUp();

            //bloque campos
            $('#nom_cliente').attr('disabled','disabled');
            $('#tel_cliente').attr('disabled','disabled');
            $('#dir_cliente').attr('disabled','disabled');

            //ocultar boton GUARDAR
            $('#div_registro_cliente').slideUp();
          }
        },
        error: function(error){
        }
      });

    });

    //crear Cliente - ventas
    $('#form_new_cliente_venta').submit(function(e) {
      e.preventDefault();

      $.ajax({
        url: 'ajax.php',
        type: "POST",
        async: true,
        data: $('#form_new_cliente_venta').serialize(),

        success: function(response)
        {
           if (response != 'error') {
             //agregar id a input hidden
             $('#idcliente').val(response);
             //bloque campos
             $('#nom_cliente').attr('disabled','disabled');
             $('#tel_cliente').attr('disabled','disabled');
             $('#dir_cliente').attr('disabled','disabled');

             //ocultar boton agregar
             $('.btn_new_cliente').slideUp();
             //ocultar boton GUARDAR
             $('#div_registro_cliente').slideUp();
           }
        },
        error: function(error){
        }
      });
    });

    //buscar producto
    $('#txt_cod_producto').keyup(function(e){
      e.preventDefault();

      var producto = $(this).val();
      var action = 'infoProducto';
      if (producto != '') {
        $.ajax({
          url: 'ajax.php',
          type: "POST",
          async: true,
          data: {action:action,producto:producto},

          success: function(response)
          {
            if (response != 'ERROR') {
              var info = JSON.parse(response);
              $('#txt_descripcion').html(info.descripcion);
              $('#txt_existencia').html(info.existencia);
              $('#txt_cant_producto').val('1');
              $('#txt_precio').html(info.precio);
              $('#txt_precio_total').html(info.precio);

              //activar cantidad
              $('#txt_cant_producto').removeAttr('disabled');

              //mostrar boton agregar
              $('#add_product_venta').slideDown();
            } else {
              $('#txt_descripcion').html('-');
              $('#txt_existencia').html('-');
              $('#txt_cant_producto').val('0');
              $('#txt_precio').html('0.00');
              $('#txt_precio_total').html('0.00');

              // bloquear cantidad
              $('#txt_cant_producto').attr('disabled','disabled');

              //ocultar boton Agregar
              $('#add_product_venta').slideUp();
            }
          },
          error: function(error){
          }
        });
      }
    });

    //validad cantidad del producto antes de Agregar
    $('#txt_cant_producto').keyup(function(e) {
      e.preventDefault();

      var precio_total = $(this).val() * $('#txt_precio').html();
      var existencia = parseInt($('#txt_existencia').html());
      $('#txt_precio_total').html(precio_total);

      //ocultar el boto agregar si la cantidad es menor que 1
      if (($(this).val() < 1 || isNaN($(this).val())) || ($(this).val() > existencia)) {
        $('#add_product_venta').slideUp();
      }else {
        $('#add_product_venta').slideDown();
      }
    });

    //agregar el producto al cliente
    $('#add_product_venta').click(function(e) {
      e.preventDefault();

      if ($('#txt_cant_producto').val() > 0) {
        var codproducto = $('#txt_cod_producto').val();
        var cantidad = $('#txt_cant_producto').val();
        var action = 'addProductoDetalle';

        $.ajax({
          url: 'ajax.php',
          type: "POST",
          async: true,
          data: {action:action,producto:codproducto,cantidad:cantidad},

          success: function(response)
          {
            if (response != 'error') {
              var info = JSON.parse(response);
              $('#detalle_venta').html(info.detalle);
              $('#detalle_totales').html(info.totales);

              $('#txt_cod_producto').val('');
              $('#txt_descripcion').html('-');
              $('#txt_existencia').html('-');
              $('#txt_cant_producto').val('0');
              $('#txt_precio').html('0.00');
              $('#txt_precio_total').html('0.00');

              //bloquear Cantidad
              $('#txt_cant_producto').attr('disabled','disabled');

              //ocultar boton agregar
              $('#add_product_venta').slideUp();

            }else {
              console.log('no data');
            }
            viewProcesar();
          },
          error: function(error){
          }
        });
      }
    });

    //anular venta
    $('#btn_anular_venta').click(function(e) {
      e.preventDefault();

      var rows = $('#detalle_venta tr').length;
      if (rows > 0) {
        var action = 'anularVenta';

        $.ajax({
          url: 'ajax.php',
          type: "POST",
          async: true,
          data: {action:action},

          success: function(response)
          {
              if (response != 'error')
              {
                location.reload();
              }
          },
          error: function(error){
          }
        });
      }
    });

});//final gaaaaaaaaaaaaaaaaaaaaaaaa

//eliminar
function del_product_detalle(correlativo) {
  var action = 'delProductoDetalle';
  var id_detalle = correlativo;
      $.ajax({
        url: 'ajax.php',
        type: "POST",
        async: true,
        data: {action:action,id_detalle:id_detalle},

        success: function(response)
        {
            if (response != 'error') {
              var info = JSON.parse(response);

              $('#detalle_venta').html(info.detalle);
              $('#detalle_totales').html(info.totales);

              $('#txt_cod_producto').val('');
              $('#txt_descripcion').html('-');
              $('#txt_existencia').html('-');
              $('#txt_cant_producto').val('0');
              $('#txt_precio').html('0.00');
              $('#txt_precio_total').html('0.00');

              //bloquear Cantidad
              $('#txt_cant_producto').attr('disabled','disabled');

              //ocultar boton agregar
              $('#add_product_venta').slideUp();

            }else {
              $('#detalle_venta').html('');
              $('#detalle_totales').html('');
            }
            viewProcesar();
        },
        error: function(error){
        }
      });
}

//mostrar/ocultar boton porcesar
function viewProcesar() {
  if ($('#detalle_venta tr').length > 0) {
      $('#btn_facturar_venta').show();
  }else {
      $('#btn_facturar_venta').hide();
  }
}

function serchForDetalle(id){
  var action = 'serchForDetalle';
  var user = id;
      $.ajax({
        url: 'ajax.php',
        type: "POST",
        async: true,
        data: {action:action,user:user},

        success: function(response)
        {
            if (response != 'error') {
              var info = JSON.parse(response);
              $('#detalle_venta').html(info.detalle);
              $('#detalle_totales').html(info.totales);
            }else {
              console.log('no data');
            }
            viewProcesar();
        },
        error: function(error){
        }
      });
}

function getUrl() {
  var loc = window.location;
  var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/')+1);
  return loc.href.substring(0, loc.href.length -((loc.pathname + loc.search + loc.hash).length - pathName.length));
}

function sendDataProduct() {
  $('.alertAddProduct').html('');
  $.ajax({
    url: 'ajax.php',
    type: 'POST',
    async: true,
    data: $('#form_add_product').serialize(),

      success: function(response){
        if (response == 'error') {
          $('.alertAddProduct').html('<p style"color: red" >error al agregar producto</p>');
        }else{
          var info = JSON.parse(response);
          $('.row'+info.producto_id+'.celPrecio').html(info.nuevo_precio);
          $('.row'+info.producto_id+'.celExistencia').html(info.nueva_existencia);
          $('#txtCantidad').val('');
          $('#txtPrecio').val('');
          $('.alertAddProduct').html('<p>producto agregado correcto</p>');
        }
      },

      error: function(error) {
        console.log(error);
      }
  });

}

//eliminar producto

function delProduct() {
  var pr = $('#producto_id').val();
  $('.alertAddProduct').html('');
  $.ajax({
    url: 'ajax.php',
    type: 'POST',
    async: true,
    data: $('#form_del_product').serialize(),

      success: function(response){
        console.log(response);

        if (response == 'error') {
          $('.alertAddProduct').html('<p style"color: red" >error al eliminar producto</p>');
        }else{
          $('.row'+pr).remove();
          $('#form_del_product .btn_ok').remove();
          $('.alertAddProduct').html('<p>producto eliminado correcto</p>');
        }

      },

      error: function(error) {
        console.log(error);
      }
  });

}

function coloseModal(){
  $('.alertAddProduct').html('');
  $('#txtCantidad').val('');
  $('#txtPrecio').val('')
  $('.modal').fadeOut();
}
