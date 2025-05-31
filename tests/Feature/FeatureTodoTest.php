<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class FeatureTodoTest extends TestCase
{
    public function testUpdateDataActivity()
    {
        // 1. Simpan task baru
        $task = \App\Models\Task::create(['name' => 'Old Task']);

        // 2. Kirim permintaan update
        $response = $this->put(route('item.update', $task->id), [
            'item' => 'Updated Task',
        ]);

        // 3. Apakah data berhasil diperbarui
        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'name' => 'Updated Task',
        ]);

        // 4. Redirect ke halaman dashboard
        $response->assertRedirect(route('dashboard'));
    }

    public function testStoreDataActivityWithMultipleTags()
    {
        // 1. Cek halaman dashboard
        $response = $this->get(route('dashboard'));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertSee('Enter an activity');

        // 2. Kirim data dengan multiple tags
        $data = [
            'item' => 'Multi Tag Task|tag1,tag2',
        ];
        $storeData = $this->post(route('item.store'), $data);

        // 3. Cek database
        $storeData->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('tasks', [
            'name' => 'Multi Tag Task',
        ]);
        $this->assertDatabaseHas('tags', [
            'tag_name' => 'tag1',
        ]);
        $this->assertDatabaseHas('tags', [
            'tag_name' => 'tag2',
        ]);

        // 4. Redirect
        $storeData->assertRedirect(route('dashboard'));
    }

    public function testStoreDataActivityValidationError()
    {
        // 1. Kirim data kosong
        $data = [
            'item' => '',
        ];
        $response = $this->post(route('item.store'), $data);

        // 2. Pastikan validasi gagal dan tidak masuk DB
        $response->assertSessionHasErrors('item');
        $this->assertDatabaseMissing('tasks', [
            'name' => '',
        ]);
    }

    public function testDashboardShowsAllTasks()
    {
        // 1. Tambah data dummy
        \App\Models\Task::create(['name' => 'Task A']);
        \App\Models\Task::create(['name' => 'Task B']);

        // 2. Kunjungi dashboard
        $response = $this->get(route('dashboard'));

        // 3. Periksa isi halaman
        $response->assertStatus(Response::HTTP_OK);
        $response->assertSee('Task A');
        $response->assertSee('Task B');
    }
}