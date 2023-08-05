<h1>本を追加する</h1>
<form action="{{ url('/books')}}" method="POST">
    @csrf
    <div>
        <label for="name">本の名前</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}">
    </div>
    <button type="submit" name="add">追加</button>
</form>