<?php
namespace App\Services\Mailjet;

use App\Services\MailjetService;
use Mailjet\Resources;

class ContactDataService extends MailjetService
{
    public function list(array $query = [])
    {
        return $this->client->get(Resources::$Contactdata);
    }

    public function getById($id){
        return $this->client->get(Resources::$Contactdata, ['id' => $id]);
    }

    public function create(array $data = []){
        return $this->client->post(Resources::$Contactdata, ["body" => $data]);
    }

    public function updateById($id, array $data)
    {
        return $this->client->put(Resources::$Contactdata, ['id' => $id, 'body' => $data]);
    }

}