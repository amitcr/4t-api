<?php
namespace App\Services\Mailjet;

use App\Services\MailjetService;
use Mailjet\Resources;

class ContactsService extends MailjetService
{
    public function list(array $query = []){
        return $this->client->get(Resources::$Contact);
    }

    public function getById($id){
        return $this->client->get(Resources::$Contact, ['id' => $id]);
    }

    public function create(array $data = []){
        return $this->client->post(Resources::$Contact, ["body" => $data]);
    }

    public function updateById($id, array $data){
        return $this->client->put(Resources::$Contact, ['id' => $id, 'body' => $data]);
    }

}