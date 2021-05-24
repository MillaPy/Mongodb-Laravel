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
                        <h2>Contacts of Teachers</h2>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Aggregate Degrees
                        </button>
                        @foreach($teachers as $t)
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" class="nav-item nav-link" href="{{route('teachers.filter_doctors', $t->degree)}}">Doctorate</a>
                                <a class="dropdown-item" class="nav-item nav-link" href="{{route('teachers.filter_masters', $t->degree)}}">Master</a>
                                <a class="dropdown-item" class="nav-item nav-link" href="{{route('teachers.filter_bachelors', $t->degree)}}">Bachelors</a>
                                <a class="dropdown-item" class="nav-item nav-link" href="{{route('teachers.filter_others', $t->degree)}}">Others</a>
                            </div>
                        @endforeach
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Contacts
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" class="nav-item nav-link" href="{{route('students.index')}}">Students</a>
                            <a class="dropdown-item" class="nav-item nav-link" href="{{route('courses.index')}}">Courses</a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{route('teachers.create')}}" class="btn btn-success pull-right"><i class="material-icons">&#xE147;</i> <span>Create Contact</span></a>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Date of Birth</th>
                    <th>Degree</th>
                    <th>Speciality</th>

                </tr>
                </thead>
                <tbody>
                @foreach($teachers as $teacher)
                    <tr>
                        <td>{{$teacher->fullname}}</td>
                        <td>{{$teacher->email}}</td>
                        <td>{{$teacher->phone}}</td>
                        <td>{{$teacher->gender}}</td>
                        <td>{{$teacher->address}}</td>
                        <td>{{$teacher->date_of_birth}}</td>
                        <td>{{$teacher->degree}}</td>
                        <td>{{$teacher->speciality}}</td>
                        <td>

                            <a href="{{route('teachers.show', $teacher->id)}}" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                            <a href="{{route('teachers.edit', $teacher->id)}}" class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                            <div id="deleteEmployeeModal" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form class="form-delete" action="{{route('teachers.destroy', $teacher->id)}}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <div class="modal-header">
                                                <h4 class="modal-title">Delete Contacts {{$teacher->id}}?</h4>
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
                <span>{{$teachers->links()}}</span>
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
