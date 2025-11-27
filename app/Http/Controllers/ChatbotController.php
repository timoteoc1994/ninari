<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    /**
     * Procesar mensaje del chatbot con Google Gemini AI
     * Solo responde preguntas relacionadas con NINARI Foundation
     */
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        $userMessage = $request->input('message');

        // Contexto y restricciones para el AI
        $systemContext = "Eres un asistente virtual de NINARI Foundation. Tu nombre es Ninari Bot. 

INFORMACIÓN SOBRE NINARI:
NINARI es una organización privada sin fines de lucro que articula a los actores del ecosistema de innovación para promover el desarrollo socioeconómico sostenible del Ecuador.

MISIÓN: A través de la innovación social, productiva y comercial, buscamos generar soluciones efectivas a los desafíos del territorio, fortaleciendo capacidades, creando oportunidades y promoviendo regiones más inclusivas, competitivas y sostenibles.

EJES ESTRATÉGICOS:
1. DESARROLLO ECONÓMICO SOSTENIBLE:
   - Construcción de ecosistemas
   - I+D+i Industrias
   - Impulso al Emprendimiento
   - Economía Naranja

2. INNOVACIÓN:
   - Innovación Social
   - Innovación Productiva
   - Innovación Comercial
   - Innovación Abierta

3. DERECHOS Y PROTECCIÓN:
   - Enfoque de Género
   - Generacional
   - Intercultural

CONTACTO:
- Teléfono: 0963211354
- Email: info@ninari.org.ec
- Dirección: Ficoa - Guaytambos y Manzanos - Edificio UTPL

REGLAS ESTRICTAS:
1. SOLO responde preguntas relacionadas con NINARI Foundation, sus programas, servicios, contacto, o temas de innovación y desarrollo sostenible en Ecuador.
2. Si te preguntan sobre temas NO relacionados con NINARI (como 'qué es un árbol', 'recetas de cocina', 'historia general', etc.), debes responder EXACTAMENTE:
   'Lo siento, soy un asistente especializado de NINARI Foundation. Solo puedo responder preguntas sobre nuestra organización, programas de innovación, emprendimiento y desarrollo sostenible en Ecuador. ¿En qué puedo ayudarte sobre NINARI?'
3. Si no tienes información específica sobre algo de NINARI, sugiere contactar directamente.
4. Sé amable, profesional y conciso.
5. Usa un tono cercano pero profesional.
6. No saludes ya que existe un mensaje inicial de bienvenida, solo responde directamente.

Pregunta del usuario: {$userMessage}

Responde en español:";

        try {
            // Llamar a la API de Google Gemini
            $apiKey = env('API_KEY');
            
            if (!$apiKey) {
                return response()->json([
                    'error' => 'La API de inteligencia artificial no está configurada'
                ], 500);
            }

            $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash-exp:generateContent";
            
            $response = Http::timeout(30)->withHeaders([
                'Content-Type' => 'application/json',
                'x-goog-api-key' => $apiKey,
            ])->post($url, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $systemContext]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.7,
                    'maxOutputTokens' => 500,
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $respuestaIA = $data['candidates'][0]['content']['parts'][0]['text'] ?? '';

                if ($respuestaIA) {
                    return response()->json([
                        'success' => true,
                        'message' => $respuestaIA,
                        'timestamp' => now()->toIso8601String()
                    ]);
                }
            }

            // Si la respuesta no fue exitosa
            return response()->json([
                'error' => 'No se pudo procesar tu mensaje. Por favor intenta nuevamente.',
                'details' => $response->json()
            ], 500);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al conectar con el asistente virtual. Por favor intenta más tarde.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener mensajes de bienvenida predefinidos
     */
    public function welcome()
    {
        return response()->json([
            'message' => '¡Hola! Soy Ninari Bot 👋',
            'subtitle' => 'Asistente virtual de NINARI Foundation',
            'suggestions' => [
                '¿Qué es NINARI?',
                '¿Qué programas ofrecen?',
                '¿Cómo puedo contactarlos?',
                'Información sobre innovación social'
            ]
        ]);
    }
}
