<?php
namespace App\Services\Api;

use App\Services\Http\BaseHttpService;

class NeedsAssessmentResultsService extends BaseHttpService
{
    protected string $endpoint = 'needs-assessment-results';

    public function list(array $query = [])
    {
        return $this->get($this->endpoint, $query);
    } 

    public function getById($id)
    {
        return $this->get("{$this->endpoint}/{$id}");
    }

    public function create(array $data)
    {
        return $this->post($this->endpoint, $data);
    }

    public function updateById($id, array $data)
    {
        return $this->put("{$this->endpoint}/{$id}", $data);
    }

    public function patchById($id, array $data)
    {
        return $this->patch("{$this->endpoint}/{$id}", $data);
    }

    public function deleteById($id)
    {
        return $this->delete("{$this->endpoint}/{$id}");
    }
}
