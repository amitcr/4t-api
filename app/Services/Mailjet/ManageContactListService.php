<?php
namespace App\Services\Mailjet;

use App\Services\MailjetService;
use Mailjet\Resources;

class ManageContactListService extends MailjetService
{
    public function list(array $query = []){
        return $this->client->get(Resources::$ContactManagecontactslists);
    }

    public function getById($id){
        return $this->client->get(Resources::$ContactManagecontactslists, ['id' => $id]);
    }

    public function create(array $data = []){
        return $this->client->post(Resources::$ContactManagecontactslists, ["body" => $data]);
    }

    public function updateById($id, array $data){
        return $this->client->post(Resources::$ContactManagecontactslists, ['id' => $id, 'body' => $data]);
    }

}