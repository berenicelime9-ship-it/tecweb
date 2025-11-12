$(document).ready(function() {
    let edit = false;

    $('#product-result').hide();
    listarProductos();

    function listarProductos() {
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function(response) {
                const productos = JSON.parse(response);
                if(Object.keys(productos).length > 0) {
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
            }
        });
    }

    // VALIDACIÓN DE NOMBRE EN TIEMPO REAL
    $("#nombre").on("input blur", function() {
        const nombre = $(this).val().trim();
        if(nombre) {
            $.get('./backend/product-search.php?nombre=' + encodeURIComponent(nombre), function(response){
                const data = JSON.parse(response);
                if(Object.keys(data).length > 0) {
                    $("#statusNombre").text("⚠ Este producto ya existe en la BD").css("color", "red");
                } else {
                    $("#statusNombre").text("Ya existe en la BD").css("color", "green");
                }
            });
        } else {
            $("#statusNombre").text("Este campo es requerido").css("color", "red");
        }
    });

    // VALIDACIÓN AL PERDER FOCO
    $("#nombre, #marca, #modelo, #precio, #unidades, #detalles").on("blur", function() {
        const campo = this.id;
        const valor = $(this).val().trim();
        validarYMostrar(campo, valor);
    });

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
                if(!valor) msg = "El precio es requerido";
                break;
            case "unidades":
                if(!valor) msg = "Unidades requeridas";
                break;
        }
        $("#status" + capitalize(campo)).text(msg).css("color", "red");
        return msg === "";
    }

    function capitalize(str){
        return str.charAt(0).toUpperCase() + str.slice(1);
    }

    // ENVÍO DEL FORMULARIO
    $('#product-form').submit(function(e){
        e.preventDefault();
        let campos = ["nombre","marca","modelo","precio","unidades"];
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
        $.post(url, postData, function(response){
            let res = JSON.parse(response);
            $("#statusBar").text(res.message).css("color", res.status === "ok" ? "green" : "red");
            $('#product-form')[0].reset();
            listarProductos();
            edit = false;
        });
    });

    // ELIMINAR PRODUCTO
    $(document).on('click', '.product-delete', function(){
        if(confirm('¿Deseas eliminar este producto?')){
            const element = $(this).closest("tr");
            const id = $(element).attr("productId");
            $.post('./backend/product-delete.php', {id}, function(){
                listarProductos();
            });
        }
    });

    // EDITAR PRODUCTO
    $(document).on('click', '.product-item', function(e){
        e.preventDefault();
        const element = $(this).closest("tr");
        const id = $(element).attr("productId");
        $.post('./backend/product-single.php', {id}, function(response){
            let product = JSON.parse(response);
            $('#nombre').val(product.nombre);
            $('#marca').val(product.marca);
            $('#modelo').val(product.modelo);
            $('#precio').val(product.precio);
            $('#unidades').val(product.unidades);
            $('#detalles').val(product.detalles);
            $('#imagen').val(product.imagen);
            $('#productId').val(product.id);
            edit = true;
        });
    });
});
