<?php
namespace App\Services\Api;

use App\Services\Http\BaseHttpService;

/**
 * TODO: GraphQL equivalents (developer guide §7):
 *   - list()     → listParticipants query
 *   - create()   → createParticipant mutation
 *   - updateById() → updateParticipant mutation
 */
class ParticipantsService extends BaseHttpService
{
    protected string $endpoint = 'participants';

    // TODO: GraphQL equivalent — listParticipants query
    public function list(array $query = [])
    {
        return $this->get($this->endpoint, $query);
    }

    // TODO: GraphQL equivalent — getParticipant query
    public function getById($id, $query = [])
    {
        return $this->get("{$this->endpoint}/{$id}", $query);
    }

    // TODO: GraphQL equivalent — createParticipant mutation
    public function create(array $data)
    {
        return $this->post($this->endpoint, $data);
    }

    // TODO: GraphQL equivalent — updateParticipant mutation
    public function updateById($id, array $data)
    {
        return $this->put("{$this->endpoint}/{$id}", $data);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function patchById($id, array $data)
    {
        return $this->patch("{$this->endpoint}/{$id}", $data);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function deleteById($id)
    {
        return $this->delete("{$this->endpoint}/{$id}");
    }
}
