@extends('layouts.app')

@section('title', 'Employes page - task-project.shop.com')

@section('content')
<div class="container">
    <form id="form-upload" method="post" action="{{ route('import') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlFile1">Employees file input</label>
            <div class="file-upload-wrapper" data-text=" ">
                <input type="file" name="file" id="file" class="file-upload-field" value="">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mb-2">Upload file</button>
    </form>

</div>

@endsection