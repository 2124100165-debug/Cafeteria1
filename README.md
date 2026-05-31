# 🔧 Reglas de Git - Kraneo Cafe

## ⚠️ REGLA MÁS IMPORTANTE

Nunca trabajar directamente sobre la rama:

```bash
main
```

La rama `main` contiene el proyecto estable y original.

---

# ✅ Flujo correcto de trabajo

## 1. Actualizar el proyecto antes de empezar

Siempre hacer esto primero:

```bash
git checkout main
git pull origin main
```

Esto descarga los cambios más recientes del equipo.

---

# ✅ Crear una rama personal

Cada integrante debe crear su propia rama.

Ejemplos:

```bash
git checkout -b melissa-maquetacion
```

```bash
git checkout -b login-usuarios
```

```bash
git checkout -b crud-productos
```

---

# ✅ Revisar en qué rama estás

Antes de trabajar:

```bash
git branch
```

La rama actual aparece con `*`

Ejemplo:

```bash
* melissa-maquetacion
main
```

---

# ✅ Revisar qué archivos modificaste

```bash
git status
```

Esto sirve para:

* ver archivos modificados
* ver archivos nuevos
* verificar qué se subirá

---

# ✅ Guardar cambios correctamente

## Agregar archivos

```bash
git add .
```

---

## Crear commit

```bash
git commit -m "Descripción clara del cambio"
```

Ejemplos:

```bash
git commit -m "Se agrega login de usuarios"
```

```bash
git commit -m "Se corrige navbar del dashboard"
```

---

# ✅ Subir SOLO tu rama

```bash
git push origin nombre-rama
```

Ejemplo:

```bash
git push origin melissa-maquetacion
```

---

# ❌ NUNCA HACER ESTO

```bash
git push origin main
```

A menos que el líder del proyecto lo autorice.

---

# 🔍 Cómo revisar cambios antes de unirlos

## Ver diferencias de archivos

```bash
git diff
```

Muestra exactamente qué cambió.

---

# 🔍 Revisar historial de commits

```bash
git log --oneline
```

Sirve para ver:

* quién hizo cambios
* qué cambios hizo
* historial del proyecto

---

# 🔍 Ver ramas existentes

```bash
git branch
```

---

# 🔍 Ver ramas remotas

```bash
git branch -r
```

---

# 🔍 Descargar ramas nuevas del equipo

```bash
git fetch
```

Esto NO modifica archivos.
Solo actualiza información del repositorio.

---

# 🔍 Revisar cambios de otro integrante antes de unirlos

## Cambiar a su rama

```bash
git checkout nombre-rama
```

Ejemplo:

```bash
git checkout melissa-maquetacion
```

---

## Ver qué hizo

```bash
git status
```

```bash
git log --oneline
```

```bash
git diff main
```

---

# ✅ Cómo unir cambios correctamente

## Volver a main

```bash
git checkout main
```

---

## Actualizar main

```bash
git pull origin main
```

---

## Unir rama

```bash
git merge nombre-rama
```

Ejemplo:

```bash
git merge melissa-maquetacion
```

---

# ⚠️ Si hay conflictos

NO borrar archivos.

NO usar:

```bash
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

# 📌 Comandos más importantes

## Revisar estado

```bash
git status
```

---

## Descargar cambios

```bash
git pull origin main
```

---

## Ver historial

```bash
git log --oneline
```

---

## Crear rama

```bash
git checkout -b nombre-rama
```

---

## Cambiar de rama

```bash
git checkout nombre-rama
```

---

## Agregar cambios

```bash
git add .
```

---

## Guardar cambios

```bash
git commit -m "mensaje"
```

---

## Subir rama

```bash
git push origin nombre-rama
```

---

# 👥 Regla del equipo

Antes de unir cualquier rama:

1. Revisar cambios
2. Probar el proyecto
3. Verificar que no rompa funcionalidades
4. Confirmar con el equipo
