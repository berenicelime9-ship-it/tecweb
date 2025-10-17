// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

  
// // FUNCIÓN CALLBACK DE BOTÓN "Buscar"
//     /**
//      * Revisar la siguiente información para entender porqué usar event.preventDefault();
//      * http://qbit.com.mx/blog/2013/01/07/la-diferencia-entre-return-false-preventdefault-y-stoppropagation-en-jquery/#:~:text=PreventDefault()%20se%20utiliza%20para,escuche%20a%20trav%C3%A9s%20del%20DOM
//      * https://www.geeksforgeeks.org/when-to-use-preventdefault-vs-return-false-in-javascript/
//      */

function buscarProducto(e) {
    e.preventDefault();

    var termino = document.getElementById('search').value;

    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE - buscarProducto]\n'+client.responseText);

            let productos = JSON.parse(client.responseText);

            if (Array.isArray(productos) && productos.length > 0) {
                let template = '';

                productos.forEach(p => {
                    let descripcion = '';
                    descripcion += '<li>precio: '+p.precio+'</li>';
                    descripcion += '<li>unidades: '+p.unidades+'</li>';
                    descripcion += '<li>modelo: '+p.modelo+'</li>';
                    descripcion += '<li>marca: '+p.marca+'</li>';
                    descripcion += '<li>detalles: '+p.detalles+'</li>';

                    template += `
                        <tr>
                            <td>${p.id}</td>
                            <td>${p.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;
                });

                document.getElementById("productos").innerHTML = template;
            } else {
                document.getElementById("productos").innerHTML = `<tr><td colspan="3">No se encontraron productos.</td></tr>`;
            }
        }
    };
    client.send("id=" + termino);
}

// FUNCIÓN CALLBACK DE BOTÓN "Agregar Producto"
// function agregarProducto(e) {
//     e.preventDefault();

//     SE OBTIENE DESDE EL FORMULARIO EL JSON A ENVIAR
//     var productoJsonString = document.getElementById('description').value;
//     SE CONVIERTE EL JSON DE STRING A OBJETO
//     var finalJSON = JSON.parse(productoJsonString);
//     SE AGREGA AL JSON EL NOMBRE DEL PRODUCTO
//     finalJSON['nombre'] = document.getElementById('name').value;
//     SE OBTIENE EL STRING DEL JSON FINAL
//     productoJsonString = JSON.stringify(finalJSON,null,2);

//     SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
//     var client = getXMLHttpRequest();
//     client.open('POST', './backend/create.php', true);
//     client.setRequestHeader('Content-Type', "application/json;charset=UTF-8");
//     client.onreadystatechange = function () {
//         SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
//         if (client.readyState == 4 && client.status == 200) {
//             console.log(client.responseText);
//         }
//     };
//     client.send(productoJsonString);
// }

function agregarProducto(e) {
    e.preventDefault();

    let nombre = document.getElementById('name').value.trim();
    let jsonText = document.getElementById('description').value;

    // Validar que el nombre no esté vacío
    if (nombre === "") {
        alert("El nombre del producto es obligatorio.");
        return;
    }

    let producto;
    try {
        producto = JSON.parse(jsonText);
    } catch (error) {
        alert("El JSON no es válido.");
        return;
    }

    // Validar campos requeridos
    const camposObligatorios = ["precio", "unidades", "modelo", "marca", "detalles", "imagen"];
    for (let campo of camposObligatorios) {
        if (!(campo in producto)) {
            alert(`Falta el campo obligatorio: ${campo}`);
            return;
        }
    }

    // Validar tipos básicos
    if (typeof producto.precio !== "number" || producto.precio < 0) {
        alert("El precio debe ser un número positivo.");
        return;
    }
    if (typeof producto.unidades !== "number" || producto.unidades < 0) {
        alert("Las unidades deben ser un número positivo.");
        return;
    }

    // Agregar el nombre al JSON
    producto.nombre = nombre;

    // Enviar al servidor
    var client = getXMLHttpRequest();
    client.open('POST', './backend/create.php', true);
    client.setRequestHeader('Content-Type', "application/json;charset=UTF-8");
    client.onreadystatechange = function () {
        if (client.readyState == 4 && client.status == 200) {
            alert(client.responseText); // Mostrar mensaje del servidor
        }
    };
    client.send(JSON.stringify(producto));
}


// SE CREA EL OBJETO DE CONEXIÓN COMPATIBLE CON EL NAVEGADOR
function getXMLHttpRequest() {
    var objetoAjax;

    try{
        objetoAjax = new XMLHttpRequest();
    }catch(err1){
        /**
         * NOTA: Las siguientes formas de crear el objeto ya son obsoletas
         *       pero se comparten por motivos historico-académicos.
         */
        try{
            // IE7 y IE8
            objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(err2){
            try{
                // IE5 y IE6
                objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
            }catch(err3){
                objetoAjax = false;
            }
        }
    }
    return objetoAjax;
}

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;
}