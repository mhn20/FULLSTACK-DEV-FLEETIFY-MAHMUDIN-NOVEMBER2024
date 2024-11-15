@extends('base')
@section('css')
  <style>
    .cursor-pointer{
      cursor: pointer;
    }
  </style>
@endsection
@section('contents')
<?php date_default_timezone_set('Asia/Jakarta'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $datawebsite['title'] }}</h1>
            </div>
            <!-- /.col -->
            <!-- <div class="col-sm-6"> <ol class="breadcrumb float-sm-right"> <li
            class="breadcrumb-item"> <a href="/panel/dashboard">Dashboard</a> </li> <li
            class="breadcrumb-item active">Data Website</li> </ol> </div> -->
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Table Data</h3>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                      <div class="input-group input-group-sm" style="width: auto;">
                            <input type="date"
                              name="table_date_attendance"
                              class="form-control float-right"
                              placeholder="Search" value="{{ date('Y-m-d') }}">
                            <input
                              type="text"
                              name="table_search"
                              class="form-control float-right"
                              placeholder="Departement">

                              <div class="input-group-append">
                                  <button type="submit" class="btn btn-default" id="btn_search">
                                      <i class="fas fa-search"></i>
                                  </button>
                              </div>
                          </div>
                      </div>
                    </h3>

                    <div class="card-tools">
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0  table-responsive">
                        <table class="table" id="table_data">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No.</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Date Attendance</th>
                                    <th>Departement</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>

@endsection

@section('js')
  <script>

    getData();

    $('#btn_search').on('click',function(){
      getData();
    });

    
    $(`[name="table_date_attendance"]`).on('change',function(){
      getData();
    });
    $(`[name="table_search"]`).on('change',function(){
      getData();
    });


    function getData(page=1){
      var table_data = $('#table_data > tbody');
      table_data.html(`
        <tr>
          <td style="width: 10px" class="text-center" colspan="7"><i class="fas fa-spin fa-spinner"></i> Loading</td>
        </tr>
      `);
      $.ajax({
        'url' : `{{ route('attendance.data') }}`,
        'type' : 'GET',
        'data' : {
          'page' : page, 'search' : $('[name="table_search"]').val(), 'date_attendance' : $('[name="table_date_attendance"]').val()
        },
        'success' : function(result){
          if(result.data.length == 0){
            table_data.html(`
              <tr>
                <td style="width: 10px" class="text-center" colspan="7">Data Tidak Ditemukan</td>
              </tr>
            `);
          }else{
            table_data.html('');
            $.each(result.data,function(key,val){
              table_data.append(`
                <tr>
                  <td style="width: 10px" class="text-center">${key+1}</td>
                  <td class="text-center">${val['status']}</td>
                  <td class="text-center">${val['attendance_type']}</td>
                  <td>${val['date_attendance']}</td>
                  <td>${val['departement_name']}</td>
                  <td>${val['employee']['name']}</td>
                  <td>${val['employee']['address']}</td>
                </tr>
              `);
            });
          }
        }
      });
    }
  </script>
@endsection