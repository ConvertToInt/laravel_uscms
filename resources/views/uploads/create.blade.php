<form method ="POST" action='{{url("/uploads")}}' enctype ="multipart/form-data">
    @csrf
    <input type="file" name="upload"><br>
    <input type="text" name="title">Title<br>
    <textarea name="content"></textarea>Content<br>
    <input type="submit" value="Save Upload">
</form>

@if ( ! empty($id) )
    <br>
    <a href="{{url("/uploads",[$id,$origName])}}">{{ $id }} {{ $origName }}</a>
    <br>
    @if(substr($mimeType, 0, 5) == 'image')
        <img height="25%" width="25%" src="{{url('/uploads',[$id,$origName])}}">
        <br>
    @endif
@endif