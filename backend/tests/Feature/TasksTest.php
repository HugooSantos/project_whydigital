<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CommonTasksTrait;
use Tests\Feature\Traits\CommonAuthTrait;
use Tests\TestCase;

class TasksTest extends TestCase
{
    use RefreshDatabase,
        CommonAuthTrait,
        CommonTasksTrait;

    public function test_update_task_sucess(): void
    {
        $token = $this->catchTokenAuth();
        $commomBody = $this->getCommonBodyDescription();
        $body = $this->changeBody($commomBody);
        $route = $this->getRouteWithId($token);
        sleep(0.5);
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json('put', $route, $body);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'id',
                    'user_id',
                    'description',
                    'complete',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }

    private function changeBody(array $commomBody): array
    {
        $commomBody['description'] = 'nova descrição';
        $commomBody['complete'] = 'T';
        return $commomBody;
    }

    public function test_delete_task_sucess(): void
    {
        $token = $this->catchTokenAuth();
        $route = $this->getRouteWithId($token);
        sleep(0.5);
        $responseDestroy = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json('delete', $route);

        $responseDestroy->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'id',
                    'user_id',
                    'description',
                    'complete',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }

    public function test_list_all_user_tasks_sucess(): void
    {
        $token = $this->catchTokenAuth();
        $this->createTask($token);
        sleep(0.5);
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json('get', '/api/tasks');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'data' => [[
                    'id',
                    'user_id',
                    'description',
                    'complete',
                    'created_at',
                    'updated_at'
                ]]
            ]);
    }

    public function test_list_specific_task_sucess(): void
    {
        $token = $this->catchTokenAuth();
        $route = $this->getRouteWithId($token);
        sleep(0.5);
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json('get', $route);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'id',
                    'user_id',
                    'description',
                    'complete',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }

    public function test_update_invalid_user_error(): void
    {
        $token = $this->catchTokenAuth();
        $commomBody = $this->getCommonBodyDescription();
        $route = $this->getRouteWithId($token);
        $newToken = $this->catchTokenAuth();
        sleep(0.5);
        $response = $this->withHeader('Authorization', 'Bearer ' . $newToken)
            ->json('put', $route, $commomBody);

        $response->assertStatus(403);
    }

    public function test_delete_invalid_user_error(): void
    {
        $token = $this->catchTokenAuth();
        $route = $this->getRouteWithId($token);
        $newToken = $this->catchTokenAuth();
        sleep(0.5);
        $response = $this->withHeader('Authorization', 'Bearer ' . $newToken)
            ->json('delete', $route);

        $response->assertStatus(403);
    }

    public function test_create_task_sucess(): void
    {
        $token = $this->catchTokenAuth();
        $body = $this->getCommonBodyDescription();
        sleep(0.5);
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json('post', '/api/tasks', $body);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'id',
                    'user_id',
                    'description',
                    'complete',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }
}
