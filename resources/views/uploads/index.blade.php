<ol type='1'>
    @foreach ($uploads as $upload)
        <li value='{{$upload->id}}'>
            <a href='{{url("/uploads/{$upload->id}/file/{$upload->origName}") }}'>{{ $upload->origName }}</a>
            {{ $upload->title }} {{ $upload->content }}
            {{ $upload->user->name }} {{ $upload->user->id }}
            @auth
            <form method ="POST"
                action='{{url("/uploads/{$upload->id}/edit")}}'  
                style="display:inline!Important;"
            >

                @csrf
                @method('get')
                <input type="submit" value="Edit" style="display:inline!important;">
            </form>

            <form method ="POST" 
                action='{{url("/uploads/{$upload->id}")}}'  
                style="display:inline!Important;">

                @csrf
                @method('delete')
                <input type="submit" value="Delete" style="display:inline!important;">
            </form>
            @endauth
        </li>
    @endforeach
</ol>

@auth
<a href="/uploads/create">Add Files</a>
<br> I am {{ Auth::user()->name }}
and not a number {{ Auth::user()->id }}.
@endauth

@guest
    <a href="/login">Login</a> or <a href="/register">Register</a>
@endguest