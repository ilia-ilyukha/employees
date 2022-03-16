@extends('layouts.app')

@section('title', 'Employes page - task-project.shop.com')

@section('content')

<style>
    .custom-file-label::after {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        z-index: 3;
        display: block;
        height: calc(calc(2.25rem + 2px) - 1px * 2);
        padding: 0.375rem 0.75rem;
        line-height: 1.5;
        color: #495057;
        content: "Browse";
        background-color: #e9ecef;
        border-left: 1px solid #ced4da;
        border-radius: 0 0.25rem 0.25rem 0;
    }

    .custom-file-label {
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        z-index: 1;
        height: calc(2.25rem + 2px);
        padding: 0.375rem 0.75rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }

    .custom-file-input {
        position: relative;
        z-index: 2;
        width: 100%;
        height: calc(2.25rem + 2px);
        margin: 0;
        opacity: 0;
    }

    .custom-file {
        position: relative;
        display: inline-block;
        width: 100%;
        height: calc(2.25rem + 2px);
        margin-bottom: 0;
    }
    #submit_button{
        margin-top: 10px
    }
    #form-upload{
        margin-top: 10px
    }
</style>
<form class="was-validated">

</form>

<div class="container">
    <form id="form-upload" method="post" action="{{ route('import') }}" enctype="multipart/form-data" class="col-lg-6 offset-lg-3 ">
        @csrf

        <div class="custom-file">
            <input type="file" class="custom-file-input" name="file" id="customFile">
            <label class="custom-file-label" for="customFile">Choose Employees file</label>
        </div>
        <button type="submit" class="btn btn-primary mb-2" id="submit_button">Upload file</button>
    </form>


</div>

@endsection