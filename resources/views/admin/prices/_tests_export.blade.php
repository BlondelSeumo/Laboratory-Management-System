<table>
    <thead>
        <tr>
            <th align="center" width="30">{{__('Test id')}}</th>
            <th align="center" width="30">{{__('Name')}}</th>
            <th align="center" width="20">{{__('Price')}}</th>
        </tr>
    </thead>
    <tbody>
    @foreach($tests as $test)
        <tr>
            <td align="center">{{ $test['id'] }}</td>
            <td align="center">{{ $test['name'] }}</td>
            <td align="center">{{ $test['price'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>