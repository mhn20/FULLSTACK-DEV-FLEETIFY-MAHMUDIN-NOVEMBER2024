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
                        <button class="btn btn-info btn-sm" id="btn_modal">
                            <i class="fas fa-plus"></i>
                            Add Data
                        </button>
                    </h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input
                                type="text"
                                name="table_search"
                                class="form-control float-right"
                                placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default" id="btn_search">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0  table-responsive">
                        <table class="table" id="table_data">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No.</th>
                                    <th style="width: 10px" class="text-center">Action</th>
                                    <th class="text-center">Absensi</th>
                                    <th class="text-center">Clock In</th>
                                    <th class="text-center">Clock Out</th>
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

    <!-- Modal -->
    <form entype="multipart/form-data" id="form_data">
        {{ csrf_field() }}
        <div
            class="modal fade"
            id="form_modal"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true">
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
                                        Departement
                                    </b>
                                </label>
                                <select name="departement_id" class="form-control select2">
                                    <option value="">Pilih</option>
                                    @foreach($departement as $rowindex)
                                    <option value="{{ $rowindex->id }}">{{ $rowindex->departement_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mt-2">
                                <label for="">
                                    <b>
                                        Name
                                    </b>
                                </label>
                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    required="required"
                                    placeholder="Name"
                                    value="">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label for="">
                                    <b>
                                        Address
                                    </b>
                                </label>
                                <textarea name="address" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12 mt-2" id="form_absen"></div>
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

    $('#btn_modal').on('click',function(){
      $('#exampleModalLabel').html(`<i class="fas fa-plus"></i> Add Data`);
      $('#form_modal').modal('show');
      $('#form_data').trigger('reset');
      $('#form_data').attr('method','POST');
      $('[name="departement_id"]').removeAttr('disabled');
      $('[name="name"]').removeAttr('disabled');
      $('[name="address"]').removeAttr('disabled');
      $('#form_absen').html('');
      $('#form_data').attr('action',`{{ route('karyawan.postData') }}`);
      
    });

    function editData(self){
      $('#exampleModalLabel').html(`<i class="fas fa-pencil-alt"></i> Edit Data`);
      $('#form_modal').modal('show');
      $('#form_data').trigger('reset');
      $('#form_data').attr('method','PUT');
      $('#form_data').attr('action',`{{ route('karyawan.editData',-1) }}`.replace(-1,self.attr('data-id')));
      $('[name="departement_id"]').removeAttr('disabled');
      $('[name="name"]').removeAttr('disabled');
      $('[name="address"]').removeAttr('disabled');
      $('[name="departement_id"]').val(self.attr('data-departement_id'));
      $('[name="name"]').val(self.attr('data-name'));
      $('#form_absen').html('');
      $('[name="address"]').val(self.attr('data-address'));
    }

    function absenData(self){
      $('#exampleModalLabel').html(`<i class="fas fa-clock"></i> Absensi`);
      $('#form_modal').modal('show');
      $('#form_data').trigger('reset');
      $('#form_data').attr('method','POST');
      $('#form_data').attr('action',`{{ route('karyawan.absenMasuk',-1) }}`.replace(-1,self.attr('data-id')));
      $('[name="departement_id"]').attr('disabled','disabled');
      $('[name="name"]').attr('disabled','disabled');
      $('[name="address"]').attr('disabled','disabled');
      $('[name="departement_id"]').val(self.attr('data-departement_id'));
      $('[name="name"]').val(self.attr('data-name'));
      $('[name="address"]').val(self.attr('data-address'));


      setInterval(updateClock, 1000);

      $('#form_absen').html(`
        <div class="row">
          <div class="col-md-12 mt-2">
              <label for="">
                  <b>
                      Absen Masuk / Keluar
                  </b>
              </label>
              <select name="attendance_type" class="form-control" onchange="attendanceType($(this))" data-id="${self.attr('data-id')}" required>
                  <option value="">Absen Masuk / Keluar</option>
                  <option value="1">Absen Masuk</option>
                  <option value="2">Absen Keluar</option>
              </select>
          </div>
          <div class="col-md-12 mt-2">
            <label for="">
              <b>
                Clock Attendance
              </b>
            </label>
            <input type="text" name="attendance_date" class="form-control" required placeholder="Clock Attendance" value="{{ date('H:i:s') }}" readonly>
          </div>
        </div>
      `);
      
    }

    function attendanceType(self){
      if(self.val() == '1'){
        $('#form_data').attr('method','POST');
        $('#form_data').attr('action',`{{ route('karyawan.absenMasuk',-1) }}`.replace(-1,self.attr('data-id')));
      }else{
        $('#form_data').attr('method','PUT');
        $('#form_data').attr('action',`{{ route('karyawan.absenKeluar',-1) }}`.replace(-1,self.attr('data-id')));
      }
    }

    function updateClock() {
        var now = new Date();
        var hours = now.getHours().toString().padStart(2, '0');
        var minutes = now.getMinutes().toString().padStart(2, '0');
        var seconds = now.getSeconds().toString().padStart(2, '0');
        var timeString = hours + ':' + minutes + ':' + seconds;

        $('[name="attendance_date"]').val(timeString);
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

    $('#btn_search').on('click',function(){
      getData();
    });

    $(`[name="table_search"]`).on('change',function(){
      getData();
    });

    function getData(page=1){
      var table_data = $('#table_data > tbody');
      table_data.html(`
        <tr>
          <td style="width: 10px" class="text-center" colspan="8"><i class="fas fa-spin fa-spinner"></i> Loading</td>
        </tr>
      `);
      $.ajax({
        'url' : `{{ route('karyawan.data') }}`,
        'type' : 'GET',
        'data' : {
          'page' : page, 'search' : $('[name="table_search"]').val()
        },
        'success' : function(result){
          if(result.data.length == 0){
            table_data.html(`
              <tr>
                <td style="width: 10px" class="text-center" colspan="8">Data Tidak Ditemukan</td>
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
                      data-id="${val['id']}" data-departement_id="${val['departement_id']}" 
                      data-name="${val['name']}" data-address="${val['address']}"></i>
                  </td>
                  <td class="text-center">
                    <i class="fas fa-solid fa-clock text-info cursor-pointer"
                      onclick="absenData($(this))"
                      data-id="${val['id']}" data-departement_id="${val['departement_id']}" 
                      data-name="${val['name']}" data-address="${val['address']}"></i>
                  </td>
                  <td class="text-center">${val['clock_in']}</td>
                  <td class="text-center">${val['clock_out']}</td>
                  <td>${val['departement']['departement_name']}</td>
                  <td>${val['name']}</td>
                  <td>${val['address']}</td>
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
          'url' : `{{ route('karyawan.deleteData',-1) }}`.replace(-1,self.attr('data-id')),
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