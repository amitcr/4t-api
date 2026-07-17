<?php
namespace App\Controllers\ScoringEngine;

use App\Core\Response;
use App\Services\Api\SelfAssessmentResponsesService;
use Illuminate\Http\Client\RequestException;

class SelfAssessmentResponseController
{
    protected SelfAssessmentResponsesService $svc;

    public function __construct()
    {
        $this->svc = new SelfAssessmentResponsesService();
    }

    // GET /v1/participants
    public function index($request)
    {
        $query = $request->all(); // optional filters
        try {
            return $this->svc->list($query);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $response = $e->getResponse();
            $body = null;

            if ($response) {
                // Convert JSON safely
                $body = json_decode($response->getBody()->getContents(), true);
            }

            return response()->json([
                'error' => $e->getMessage(),
                'body'  => $body
            ], $response ? $response->getStatusCode() : 500);
        }
    }


        // GET /v1/participants/{id}
    public function show($request, $id)
    {
        try {
            return $this->svc->getById($id);
        } catch (RequestException $e) {
            $status = ($e->response) ? $e->response->getStatusCode() : 500;
            $body   = ($e->response) ? $e->response->json() : null;
            return Response::json(['error' => $e->getMessage(), 'body' => $body], $status);
        }
    }

    // POST /v1/self-assessment-responses
    public function store($request)
    {
        $data = $request->all();

        // Idempotent upsert keyed by (participantSessionId, questionPath): one round-trip
        // creates or updates the response, so no duplicate-check snapshot is needed.
        try {
            $saved = $this->svc->save($data);

            if ($saved === null) {
                $message = $this->svc->getLastError() ?? 'Your response could not be saved. Please try again.';
                return Response::json(['message' => $message], 422);
            }

            // Normalize to a transport-neutral shape — never leak the GraphQL structure
            // to the browser. The client only needs the response id to reuse on re-saves.
            $responseId = $saved->saveSelfAssessmentResponse->response->id ?? null;

            return Response::json(['responseId' => $responseId], 200);
        } catch (RequestException $e) {
            $status = ($e->response) ? $e->response->getStatusCode() : 500;
            $body   = ($e->response) ? $e->response->json() : null;
            return Response::json(['error' => $e->getMessage(), 'body' => $body], $status);
        }
    }

    // PUT /v1/self-assessment-responses/{id}
    public function update($request, $id)
    {
        $data = $request->all();
        try {
            $updated = $this->svc->updateById($id, $data);

            if ($updated === null) {
                $message = $this->svc->getLastError() ?? 'Your response could not be updated. Please try again.';
                return Response::json(['message' => $message], 422);
            }

            return Response::json($updated);
        } catch (RequestException $e) {
            $status = ($e->response) ? $e->response->getStatusCode() : 500;
            $body   = ($e->response) ? $e->response->json() : null;
            return Response::json(['error' => $e->getMessage(), 'body' => $body], $status);
        }
    }

    // PATCH /v1/participants/{id}
    public function patch($request, $id)
    {
        $data = $request->all();
        try {
            return $this->svc->patchById($id, $data);
        } catch (RequestException $e) {
            $status = ($e->response) ? $e->response->getStatusCode() : 500;
            $body   = ($e->response) ? $e->response->json() : null;
            return Response::json(['error' => $e->getMessage(), 'body' => $body], $status);
        }
    }

    // DELETE /v1/participants/{id}
    public function destroy($request, $id)
    {
        try {
            return $this->svc->deleteById($id);
        } catch (RequestException $e) {
            $status = ($e->response) ? $e->response->getStatusCode() : 500;
            $body   = ($e->response) ? $e->response->json() : null;
            return Response::json(['error' => $e->getMessage(), 'body' => $body], $status);
        }
    }

}
