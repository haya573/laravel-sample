<h1>{{ $book->name }}の詳細</h1>

<a href="/books/{{$book->id}}/edit">編集する</a>

<form method="post" action="{{ url("/books/{$book->id}") }}">
    @method('delete')
    @csrf
    <button type="submit">削除する</button>
</form>