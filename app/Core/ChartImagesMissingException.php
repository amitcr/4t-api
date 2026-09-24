<?php
namespace App\Core;

use Exception;

/**
 * Thrown by a report job when the assessment's chart images are not yet available.
 *
 * The queue worker treats this differently from a normal failure: instead of marking
 * the job failed (or completed), it HOLDS the job for a configurable window and retries
 * later. The job is released immediately once the admin generates the missing chart.
 */
class ChartImagesMissingException extends Exception
{
}