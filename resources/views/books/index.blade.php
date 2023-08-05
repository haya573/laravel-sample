<h1>本の一覧</h1>

<ul>
    @foreach($books as $index => $book)
        <li>
            <a href="/books/{{$book->id}}">{{ $index+1 }}: {{ $book->name }}</a>
        </li>
    @endforeach
</ul>