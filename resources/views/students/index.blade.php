<!DOCTYPE html>
<html lang="en">
<head>
@include('layouts.head')
</head>
    <body>
    <div class="container-xl">
        <div class="row">
            @if(session('success'))
                <div class = "alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong>{{session('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif</div>
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2 href="{{route('students.index')}}">Contacts of Students</h2>
                            <a href="{{route('students.index')}}" class="btn btn-success pull-right"><span>Students</span></a>
                            <a href="{{route('students.create')}}" class="btn btn-success pull-right"><i class="material-icons">&#xE147;</i> <span>Create Contact</span></a>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropbtn">
                                Filter
                            </button>
                            @foreach($students as $s)
                                <div class="dropdown-content" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" class="nav-item nav-link" href="{{route('students.filter_gender_male', $s->gender)}}">Male</a>
                                    <a class="dropdown-item" class="nav-item nav-link" href="{{route('students.filter_gender_female', $s->gender)}}">Female</a>
                                    <a class="dropdown-item" class="nav-item nav-link" href="{{route('students.filter_gender_other', $s->gender)}}">Other</a>
                                </div>
                            @endforeach
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Contacts
                            </button>
                                <div class="dropdown-content" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" class="nav-item nav-link" href="{{route('teachers.index')}}">Teachers</a>
                                    <a class="dropdown-item" class="nav-item nav-link" href="{{route('courses.index')}}">Courses</a>
                                </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Student ID</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Date of Birth</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{$student->fullname}}</td>
                            <td>{{$student->email}}</td>
                            <td>{{$student->student_id}}</td>
                            <td>{{$student->phone}}</td>
                            <td>{{$student->gender}}</td>
                            <td>{{$student->address}}</td>
                            <td>{{$student->date_of_birth}}</td>
                            <td>

                                <a href="{{route('students.show', $student->id)}}" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                                <a href="{{route('students.edit', $student->id)}}" class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                                <div id="deleteEmployeeModal" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form class="form-delete" action="{{route('students.destroy', $student->id)}}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Delete Contacts {{$student->id}}?</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete these Records?</p>
                                                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                                    <input type="submit" class="btn btn-danger" value="Delete">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="clearfix">
                    <span>{{$students->links()}}</span>
                    <style>
                        nav svg{
                            max-height: 20px;
                            max-width: 40px;
                        }
                    </style>
                </div>
            </div>
        </div>
    </div>
