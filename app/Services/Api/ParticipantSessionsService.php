<?php
namespace App\Services\Api;

use App\Services\Http\BaseHttpService;

class ParticipantSessionsService extends BaseHttpService
{
    protected string $endpoint = 'participant-sessions';

    public function list(array $query = [])
    {
        return $this->get($this->endpoint, $query);
    }

    public function getById($id, $query = [])
    {
        return $this->get("{$this->endpoint}/{$id}", $query);
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
