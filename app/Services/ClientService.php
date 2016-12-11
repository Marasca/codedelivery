<?php

namespace CodeDelivery\Services;


use CodeDelivery\Repositories\ClientRepository;
use CodeDelivery\Repositories\UserRepository;

class ClientService
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(ClientRepository $clientRepository, UserRepository $userRepository)
    {
        $this->clientRepository = $clientRepository;
        $this->userRepository = $userRepository;
    }

    public function create(array $data)
    {
        $data['user']['password'] = bcrypt($data['user']['password']);
        $userId = $this->userRepository->create($data['user'])->id;

        $data['user_id'] = $userId;
        $this->clientRepository->create($data);
    }

    public function update(array $data, $id)
    {
        $this->clientRepository->update($data, $id);

        $userId = $this->clientRepository->find($id)->user_id;

        if (!empty($data['user']['password']))
            $data['user']['password'] = bcrypt($data['user']['password']);
        else
            unset($data['user']['password']);

        $this->userRepository->update($data['user'], $userId);
    }
}