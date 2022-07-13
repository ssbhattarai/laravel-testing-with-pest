<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

beforeEach(function (){
    $user = User::factory()->create();
    Sanctum::actingAs($user);
});

it('can create a post', function () {

    $post = Post::factory()->raw();
    $response = $this->postJson('/api/posts', $post);
    $response->assertStatus(201)->assertJson(['message' => 'post created successfully', 'status' => 'success']);
    $this->assertDatabaseHas('posts', $post);
});

it('error when title not supplied', function () {
    $response = $this->postJson('/api/posts', ['content' => 'Updated tite']);
    $response->assertStatus(422);
});

it('error when content not supplied', function () {
    $response = $this->postJson('/api/posts', ['title' => 'Updated tite']);
    $response->assertStatus(422);
});

it('error when title and content are not supplied', function () {
    $response = $this->postJson('/api/posts', []);
    $response->assertStatus(422);
});

it('can fetch a post', function () {
    $post = Post::factory()->create();
    $response = $this->getJson("/api/posts/{$post->id}");
    $data = [
        'message' => 'post fetched successfully',
        'data' => [
            'id' => $post->id,
            'title' => $post->title,
            'excerpt' => $post->excerpt,
            'content' => $post->content,
        ]
    ];

    $response->assertStatus(200)->assertJson($data);
});

it('can not fetch a post with wrong id', function () {
    $post = Post::factory()->create();
    $wrongId = $post->id + 1;
    $response = $this->getJson("/api/posts/{$wrongId}");
    $response->assertStatus(500);
});

it('can update a post', function () {
    $post = Post::factory()->create();
    $updatedpost = ['title' => 'Updated tite', 'content' => 'Updated content'];
    $response = $this->putJson("/api/posts/{$post->id}", $updatedpost);
    $response->assertStatus(200)->assertJson(['message' => 'post updated successfully']);
    $this->assertDatabaseHas('posts', $updatedpost);
});

it('can delete a post', function () {
    $post = Post::factory()->create();
    $response = $this->deleteJson("/api/posts/{$post->id}");
    $response->assertStatus(200)->assertJson(['message' => 'post deleted successfully']);
    $this->assertCount(0, Post::all());
});

