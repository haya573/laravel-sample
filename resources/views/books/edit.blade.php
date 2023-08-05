<h1>{{ $book->name }}を編集する</h1>

<form action="{{ url("/books/{$book->id}") }}" method="post">
    @method('PATCH')
    @csrf
    <div>
        <label for="name">本の名前</label>
        <input id="name" type="text" name="name" value="{{ $book->name }}">
    </div>
    <button type="submit" name="add">更新</button>
</form>