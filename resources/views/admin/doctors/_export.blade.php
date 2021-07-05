<table>
    <thead>
        <tr>
            <th align="center" width="10">{{__('id')}}</th>
            <th align="center" width="20">{{__('Code')}}</th>
            <th align="center" width="20">{{__('Name')}}</th>
            <th align="center" width="20">{{__('Phone')}}</th>
            <th align="center" width="20">{{__('Email')}}</th>
            <th align="center" width="20">{{__('Address')}}</th>
            <th align="center" width="20">{{__('Commission')}}</th>
            <th align="center" width="20">{{__('Total')}}</th>
            <th align="center" width="20">{{__('Paid')}}</th>
            <th align="center" width="20">{{__('Due')}}</th>
        </tr>
    </thead>
    <tbody>
    @foreach($doctors as $doctor)
        <tr>
            <td align="center">{{ $doctor['id'] }}</td>
            <td align="center">{{ $doctor['code'] }}</td>
            <td align="center">{{ $doctor['name'] }}</td>
            <td align="center">{{ (string) $doctor['phone'] }}</td>
            <td align="center">{{ $doctor['email'] }}</td>
            <td align="center">{{ $doctor['address'] }}</td>
            <th align="center">{{ $doctor['commission']}}</th>
            <td align="center">{{ formated_price($doctor['total']) }}</td>
            <td align="center">{{ formated_price($doctor['paid']) }}</td>
            <td align="center" style="@if($doctor['due']>0) color:red; @else color:#28a745; @endif">{{ formated_price($doctor['due']) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>