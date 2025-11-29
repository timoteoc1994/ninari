<?php

namespace App\Services;

use setasign\Fpdi\Fpdi;
use Illuminate\Support\Facades\Storage;

class PdfService
{
    public function generate($pdfPath, $variables)
    {
        // Initialize in 'pt' (points) to match PDFJS coordinates from frontend
        $pdf = new Fpdi('P', 'pt');

        // Disable compression to preserve PDF quality
        $pdf->SetCompression(false);

        // Disable auto page breaks to prevent unwanted new pages
        $pdf->SetAutoPageBreak(false);

        // Remove margins to ensure absolute positioning works from (0,0)
        $pdf->SetMargins(0, 0, 0);

        // Get the absolute path to the file
        $fullPath = Storage::disk('public')->path($pdfPath);

        if (!file_exists($fullPath)) {
            throw new \Exception("PDF template not found: " . $fullPath);
        }

        $pageCount = $pdf->setSourceFile($fullPath);

        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $templateId = $pdf->importPage($pageNo);
            $size = $pdf->getTemplateSize($templateId);

            // Add a page with the same orientation and size
            $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
            $pdf->useTemplate($templateId);

            // Add variables for this page
            foreach ($variables as $variable) {
                // Determine font style based on bold and italic
                $style = '';
                if (!empty($variable['bold']) && !empty($variable['italic'])) {
                    $style = 'BI'; // Bold Italic
                } elseif (!empty($variable['bold'])) {
                    $style = 'B'; // Bold
                } elseif (!empty($variable['italic'])) {
                    $style = 'I'; // Italic
                }

                // Set font with style
                $fontFamily = $variable['font_family'] ?? 'Arial';
                $fontSize = $variable['font_size'] ?? 12;
                $pdf->SetFont($fontFamily, $style, $fontSize);

                // Convert hex color to RGB
                if (isset($variable['color'])) {
                    list($r, $g, $b) = sscanf($variable['color'], "#%02x%02x%02x");
                    $pdf->SetTextColor($r, $g, $b);
                } else {
                    $pdf->SetTextColor(0, 0, 0);
                }

                // Use Text() instead of Write() for absolute positioning
                // This prevents text flow issues and page breaks
                $pdf->Text($variable['x_pos'], $variable['y_pos'], $variable['text']);

                // Handle underline manually by drawing a line
                if (!empty($variable['underline'])) {
                    $textWidth = $pdf->GetStringWidth($variable['text']);
                    $pdf->SetLineWidth(0.5);
                    $pdf->Line(
                        $variable['x_pos'],
                        $variable['y_pos'] + 1,
                        $variable['x_pos'] + $textWidth,
                        $variable['y_pos'] + 1
                    );
                }
            }
        }

        return $pdf->Output('S');
    }
}
