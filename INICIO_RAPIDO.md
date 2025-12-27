# 🚀 Inicio Rápido - Sistema de Base de Datos Dinámica

## Instalación en 3 Pasos

### 1️⃣ Ejecutar Setup Automático

**Windows:**
```bash
setup-database-system.bat
```

**Linux/Mac:**
```bash
chmod +x setup-database-system.sh
./setup-database-system.sh
```

### 2️⃣ Iniciar Servidor

```bash
php artisan serve
```

### 3️⃣ Acceder al Sistema

Abre tu navegador en: **http://localhost:8000/entities**

---

## 📋 Instalación Manual (Alternativa)

Si prefieres hacerlo paso a paso:

```bash
# 1. Ejecutar migraciones
php artisan migrate

# 2. (Opcional) Poblar con datos de ejemplo
php artisan db:seed --class=EntityDatabaseSeeder

# 3. Limpiar cachés
php artisan cache:clear
php artisan config:clear

# 4. Crear enlaces de storage
php artisan storage:link

# 5. (Opcional) Compilar assets
npm run build

# 6. Iniciar servidor
php artisan serve
```

---

## 🎯 Primeros Pasos

### Opción A: Crear Campos Manualmente

1. Ve a: `http://localhost:8000/entity-fields`
2. Click en el botón **"+"** (esquina inferior derecha)
3. Crea tus primeros campos:
   - **Email** (tipo: texto)
   - **Teléfono** (tipo: texto)  
   - **Ciudad** (tipo: texto)
   - **Edad** (tipo: número)

### Opción B: Importar desde Excel

1. Ve a: `http://localhost:8000/excel-import`
2. Prepara un Excel con columnas como:
   ```
   Nombre | Apellido | Email | Teléfono | Ciudad
   ```
3. Arrastra el archivo
4. Click en **"✨ Crear Campos Automáticamente"**
5. Mapea las columnas
6. Importa los datos

---

## 📍 Rutas Principales

| Ruta | Descripción |
|------|-------------|
| `/entities` | Lista de todas las entidades |
| `/entity-fields` | Gestión de campos dinámicos |
| `/excel-import` | Importar datos desde Excel |
| `/contexts` | Gestión de contextos/proyectos |

---

## 💡 Ejemplo Rápido

### Crear tu primera entidad manualmente:

1. Ve a `/entities`
2. Click en el botón **"+"**
3. Selecciona tipo (Persona/Institución/Empresa)
4. Completa:
   - **Nombre**: Juan
   - **Apellido**: Pérez
   - **Email**: juan@example.com
   - **Ciudad**: Madrid
5. Click en **"Crear Registro"**

### Importar un Excel:

1. Crea un archivo Excel con:
   ```
   Nombre    | Apellido  | Email              | Ciudad
   Carlos    | Martínez  | carlos@test.com    | Madrid
   Ana       | García    | ana@test.com       | Barcelona
   Pedro     | López     | pedro@test.com     | Valencia
   ```

2. Ve a `/excel-import`
3. Sube el archivo
4. Click en **"✨ Crear Campos Automáticamente"**
5. Revisa vista previa
6. Click en **"Importar Datos"**

---

## 🔧 Comandos Útiles

```bash
# Ver estado de migraciones
php artisan migrate:status

# Revertir última migración
php artisan migrate:rollback

# Refrescar base de datos (CUIDADO: elimina todos los datos)
php artisan migrate:fresh

# Poblar con datos de ejemplo
php artisan db:seed --class=EntityDatabaseSeeder

# Ver todas las rutas
php artisan route:list

# Limpiar todo
php artisan optimize:clear
```

---

## 📚 Documentación Completa

Para información detallada, consulta:
- [SISTEMA_BASE_DATOS.md](./SISTEMA_BASE_DATOS.md) - Documentación completa
- [EJEMPLOS_EXCEL.md](./EJEMPLOS_EXCEL.md) - Ejemplos de archivos Excel

---

## ❓ Preguntas Frecuentes

### ¿Cómo agrego un nuevo tipo de campo?

Los tipos disponibles son:
- **Texto** - Para cualquier texto libre
- **Número** - Para valores numéricos
- **Fecha** - Para fechas
- **Sí/No** - Para valores booleanos
- **Lista** - Para selección de opciones predefinidas

### ¿Puedo cambiar el tipo de un campo después de crearlo?

Sí, pero ten cuidado: los valores existentes se intentarán convertir al nuevo tipo.

### ¿Qué pasa si mi Excel tiene columnas que no existen?

El sistema puede:
1. Auto-crear los campos nuevos (botón "✨ Crear Campos Automáticamente")
2. O puedes mapearlas a campos existentes
3. O ignorar la columna

### ¿Cuántos registros puedo importar?

- Recomendado: hasta 1,000 por archivo
- Máximo tamaño: 10MB
- Para más registros, divide en varios archivos

### ¿Los campos son obligatorios?

Por defecto NO. Pero puedes marcar campos como "requeridos" al crearlos o editarlos.

---

## 🆘 Solución de Problemas

### Error: "Base de datos no encontrada"
```bash
# Verifica tu archivo .env
# Asegúrate de que DB_DATABASE esté configurado
php artisan config:clear
```

### Error: "Class not found"
```bash
composer dump-autoload
php artisan clear-compiled
```

### Error: "SQLSTATE[42S02]: Base table not found"
```bash
php artisan migrate:fresh
```

### Assets no se cargan
```bash
npm install
npm run build
php artisan view:clear
```

---

## 🎨 Personalización

### Cambiar colores de tipos de entidad

Edita [VerBase.vue](resources/js/Pages/Admin/BaseDeDatos/VerBase.vue):

```javascript
const entityTypes = [
    { value: "persona", label: "Persona", icon: "👤", color: "bg-blue-500" },
    { value: "institucion", label: "Institución", icon: "🏛️", color: "bg-purple-500" },
    { value: "empresa", label: "Empresa", icon: "🏢", color: "bg-green-500" },
];
```

### Agregar nuevo tipo de entidad

1. Edita migración `create_entities_table.php`:
```php
$table->enum('tipo', ['persona', 'institucion', 'empresa', 'nuevo_tipo']);
```

2. Ejecuta:
```bash
php artisan migrate:refresh
```

---

## ✅ Checklist de Verificación

- [ ] Migraciones ejecutadas
- [ ] Storage link creado
- [ ] Servidor corriendo
- [ ] Puedo acceder a /entities
- [ ] Puedo crear campos en /entity-fields
- [ ] Puedo crear entidades
- [ ] Puedo importar Excel

---

**¡Listo para empezar! 🎉**

Cualquier duda, revisa la documentación completa en [SISTEMA_BASE_DATOS.md](./SISTEMA_BASE_DATOS.md)
