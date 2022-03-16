@extends('layouts.app')

@section('title', 'Employes page - task-project.shop.com')

@section('content')
<label for="date">Select period:</label>
<select name="date" id="date" class="form-select">
  <option value="2022-01">January 2022</option>
  <option value="2022-02">February 2022</option>
  <option value="2022-03">March 2022</option>
</select>

<label for="department">Select department:</label>
<select name="department" id="department" class="form-select">
  <option value=''>All</option>
  @foreach ($departments as $department)
  <option value='{{ $department->codename }}' data-codename="{{ $department->codename }}">{{ $department->name }}</option>
  @endforeach
</select>

<h3>Period: {{ $period }}</h3>

@isset($department_name)
<h3>Department: {{ $department_name }}</h3>
@endisset

@if (isset($empty))
  <p>
    There is not employyers!
  </p>
@else
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Surname</th>
        <th scope="col">Salary</th>
        <th scope="col">Department</th>
        <th scope="col">Birthday</th>
        <th scope="col">Position</th>
        <th scope="col">Hours</th>
        <th scope="col">Total salary</th>
      </tr>
    </thead>
    <tbody>

      @foreach ($employers as $employee)
      <tr>
        <th scope="row">{{ $employee->id }}</th>
        <td>{{ $employee->name }} </td>
        <td>{{ $employee->surname }}</td>
        <td>
          {{ $employee->salary }}
          @if ($employee->salary_type === 2)
          (per hour)
          @endif
        </td>
        <td>{{ $employee->department_name }}</td>
        <td>{{ $employee->birthday }}</td>
        <td>{{ $employee->position }}</td>
        <td>
          @if ($employee->salary_type === 1)
          -
          @else
          {{ $employee->hours }}
          @endif
        </td>
        <td>{{ $employee->total_salary }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <hr>
  <label for="limit">Show:</label>
  <select name="limit" id="limit" class="form-select col-sm-1">
    <option value='5'>5</option>
    <option value='10'>10</option>
    <option value='25'>25</option>
    <option value='50'>50</option>
    <option value='100'>100</option>
  </select>
  <hr>
  <div class="div">{{ $employers->appends(request()->input())->links() }}</div>

@endif
<script>
  $(document).ready(function() {
    $("#date option[value='{{ $period }}']").attr("selected", "selected");

    @isset($department_name)
    $("#department option[value='{{ $department_codename }}']").attr("selected", "selected");
    @endisset

    @isset($limit)
    $("#limit option[value='{{ $limit }}']").attr("selected", "selected");
    @endisset

    $('#date').on('change', function(e) {
      window.location.href = "{{ $current_link }}?start=" + $(this).val();
    });

    $('#department').on('change', function(e) {
      window.location.href = "{{ route('employes') }}/" + $(this).val();
    });

    $('#limit').on('change', function(e) {
      window.location.href = "{{ $current_link }}?limit=" + $(this).val();
    });

  });
</script>
@endsection