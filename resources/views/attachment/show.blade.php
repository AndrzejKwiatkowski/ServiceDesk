@extends('layouts.app')
@section('content')
<h3>Attachments</h3>
@foreach ($attachments as $attachment)


<table>
    <th>
        <tr>
         <td>{{$attachment->hashName}}</td>
            <td>
                <a href="{{asset('storage/attachments/' . $attachment->hashName)}}" download>{{$attachment->hashName}}</a>
            </td>
        </tr>
    </th>
</table>
@endforeach

@endsection
