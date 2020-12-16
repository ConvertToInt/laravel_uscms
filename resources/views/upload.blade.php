<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Uploads</title>
</head>
<body>
    <form method ="POST" action="/upload" enctype ="multipart/form-data">
    {{ csrf_field() }}
    <input type="file" name="attachment"></input>
    <button type="submit">Upload attachment</button>
    </form>
    @isset($path)
    {{ $path }}</br>
    {{ $originalName }}</br>
    {{ $mime }}
    @endisset

</body>
</html>