@extends('admin.admin_master')

@section('admin')
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Student Search</h3>

                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <form method="GET" action="{{ route('student.registration.search') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <h5>Year <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="year_id" id="year_id" required="" class="form-control">
                                                        <option value="" disabled>Select Year</option>
                                                        @foreach ($years as $year)
                                                            <option value="{{ $year->id }}"
                                                                {{ @$year_id == $year->id ? 'selected' : '' }}>
                                                                {{ $year->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <h5>Class <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="class_id" id="class_id" required=""
                                                        class="form-control">
                                                        <option value="" disabled>Select Class</option>
                                                        @foreach ($classes as $class)
                                                            <option value="{{ $class->id }}"
                                                                {{ @$class_id == $class->id ? 'selected' : '' }}>
                                                                {{ $class->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group" style="padding-top: 25px;">
                                                <input type="submit" value="Search" class="btn btn-info mb-5 btn-rounded"
                                                    name="search">
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>

                <div class="row">
                    <div class="col-12">

                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Student List</h3>
                                <a href="{{ route('student.registration.add') }}" style="float: right;"
                                    class="btn btn-rounded btn-primary mb-5">Add Student</a>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Roll</th>
                                                <th>Year</th>
                                                <th>Class</th>
                                                <th>Image</th>
                                                @if (Auth::user()->role == 'Admin')
                                                    <th>Code</th>
                                                @endif
                                                <th with="25%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $item['student']['id_no'] }}</td>
                                                    <td>{{ $item['student']['name'] }}</td>
                                                    <td>{{ $item->roll }}</td>
                                                    <td>{{ $item['student_year']['name'] }}</td>
                                                    <td>{{ $item['student_class']['name'] }}</td>
                                                    <td>
                                                        <img id="showImage"
                                                            src="{{ !empty($item['student']['image'])? url('upload/student_images/' . $item['student']['image']): url('upload/no_image.jpg') }}"
                                                            style="width: 50px; height: 50px; border:1px solid #000000;">
                                                    </td>
                                                    <td>{{ $item['student']['code'] }}</td>
                                                    <td>
                                                        {{-- <a href="{{ route('student.year.edit', $item->id) }}" class="btn btn-info mb-5">Edit</a>
                                                <a href="{{ route('student.year.delete', $item->id) }}" id="delete" class="btn btn-danger mb-5">Delete</a> --}}
                                                        <a href="{{ route('student.registration.edit', $item->student_id) }}" class="btn btn-info mb-5">Edit</a>
                                                        <a href="" id="delete" class="btn btn-danger mb-5">Promotion</a>
                                                        <a href="{{ route('student.registration.details', $item->student_id) }}"  class="btn btn-success mb-5">Details</a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>


                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->

        </div>
    </div>

@endsection
