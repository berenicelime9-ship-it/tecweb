#include <iostream>
#include <thread>

using namespace std;

// Variables compartidas
int j = 0, k = 0, a[2];

// Funciones para cada tarea
void S1() {
    j += 10;
    cout << "S1 ejecutada: j=" << j << endl;
}

void S2() {
    k += 100;
    cout << "S2 ejecutada: k=" << k << endl;
}

void S3() {
    a[0] = j * k;
    cout << "S3 ejecutada: a[0]=" << a[0] << endl;
}

void S4() {
    j += 20;
    cout << "S4 ejecutada: j=" << j << endl;
}

void S5() {
    k += 200;
    cout << "S5 ejecutada: k=" << k << endl;
}

void S6() {
    a[1] = j + k;
    cout << "S6 ejecutada: a[1]=" << a[1] << endl;
}

void S7() {
    j *= 2;
    cout << "S7 ejecutada: j=" << j << endl;
}

void S8() {
    k *= 2;
    cout << "S8 ejecutada: k=" << k << endl;
}

void S9() {
    cout << "S9 ejecutada: j+k=" << j+k << endl;
}

int main() {
    // Primer bloque paralelo: S1 y S2
    thread t1(S1);
    thread t2(S2);
    t1.join();
    t2.join();

    // S3 secuencial
    S3();

    // Segundo bloque paralelo: S4 y S5
    thread t3(S4);
    thread t4(S5);
    t3.join();
    t4.join();

    // Tercer bloque paralelo: S6+S9 secuencial dentro y S7, S8 concurrentes
    thread t5([](){
        S6();
        S9();
    });
    thread t6(S7);
    thread t7(S8);
    t5.join();
    t6.join();
    t7.join();

    // Mostrar resultados finales
    cout << "\nResultados finales:\n";
    cout << "j=" << j << ", k=" << k << "\n";
    for(int i=0; i<2; i++)
        cout << "a[" << i << "]=" << a[i] << "\n";

    return 0;
}
