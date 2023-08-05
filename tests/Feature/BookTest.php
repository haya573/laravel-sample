<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_本一覧のurlにアクセスして画面が表示される()
    {
        $response = $this->get(route("books.index"));
        $response->assertOk();
    }

    /** @test */
    public function create_本作成のurlにアクセスして画面が表示される()
    {
        $response = $this->get(route("books.create"));
        $response->assertOk();
    }

    /** @test */
    public function store_本を作成する()
    {
        $data = Book::factory()->make()->toArray();

        $this->post(route("books.store"), $data);
        $this->assertDatabaseHas("books", $data);
    }

    /** @test */
    public function store_作成後は本一覧に遷移する()
    {
        $data = Book::factory()->make()->toArray();
        $response = $this->post(route("books.store"), $data);
        $response->assertRedirect(route("books.index"));
    }


    /** @test */
    public function show_本詳細のurlにアクセスして画面が表示される()
    {
        $book = Book::factory()->create();

        $response = $this->get(route("books.show", $book->id));
        $response->assertOk();
    }

    /** @test */
    public function edit_本編集のurlにアクセスして画面が表示される()
    {
        $book = Book::factory()->create();

        $response = $this->get(route("books.edit", $book->id));
        $response->assertOk();
    }

    /** @test */
    public function update_本を更新する()
    {
        $book = Book::factory()->create();
        $data = ["name" => "ハリーポッター"];

        $response = $this->put(route("books.update", $book->id), $data);
        $this->assertDatabaseHas("books", $data);
    }

    /** @test */
    public function update_更新完了後は本詳細画面に遷移する()
    {
        $book = Book::factory()->create();
        $data = ["name" => "ハリーポッター"];

        $response = $this->put(route("books.update", $book->id), $data);
        $response->assertRedirect(route("books.show", $book->id));
    }

    /** @test */
    public function destroy_本を削除する()
    {
        $book = Book::factory()->create();
        $book->delete();

        $this->assertDatabaseMissing("books", $book->toArray());
    }

    /** @test */
    public function destroy_削除後は本一覧画面に遷移する()
    {
        $book = Book::factory()->create();
        $response = $this->delete(route("books.destroy", $book->id));
        $response->assertRedirect(route("books.index"));
    }
}
