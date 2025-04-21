<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form action="{{ route('herramientas.store') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="text" name="categoria"/>
    <input type="text" name="marca"/>
    <input type="text" name="titulo"/>
    <input type="text" name="descripcion"/>
    <input type="text" name="archivo"/>
    <input type="file" name="link"/>
    <input type="text" name="status"/>
    
    <input type="submit" value="Upload" />
</form>



@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


</body>
</html>