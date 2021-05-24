<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')
    <title>Edit Contact</title>
    <meta name = "csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="table-responsive">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Contacts Edition</h2>
                    <p>Please fill this form and submit to add a record</p>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
            <div class="col-md-12">
                <h4>Edit Contacts with IIN {{$course->id}}</h4>
            </div>
            <form action ="{{route('courses.update', $course->id)}}" method ="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="title" value ="{{$course->title}}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Code</label>
                    <input type="text" name="course_code" value ="{{$course->course_code}}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <input type ="text" name="teacher_id" value ="{{$course->description}}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Duration</label>
                    <input type="text" name="phone" value ="{{$course->duration}}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>ECTS</label>
                    <input type="text" name="phone" value ="{{$course->ects}}" class="form-control" required>
                </div>
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="{{route('courses.index')}}" class="btn btn-default">Cancel</a>
            </form>
            </thead>
        </table>
    </div>
</div>
</body>
</html>
