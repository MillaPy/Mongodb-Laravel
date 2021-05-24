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
                    <div class="col-sm-4">
                        <div class="search-box">
                            <i class="material-icons">&#xE8B6;</i>
                            <input type="text" class="form-control" placeholder="Search&hellip;">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{route('teachers.index')}}" class="btn btn-success pull-right"><i class="material-icons">&#xE147;</i> <span>Back</span></a>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Teacher ID</th>
                    <th>Degree</th>
                    <th>Speciality</th>
                    <th>Awards</th>

                </tr>
                </thead>
                <tbody>
                @foreach($teachers as $teacher)
                    <tr>
                        <td>{{$teacher->fullname}}</td>
                        <td>{{$teacher->teacher_id}}</td>
                        <td>{{$teacher->degree}}</td>
                        <td>{{$teacher->speciality}}</td>
                        <td>{{$teacher->awards_amount}}</td>
                        <td>
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
