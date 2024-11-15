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
            <!-- <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="/panel/dashboard">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Data Website</li>
                </ol>
            </div> -->
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
                    <button class="btn btn-info btn-sm" id="btn_modal">
                        <i class="fas fa-plus"></i> Add Data
                    </button>
                </h3>

                <!-- <div class="card-tools">
                  <ul class="pagination pagination-sm float-right">
                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                  </ul>
                </div> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0 table-responsive">
                <table class="table" id="table_data">
                  <thead>
                    <tr>
                      <th style="width: 10px">No.</th>
                      <th style="width: 10px">Action</th>
                      <th>Departement Name</th>
                      <th>Max Clock In Time</th>
                      <th>Max Clock Out Time</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</section>

<!-- Modal -->
<form  entype="multipart/form-data" id="form_data">
{{ csrf_field() }}
<div class="modal fade" id="form_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <label for="">
              <b>
                Departement Name
              </b>
            </label>
            <input type="text" name="departement_name" class="form-control" maxlength="255" placeholder="Departement Name">
          </div>
          <div class="col-md-12 mt-2">
            <label for="">
              <b>
                Max Clock In Time
              </b>
            </label>
            <input type="text" name="max_clock_in_time" class="form-control" required placeholder="Max Clock In Time" value="{{ date('H:i:s') }}">
          </div>
          <div class="col-md-12 mt-2">
            <label for="">
              <b>
                Max Clock Out Time
              </b>
            </label>
            <input type="text" name="max_clock_out_time" class="form-control" required placeholder="Max Clock Out Time" value="{{ date('H:i:s') }}">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Save</button>
      </div>
    </div>
  </div>
</div>
</form>
@endsection

@section('js')
  <script>
    $('input[name="max_clock_in_time"]').datetimepicker({
      format:'HH:mm:ss'
    });

    $('input[name="max_clock_out_time"]').datetimepicker({
      format:'HH:mm:ss'
    });


    $('#btn_modal').on('click',function(){
      $('#exampleModalLabel').html(`<i class="fas fa-plus"></i> Add Data`);
      $('#form_modal').modal('show');
      $('#form_data').trigger('reset');
      $('#form_data').attr('method','POST');
      $('#form_data').attr('action',`{{ route('departement.postData') }}`);
      
      $('[name="max_clock_in_time"]').val(`{{ date('H:i:s') }}`);
      $('[name="max_clock_out_time"]').val(`{{ date('H:i:s') }}`);
    });

    function editData(self){
      $('#exampleModalLabel').html(`<i class="fas fa-pencil-alt"></i> Edit Data`);
      $('#form_modal').modal('show');
      $('#form_data').trigger('reset');
      $('#form_data').attr('method','PUT');
      $('#form_data').attr('action',`{{ route('departement.editData',-1) }}`.replace(-1,self.attr('data-id')));
      $('[name="departement_name"]').val(self.attr('data-departement_name'));
      $('[name="max_clock_in_time"]').val(self.attr('data-max_clock_in_time'));
      $('[name="max_clock_out_time"]').val(self.attr('data-max_clock_out_time'));
    }

    $('#form_data').on('submit',function(e){
        e.preventDefault();
        var btn_submit = $(this).find('button[type="submit"]');
        btn_submit.attr('disabled','disabled');
        btn_submit.html(`<i class="fas fa-spin fa-spinner"></i>`);
        var send_form = new FormData(this);
        send_form.append('_method', $(this).attr('method'));
        $.ajax({
            method:'POST',
            processData: false,
            contentType: false,
            cache: false,
            url: $(this).attr('action'),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: send_form,
            success:function(result){
                btn_submit.removeAttr('disabled');
                btn_submit.html(`Save`);
                if(result.status==200){
                  $('#form_modal').modal('hide');
                }
                alertToatstr(result.status,result.messages);
                getData();
            },
            error:function(err){
                btn_submit.removeAttr('disabled');
                btn_submit.html(`Save`);
                alertToatstr(500,'Error Sistem');
            }
        });
    });

    getData();

    function getData(page=1){
      var table_data = $('#table_data > tbody');
      table_data.html(`
        <tr>
          <td style="width: 10px" class="text-center" colspan="5"><i class="fas fa-spin fa-spinner"></i> Loading</td>
        </tr>
      `);
      $.ajax({
        'url' : `{{ route('departement.data') }}`,
        'type' : 'GET',
        'data' : {
          'page' : page
        },
        'success' : function(result){
          if(result.data.length == 0){
            table_data.html(`
              <tr>
                <td style="width: 10px" class="text-center" colspan="5">Data Tidak Ditemukan</td>
              </tr>
            `);
          }else{
            table_data.html('');
            $.each(result.data,function(key,val){
              table_data.append(`
                <tr>
                  <td style="width: 10px" class="text-center">${key+1}</td>
                  <td style="width: 10px" class="text-center">
                    <i class="fas fa-solid fa-trash text-danger cursor-pointer"
                      onclick="deleteData($(this))"
                      data-id="${val['id']}"></i>

                    <i class="fas fa-solid fa-pencil-alt text-info cursor-pointer"
                      onclick="editData($(this))"
                      data-id="${val['id']}" data-departement_name="${val['departement_name']}" 
                      data-max_clock_in_time="${val['max_clock_in_time']}" data-max_clock_out_time="${val['max_clock_out_time']}"></i>
                  </td>
                  <td>${val['departement_name']}</td>
                  <td>${val['max_clock_in_time']}</td>
                  <td>${val['max_clock_out_time']}</td>
                </tr>
              `);
            });
          }
        }
      });
    }

    function deleteData(self){
      var konfirm = confirm('Hapus Data ?');
      if(konfirm == true){
        self.attr('disabled','disabled');
        self.html(`<i class="fas fa-spin fa-spinner"></i>`);
        $.ajax({
          'url' : `{{ route('departement.deleteData',-1) }}`.replace(-1,self.attr('data-id')),
          'type' : 'delete',
          'data' : {
            '_token' : $('input[name="_token"]').val()
          },
          'success' : function(result){
            self.removeAttr('disabled');
            self.html(``);
            alertToatstr(result.status,result.messages);
            getData();
          },
          'error':function(err){
            self.removeAttr('disabled');
            self.html(``);
            alertToatstr(500,'Error Sistem');
          }
        })
      }
    }
  </script>
@endsection