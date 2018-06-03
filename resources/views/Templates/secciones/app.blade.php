
<!DOCTYPE html>
<html lang="en">
<div id="header">
    @include('Templates.secciones._header')
    <style type="text/css" media="screen">
    .derecha{
       float: right;
   }
   
   .derecha{
       text-align: right;
   }
    </style>
</div>
<body style="padding-top: 0px;">
    <div id="head" class="navbar navbar-inverse navbar-fixed-top" style="z-index:4; background-color:#295c93 !important; border-color: #295c93;margin-bottom: 5px !important;">
            <table class="derecha">
                <tr>              
                    <td>
                        <div class="item-subMenuApp unlock">
                            <div class="item-subMenuApp-header">
                                <a href="{{ url('/') }}" title="Menú" style="cursor:pointer;">
                                    <div class="subMenu-icon">                   
                                        <span class="fa fa-home" aria-hidden="true" style="color:#295c93"></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </td>

                </tr>   
            </table>   
    </div>

    <div class="container">

        <div id="body">        
            
            <input type="hidden" id="APP_URL" value="{{ url("/")  }}" />
            <input type="hidden" id="_MTOKEN" value="{{ csrf_token()  }}" />

            @yield('content')
            <div class="modal fade" id="popup" role="dialog">
                @section('content_modal')
                 <div class="modal-dialog" style="min-width: 80% !important;">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                        </div>
                        <div class="modal-body">
                            <div class="row center-block">
                            </div>                  
                        </div>
                        <div class="modal-footer"> 
                        </div>                               
                    </div>
                </div>
                @show
            </div>
           

        </div>    </div> <!-- /container -->
<script type="text/javascript">
      
$(document).ready(function(){
   $('#popup').modal({
        backdrop: 'static',
        //keyboard: false  // to prevent closing with Esc button (if you want this too),
        show: false
    });
});

</script>
</body>
