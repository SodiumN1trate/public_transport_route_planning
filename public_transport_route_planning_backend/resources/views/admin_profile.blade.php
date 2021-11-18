@extends('layout')

@section('main_content')
    <div class="upload-box">
        Lai pievienotu JSON failu nepieciešams to augšupielādēt.
        <form method="post" action="admin/upload_json" enctype="multipart/form-data">
            @csrf
            <input type="file" name="json">
            <input type="submit">
        </form>
    </div>
@endsection()
