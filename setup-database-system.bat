@echo off
REM Script de Instalación para Sistema de Base de Datos Dinámica - Windows

echo =====================================================
echo    Sistema de Base de Datos Dinámica - Setup
echo =====================================================
echo.

REM 1. EJECUTAR MIGRACIONES
echo [1/5] Ejecutando migraciones...
php artisan migrate

if %errorlevel% neq 0 (
    echo ERROR: Fallo al ejecutar migraciones
    pause
    exit /b 1
)

echo [OK] Migraciones ejecutadas correctamente
echo.

REM 2. POBLAR CON DATOS DE EJEMPLO
set /p SEED="Deseas poblar la base de datos con datos de ejemplo? (S/N): "

if /i "%SEED%"=="S" (
    echo Poblando base de datos...
    php artisan db:seed --class=EntityDatabaseSeeder
    
    if %errorlevel% neq 0 (
        echo ADVERTENCIA: Error al poblar datos
    ) else (
        echo [OK] Base de datos poblada con datos de ejemplo
    )
) else (
    echo Saltando datos de ejemplo
)

echo.

REM 3. LIMPIAR CACHE
echo [2/5] Limpiando caches...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo [OK] Caches limpiados
echo.

REM 4. CREAR STORAGE LINKS
echo [3/5] Creando enlaces simbolicos de storage...
php artisan storage:link

echo [OK] Enlaces creados
echo.

REM 5. COMPILAR ASSETS
set /p BUILD="Deseas compilar assets de frontend? (S/N): "

if /i "%BUILD%"=="S" (
    echo [4/5] Compilando assets...
    call npm run build
    
    if %errorlevel% neq 0 (
        echo ADVERTENCIA: Error al compilar assets
    ) else (
        echo [OK] Assets compilados
    )
) else (
    echo Saltando compilacion de assets
)

echo.

REM 6. INFORMACIÓN FINAL
echo =====================================================
echo [OK] Instalacion Completada
echo =====================================================
echo.
echo Rutas disponibles:
echo   - Base de Datos:          /entities
echo   - Gestion de Campos:      /entity-fields
echo   - Importar Excel:         /excel-import
echo   - Contextos:              /contexts
echo.
echo Comandos utiles:
echo   - Ver migraciones:        php artisan migrate:status
echo   - Revertir ultima:        php artisan migrate:rollback
echo   - Refrescar todo:         php artisan migrate:fresh
echo   - Ver rutas:              php artisan route:list
echo.
echo Proximos pasos:
echo   1. Inicia el servidor:    php artisan serve
echo   2. Accede a:              http://localhost:8000/entities
echo   3. Revisa docs:           SISTEMA_BASE_DATOS.md
echo.
echo =====================================================
echo.
pause
