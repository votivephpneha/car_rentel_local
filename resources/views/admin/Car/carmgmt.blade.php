@extends('admin.layout.layout')



@section('title', 'User - Profile')



@section('current_page_css')

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<style>

  .slow .toggle-group { transition: left 0.7s; -webkit-transition: left 0.7s; }

  .table-bordered td, .table-bordered th {
    border: 1px solid #dee2e6;
    vertical-align: middle;
  }
</style>

@endsection



@section('current_page_js')

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script type="text/javascript">

 function delete_car(car_id){

    $.ajaxSetup({

      headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }

    });

    $.ajax({

     type: 'POST',

     url: "<?php echo url('/admin/delete_car'); ?>",

     enctype: 'multipart/form-data',

     data:{car_id:car_id,'_token':'<?php echo csrf_token(); ?>'},

     beforeSend:function(){

       return confirm("Are you sure you want to delete this car?");

     },

     success: function(resultData) { 

      //  console.log(resultData);

       var obj = JSON.parse(resultData);

       console.log(resultData);

       if (obj.status == 'success') {

         setTimeout(function() {

          $('#success_message').fadeOut("slow");

        }, 2000 );

        $("#row" + car_id).remove();

        success_noti(results.success);

       } 

     },

     error: function(errorData) {

      console.log(errorData);

      alert('Please refresh page and try again!');

    }

  });

}

</script>



<script type="text/javascript">

  function deleteConfirmation(car_id) {

    toastDelete.fire({

    }).then(function(e) {

      if (e.value === true) {

          // alert(id);

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({

          type: 'POST',

          url: "{{url('/admin/delete_car')}}",

          data: {

            car_id: car_id,

            _token: CSRF_TOKEN

          },

          dataType: 'JSON',

          success: function(results) {

            $("#row" + car_id).remove();

            // console.log(results);

            success_noti(results.msg);

          }

        });

      } else {

        e.dismiss;

      }

    }, function(dismiss) {

      return false;

    })

  }

</script>

<script>

  $('.toggle-class').on('change', function() {

    var status = $(this).prop('checked') == true ? 1 : 0; 

    var car_id = $(this).data('id');

    // alert(status);

    // alert(user_id);

    $.ajax({

      type: "GET",

      dataType: "json",

      url: "<?php echo url('/admin/change_car_status'); ?>",

      data: {'status': status, 'car_id': car_id},

      success: function(data){

        success_noti(data.success);

        // console.log(data);

        // $('#success_message').fadeIn().html(data.success);

        // setTimeout(function() {

        //   $('#success_message').fadeOut("slow");

        // }, 2000 );

      },

      error: function(errorData) {

        console.log(errorData);

        alert('Please refresh page and try again!');

      }

    });

  })

</script>

@endsection





@section('content')



    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

            <div class="container-fluid">

                <div class="row mb-2">

                    <div class="col-sm-6">

                        <h1>Car Management</h1>

                    </div>

                    <div class="col-sm-6">

                        <ol class="breadcrumb float-sm-right">

                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>

                            <li class="breadcrumb-item active">Car Management</li>

                        </ol>

                    </div>

                </div>

            </div><!-- /.container-fluid -->

        </section>

                       @if(session()->has('message'))
           <div class="alert alert-success">
              {{ session()->get('message') }}
           </div>
           @endif

        <!-- Main content -->

        <section class="content">

            <div class="container-fluid">

                <div class="row">

                    <div class="col-12">

                        <div class="row">

                        <div class="col-md-11"></div>

                        <div class="col-md-1" style="margin-bottom: 5px;"><a href="{{ url('/admin/add_cars') }}" class="btn btn-block btn-dark">Add</a></div>

                        </div>


                        <div class="card">


                            <div class="card-body">

                                <table id="example1" class="table table-bordered table-striped">

                                    <thead>

                                        <tr>

                                            <th>SNo.</th>

                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Vehicle Type</th>
                                            
                                            <th>Status</th>
                                            <th>Action</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        @if (!$car_list->isEmpty())

                                            <?php $i = 1; ?>

                                            @foreach ($car_list as $arr)

                                                <tr id="row{{ $arr->id }}">

                                                    <td>{{ $i }}</td>
                                                    <td><img src="{{ url('public/uploads/cars') }}/{{ $arr->image }}" style="width:100px"></td>
                                                    <td>{{ $arr->title }}</td>

                                                    <td>{{ $arr->vehicle_type }}</td>

                                                    <td class="project-state">

                                                        <input  type="checkbox" class="toggle-class" data-id="{{$arr->id}}" data-toggle="toggle" data-style="slow" data-onstyle="success" data-size="small" data-on="Active" data-off="InActive" {{ $arr->status ? 'checked' : '' }}>

                                                    </td>

                                                    <td class="text-center py-0 align-middle">

                                                        <div class="btn-group btn-group-sm">

                                                          

                                                            <a href="{{url('/admin/edit_cars')}}/{{$arr->id}}" class="btn btn-info" style="margin-right: 3px;"><i class="fas fa-pencil-alt"></i></a>

                                                            <a href="javascript:void(0)" onclick="deleteConfirmation('<?php echo $arr->id; ?>');" class="btn btn-danger" style="margin-right: 3px;"><i class="fas fa-trash"  alt="user" title="car"></i></a>

                                                            


                                                        </div>

                                                    </td>

                                                    

                                                </tr>

                                                <?php $i++; ?>

                                            @endforeach



                                        @endif

                                    </tbody>

                                </table>

                            </div>

                            <!-- /.card-body -->

                        </div>

                        <!-- /.card -->

                    </div>

                    <!-- /.col -->

                </div>

                <!-- /.row -->

            </div>

            <!-- /.container-fluid -->

        </section>

        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->



@endsection

