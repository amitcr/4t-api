<?php

declare(strict_types=1);

namespace App\Services;

/**
 * ChartService
 *
 * Server-side PHP GD port of the HTML5 Canvas chart rendering logic from:
 *   includes/graph.php        — three-chart (Social + Historical + Preference)
 *   includes/single-graph.php — single-chart (Preference only)
 *
 * All block heights, X-axis positions, and text margin calculations are
 * identical to the originals so the generated PNGs match the canvas output.
 *
 * @since 2.0
 */
class ChartService
{
    /** @var string|null Resolved path to a TrueType bold font, or null if none found */
    private ?string $fontPath = null;

    public function __construct()
    {
        $this->fontPath = $this->resolveFontPath();
    }

    // -----------------------------------------------------------------------
    // Three-chart constants (from graph.php)
    // -----------------------------------------------------------------------

    /** @var array<int,int> Block top-Y per rating level (1=highest bar, 6=lowest) */
    private static array $blocksHeights = [
        1 => 410,
        2 => 360,
        3 => 310,
        4 => 260,
        5 => 210,
        6 => 160,
    ];

    private static int $perBlockHeight = 50;

    // -----------------------------------------------------------------------
    // Single-chart constants (from single-graph.php)
    // -----------------------------------------------------------------------

    private static array $singleBlocksHeights = [
        1 => 328,
        2 => 277,
        3 => 226,
        4 => 177,
        5 => 128,
        6 => 78,
    ];

    private static array $singleEachBlocksHeight = [
        1 => 51,
        2 => 50,
        3 => 49,
        4 => 49,
        5 => 50,
        6 => 51,
    ];

    // -----------------------------------------------------------------------
    // Public API
    // -----------------------------------------------------------------------

    /**
     * Generate the three-chart PNG (Social + Historical + Preference).
     *
     * @param object $result   Full self-assessment result with all rating fields.
     * @param string $savePath Absolute path to write the PNG.
     * @return bool
     */
    public function generateThreeChart(object $result, string $savePath): bool
    {
        $bgPath = dirname(dirname(__DIR__)) . '/resources/images/4t-graph-image.png';

        if (!file_exists($bgPath)) {
            return false;
        }

        $img = imagecreatefrompng($bgPath);
        if (!$img) {
            return false;
        }

        $black = imagecolorallocate($img, 0, 0, 0);

        $bh  = self::$blocksHeights;
        $pbh = self::$perBlockHeight;

        // --- Social block points ---
        $dSocial = $this->blockPoint($bh, $pbh, (int)($result->dSocialRating ?? 1), (float)($result->dSocialRatingScore ?? 0));
        $iSocial = $this->blockPoint($bh, $pbh, (int)($result->iSocialRating ?? 1), (float)($result->iSocialRatingScore ?? 0));
        $sSocial = $this->blockPoint($bh, $pbh, (int)($result->sSocialRating ?? 1), (float)($result->sSocialRatingScore ?? 0));
        $cSocial = $this->blockPoint($bh, $pbh, (int)($result->cSocialRating ?? 1), (float)($result->cSocialRatingScore ?? 0));

        // --- Historical block points ---
        $dHistory = $this->blockPoint($bh, $pbh, (int)($result->dHistoricalRating ?? 1), (float)($result->dHistoricalRatingScore ?? 0));
        $iHistory = $this->blockPoint($bh, $pbh, (int)($result->iHistoricalRating ?? 1), (float)($result->iHistoricalRatingScore ?? 0));
        $sHistory = $this->blockPoint($bh, $pbh, (int)($result->sHistoricalRating ?? 1), (float)($result->sHistoricalRatingScore ?? 0));
        $cHistory = $this->blockPoint($bh, $pbh, (int)($result->cHistoricalRating ?? 1), (float)($result->cHistoricalRatingScore ?? 0));

        // --- Preference block points ---
        $dPref = $this->blockPoint($bh, $pbh, (int)($result->dPreferenceRating ?? 1), (float)($result->dPreferenceRatingScore ?? 0));
        $iPref = $this->blockPoint($bh, $pbh, (int)($result->iPreferenceRating ?? 1), (float)($result->iPreferenceRatingScore ?? 0));
        $sPref = $this->blockPoint($bh, $pbh, (int)($result->sPreferenceRating ?? 1), (float)($result->sPreferenceRatingScore ?? 0));
        $cPref = $this->blockPoint($bh, $pbh, (int)($result->cPreferenceRating ?? 1), (float)($result->cPreferenceRatingScore ?? 0));

        // X positions — identical to JS vars in graph.php
        $S_D = 52;  $S_I = 98;  $S_S = 144; $S_C = 190;
        $H_D = 298; $H_I = 341; $H_S = 384; $H_C = 433;
        $P_D = 537; $P_I = 586; $P_S = 629; $P_C = 674;

        // Lines
        imageline($img, $S_D, $dSocial,  $S_I, $iSocial,  $black);
        imageline($img, $S_I, $iSocial,  $S_S, $sSocial,  $black);
        imageline($img, $S_S, $sSocial,  $S_C, $cSocial,  $black);

        imageline($img, $H_D, $dHistory, $H_I, $iHistory, $black);
        imageline($img, $H_I, $iHistory, $H_S, $sHistory, $black);
        imageline($img, $H_S, $sHistory, $H_C, $cHistory, $black);

        imageline($img, $P_D, $dPref,    $P_I, $iPref,    $black);
        imageline($img, $P_I, $iPref,    $P_S, $sPref,    $black);
        imageline($img, $P_S, $sPref,    $P_C, $cPref,    $black);

        // Dots (radius 5 = diameter 10, mirrors ctx.arc(..., 5, ...))
        $this->drawDot($img, $S_D, $dSocial,  $black);
        $this->drawDot($img, $S_I, $iSocial,  $black);
        $this->drawDot($img, $S_S, $sSocial,  $black);
        $this->drawDot($img, $S_C, $cSocial,  $black);

        $this->drawDot($img, $H_D, $dHistory, $black);
        $this->drawDot($img, $H_I, $iHistory, $black);
        $this->drawDot($img, $H_S, $sHistory, $black);
        $this->drawDot($img, $H_C, $cHistory, $black);

        $this->drawDot($img, $P_D, $dPref,    $black);
        $this->drawDot($img, $P_I, $iPref,    $black);
        $this->drawDot($img, $P_S, $sPref,    $black);
        $this->drawDot($img, $P_C, $cPref,    $black);

        // Text labels — derived from ranked temperaments arrays
        $socialLabel     = $this->patternLabel($result->socialRankedTemperaments     ?? []);
        $historicalLabel = $this->patternLabel($result->historicalRankedTemperaments ?? []);
        $preferenceLabel = $this->patternLabel($result->preferenceRankedTemperaments ?? []);

        // Margin calcs mirror graph.php
        $sMargin = max(0, 120 - (strlen($socialLabel)     * 4));
        $hMargin = max(0, 360 - (strlen($historicalLabel) * 4));
        $pMargin = max(0, 605 - (strlen($preferenceLabel) * 4));

        $this->drawWrappedText($img, $socialLabel,     $sMargin, 430, 210, 15, $black);
        $this->drawWrappedText($img, $historicalLabel, $hMargin, 430, 210, 15, $black);
        $this->drawWrappedText($img, $preferenceLabel, $pMargin, 430, 210, 15, $black);

        $this->ensureDir($savePath);
        $ok = imagepng($img, $savePath);
        imagedestroy($img);

        return $ok !== false;
    }

    /**
     * Generate the single-chart PNG (Preference only).
     *
     * @param object $result   Full self-assessment result.
     * @param string $savePath Absolute path to write the PNG.
     * @return bool
     */
    public function generateSingleChart(object $result, string $savePath): bool
    {
        $bgPath = dirname(dirname(__DIR__)) . '/resources/images/4t-single-graph.png';

        if (!file_exists($bgPath)) {
            return false;
        }

        $img = imagecreatefrompng($bgPath);
        if (!$img) {
            return false;
        }

        $black = imagecolorallocate($img, 0, 0, 0);

        $bh  = self::$singleBlocksHeights;
        $ebh = self::$singleEachBlocksHeight;

        $r     = (int)($result->dPreferenceRating ?? 1);
        $dPref = (int)round($bh[$r] - ($ebh[$r] * ((float)($result->dPreferenceRatingScore ?? 0)) / 100));
        $r     = (int)($result->iPreferenceRating ?? 1);
        $iPref = (int)round($bh[$r] - ($ebh[$r] * ((float)($result->iPreferenceRatingScore ?? 0)) / 100));
        $r     = (int)($result->sPreferenceRating ?? 1);
        $sPref = (int)round($bh[$r] - ($ebh[$r] * ((float)($result->sPreferenceRatingScore ?? 0)) / 100));
        $r     = (int)($result->cPreferenceRating ?? 1);
        $cPref = (int)round($bh[$r] - ($ebh[$r] * ((float)($result->cPreferenceRatingScore ?? 0)) / 100));

        // X positions — identical to JS vars in single-graph.php
        $P_D = 52; $P_I = 98; $P_S = 144; $P_C = 190;

        imageline($img, $P_D, $dPref, $P_I, $iPref, $black);
        imageline($img, $P_I, $iPref, $P_S, $sPref, $black);
        imageline($img, $P_S, $sPref, $P_C, $cPref, $black);

        $this->drawDot($img, $P_D, $dPref, $black);
        $this->drawDot($img, $P_I, $iPref, $black);
        $this->drawDot($img, $P_S, $sPref, $black);
        $this->drawDot($img, $P_C, $cPref, $black);

        $prefLabel = $this->patternLabel($result->preferenceRankedTemperaments ?? []);

        $pMargin = max(0, 110 - (strlen($prefLabel) * 4));

        $this->drawWrappedText($img, $prefLabel, $pMargin, 355, 210, 15, $black);

        $this->ensureDir($savePath);
        $ok = imagepng($img, $savePath);
        imagedestroy($img);

        return $ok !== false;
    }

    // -----------------------------------------------------------------------
    // Private helpers
    // -----------------------------------------------------------------------

    /**
     * Compute the Y pixel position for a data point.
     * Mirrors: ($blocksHeights[$rating] - ($perBlockHeight * $score/100))
     */
    private function blockPoint(array $bh, int $perBlock, int $rating, float $score): int
    {
        $rating = max(1, min(6, $rating));
        return (int) round($bh[$rating] - ($perBlock * $score / 100));
    }

    /**
     * Draw a filled circle (radius 5) — mirrors ctx.arc(..., 5, 0, 2*PI, true).
     *
     * @param \GdImage $img
     */
    private function drawDot($img, int $x, int $y, $color): void
    {
        imagefilledellipse($img, $x, $y, 10, 10, $color);
    }

    /**
     * Word-wrap text and draw line-by-line — mirrors the canvas wrapText() function.
     *
     * When a TrueType font is available, uses imagettftext() whose Y parameter is the
     * text baseline — identical to canvas fillText(). When falling back to the GD
     * bitmap font, imagestring() uses Y as the top of the glyph, so we subtract
     * imagefontheight() to align the visual baseline with the canvas position.
     *
     * @param \GdImage $img
     * @param float    $fontSize Point size for TTF rendering (ignored in bitmap fallback).
     */
    private function drawWrappedText($img, string $text, int $x, int $y, int $maxWidth, int $lineHeight, $color, float $fontSize = 11.0): void
    {
        if ($this->fontPath !== null) {
            // TTF path — y is baseline, matches canvas fillText() exactly
            foreach (explode("\n", $text) as $paragraph) {
                $line  = '';
                $words = explode(' ', $paragraph);

                foreach ($words as $word) {
                    $test      = $line . $word . ' ';
                    $bbox      = imagettfbbox($fontSize, 0, $this->fontPath, rtrim($test));
                    $testWidth = abs($bbox[2] - $bbox[0]);

                    if ($testWidth > $maxWidth && $line !== '') {
                        imagettftext($img, $fontSize, 0, $x, $y, $color, $this->fontPath, rtrim($line));
                        $line = $word . ' ';
                        $y   += $lineHeight;
                    } else {
                        $line = $test;
                    }
                }

                if ($line !== '') {
                    imagettftext($img, $fontSize, 0, $x, $y, $color, $this->fontPath, rtrim($line));
                    $y += $lineHeight;
                }
            }
        } else {
            // Bitmap fallback — imagestring() y is top of glyph; shift up by font height
            // to place the visual baseline at the same pixel as the canvas y coordinate.
            $font  = 4;
            $adjY  = $y - imagefontheight($font);
            $charW = imagefontwidth($font);

            foreach (explode("\n", $text) as $paragraph) {
                $line  = '';
                $words = explode(' ', $paragraph);

                foreach ($words as $word) {
                    $test = $line . $word . ' ';

                    if ((strlen($test) * $charW) > $maxWidth && $line !== '') {
                        imagestring($img, $font, $x, $adjY, rtrim($line), $color);
                        $line  = $word . ' ';
                        $adjY += $lineHeight;
                    } else {
                        $line = $test;
                    }
                }

                if ($line !== '') {
                    imagestring($img, $font, $x, $adjY, rtrim($line), $color);
                    $adjY += $lineHeight;
                }
            }
        }
    }

    /**
     * Find a usable bold TrueType font on the host.
     * Checks the API's own resources/fonts/ directory first so a bundled copy
     * can be deployed independently of the OS font paths.
     */
    private function resolveFontPath(): ?string
    {
        if (!function_exists('imagettftext')) {
            return null;
        }

        $candidates = [
            dirname(dirname(__DIR__)) . '/resources/fonts/arialbd.ttf',
            'C:/Windows/Fonts/arialbd.ttf',
            'C:/Windows/Fonts/arial.ttf',
            '/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf',
            '/usr/share/fonts/truetype/liberation/LiberationSans-Bold.ttf',
        ];

        foreach ($candidates as $path) {
            if (file_exists($path)) {
                return $path;
            }
        }

        return null;
    }

    /**
     * Build a "The XY" label from a ranked temperaments array.
     * e.g. ["D","I"] → "The DI"
     */
    private function patternLabel($rankedTemperaments): string
    {
        if (empty($rankedTemperaments)) {
            return '';
        }
        return 'The ' . implode('', (array) $rankedTemperaments);
    }

    private function ensureDir(string $filePath): void
    {
        $dir = dirname($filePath);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
    }
}
