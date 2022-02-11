@extends('admin.admin_master')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">

                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Edit Student</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form method="post" action="{{ route('student.registration.update',  $editStudent['student_id'] ) }}" enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $editStudent->id }}">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <h5>Student Name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" id="student_name" name="student_name" class="form-control" value="{{ $editStudent['student']['name'] }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <h5>Father's Name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" id="father_name" name="father_name" class="form-control" value="{{ $editStudent['student']['fname'] }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <h5>Mother's Name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" id="mother_name" name="mother_name" class="form-control" value="{{ $editStudent['student']['mname'] }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <h5>Mobile Number <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" id="mobile" name="mobile" class="form-control" value="{{ $editStudent['student']['mobile'] }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <h5>Address <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" id="address" name="address" class="form-control" value="{{ $editStudent['student']['address'] }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <h5>Gender <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="gender" id="gender" required="" class="form-control">
                                                        <option value="">Select Gender</option>
                                                        <option value="Male" {{ ( $editStudent['student']['gender'] == "Male") ? 'selected': '' }}>Male</option>
                                                        <option value="Female"  {{ ( $editStudent['student']['gender'] == "Female") ? 'selected': '' }}>Female</option>
                                                    </select>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <h5>Religion <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="religion" id="religion" required="" class="form-control">
                                                        <option value="">Select Religion</option>
                                                        <option value="Hindi" {{ ( $editStudent['student']['religion'] == 'Hindi') ? 'selected': '' }}>Hindi</option>
                                                        <option value="Buddhism" {{ ( $editStudent['student']['religion'] == 'Buddhism') ? 'selected': '' }}>Buddhism</option>
                                                    </select>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <h5>Date of Birth <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" id="date" name="date" class="form-control" value="{{ $editStudent['student']['dob'] }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <h5>Discount <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" id="discount" name="discount" class="form-control" value="{{ $editStudent['discount']['discount'] }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <h5>Year <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="year_id" id="year_id" required="" class="form-control">
                                                        <option value="" disabled>Select Year</option>
                                                        @foreach ($years as $year)
                                                            <option value="{{ $year->id }}" {{ ( $editStudent['student_year']['name'] == $year->name) ? 'selected': '' }}>{{ $year->name }}
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
                                                    <select name="class_id" id="class_id" required="" class="form-control">
                                                        <option value="" disabled>Select Class</option>
                                                        @foreach ($classes as $class)
                                                            <option value="{{ $class->id }}" {{ ( $editStudent['student_class']['name'] == $class->name) ? 'selected': '' }}>{{ $class->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <h5>Group <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="group_id" id="group_id" required="" class="form-control">
                                                        <option value="" disabled>Select Group</option>
                                                        @foreach ($groups as $group)
                                                            <option value="{{ $group->id }}" {{ ( $editStudent['student']['group_id'] == $group->id) ? 'selected': '' }}>{{ $group->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <h5>Shift <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="shift_id" id="shift_id" required="" class="form-control">
                                                        <option value="" disabled>Select Shift</option>
                                                        @foreach ($shifts as $shift)
                                                            <option value="{{ $shift->id }}" {{ ( $editStudent['student']['shift_id'] == $shift->id) ? 'selected': '' }}>{{ $shift->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <h5>Profile Image <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="image" id="image" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <img id="showImage" src="{{ !empty($editStudent['student']['image']) ? url('upload/student_images/' . $editStudent['student']['image']) : url('upload/no_image.jpg') }}"
                                                    style="width: 100px; height: 100px; border:1px solid #000000;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-info mb-5" value="Submit" />
                                </form>

                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </section>

        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            })
        })
    </script>

@endsection
