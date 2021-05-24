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
            <form action ="{{route('students.store')}}" method ="post">
                @csrf
                <div class="form-group">
                    <label>Full-Name</label>
                    <input type="text" name ="fullname" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>E-mail</label>
                    <input type="email" name ="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Student ID</label>
                    <input type ="text" name ="student_id" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Phone number</label>
                    <input type="text" name ="phone" class="form-control" required>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Gender
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <div class="flex flex-row items-center">
                            <label class="block text-gray-500 font-bold">
                                <input name="gender" class="mr-2 leading-tight" type="radio" value="male">
                                <span class="text-sm">Male</span>
                            </label>
                            <label class="ml-4 block text-gray-500 font-bold">
                                <input name="gender" class="mr-2 leading-tight" type="radio" value="female">
                                <span class="text-sm">Female</span>
                            </label>
                            <label class="ml-4 block text-gray-500 font-bold">
                                <input name="gender" class="mr-2 leading-tight" type="radio" value="other">
                                <span class="text-sm">Other</span>
                            </label>
                        </div>
                    </div>
                <div class="form-group">
                    <label>Permanent Address</label>
                    <input type="text" name ="address" class="form-control" required>
                </div>
                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                                    Date of Birth
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input name="date_of_birth" id="datepicker-sc" autocomplete="off" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" value="{{ old('date_of_birth') }}">
                                @error('date_of_birth')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="{{route('students.index')}}" class="btn btn-default">Cancel</a>
            </thead>
        </table>
    </div>
</div>
</body>
</html>
