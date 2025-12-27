# Sistema de Base de Datos Dinámica con Importación Excel

## 📋 Descripción

Sistema flexible de registro de entidades (personas, instituciones, empresas) con campos dinámicos y capacidad de importar datos desde Excel con formatos variables, usando modelo EAV (Entity-Attribute-Value).

## ✨ Características

- ✅ Registro de entidades con campos personalizados
- ✅ Gestión dinámica de campos (CRUD completo)
- ✅ Importación de Excel (.xlsx, .xls, .csv)
- ✅ Mapeo inteligente de columnas
- ✅ Creación automática de campos desde Excel
- ✅ Soporte para valores NULL
- ✅ Validación de campos requeridos
- ✅ Múltiples tipos de datos (texto, número, fecha, booleano, select)
- ✅ Sistema de contextos (proyectos, programas, convocatorias)
- ✅ Interfaz moderna con Vue 3 + Inertia.js

## 🚀 Instalación

### 1. Ejecutar Migraciones

```bash
php artisan migrate
```

Esto creará las siguientes tablas:
- `entities` - Entidades principales
- `entity_fields` - Definición de campos dinámicos
- `entity_values` - Valores de campos por entidad
- `contexts` - Contextos/proyectos
- `entity_context` - Relación entidades-contextos

### 2. Instalar Dependencias de PHP (si no están instaladas)

El sistema usa la librería PHPSpreadsheet que ya debería estar instalada por Maatwebsite Excel:

```bash
composer require maatwebsite/excel
```

### 3. Verificar Configuración

Asegúrate de que el archivo `.env` tenga configurada la base de datos correctamente.

## 📖 Uso del Sistema

### 1. Gestión de Campos Dinámicos

**Ruta:** `/entity-fields`

Desde aquí puedes:
- Crear nuevos campos personalizados
- Definir tipos de dato (text, number, boolean, date, select)
- Marcar campos como requeridos
- Establecer opciones para campos tipo select
- Ordenar campos

### 2. Base de Datos de Entidades

**Ruta:** `/entities`

Funcionalidades:
- Ver todas las entidades registradas
- Filtrar por tipo (persona, institución, empresa)
- Buscar por nombre
- Crear/editar/eliminar registros
- Formulario dinámico basado en campos configurados

### 3. Importación desde Excel

**Ruta:** `/excel-import`

#### Paso a Paso:

**PASO 1: Subir Archivo**
- Formatos aceptados: .xlsx, .xls, .csv
- Tamaño máximo: 10MB
- Arrastra y suelta o selecciona archivo

**PASO 2: Mapear Columnas**
- El sistema detecta automáticamente las columnas del Excel
- Mapea cada columna a:
  - **Nombre** (requerido)
  - **Apellido** (opcional)
  - **Campo dinámico** existente
  - **No usar** (omitir columna)

**Función Automática:**
Usa el botón "✨ Crear Campos Automáticamente" para:
- Detectar columnas no mapeadas
- Crear campos nuevos automáticamente
- Auto-detectar tipo de dato
- Mapear automáticamente

**PASO 3: Vista Previa**
- Selecciona tipo de entidad (persona/institución/empresa)
- Revisa las primeras 5 filas
- Verifica el mapeo

**PASO 4: Resultado**
- Visualiza estadísticas de importación
- Ver registros importados
- Ver errores si los hay

### 4. Sistema de Contextos

**Ruta:** `/contexts`

Permite:
- Crear proyectos, programas o convocatorias
- Asignar entidades a contextos
- Definir roles (participante, aliado, beneficiario, mentor)
- Ver entidades por contexto

## 📁 Estructura de Archivos

### Backend (Laravel)

```
app/
├── Models/
│   ├── Entity.php              # Modelo principal de entidades
│   ├── EntityField.php         # Definición de campos dinámicos
│   ├── EntityValue.php         # Valores de campos
│   └── Context.php             # Contextos/proyectos
│
├── Http/Controllers/
│   ├── EntityController.php         # CRUD de entidades
│   ├── EntityFieldController.php    # CRUD de campos
│   ├── ContextController.php        # CRUD de contextos
│   └── ExcelImportController.php    # Importación Excel
│
└── Services/
    ├── ExcelReaderService.php       # Lectura de archivos Excel
    └── EntityImportService.php      # Lógica de importación
```

### Frontend (Vue 3)

```
resources/js/Pages/Admin/BaseDeDatos/
├── VerBase.vue                 # Listado principal
├── ImportarExcel.vue           # Wizard de importación
└── Components/
    └── DynamicForm.vue         # Formulario dinámico
```

## 🔌 Rutas API

### Entidades
```
GET    /entities              # Listar entidades
POST   /entities              # Crear entidad
GET    /entities/{entity}     # Ver detalle
PUT    /entities/{entity}     # Actualizar
DELETE /entities/{entity}     # Eliminar
```

### Campos Dinámicos
```
GET    /entity-fields         # Listar campos
POST   /entity-fields         # Crear campo
PUT    /entity-fields/{field} # Actualizar
DELETE /entity-fields/{field} # Eliminar
GET    /entity-fields/all     # Obtener todos (API)
```

### Importación Excel
```
GET  /excel-import                  # Vista principal
POST /excel-import/upload           # Subir archivo
POST /excel-import/create-fields    # Crear campos automáticos
POST /excel-import/import           # Importar datos
POST /excel-import/cancel           # Cancelar importación
```

### Contextos
```
GET    /contexts                          # Listar contextos
POST   /contexts                          # Crear contexto
PUT    /contexts/{context}                # Actualizar
DELETE /contexts/{context}                # Eliminar
GET    /contexts/{context}/entities       # Ver entidades
POST   /contexts/{context}/attach         # Asignar entidades
DELETE /contexts/{context}/detach/{entity} # Desasignar
```

## 💡 Ejemplos de Uso

### Ejemplo 1: Crear Campo Dinámico

```php
// Crear campo "Edad"
$field = EntityField::create([
    'nombre_campo' => 'edad',
    'etiqueta' => 'Edad',
    'tipo_dato' => 'number',
    'es_requerido' => false,
    'orden' => 1,
]);
```

### Ejemplo 2: Crear Entidad con Campos Dinámicos

```php
// Crear entidad
$entity = Entity::create([
    'tipo' => 'persona',
    'nombre' => 'Juan',
    'apellido' => 'Pérez',
]);

// Asignar valores dinámicos
$entity->setFieldValue('edad', '25');
$entity->setFieldValue('ciudad', 'Madrid');
```

### Ejemplo 3: Obtener Entidad con Todos sus Valores

```php
$entity = Entity::with(['values.field'])->find(1);
$allValues = $entity->getAllFieldValues();

// Resultado:
// [
//     'id' => 1,
//     'tipo' => 'persona',
//     'nombre' => 'Juan',
//     'apellido' => 'Pérez',
//     'edad' => '25',
//     'ciudad' => 'Madrid'
// ]
```

## 🎯 Casos de Uso

1. **Eventos y Participantes**
   - Importar lista de asistentes desde Excel
   - Campos: nombre, email, empresa, cargo, ciudad

2. **Programas Educativos**
   - Registrar estudiantes con datos variables
   - Campos: nombre, edad, institución, programa, año

3. **Convocatorias**
   - Registrar aplicantes con información diversa
   - Campos personalizados según convocatoria
   - Reutilizar base para futuras convocatorias

4. **Alianzas y Beneficiarios**
   - Crear contextos por proyecto
   - Asignar roles (aliado, beneficiario, mentor)
   - Registrar información específica

## ⚠️ Consideraciones

- **Campos Requeridos**: Si un campo está marcado como requerido, la importación fallará si falta el valor
- **Valores NULL**: Se permiten valores vacíos en campos no requeridos
- **Tipos de Dato**: El sistema intenta auto-detectar tipos, pero puedes ajustarlos manualmente
- **Rendimiento**: Para archivos muy grandes (>10,000 filas), considera procesar en chunks
- **Validación**: Siempre revisa la vista previa antes de importar

## 🔧 Personalización

### Agregar Nuevo Tipo de Dato

1. Actualizar migración `entity_fields`:
```php
$table->enum('tipo_dato', ['text', 'number', 'boolean', 'date', 'select', 'nuevo_tipo']);
```

2. Actualizar `EntityField::normalizeValue()`
3. Actualizar componente `DynamicForm.vue`

### Agregar Nuevo Tipo de Entidad

1. Actualizar migración `entities`:
```php
$table->enum('tipo', ['persona', 'institucion', 'empresa', 'nuevo_tipo']);
```

2. Actualizar `EntityController` validaciones
3. Actualizar `VerBase.vue` en array `entityTypes`

## 📝 Notas Técnicas

- **Modelo EAV**: Permite flexibilidad sin modificar estructura de BD
- **Normalización**: Los encabezados de Excel se normalizan a snake_case
- **Transacciones**: Las importaciones usan transacciones DB para integridad
- **Limpieza**: Los archivos temporales se eliminan después de importar
- **Errores**: Se reportan por fila para fácil corrección

## 🤝 Soporte

Para dudas o problemas:
1. Revisa los logs en `storage/logs/laravel.log`
2. Verifica errores en la consola del navegador
3. Revisa que las migraciones se ejecutaron correctamente

## 📜 Licencia

Este sistema es parte del proyecto Ninari.

---

**Desarrollado con Laravel 11, Inertia.js y Vue 3** 🚀
