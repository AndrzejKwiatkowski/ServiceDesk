@extends('layouts.app')
@section('content')
<h3>Załączniki</h3>
@foreach ($attachments as $attachment)


<table>
    <th>
        <tr>
         <td>{{$attachment->orginal_name}}</td>
            <td>
                <a href="{{asset('storage/attachments/' . $attachment->orginal_name)}}" download>{{$attachment->orginal_name}}</a>
            </td>
        </tr>
    </th>
</table>
@endforeach

@endsection
