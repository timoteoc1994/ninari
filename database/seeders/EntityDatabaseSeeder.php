<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Entity;
use App\Models\EntityField;
use App\Models\Context;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear campos dinámicos de ejemplo
        $emailField = EntityField::create([
            'nombre_campo' => 'email',
            'etiqueta' => 'Correo Electrónico',
            'tipo_dato' => 'text',
            'es_requerido' => false,
            'orden' => 1,
        ]);

        $telefonoField = EntityField::create([
            'nombre_campo' => 'telefono',
            'etiqueta' => 'Teléfono',
            'tipo_dato' => 'text',
            'es_requerido' => false,
            'orden' => 2,
        ]);

        $ciudadField = EntityField::create([
            'nombre_campo' => 'ciudad',
            'etiqueta' => 'Ciudad',
            'tipo_dato' => 'text',
            'es_requerido' => false,
            'orden' => 3,
        ]);

        $cargoField = EntityField::create([
            'nombre_campo' => 'cargo',
            'etiqueta' => 'Cargo',
            'tipo_dato' => 'text',
            'es_requerido' => false,
            'orden' => 4,
        ]);

        $edadField = EntityField::create([
            'nombre_campo' => 'edad',
            'etiqueta' => 'Edad',
            'tipo_dato' => 'number',
            'es_requerido' => false,
            'orden' => 5,
        ]);

        $fechaNacimientoField = EntityField::create([
            'nombre_campo' => 'fecha_nacimiento',
            'etiqueta' => 'Fecha de Nacimiento',
            'tipo_dato' => 'date',
            'es_requerido' => false,
            'orden' => 6,
        ]);

        $activoField = EntityField::create([
            'nombre_campo' => 'activo',
            'etiqueta' => 'Activo',
            'tipo_dato' => 'boolean',
            'es_requerido' => false,
            'orden' => 7,
        ]);

        $generoField = EntityField::create([
            'nombre_campo' => 'genero',
            'etiqueta' => 'Género',
            'tipo_dato' => 'select',
            'opciones' => ['Masculino', 'Femenino', 'Otro', 'Prefiero no decir'],
            'es_requerido' => false,
            'orden' => 8,
        ]);

        // Crear entidades de ejemplo
        $persona1 = Entity::create([
            'tipo' => 'persona',
            'nombre' => 'Juan',
            'apellido' => 'Pérez García',
        ]);

        $persona1->setFieldValue('email', 'juan.perez@example.com');
        $persona1->setFieldValue('telefono', '+34 600 123 456');
        $persona1->setFieldValue('ciudad', 'Madrid');
        $persona1->setFieldValue('cargo', 'Desarrollador Senior');
        $persona1->setFieldValue('edad', '35');
        $persona1->setFieldValue('genero', 'Masculino');
        $persona1->setFieldValue('activo', '1');

        $persona2 = Entity::create([
            'tipo' => 'persona',
            'nombre' => 'María',
            'apellido' => 'González López',
        ]);

        $persona2->setFieldValue('email', 'maria.gonzalez@example.com');
        $persona2->setFieldValue('telefono', '+34 600 789 012');
        $persona2->setFieldValue('ciudad', 'Barcelona');
        $persona2->setFieldValue('cargo', 'Diseñadora UX/UI');
        $persona2->setFieldValue('edad', '28');
        $persona2->setFieldValue('genero', 'Femenino');
        $persona2->setFieldValue('activo', '1');

        $institucion1 = Entity::create([
            'tipo' => 'institucion',
            'nombre' => 'Universidad Nacional',
            'apellido' => null,
        ]);

        $institucion1->setFieldValue('email', 'contacto@universidad.edu');
        $institucion1->setFieldValue('telefono', '+34 91 123 45 67');
        $institucion1->setFieldValue('ciudad', 'Madrid');

        $empresa1 = Entity::create([
            'tipo' => 'empresa',
            'nombre' => 'Tech Solutions S.L.',
            'apellido' => null,
        ]);

        $empresa1->setFieldValue('email', 'info@techsolutions.com');
        $empresa1->setFieldValue('telefono', '+34 93 456 78 90');
        $empresa1->setFieldValue('ciudad', 'Barcelona');

        // Crear contextos de ejemplo
        $proyecto1 = Context::create([
            'nombre' => 'Programa Innova 2025',
            'year' => '2025',
            'tipo' => 'programa',
            'descripcion' => 'Programa de innovación y emprendimiento',
        ]);

        $proyecto2 = Context::create([
            'nombre' => 'Convocatoria Tech Startups',
            'year' => '2025',
            'tipo' => 'convocatoria',
            'descripcion' => 'Convocatoria para startups tecnológicas',
        ]);

        // Asignar entidades a contextos con roles
        $proyecto1->entities()->attach($persona1->id, ['rol' => 'participante']);
        $proyecto1->entities()->attach($persona2->id, ['rol' => 'mentor']);
        $proyecto1->entities()->attach($institucion1->id, ['rol' => 'aliado']);

        $proyecto2->entities()->attach($persona1->id, ['rol' => 'beneficiario']);
        $proyecto2->entities()->attach($empresa1->id, ['rol' => 'aliado']);

        $this->command->info('Base de datos poblada con datos de ejemplo exitosamente.');
    }
}
