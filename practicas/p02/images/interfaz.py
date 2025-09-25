import tkinter as tk

# Funciones para abrir cada ventana
def abrir_bernoulli():
    nueva = tk.Toplevel(ventana)
    nueva.title("Distribución Bernoulli")
    tk.Label(nueva, text="Aquí irá la simulación de Bernoulli").pack(pady=20)

def abrir_binomial():
    nueva = tk.Toplevel(ventana)
    nueva.title("Distribución Binomial")
    tk.Label(nueva, text="Aquí irá la simulación de Binomial").pack(pady=20)

def abrir_multinomial():
    nueva = tk.Toplevel(ventana)
    nueva.title("Distribución Multinomial")
    tk.Label(nueva, text="Aquí irá la simulación de Multinomial").pack(pady=20)

def abrir_normal():
    nueva = tk.Toplevel(ventana)
    nueva.title("Distribución Normal")
    tk.Label(nueva, text="Aquí irá la simulación de Normal").pack(pady=20)

def abrir_geebs():
    nueva = tk.Toplevel(ventana)
    nueva.title("Distribución Geebs")
    tk.Label(nueva, text="Aquí irá la simulación de Geebs").pack(pady=20)

def abrir_exponencial():
    nueva = tk.Toplevel(ventana)
    nueva.title("Distribución Exponencial")
    tk.Label(nueva, text="Aquí irá la simulación de Exponencial").pack(pady=20)

# Ventana principal
ventana = tk.Tk()
ventana.title("Simulación de distribuciones")
ventana.geometry("400x300")

tk.Label(ventana, text="Elige una distribución:", font=("Arial", 14)).pack(pady=20)

# Botones
tk.Button(ventana, text="Bernoulli", width=20, command=abrir_bernoulli).pack(pady=5)
tk.Button(ventana, text="Binomial", width=20, command=abrir_binomial).pack(pady=5)
tk.Button(ventana, text="Multinomial", width=20, command=abrir_multinomial).pack(pady=5)
tk.Button(ventana, text="Normal", width=20, command=abrir_normal).pack(pady=5)
tk.Button(ventana, text="Geebs", width=20, command=abrir_geebs).pack(pady=5)
tk.Button(ventana, text="Exponencial", width=20, command=abrir_exponencial).pack(pady=5)

ventana.mainloop()
