function getDatos()
{
    var nombre = prompt("Nombre: ", "");

    var edad = prompt("Edad: ", 0);

    var div1 = document.getElementById('nombre');
    div1.innerHTML = '<h3> Nombre: '+nombre+'</h3>';

    var div2 = document.getElementById('edad');
    div2.innerHTML = '<h3> Edad: '+edad+'</h3>';
}

//JS01_Introduccion_a_JavaScript.pdf - Pag.8
//funcion del ejemplo 1
function ejemplo1() {
    document.write('Hola Mundo');
}


//JS02_Variables_Entradas_Operadores.pdf
//funcion ejemplo 2 pag.6
function ejemplo2() {
    var nombre = 'Juan';
    var edad = 10;
    var altura = 1.92;
    var casado = false;

    document.write(nombre);
    document.write('<br>');
    document.write(edad);
    document.write('<br>');
    document.write(altura);
    document.write('<br>');
    document.write(casado);
}

//funcion ejemplo 3 pag.12
function ejemplo3() {
    var nombre;
    var edad;
    nombre = prompt('Ingresa tu nombre:', '');
    edad = prompt('Ingresa tu edad:', '');
    document.write('Hola ');
    document.write(nombre);
    document.write(' así que tienes ');
    document.write(edad);
    document.write(' años');
}

// JS03_Estructuras_de_condicion.pdf

// función ejemplo 4 pág.3
function ejemplo4() {
    var valor1;
    var valor2;
    valor1 = prompt('Introducir primer número:', '');
    valor2 = prompt('Introducir segundo número:', '');
    var suma = parseInt(valor1) + parseInt(valor2);
    var producto = parseInt(valor1) * parseInt(valor2);
    document.write('La suma es ');
    document.write(suma);
    document.write('<br>');
    document.write('El producto es ');
    document.write(producto);
}

// función ejemplo 5 pág.8
function ejemplo5() {
    var nombre;
    var nota;
    nombre = prompt('Ingresa tu nombre:', '');
    nota = prompt('Ingresa tu nota:', '');
    if (nota >= 4) {
        document.write(nombre + ' está aprobado con un ' + nota);
    }
}

// función ejemplo 6 pág.11
function ejemplo6() {
    var num1, num2;
    num1 = prompt('Ingresa el primer número:', '');
    num2 = prompt('Ingresa el segundo número:', '');
    num1 = parseInt(num1);
    num2 = parseInt(num2);
    if (num1 > num2) {
        document.write('El mayor es ' + num1);
    } else {
        document.write('El mayor es ' + num2);
    }
}

// función ejemplo 7 pág.15-16
function ejemplo7() {
    var nota1, nota2, nota3;

    nota1 = prompt('Ingresa 1ra. nota:', '');
    nota2 = prompt('Ingresa 2da. nota:', '');
    nota3 = prompt('Ingresa 3ra. nota:', '');

    nota1 = parseInt(nota1);
    nota2 = parseInt(nota2);
    nota3 = parseInt(nota3);

    var pro;
    pro = (nota1 + nota2 + nota3) / 3;

    if (pro >= 7) {
        document.write('Aprobado');
    } else if (pro >= 4) {
        document.write('Regular');
    } else {
        document.write('Reprobado');
    }
}

// función ejemplo 8 pág.18
function ejemplo8() {
    var valor;
    valor = prompt('Ingresar un valor comprendido entre 1 y 5:', '');
    valor = parseInt(valor);
    switch (valor) {
        case 1: document.write('uno'); break;
        case 2: document.write('dos'); break;
        case 3: document.write('tres'); break;
        case 4: document.write('cuatro'); break;
        case 5: document.write('cinco'); break;
        default: document.write('Debe ingresar un valor comprendido entre 1 y 5.');
    }
}

// función ejemplo 9 pág.21
function ejemplo9() {
    var col;
    col = prompt('Ingresa el color con que quieras pintar el fondo de la ventana (rojo, verde, azul):', '');
    switch (col) {
        case 'rojo': document.bgColor = '#ff0000'; break;
        case 'verde': document.bgColor = '#00ff00'; break;
        case 'azul': document.bgColor = '#0000ff'; break;
        default: alert('Color no válido. Usa: rojo, verde o azul.');
    }
}

// JS04_Estructuras_de_repeticion.pdf

// función ejemplo 10 pág.5
function ejemplo10() {
    var x;
    x = 1;
    while (x <= 100) {
        document.write(x);
        document.write('<br>');
        x = x + 1;
    }
}

// función ejemplo 11 pág.6
function ejemplo11() {
    var x = 1;
    var suma = 0;
    var valor;
    while (x <= 5) {
        valor = prompt('Ingresa el valor:', '');
        valor = parseInt(valor);
        suma = suma + valor;
        x = x + 1;
    }
    document.write("La suma de los valores es " + suma + "<br>");
}

// función ejemplo 12 pág.12
function ejemplo12() {
    var valor;
    do {
        valor = prompt('Ingresa un valor entre 0 y 999:', '');
        valor = parseInt(valor);
        document.write('El valor ' + valor + ' tiene ');
        if (valor < 10)
            document.write('1 dígito');
        else if (valor < 100)
            document.write('2 dígitos');
        else
            document.write('3 dígitos');
        document.write('<br>');
    } while (valor != 0);
}

// función ejemplo 13 pág.16
function ejemplo13() {
    var f;
    for (f = 1; f <= 10; f++) {
        document.write(f + " ");
    }
}

// Ejemplo 14 pág.6
function ejemplo14() {
    document.write("Cuidado<br>");
    document.write("Ingresa tu documento correctamente<br>");
    document.write("Cuidado<br>");
    document.write("Ingresa tu documento correctamente<br>");
    document.write("Cuidado<br>");
    document.write("Ingresa tu documento correctamente<br>");
}

// Ejemplo 15 pág.6
function mostrarMensaje() {
    document.write("Cuidado<br>");
    document.write("Ingresa tu documento correctamente<br>");
}
function ejemplo15() {
    mostrarMensaje();
    mostrarMensaje();
    mostrarMensaje();
}

// Ejemplo 16 pág.10
function mostrarRango(x1, x2) {
    for (let inicio = x1; inicio <= x2; inicio++) {
        document.write(inicio + " ");
    }
}
function ejemplo16() {
    let valor1 = parseInt(prompt("Ingresa el valor inferior:", ""));
    let valor2 = parseInt(prompt("Ingresa el valor superior:", ""));
    mostrarRango(valor1, valor2);
}

// Ejemplo 17 pág.13
function convertirCastellano(x) {
    if (x == 1) return "uno";
    else if (x == 2) return "dos";
    else if (x == 3) return "tres";
    else if (x == 4) return "cuatro";
    else if (x == 5) return "cinco";
    else return "valor incorrecto";
}
function ejemplo17() {
    let valor = parseInt(prompt("Ingresa un valor entre 1 y 5:", ""));
    document.write(convertirCastellano(valor));
}

// Ejemplo 18 pág.15
function convertirCastellanoSwitch(x) {
    switch (x) {
        case 1: return "uno";
        case 2: return "dos";
        case 3: return "tres";
        case 4: return "cuatro";
        case 5: return "cinco";
        default: return "valor incorrecto";
    }
}
function ejemplo18() {
    let valor = parseInt(prompt("Ingresa un valor entre 1 y 5:", ""));
    document.write(convertirCastellanoSwitch(valor));
}
