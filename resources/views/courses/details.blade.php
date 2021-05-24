<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')
    <script>
        $(document).ready(function(){
            // Activate tooltip
            $('[data-toggle="tooltip"]').tooltip();

            // Select/Deselect checkboxes
            var checkbox = $('table tbody input[type="checkbox"]');
            $("#selectAll").click(function(){
                if(this.checked){
                    checkbox.each(function(){
                        this.checked = true;
                    });
                } else{
                    checkbox.each(function(){
                        this.checked = false;
                    });
                }
            });
            checkbox.click(function(){
                if(!this.checked){
                    $("#selectAll").prop("checked", false);
                }
            });
        });
    </script>
</head>
<body>
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Details about Contact {{$course->id}}</b></h2>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
                    </th>
                    <th>Title</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Duration</th>
                    <th>ECTS</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
							<span class="custom-checkbox">
								<input type="checkbox" id="checkbox1" name="options[]" value="1">
								<label for="checkbox1"></label>
							</span>
                    </td>
                    <td>{{$course->title}}</td>
                    <td>{{$course->course_code}}</td>
                    <td>{{$course->description}}</td>
                    <td>{{$course->duration}}</td>
                    <td>{{$course->ects}}</td>
                </tr>
                <p class = "text-center mt-5">
                    <a href="{{route('courses.index')}}" class="btn btn-primary">Back</a>
                </p>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>

