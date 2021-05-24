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
                        <h2>Courses</h2>
                        <a href="{{route('courses.create')}}" class="btn btn-success pull-right"><i class="material-icons">&#xE147;</i> <span>Create Course</span></a>
                    </div>
                    <form method="GET" >
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="search" class="form-control" placeholder="Search" value="{{ old('search') }}">
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('courses.search')}}" class="btn btn-xs btn-info pull-right">Search</a>
                            </div>
                        </div>
                    </form>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Find ECTS
                        </button>
                        @foreach($courses as $c)
                        <div class="dropdown-content" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" class="nav-item nav-link" href="{{route('courses.find_more', $c->ects)}}">More 5 ECTS</a>
                            <a class="dropdown-item" class="nav-item nav-link" href="{{route('courses.find_less', $c->ects)}}">Less 5 ECTS</a>
                        </div>
                        @endforeach
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Contacts
                        </button>
                        <div class="dropdown-content" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" class="nav-item nav-link" href="{{route('students.index')}}">Students</a>
                            <a class="dropdown-item" class="nav-item nav-link" href="{{route('teachers.index')}}">Teachers</a>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Duration</th>
                    <th>ECTS</th>
                </tr>
                </thead>
                <tbody>
                @if($courses->count())
                @foreach($courses as $course)
                    <tr>
                        <td>{{$course->title}}</td>
                        <td>{{$course->course_code}}</td>
                        <td>{{$course->description}}</td>
                        <td>{{$course->duration}}</td>
                        <td>{{$course->ects}}</td>
                        <td>

                            <a href="{{route('courses.show', $course->id)}}" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                            <a href="{{route('courses.edit', $course->id)}}" class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                            <div id="deleteEmployeeModal" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form class="form-delete" action="{{route('courses.destroy', $course->id)}}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <div class="modal-header">
                                                <h4 class="modal-title">Delete Contacts {{$course->id}}?</h4>
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
                @else
                    <tr>
                        <td colspan="3">Result not found.</td>
                    </tr>
                @endif
                </tbody>
            </table>
            <div class="clearfix">
                <span>{{$courses->links()}}</span>
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
