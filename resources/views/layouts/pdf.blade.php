<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 
    <style>
        @if($type==3||$type==4)
        @page {
                margin-top: {{$reports_settings['margin-top']}}px;
                margin-right: {{$reports_settings['margin-right']}}px;
                margin-left: {{$reports_settings['margin-left']}}px;
                margin-bottom: {{$reports_settings['margin-bottom']}}px;
            }
        @else
            @page {
                header: page-header;
                footer: page-footer;

                margin-left: {{$reports_settings['margin-left']}}px;
                margin-right: {{$reports_settings['margin-right']}}px;
                
                margin-top: {{$reports_settings['content-margin-top']}}px;
                margin-header: {{$reports_settings['margin-top']}}px;

                margin-bottom: {{$reports_settings['content-margin-bottom']}}px;
                margin-footer: {{$reports_settings['margin-bottom']}}px;
            }
        @endif

        .table-bordered {
            border: 1px solid #dee2e6;
            border-collapse: collapse;
            background-color: white!important;
        }

        .table-bordered,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }  

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #ddd !important;
        }
        table{
            width: 100%;
            border-collapse: collapse;
        }
        table td,th{
            padding: 5px;
        }
        .title{
            background-color: #ddd;
        }
        .signature{
            font-size:13px;
            font-weight: bold!important; 
        }
        .footer{
            border-top: 3px double;
        }
        .branch_name{
            color:{{$reports_settings['branch_name']['color']}}!important;
            font-size:{{$reports_settings['branch_name']['font-size']}}!important;
            font-family:{{$reports_settings['branch_name']['font-family']}}!important;
        }
        .branch_info{
            color:{{$reports_settings['branch_info']['color']}}!important;
            font-size:{{$reports_settings['branch_info']['font-size']}}!important;
            font-family:{{$reports_settings['branch_info']['font-family']}}!important;
        }
        .title{
            color:{{$reports_settings['patient_title']['color']}}!important;
            font-size:{{$reports_settings['patient_title']['font-size']}}!important;
            font-family:{{$reports_settings['patient_title']['font-family']}}!important;
        }
        .data{
            color:{{$reports_settings['patient_data']['color']}}!important;
            font-size:{{$reports_settings['patient_data']['font-size']}}!important;
            font-family:{{$reports_settings['patient_data']['font-family']}}!important;
        }
        .signature{
            color:{{$reports_settings['signature']['color']}}!important;
            font-size:{{$reports_settings['signature']['font-size']}}!important;
            font-family:{{$reports_settings['signature']['font-family']}}!important;
        }
        .footer{
            color:{{$reports_settings['report_footer']['color']}}!important;
            font-size:{{$reports_settings['report_footer']['font-size']}}!important;
            font-family:{{$reports_settings['report_footer']['font-family']}}!important;
            text-align:{{$reports_settings['report_footer']['text-align']}}!important;
        }
    </style>

</head>

<body>
    @if($type!==3&&$type!==4)
        <htmlpageheader name="page-header">
            
            @if($reports_settings['show_header']&&isset($group['branch']))
                <table width="100%">
                    <tbody>
                        <tr>
                            <td width="15%" align="left">
                                <img src="data:image/png;base64,{{$info_settings['reports_logo']}}" width="100px" height="100px"/>
                            </td>
                            <td width="70%" align="center">
                                <p class="branch_name"  align="center">
                                    {{ $group['branch']['name'] }}
                                </p>
                                <p class="branch_info">
                                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAA7AAAAOwBeShxvQAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAAK8SURBVFiFrddPqBV1FAfwj17pafqUQBF0k2iS9F4FgRtF1BaSRSCUtUgQSRQp3ZnLFqJPXaogouXGIsGFXMKFEAhGJRq1qM17C7Wefwoh0Cem+abFb673d8eZuXfmvS8cBs6c75zv7zdnzu8M+XgVp3EbbxfETMPPeIS/cBnH8SH6CzhdsRJNjCNJ7RZeyImdgbtRXGz3UzGLqyS+UPCwBCcKePOwBh9hN77Fw4j3CEPoK0veLEncsnGs7XEx/diMaxH/e8wvIvzTg4AEI3i+RxGEVe/Gvyn/BgbyAn/qUUCCgxnuO9iF97G0QMgKoZgTjGJBNuCLCgIeYzDl9eNJ5v7v+BTPZXIswd/ar6OjJnZWEJDgg4i7D5dwPRMzjDcyIlZpv47P4xsDFZJ/I3z/eVgqVPxYGjuGdzMxn6X37omKcopQIN2Sf41GQfIYL+KXSES8E9O1d+toTDrQJXmzx+Qt9EcihnXWxBbtZjWr5RzsIuDjCslbWIQHKf+TyD9bu1ltjAnflQg4XEMA7Z39LeM/n/qPxc51JQJGMbWGgJejZ7wU+fekvh/i4CnKm9JbNQTAHyn/vci3KfXdiVeVYIfQ9/MwpFohxgJgYeQbTa9z8ginFO/CthoC9uE/nXPFPOEov5JHmJsqzBMwJgwrVTEzxzddcVOz1rN9Pi7IRTVEVMbeAgEtEa/18IyGMKINdgvMw1ScKRExhu2KP88GvtI+RQ+pNk8gHJtlDSrBr8InGgtpCGdHNnZE75PVU8zB1S4iEuFzO4Ktyse8cZyUP+iWiui2E1XtpuKRPxd9ymuijt2q0tme4KzwflcKrXuiOFeXuBp/mtjqx/F6belCx/xS519UFWtOJHmM5fixhoAVkyWghbz/yiK7ONnJY7yC/Tp/zbK2vhU8GZVchmV4Uzg3BoQJ6SI2pEL8DyGtlQp6zzbRAAAAAElFTkSuQmCC" width="16px" alt="">
                                    @if(isset($group['branch']))
                                        {{ $group['branch']['phone'] }}
                                    @endif
                                </p>
                                <p class="branch_info">
                                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAA7AAAAOwBeShxvQAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAAHFSURBVFiFvdbPi09RGMfxl/Fr40dRwky2FnbKaggbpZEVW7L1Y+cPMPgj8CeQ8qMUtr4xspClWBiF1GSYoRE1Fud7y4/7nLnn3js+9XTrnPs878+99/Q8lzJtxhncwTQWhjE9XDuNTYU1G2ktLmIOi0vEHCaHOb1oB140AP8dzzHWFT4mvd5SeBVvsL0tfDWedYBX8RSrIsjKjIHzOJHZf4Ibw+uI+HWP4isGmVr/aANm1D/RJxyuyZnAbJAzg/UlBk4FhRYDeKUjmbyTJQZuBkUeN8idCnKv1908EhTZHaw3+Y6PSmpGBrYG6ysaGIju2VZiIFofb2Bgb2HNWr0TH6aJTN7RTN7bEgP3M4VmpdNeB/+cybtXB4o61AMcCvY24q7U4QbSNx/HnvwzebjE/h8axXfd23AVC4JDmNO1Hg1cLYWTpth8D/BvOozlyz0YuNQWThogHzrAP0qDrZPOdTBwtiuc9GPysgX8Ndb0YQCOtzBwrC94pUEBfEqzwVWkfQUGDvYNr3S7AfzWcsFhJ35k4D+xazkNkNpqZODKcsNhC77UwOe1GDhtNVlj4ML/gsM6vP8N3kvLLdUBqdu9wv62RX4BVBlWX7xnJp8AAAAASUVORK5CYII=" width="16px" alt=""> 
                                    @if(isset($group['branch']))
                                        {{$group['branch']['address'] }}
                                    @endif
                                </p>
                                <p class="branch_info">
                                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAA3QAAAN0BcFOiBwAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAAHFSURBVFiF7dexS1tRFMfxTzoIBjESUAT/AP+GooODQyAubm4t9F/o2v4PHQrVgkMFpVN3XTp0dtOhIAGpOBTsmsXcDj2hl6cvPmvM6+CDA3nvnPP7/u69794kjZSSOq9ntdKfDPwPBuA5jpEmHMfBdlQDfBhH0MZeDfA9tKWUxFmwgYsJgC+wkXF9RCtu5rD7iPBdzAWrFWwJP9DNXHVwPkbwOTqZfjeYSaHwE9pRNIudMcB3MBua7WDk+RsNl9jM3K6j9w/gHtYznc3QLtaVCnzGfDTP4D0GFcCDqJ2J3vnQKqsfKfYTW9ko1nA2ov4Ma1n9VmiMYlSazi9YDNEm3uE6y1/Hs2bULEZPFe1KRZeyXRKQVXyPWC3kuiXrfW8DA2z7u3ebeI2luJ/GdHxeilwzO1O23f3elCZO85H5czb0IvcLL7Lcy3g2fPs7hZk6vY+BPt5iKgQWsF/S/C3ittw+FkJjKjT7dxn4iuVoauAVriqu5W1xFRqN0FwOxg0DVQofEqMG5qAwVW9Kpuqh0Q/tfGkP8q2zgpNHABfjBCv513ELH1Q7ZscVg2C24HCC4GIcUvOP0uFbX9tV+/+CJwO1G/gNW13WamxIoPoAAAAASUVORK5CYII=" width="16px" alt=""> 
                                    {{$info_settings['email']}}
                                </p>
                                <p class="branch_info">
                                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAA7AAAAOwBeShxvQAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAANESURBVFiFxddNb5VFFADgpzehIdKuNBRwobEF1Ej8iDG6UupGowtdCBJdowlBE90QfoH0H9CqC3CtgsYlcaEuEAJ+QdREa4S0hTQubEmKSetizuROp/e+3NtKPMnkfed8z5kzc84M6B2G8SKewYPYiruDdhVzuIQv8TkW+tDdCDsxhRtY6XEsYhJjGzG8GRO42cHAnzhYzA/iSge+JRwLXX3BGL4vFJ3Ctfj/SQr/poK+CSPSFqwE7+mCfhH39Wr8YcyG4BU8jbdjPoftwVc7ADsKR9+S8iVHZjZ033Ll2fgN7JaSbz5wrxa8nRyA1wI3j6HQkfNnFqPdjG+2OuwrmJYScAVnK/5uDsC5wE+FjlLnd7rkxIR22J8Ig6XgO3048G4lezZ05u2YqI3vkrJ9GXsDNygdpVLRBRzF8yGT8bsCdzR4Spmp0AXjYWNJdURzmD+uHDtURGWxUtw0ForVHqp0fhr4yYwYLpTXWfpR4A/jDuzDB/gK1wuD1wP3Pl4J3sNBO1HpfFT7shqCA9pntYZfg/ZkB1pTDsBTQfu5A+2HoO1vSWcVPqmYWrgn/n/soORWkGXuxUBFy7bGW1JhgfMV013Syhasr7D8LYV5EHdWtHPxfaClfbP9UjGNxHduHcYzZNltFT5vy/YBaXVbNmBkI7DYkpLh/4LlFmZisltKljz2BP63Cp/HYKFosAvP70F/qMLfH/iZllQgSLdZCXn/RqwftmZDFT47MNuSajg8XjHN4x8pP4bWYXw4ZG/ir4qWbV1uST0cvFwxLeOP+N+jf8gy09bm2UvxPUNaXb6KH6kYT2pfxVuwHx/iG2uv4q+la3qf5qv4MdVVTLvq/VfFaFH3YnQq8MdL5JhUIutynKtkHudxBM9J3XLG7wzckeApZSa1T8yz2uV4TWd0rFjt7WpIrsb8vdo4qU26WAlOF1H4tg8HchQ6tWQXNLTpo5qb0gM9OPC67k3pjB7a87ot32t1W76jwYG6LR/XDvuMHtryDKNS95oNnC4UX9L9YXI55tfwmdVh7/lhkiE/zZas3sMcmTeK+ZvFSsuxJCVc30+zEsako9Tv4/S4hkdIhrpVaoIhvCDta9Pz/Ay+0GMX9S+x73YBt+GuggAAAABJRU5ErkJggg==" width="16px" alt="">
                                    {{ $info_settings['website'] }}
                                </p>
                            
                            </td>
                            <td align="right" width="15%">
                                @if(isset($group['patient']))
                                    <img src="https://chart.googleapis.com/chart?chs=120x120&cht=qr&chl={{url('patient/login/'.$group['patient']['code'])}}&choe=UTF-8" title="Link to Google.com" />
                                @endif
                            </td>
                        </tr>

                    </tbody>
                </table>
            @endif

            @if(isset($group['patient']))
                <table width="100%" class="table table-bordered">
                    <tbody>
                        <tr>
                            <td width="50%">
                                <span class="title">Patient Code :</span> <span
                                    class="data">
                                    @if(isset($group['patient']))
                                        {{ $group['patient']['code'] }}
                                    @endif
                                </span>

                            </td>
                            <td width="50%">
                                <span class="title">Patient Name :</span> <span
                                    class="data">
                                    @if(isset($group['patient']))
                                        {{ $group['patient']['name'] }}
                                    @endif
                                </span>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <span class="title">Age :</span> 
                                <span class="data">
                                    @if(isset($group['patient']))
                                        {{$group['patient']['age']}}
                                    @endif
                                </span>

                            </td>
                            <td>
                                <span class="title">Gender :</span> <span
                                    class="data">
                                    @if(isset($group['patient']))
                                        {{ __($group['patient']['gender']) }}
                                    @endif
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="title">Doctor :</span> <span
                                    class="data">
                                    @if(isset($group['doctor']))
                                        {{ $group['doctor']['name'] }}
                                    @endif
                                </span>
                            </td>
                            <td>
                                <span class="title">Date :</span> 
                                <span class="data">
                                    {{ date('d-m-Y H:i',strtotime($group['created_at'])) }}
                                </span>
                            </td>
                        </tr>

                    </tbody>
                </table>    
            @endif

        </htmlpageheader>
    @endif
    
    @yield('content')
   
      
        <htmlpagefooter name="page-footer" class="page-footer">
            @if($type==1)
                @if($reports_settings['show_signature'])
                <table>
                    <tbody>
                        <tr>
                            <td width="70%">
                            </td>
                            <td align="center">
                                <p class="signature">
                                    {{__('Signature')}}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td width="70%">
                            </td>
                            <td align="center">
                                <p class="signature">
                                   @if(!empty($group['signature']))
                                    <img src="{{url('uploads/signature/'.$group['signature'])}}" alt="" height="100">
                                   @endif
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                @endif
            @endif
            @if($reports_settings['show_footer'])
                @if($type==1||$type==2)
                    <p class="footer"> 
                        {!! str_replace(["\r\n", "\n\r", "\r", "\n"], "<br>", $reports_settings['footer'])!!}
                    </p>
                @endif
            @endif
        </htmlpagefooter>
</body>

</html>