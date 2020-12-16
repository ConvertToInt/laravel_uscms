<form method ="POST" action='{{url("/uploads/$id")}}' enctype ="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="file" name="upload"><br>
    <input type="text" name="title" value="{{$title}}">Title<br>
    <textarea name="content">{{$content}}</textarea>Content<br>
    <input type="submit" value="Change Upload">
</form>

@if ( ! empty($id) )
    <br>
    <a href="{{url("/uploads",[$id,'file',$origName])}}">{{ $id }} {{ $origName }}</a>
    <br>
    @if(substr($mimeType, 0, 5) == 'image')
        <img height="25%" width="25%" src="{{url('/uploads',[$id,'file',$origName])}}">
        <br>
    @endif
@endif

@isset($id)
    <strong>ID:</strong> {{ $id }}<br>
    <strong>Title:</strong> {{ $title }}<br>
    <strong>Content:</strong> {{ $content }}<br>
    <strong>OrigName:</strong> {{ $origName }}<br>
    <strong>Mime:</strong> {{ $mimeType }}<br>
@endisset

<br><a href="{{url('/uploads')}}">Back to uploads</a>

</body>
</html>