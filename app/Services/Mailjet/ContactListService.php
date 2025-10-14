<?php
namespace App\Services\Mailjet;

use App\Services\MailjetService;
use Mailjet\Resources;

class ContactListService extends MailjetService
{
    public function list(array $query = [])
    {
        return $this->client->get(Resources::$Contactslist);
    }

    public function getById($id){
        return $this->client->get(Resources::$Contactslist, ['id' => $id]);
    }

    public function create(array $data = []){
        return $this->client->post(Resources::$Contactslist, ["body" => $data]);
    }

    public function updateById($id, array $data)
    {
        return $this->client->put(Resources::$Contactslist, ['id' => $id, 'body' => $data]);
    }
    
    public function deleteById($id)
    {
        return $this->client->delete(Resources::$Contactslist, ['id' => $id]);
    }

}