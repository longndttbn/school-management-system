@extends('admin.admin_master')

@section('admin')

    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">

                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Edit User</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form method="post" action="{{ route('user.update', $user->id) }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <h5>User Role <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="role" id="role" required="" class="form-control">
                                                        <option value="" disabled>Select Role</option>
                                                        <option value="Admin"
                                                            {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                                                        <option value="Operator" {{ $user->role == 'Operator' ? 'selected' : '' }}>Operator</option>
                                                    </select>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <h5>User Email <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="email" name="email" class="form-control"
                                                        value="{{ $user->email }}">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-6">

                                            <div class="form-group">
                                                <h5>User Name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="name" class="form-control"
                                                        value="{{ $user->name }}">
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-info mb-5" value="Update" />
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

@endsection
