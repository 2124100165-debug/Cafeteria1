# ☕ Kraneo Cafe

Proyecto desarrollado en Laravel para la administración de cafetería y gestión de productos.

---

# 👥 Integrantes del equipo

* Delia
* Jonathan
* (Agregar integrantes)
---

# ⚠️ Reglas importantes del proyecto

## ❌ NO trabajar directamente sobre `main`

La rama `main` contiene la versión estable y original del proyecto.

Todos los integrantes deben trabajar en ramas separadas.

---

# ✅ Flujo correcto de trabajo

## 1. Actualizar el proyecto antes de empezar

```bash id="jfe1m4"
git checkout main
git pull origin main
```

Esto descarga los cambios más recientes del equipo.

---

## 2. Crear una rama personal

Cada integrante debe crear su propia rama.

Ejemplos:

```bash id="jwrj8g"
git checkout -b jonathan-maquetacion
```

```bash id="9f0k59"
git checkout -b login-usuarios
```

```bash id="rjlwm1"
git checkout -b crud-productos
```

---

## 3. Revisar en qué rama estás

```bash id="wdvltb"
git branch
```

La rama actual aparece con `*`

Ejemplo:

```bash id="crf0wu"
* jonathan-maquetacion
main
```

---

## 4. Revisar archivos modificados

```bash id="4s5eyf"
git status
```

Sirve para:

* ver archivos modificados
* ver archivos nuevos
* verificar qué se subirá

---

## 5. Guardar cambios

### Agregar archivos

```bash id="3e5mn4"
git add .
```

### Crear commit

```bash id="bjlwm6"
git commit -m "Descripción clara del cambio"
```

Ejemplos:

```bash id="vjl72f"
git commit -m "Se agrega login de usuarios"
```

```bash id="4a5wcf"
git commit -m "Se corrige navbar del dashboard"
```

---

## 6. Subir SOLO tu rama

```bash id="ynhl7r"
git push origin nombre-rama
```

Ejemplo:

```bash id="6h4pj8"
git push origin jonathan-maquetacion
```

---

# ❌ NUNCA HACER ESTO

```bash id="a2zj9m"
git push origin main
```

A menos que el líder del proyecto lo autorice.

---

# 🔍 Cómo revisar cambios antes de unir ramas

## Ver diferencias de archivos

```bash id="v3fj82"
git diff
```

---

## Ver historial de commits

```bash id="ep2x7g"
git log --oneline
```

---

## Ver ramas existentes

```bash id="bg4nyv"
git branch
```

---

## Ver ramas remotas

```bash id="y0mj8m"
git branch -r
```

---

## Descargar información nueva del repositorio

```bash id="5m1fj3"
git fetch
```

Esto NO modifica archivos.
Solo actualiza información del repositorio.

---

# 🔍 Revisar cambios de otro integrante

## Cambiar a la rama del compañero

```bash id="h4s8ew"
git checkout nombre-rama
```

Ejemplo:

```bash id="xq9v0l"
git checkout jonathan-maquetacion
```

---

## Revisar sus cambios

```bash id="5b9jmd"
git status
```

```bash id="2xg4qf"
git log --oneline
```

```bash id="grj0q9"
git diff main
```

---

# ✅ Cómo unir cambios correctamente

## Volver a main

```bash id="tr8x6m"
git checkout main
```

---

## Actualizar main

```bash id="7yq0kb"
git pull origin main
```

---

## Unir rama

```bash id="z7q4pd"
git merge nombre-rama
```

Ejemplo:

```bash id="1l0c8e"
git merge jonathan-maquetacion
```

---

# ⚠️ Si hay conflictos

NO borrar archivos.

NO usar:

```bash id="4r3vzc"
git push --force
```

Avisar al líder del proyecto primero.

---

# 🚫 Archivos que NO se deben subir

Nunca subir:

* `.env`
* `vendor`
* `node_modules`
* contraseñas
* archivos pesados
* configuraciones personales

---

# ▶️ Cómo ejecutar el proyecto

## Instalar dependencias

```bash id="brm5tw"
composer install
npm install
```

---

## Configurar entorno

```bash id="m1t7ys"
cp .env.example .env
php artisan key:generate
```

---

## Ejecutar migraciones

```bash id="mjlwm9"
php artisan migrate
```

---

## Iniciar servidor

```bash id="c9j4vf"
php artisan serve
```

---

# 📌 Comandos más importantes

## Revisar estado

```bash id="x8s5fe"
git status
```

---

## Descargar cambios

```bash id="d8m1pl"
git pull origin main
```

---

## Ver historial

```bash id="4ew2fg"
git log --oneline
```

---

## Crear rama

```bash id="w6j2rn"
git checkout -b nombre-rama
```

---

## Cambiar de rama

```bash id="f4j0xv"
git checkout nombre-rama
```

---

## Agregar cambios

```bash id="7d1qmx"
git add .
```

---

## Guardar cambios

```bash id="0y7nfg"
git commit -m "mensaje"
```

---

## Subir rama

```bash id="4a1rkw"
git push origin nombre-rama
```

---

# 👥 Regla final del equipo

Antes de unir cualquier rama:

1. Revisar cambios
2. Probar el proyecto
3. Verificar que no rompa funcionalidades
4. Confirmar con el equipo
