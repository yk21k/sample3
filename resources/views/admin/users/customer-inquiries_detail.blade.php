@extends('admin.layout.layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
      <div class="container-fluid">
          <div class="">
            <!-- /.card -->
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Inquiry & Answer</h3>
              </div>
              <!-- /.card-header -->
              @foreach($inquiryAnswersDetails as $inquiryAnswersDetail)
              
              <div style=""><lable>This User:{{ $inquiryAnswersDetail->user_id }}</lable></div>
              <div class="card-body">
                <form>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>User ID</label>
                        <input type="text" class="form-control col-3" value="{{ $inquiryAnswersDetail->user_id }}" disabled>
                        <label>Inquiry Subject</label>
                        <input type="text" class="form-control" value="{{ $inquiryAnswersDetail->inq_subject }}" disabled>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>User ID</label>
                        <input type="text" class="form-control col-3" value="{{ $inquiryAnswersDetail->user_id }}" disabled>
                        <label>Answer Subject</label>
                        <input type="text" class="form-control" placeholder="Enter ...">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Inquiry Detail</label>
                        <textarea class="form-control" rows="3" disabled>{{ $inquiryAnswersDetail->inquiry_details }}</textarea>
                      </div>
                    </div>  
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Answers</label>
                        <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                      </div>
                    </div>
                  </div>

                  <!-- input states -->
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- checkbox -->
                      <div class="form-group">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                          <label class="form-check-label">Checkbox</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" checked>
                          <label class="form-check-label">Checkbox checked</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" disabled>
                          <label class="form-check-label">Checkbox disabled</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- radio -->
                      <div class="form-group">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="radio1">
                          <label class="form-check-label">Radio</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="radio1" checked>
                          <label class="form-check-label">Radio checked</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" disabled>
                          <label class="form-check-label">Radio disabled</label>
                        </div>
                      </div>
                    </div>
                  </div>

                </form>
              </div>
              @endforeach
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection 