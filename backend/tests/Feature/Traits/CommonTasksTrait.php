<?php

namespace Tests\Feature\Traits;

trait CommonTasksTrait
{
    use CommonAuthTrait;

    protected function getCommonBodyDescription(): array
    {
        return [
            "description" => "teste"
        ];
    }

    protected function createTask(string $token): string
    {
        $body = $this->getCommonBodyDescription();
        return $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json('post', '/api/tasks', $body)->getContent();
    }

    protected function getLastCreatedTaskId(string $token): int
    {
        $bodyResponse = $this->createTask($token);
        return json_decode($bodyResponse, true)['data']['id'];
    }

    protected function getRouteWithId(string $token): string
    {
        $taskId = $this->getLastCreatedTaskId($token);
        return '/api/tasks/' . $taskId;
    }
}
