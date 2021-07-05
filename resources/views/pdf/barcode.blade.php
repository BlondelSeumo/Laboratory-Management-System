<html>
    <head>
        <style>
            img{
                margin-right: 20px;
                margin-top: 20px;
            }
          
        </style>
        <title>
            {{__('Barcode')}} - #{{$group['id']}}
        </title>
    </head>
    <body>
        @for ($i = 0; $i < $number; $i++)
            <img src="data:image/png;base64,{{$barcode_image}}" alt="barcode"  width="200"/>
        @endfor
    </body>
</html>
