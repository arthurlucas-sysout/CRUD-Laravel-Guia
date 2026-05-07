    <form action="{{ url($url)}}" method="POST">
        @csrf
        @method('DELETE')

        <input type="hidden" name="id" value="{{ $id }}">
        <button type="submit">{{ $text }}</button>
    </form>
