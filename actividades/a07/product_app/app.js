function init() {
  // Limpia el formulario
  $('#product-form')[0].reset();
}

$(document).ready(function() {
  let edit = false;

  $('#product-result').hide();
  listarProductos();

  // ==============================
  // === LISTAR PRODUCTOS ========
  // ==============================
  function listarProductos() {
    $.ajax({
      url: './backend/product-list.php',
      type: 'GET',
      success: function(response) {
        const productos = JSON.parse(response);
        let template = '';
        productos.forEach(producto => {
          let descripcion = `
            <li>Precio: ${producto.precio}</li>
            <li>Unidades: ${producto.unidades}</li>
            <li>Modelo: ${producto.modelo}</li>
            <li>Marca: ${producto.marca}</li>
            <li>Detalles: ${producto.detalles}</li>
          `;
          template += `
            <tr productId="${producto.id}">
              <td>${producto.id}</td>
              <td><a href="#" class="product-item">${producto.nombre}</a></td>
              <td><ul>${descripcion}</ul></td>
              <td><button class="product-delete btn btn-danger">Eliminar</button></td>
            </tr>
          `;
        });
        $('#products').html(template);
      }
    });
  }

  // ==============================
  // === BUSCAR PRODUCTOS ========
  // ==============================
  $('#search').keyup(function() {
    let search = $('#search').val().trim();
    if (search) {
      $.ajax({
        url: './backend/product-search.php',
        data: { search },
        type: 'GET',
        success: function(response) {
          let products = JSON.parse(response);
          let template = '';
          products.forEach(product => {
            let desc = `
              <li>Precio: ${product.precio}</li>
              <li>Unidades: ${product.unidades}</li>
              <li>Modelo: ${product.modelo}</li>
              <li>Marca: ${product.marca}</li>
              <li>Detalles: ${product.detalles}</li>
            `;
            template += `
              <tr productId="${product.id}">
                <td>${product.id}</td>
                <td>${product.nombre}</td>
                <td><ul>${desc}</ul></td>
                <td><button class="product-delete btn btn-danger">Eliminar</button></td>
              </tr>`;
          });
          $('#product-result').show();
          $('#container').html(`<li>${products.length} resultados encontrados</li>`);
          $('#products').html(template);
        }
      });
    } else {
      listarProductos();
      $('#product-result').hide();
    }
  });

  // ==============================
  // === VALIDACIÓN DE CAMPOS ====
  // ==============================
  function validarYMostrar(campo, valor) {
    let msg = "";
    switch(campo) {
      case "nombre":
        if(!valor) msg = "El nombre es requerido";
        break;
      case "marca":
        if(!valor) msg = "La marca es requerida";
        break;
      case "modelo":
        if(!valor) msg = "El modelo es requerido";
        break;
      case "precio":
        if(!valor || valor <= 0) msg = "El precio debe ser mayor que 0";
        break;
      case "unidades":
        if(!valor || valor <= 0) msg = "Unidades requeridas";
        break;
    }
    $("#status" + capitalize(campo)).text(msg).css("color", "red");
    return msg === "";
  }

  function capitalize(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
  }

  // ==============================
  // === ENVÍO DE FORMULARIO =====
  // ==============================
  $('#product-form').submit(function(e) {
    e.preventDefault();
    let campos = ["nombre", "marca", "modelo", "precio", "unidades"];
    let todosValidos = true;
    campos.forEach(campo => {
      if(!validarYMostrar(campo, $("#" + campo).val().trim())) todosValidos = false;
    });
    if(!todosValidos) return;

    let postData = {
      nombre: $('#nombre').val().trim(),
      marca: $('#marca').val().trim(),
      modelo: $('#modelo').val().trim(),
      precio: $('#precio').val().trim(),
      unidades: $('#unidades').val().trim(),
      detalles: $('#detalles').val().trim(),
      imagen: $('#imagen').val().trim(),
      id: $('#productId').val()
    };

    const url = edit ? './backend/product-edit.php' : './backend/product-add.php';
    $.ajax({
      url,
      type: 'POST',
      data: JSON.stringify(postData),
      contentType: 'application/json',
      success: function(response) {
        let res;
        try { res = JSON.parse(response); }
        catch(e) { res = {status:"error", message:"Respuesta inválida"}; }
        $('#statusBar').text(res.message)
          .css("color", res.status === "ok" ? "lightgreen" : "red");
        listarProductos();
        $('#product-form')[0].reset();
        $('#agregarProducto').text("Agregar Producto");
        edit = false;
      }
    });
  });

  // ==============================
  // === EDITAR PRODUCTO =========
  // ==============================
  $(document).on('click', '.product-item', function(e) {
    e.preventDefault();
    const element = $(this).closest("tr");
    const id = $(element).attr("productId");
    $.post('./backend/product-single.php', {id}, function(response) {
      let product = JSON.parse(response);
      $('#nombre').val(product.nombre);
      $('#marca').val(product.marca);
      $('#modelo').val(product.modelo);
      $('#precio').val(product.precio);
      $('#unidades').val(product.unidades);
      $('#detalles').val(product.detalles);
      $('#imagen').val(product.imagen);
      $('#productId').val(product.id);
      $('#agregarProducto').text("Modificar Producto");
      edit = true;
    });
  });

  // ==============================
  // === ELIMINAR PRODUCTO =======
  // ==============================
  $(document).on('click', '.product-delete', function() {
    if(confirm('¿Deseas eliminar este producto?')) {
      const element = $(this).closest("tr");
      const id = $(element).attr("productId");
      $.ajax({
        url: './backend/product-delete.php',
        type: 'GET',
        data: {id},
        success: function(response) {
          let res;
          try { res = JSON.parse(response); }
          catch(e) { res = {status:"error", message:"Respuesta inválida"}; }
          $('#statusBar').text(res.message)
            .css("color", res.status === "ok" ? "lightgreen" : "red");
          listarProductos();
        }
      });
    }
  });
});
