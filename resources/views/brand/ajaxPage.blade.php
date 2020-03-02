@foreach($data as $k=>$v)
       <tr @if($k%2==0) class="success" @else class="active" @endif>
           <td>{{$v->b_id}}</td>
           <td>{{$v->b_name}}</td>
           <td>@if($v->b_logo)<img src="{{env('UPLOADS_URL')}}{{$v->b_logo}}" width="30" height="30">@endif</td>
           <td>{{$v->b_desc}}</td>
           <td> <a href="{{url('brand/edit/'.$v->b_id)}}" class="btn btn-info">编辑</a> <a href="{{url('brand/destroy/'.$v->b_id)}}" class="btn btn-danger">删除</a></td>
       </tr>
       @endforeach
       <tr><td colsapn="7">{{$data->appends(['b_name'=>$b_name])->links()}}</td></tr>