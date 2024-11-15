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
            <div class="card">
                <div class="card-header">
                    <embed src="/DOKUMENTASI.pdf" type="application/pdf" width="100%" height="800px">
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