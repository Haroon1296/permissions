@extends('layouts.app')
@section('title','User Permissions')
@section('content')


@if (count($errors) > 0)
<div class="">
    <div class="alert alert-danger alert-dismissable alert-sticky">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif


<div class="flash_msgs">
	@if(Session::has('flash_danger'))
    <div style="margin-bottom: 0px;" class="alert alert-danger notification">
      <em> {!! session('flash_danger') !!}</em>
    </div>
  @endif
  @if(Session::has('success'))
    <div style="margin-bottom: 0px;" class="alert bg-green notification">
      <em> {!! session('success') !!}</em>
    </div>
  @endif
  @if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'bg-green') }}">
      {{ Session::get('message') }}
    </p>
    @endif
</div> 

<div class="page-title">
  <div class="title_left">
    <h3>Users </h3>
  </div>
</div>
<div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_content">            
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>S.No</th>
                <th>Module/Function Name</th>
                <th>View &nbsp; <input type="checkbox" id="checkAll" class="view_check_all" value="1" /> </th>
                <th>Add &nbsp; <input type="checkbox" id="fn_add" class="add_check_all" value="1" /> </th>
                <th>Edit &nbsp; <input type="checkbox" id="fn_edit" class="edit_check_all" value="1" /> </th>
                <th>Delete &nbsp; <input type="checkbox" id="fn_delete" class="delete_check_all" value="1" /> </th>       
              </tr>
            </thead>
            <tbody>
              <form action="{{route('Permission.store')}}" method="POST">
                <input type="hidden" value="{{$user_id}}" name="user_id">
              @csrf
              <?php 
                $s_no = 0;
                foreach ($data as  $key => $data) {	 ?>
	            <tr>
	              <td style="background: #ececec; font-weight: bold;">{{$data['m_s_no']}}</td>
	              <td style="background: #ececec; font-weight: bold;" colspan="6" >{{$data['module_name']}} &raquo;</td>
	            </tr>
              @foreach($data['operations'] as $key => $row)
               <tr>
                <td>{{$row['o_s_no']}}</td>
                <td align="center">{{$row['operation_name']}}
                  <input type="hidden" name="operation[{{$row['op_id']}}]" id="operatio[]" value="{{$row['op_id']}}"/>
                </td>
                @foreach($row['privileges']  as  $row2)        
                  <td>
                    @if($row['is_view_visible'] != 0)
                      <input type="checkbox" name="is_view[{{$row['op_id']}}]" value="1" class="view_check" {{ $row2['is_view'] == 1 ? "checked='checked'" : '' }}/>          
                    @endif
                  </td>
                  <td>
                    @if($row['is_add_visible'] != 0)
                      <input type="checkbox" name="is_add[{{$row['op_id']}}]" value="1" class="add_check" {{ $row2['is_add'] == 1 ? "checked='checked'" : '' }}/>
                    @endif
                  </td>
                  <td>
                    @if($row['is_edit_visible'] != 0)
                      <input type="checkbox" name="is_edit[{{$row['op_id']}}]" value="1" class="edit_check" {{ $row2['is_edit'] == 1 ? "checked='checked'" : '' }}/>
                    @endif
                  </td>
                  <td>
                    @if($row['is_delete_visible'] != 0)
                      <input type="checkbox" name="is_delete[{{$row['op_id']}}]" value="1" class="delete_check" {{ $row2['is_delete'] == 1 ? "checked='checked'" : '' }}/>
                    @endif
                  </td>
                @endforeach
              </tr>
              @endforeach
              <?php $s_no++; } ?>
              <tr>
                <td colspan="6">
                  <input type="submit" value="save" class="btn btn-primary" style="float:right;">
                </td>
              </tr>
              </form>
            </tbody>
          </table>
        </div>
      </div>
    </div>	
	</div>
</div>

@endsection

@section('script')
<script>

$(document).ready(function(){

  $(".view_check_all").click(function(){
    if(this.checked){
      $('.view_check').each(function(){
        this.checked = true;
      })
    }else{
      $('.view_check').each(function(){
        this.checked = false;
      })
    }
  });

  $(".add_check_all").click(function(){
    if(this.checked){
      $('.add_check').each(function(){
        this.checked = true;
      })
    }else{
      $('.add_check').each(function(){
        this.checked = false;
      })
    }
  });

  $(".edit_check_all").click(function(){
    if(this.checked){
      $('.edit_check').each(function(){
        this.checked = true;
      })
    }else{
      $('.edit_check').each(function(){
        this.checked = false;
      })
    }
  });

  $(".delete_check_all").click(function(){
    if(this.checked){
      $('.delete_check').each(function(){
        this.checked = true;
      })
    }else{
      $('.delete_check').each(function(){
        this.checked = false;
      })
    }
  });

});

</script>
@endsection
