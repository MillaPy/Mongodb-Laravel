<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')
    <title>Create Contact</title>
    <meta name = "csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="table-responsive">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Contacts Creation</h2>
                    <p>Please fill this form and submit to add a record</p>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
            <form action ="{{route('courses.store')}}" method ="post">
                @csrf
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name ="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <input type="text-field" name ="description" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Course Code</label>
                    <input type ="text" name ="course_code" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Duration</label>
                    <input type="text" name ="duration" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>ECTS</label>
                    <input type="text" name ="ects" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Course ID</label>
                    <input type="text" name ="course_id" class="form-control" required>
                </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="{{route('courses.index')}}" class="btn btn-default">Cancel</a>
            </thead>
        </table>
    </div>
</div>
</body>
</html>
