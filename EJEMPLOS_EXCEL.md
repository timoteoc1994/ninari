# Ejemplos de Archivos Excel para Importar

## Formato Básico - Lista de Participantes

Crea un archivo Excel con las siguientes columnas:

| Nombre | Apellido | Email | Teléfono | Ciudad | Edad |
|--------|----------|-------|----------|--------|------|
| Carlos | Martínez | carlos.m@example.com | 600123456 | Madrid | 32 |
| Ana | Rodríguez | ana.r@example.com | 600789012 | Barcelona | 27 |
| Pedro | Sánchez | pedro.s@example.com | 600345678 | Valencia | 45 |
| Laura | Torres | laura.t@example.com | 600901234 | Sevilla | 29 |

## Formato Completo - Con Más Datos

| Nombre | Apellido | Email | Teléfono | Ciudad | Cargo | Empresa | Fecha Ingreso | Activo |
|--------|----------|-------|----------|--------|-------|---------|---------------|--------|
| Miguel | Fernández | miguel.f@example.com | 600111222 | Madrid | Director | Tech Corp | 2023-01-15 | Sí |
| Isabel | García | isabel.g@example.com | 600333444 | Barcelona | Gerente | Innovate SL | 2023-03-20 | Sí |
| David | López | david.l@example.com | 600555666 | Valencia | Analista | Data Pro | 2023-06-10 | No |

## Formato Variable - Diferentes Campos

El sistema puede importar Excel con CUALQUIER combinación de columnas. Ejemplos:

### Ejemplo 1: Contactos Simples
| Nombre Completo | Email | Ciudad |
|-----------------|-------|--------|
| Juan Pérez | juan@example.com | Madrid |
| María González | maria@example.com | Barcelona |

### Ejemplo 2: Instituciones
| Nombre Institución | Tipo | Director | Email Contacto | Teléfono | Ciudad |
|--------------------|------|----------|----------------|----------|--------|
| Universidad ABC | Pública | Dr. Pérez | contacto@uabc.edu | 91-1234567 | Madrid |
| Instituto XYZ | Privada | Dra. García | info@ixyz.com | 93-9876543 | Barcelona |

### Ejemplo 3: Empresas con Datos Personalizados
| Razón Social | CIF | Sector | Empleados | Facturación Anual | Ciudad | País |
|--------------|-----|--------|-----------|-------------------|--------|------|
| Tech Solutions SL | B12345678 | Tecnología | 50 | 1000000 | Madrid | España |
| Innova Digital SA | A87654321 | Marketing | 25 | 500000 | Barcelona | España |

## Guía de Importación

### Paso 1: Preparar tu Excel
1. Asegúrate de que la primera fila contenga los nombres de las columnas
2. No dejes filas vacías entre los datos
3. Los nombres de columnas pueden tener:
   - Espacios
   - Tildes
   - Mayúsculas y minúsculas
   - Caracteres especiales
   
   El sistema los normalizará automáticamente

### Paso 2: Columnas Requeridas
- **Obligatorio**: Una columna con el "Nombre" (puede llamarse: Nombre, Name, nombre_completo, etc.)
- **Opcional**: Apellido, y cualquier otro campo

### Paso 3: Tipos de Datos Soportados
- **Texto**: Cualquier texto (emails, nombres, direcciones)
- **Número**: Valores numéricos (edad, cantidad, precio)
- **Fecha**: Formatos: DD/MM/AAAA, AAAA-MM-DD, DD-MM-AAAA
- **Booleano**: Sí/No, True/False, 1/0, Verdadero/Falso
- **Select**: El sistema creará una lista con las opciones únicas

### Paso 4: Mapeo Inteligente
El sistema intentará:
1. Detectar automáticamente columnas "Nombre" y "Apellido"
2. Auto-detectar el tipo de dato de cada columna
3. Crear campos nuevos para columnas no existentes

### Ejemplo de Mapeo

Si tu Excel tiene:
```
Nombre Completo | E-mail | Teléfono Móvil | Ciudad Residencia
```

El sistema creará:
```
nombre_completo  → Nombre Completo (texto)
e_mail          → E Mail (texto)
telefono_movil  → Teléfono Móvil (texto)
ciudad_residencia → Ciudad Residencia (texto)
```

Y podrás mapearlas a:
- **Nombre Completo** → Campo base "Nombre"
- **E-mail** → Campo dinámico "email"
- **Teléfono Móvil** → Campo dinámico "telefono"
- **Ciudad Residencia** → Campo dinámico "ciudad"

### Errores Comunes y Soluciones

❌ **Error**: "Falta el nombre"
✅ **Solución**: Asegúrate de mapear al menos una columna como "Nombre"

❌ **Error**: "El campo X es requerido"
✅ **Solución**: El campo está marcado como obligatorio. Asegúrate de que todos los registros tengan valor o desmarca el campo como requerido

❌ **Error**: "Formato de archivo no permitido"
✅ **Solución**: Usa formatos .xlsx, .xls o .csv

❌ **Error**: "El archivo es demasiado grande"
✅ **Solución**: El límite es 10MB. Divide el archivo en varios más pequeños

### Tips para Mejores Resultados

1. **Limpia tus datos antes de importar**
   - Elimina filas vacías
   - Revisa que no haya errores de ortografía
   - Verifica formatos de fecha

2. **Nombres de columnas claros**
   - Usa nombres descriptivos
   - Evita abreviaturas confusas

3. **Usa la función "Crear Campos Automáticamente"**
   - Ahorra tiempo
   - Detecta tipos automáticamente
   - Auto-mapea las columnas

4. **Revisa la Vista Previa**
   - Verifica que los datos se vean correctos
   - Confirma el tipo de cada campo
   - Ajusta el mapeo si es necesario

## Plantilla Recomendada

Para empezar rápido, usa esta plantilla básica:

| Nombre | Apellido | Email | Teléfono | Ciudad | Cargo | Empresa |
|--------|----------|-------|----------|--------|-------|---------|
|        |          |       |          |        |       |         |

### Descarga Plantilla Excel

Crea un archivo nuevo con estas columnas y guárdalo como:
- **participantes.xlsx** (para personas)
- **instituciones.xlsx** (para instituciones)
- **empresas.xlsx** (para empresas)

## Importación Masiva

Para grandes volúmenes de datos:

1. **Divide en Lotes**
   - Máximo 1,000 registros por archivo
   - Importa en horarios de bajo tráfico

2. **Valida Primero**
   - Importa un archivo pequeño de prueba
   - Verifica el resultado
   - Luego importa el completo

3. **Backup**
   - Exporta tu base actual antes de importaciones masivas
   - Permite deshacer cambios si es necesario

---

**¿Necesitas ayuda?**
Revisa el archivo [SISTEMA_BASE_DATOS.md](./SISTEMA_BASE_DATOS.md) para más detalles técnicos.
