<table>
    <thead>
        <tr>
            <th align="center" width="30">{{__('Culture id')}}</th>
            <th align="center" width="30">{{__('Name')}}</th>
            <th align="center" width="20">{{__('Price')}}</th>
        </tr>
    </thead>
    <tbody>

    @foreach($cultures as $culture)
        <tr>
            <td align="center">{{ $culture['id'] }}</td>
            <td align="center">{{ $culture['name'] }}</td>
            <td align="center">{{ $culture['price'] }}</td>
        </tr>
    @endforeach

    </tbody>
</table>