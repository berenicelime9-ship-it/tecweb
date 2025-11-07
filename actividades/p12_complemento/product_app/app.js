// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;
    document.getElementById("name").value="";
}

// Conforme se vayan presionando teclas en la búsqueda
$(document).ready(function() {
  // Global Settings
  let edit = false;

  listarProductos();
  $('#product-result').hide();


  // search key type event
  $('#search').keyup(function() {
    if($('#search').val()) {
      let search = $('#search').val();
      $.ajax({
        url: './backend/product-search.php',
        data: {search},
        type: 'GET',
        success: function (response) {
          if(!response.error) {
            let products = JSON.parse(response);
            let template = '';
            let template_bar = '';
            let descripcion = '';
            products.forEach(product => {

                descripcion = '';
                descripcion += '<li>precio: '+product.precio+'</li>';
                descripcion += '<li>unidades: '+product.unidades+'</li>';
                descripcion += '<li>modelo: '+product.modelo+'</li>';
                descripcion += '<li>marca: '+product.marca+'</li>';
                descripcion += '<li>detalles: '+product.detalles+'</li>';
                
                template += `
                    <tr productId="${product.id}">
                        <td>${product.id}</td>
                        <td>${product.nombre}</td>
                        <td><ul>${descripcion}</ul></td>
                        <td>
                            <button class="product-delete btn btn-danger">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                `;
                template_bar += 
                    `
                     <li><a href="#" class="product-item">${product.nombre}</a></li>
                    `
            });
            $('#product-result').show();
            $('#container').html(template_bar);
            $('#products').html(template);
          }
        } 
      })
    }
  });

    $('#product-form').submit(e => {
        e.preventDefault();

        const finalJSON = {
          nombre: $('#name').val(),
          precio: parseFloat($('#precio').val()),
          unidades: parseInt($('#unidades').val()),
          modelo: $('#modelo').val(),
          marca: $('#marca').val(),
          detalles: $('#detalles').val(),
          imagen: $('#imagen').val() || 'img/default.png'
        };


        const postData = JSON.stringify(finalJSON);

        const url = edit === false 
            ? './backend/product-add.php' 
            : './backend/product-edit.php';
        $.ajax({
            url: url,
            type: 'POST',
            data: postData,
            contentType: 'application/json',
            success: function(response) {
                console.log(response);
                // Respuesta en JSON
                let res;
                try {
                res = JSON.parse(response);
                } catch (e) {
                res = { status: 'error', message: 'Respuesta inválida del servidor' };
                }

                let template_bar = '';
                    template_bar += 
                        `
                        <li style="list-style: none;">status: ${res.status}</li>
                        <li style="list-style: none;">message: ${res.message}</li>
                        `;
                $('#product-result').show();

                // Se muestra el mensaje
                $('#container').html(template_bar);

                listarProductos();
            }
        });

        $('#agregarProducto').text("Agregar Producto");
        edit = false;
    });

  // Fetching products
  function listarProductos() {
    $.ajax({
      url: './backend/product-list.php',
      type: 'GET',
      success: function(response) {
        const products = JSON.parse(response);
        let template = '';
        let descripcion = '';
        products.forEach(product => {
            descripcion = '';
            descripcion += '<li>precio: '+product.precio+'</li>';
            descripcion += '<li>unidades: '+product.unidades+'</li>';
            descripcion += '<li>modelo: '+product.modelo+'</li>';
            descripcion += '<li>marca: '+product.marca+'</li>';
            descripcion += '<li>detalles: '+product.detalles+'</li>';

          template += `
                  <tr productId="${product.id}">
                  <td>${product.id}</td>
                  <td>
                  <a href="#" class="product-item">
                    ${product.nombre} 
                  </a>
                  </td>
                  <td>${descripcion}</td>
                  <td>
                    <button class="product-delete btn btn-danger">
                     Delete 
                    </button>
                  </td>
                  </tr>
                `
        });
        $('#products').html(template);
      }
    });
  }

  // Obtener producto para editarlo
    $(document).on('click', '.product-item', (e) => {

        e.preventDefault();
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('productId');
        $.post('./backend/product-single.php', {id}, (response) => {
            const product = JSON.parse(response);

            let description = {
                "precio" : product.precio,
                "unidades" : product.unidades,
                "modelo" : product.modelo,
                "marca" : product.marca,
                "detalles" : product.detalles,
                "imagen" : product.imagen,
            }
            description = JSON.stringify(description, null, 2)
            
            $('#name').val(product.nombre);
            $('#description').val(description);
            $('#productId').val(product.id);

            $('#agregarProducto').text("Modificar Producto");
            edit = true;
        });
        
    });

    // Eliminar product
    $(document).on('click', '.product-delete', (e) => {
        if(confirm('Estás seguro que quieres eliminarlo?')) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('productId');
            $.ajax({
                url: './backend/product-delete.php',
                type: 'GET',
                data: {id},
                success: function(response) {

                    // Respuesta en JSON
                    let res;
                    try {
                    res = JSON.parse(response);
                    } catch (e) {
                    res = { status: 'error', message: 'Respuesta inválida del servidor' };
                    }

                    let template_bar = '';
                        template_bar += 
                            `
                            <li style="list-style: none;">status: ${res.status}</li>
                            <li style="list-style: none;">message: ${res.message}</li>
                            `;
                    $('#product-result').show();

                    // Se muestra el mensaje
                    $('#container').html(template_bar);

                    listarProductos();
                }
            });
        }
    });
    });