<table>
    <thead>
        <tr>
            <th align="center" width="10">{{__('id')}}</th>
            <th align="center" width="20">{{__('Code')}}</th>
            <th align="center" width="20">{{__('Name')}}</th>
            <th align="center" width="20">{{__('Gender')}}</th>
            <th align="center" width="20">{{__('DOB')}}</th>
            <th align="center" width="20">{{__('Age')}}</th>
            <th align="center" width="20">{{__('Phone')}}</th>
            <th align="center" width="20">{{__('Email')}}</th>
            <th align="center" width="20">{{__('Address')}}</th>
            <th align="center" width="20">{{__('Total')}}</th>
            <th align="center" width="20">{{__('Paid')}}</th>
            <th align="center" width="20">{{__('Due')}}</th>
        </tr>
    </thead>
    <tbody>
    @foreach($patients as $patient)
        <tr>
            <td align="center">{{ $patient['id'] }}</td>
            <td align="center">{{ $patient['code'] }}</td>
            <td align="center">{{ $patient['name'] }}</td>
            <td align="center">{{ $patient['gender'] }}</td>
            <td align="center">{{ date('d-m-Y',strtotime($patient['dob'])) }}</td>
            <td align="center">{{ $patient['age'] }}</td>
            <td align="center">{{ (string) $patient['phone'] }}</td>
            <td align="center">{{ $patient['email'] }}</td>
            <td align="center">{{ $patient['address'] }}</td>
            <td align="center">{{ formated_price($patient['total']) }}</td>
            <td align="center">{{ formated_price($patient['paid']) }}</td>
            <td align="center" style="@if($patient['due']>0) color:red; @else color:#28a745; @endif">{{ formated_price($patient['due']) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>