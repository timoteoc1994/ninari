#!/bin/bash

# Script de Instalación y Comandos Útiles para Sistema de Base de Datos Dinámica

echo "====================================================="
echo "   Sistema de Base de Datos Dinámica - Setup"
echo "====================================================="
echo ""

# Colores
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# 1. EJECUTAR MIGRACIONES
echo -e "${BLUE}1. Ejecutando migraciones...${NC}"
php artisan migrate

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✓ Migraciones ejecutadas correctamente${NC}"
else
    echo -e "${YELLOW}⚠ Error al ejecutar migraciones${NC}"
    exit 1
fi

echo ""

# 2. POBLAR CON DATOS DE EJEMPLO (OPCIONAL)
echo -e "${BLUE}2. ¿Deseas poblar la base de datos con datos de ejemplo? (s/n)${NC}"
read -r response

if [[ "$response" =~ ^([sS][iI]|[sS])$ ]]; then
    php artisan db:seed --class=EntityDatabaseSeeder
    if [ $? -eq 0 ]; then
        echo -e "${GREEN}✓ Base de datos poblada con datos de ejemplo${NC}"
    else
        echo -e "${YELLOW}⚠ Error al poblar datos${NC}"
    fi
else
    echo -e "${YELLOW}Saltando datos de ejemplo${NC}"
fi

echo ""

# 3. LIMPIAR CACHE
echo -e "${BLUE}3. Limpiando cachés...${NC}"
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo -e "${GREEN}✓ Cachés limpiados${NC}"
echo ""

# 4. CREAR STORAGE LINKS
echo -e "${BLUE}4. Creando enlaces simbólicos de storage...${NC}"
php artisan storage:link

echo -e "${GREEN}✓ Enlaces creados${NC}"
echo ""

# 5. COMPILAR ASSETS (si es necesario)
echo -e "${BLUE}5. ¿Deseas compilar assets de frontend? (s/n)${NC}"
read -r response

if [[ "$response" =~ ^([sS][iI]|[sS])$ ]]; then
    npm run build
    if [ $? -eq 0 ]; then
        echo -e "${GREEN}✓ Assets compilados${NC}"
    else
        echo -e "${YELLOW}⚠ Error al compilar assets${NC}"
    fi
else
    echo -e "${YELLOW}Saltando compilación de assets${NC}"
fi

echo ""

# 6. INFORMACIÓN FINAL
echo "====================================================="
echo -e "${GREEN}✓ Instalación Completada${NC}"
echo "====================================================="
echo ""
echo -e "${BLUE}Rutas disponibles:${NC}"
echo "  - Base de Datos:          /entities"
echo "  - Gestión de Campos:      /entity-fields"
echo "  - Importar Excel:         /excel-import"
echo "  - Contextos:              /contexts"
echo ""
echo -e "${BLUE}Comandos útiles:${NC}"
echo "  - Ver migraciones:        php artisan migrate:status"
echo "  - Revertir última:        php artisan migrate:rollback"
echo "  - Refrescar todo:         php artisan migrate:fresh"
echo "  - Ver rutas:              php artisan route:list"
echo ""
echo -e "${YELLOW}Próximos pasos:${NC}"
echo "  1. Inicia el servidor:    php artisan serve"
echo "  2. Accede a:              http://localhost:8000/entities"
echo "  3. Revisa docs:           SISTEMA_BASE_DATOS.md"
echo ""
echo "====================================================="
