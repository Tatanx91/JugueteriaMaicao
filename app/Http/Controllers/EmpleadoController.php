<?php

namespace Jugueteria\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Jugueteria\model\EmpleadoModel;
use Jugueteria\model\TipoDocumento_Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Jugueteria\model\UsuariosModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use File;

class EmpleadoController extends Controller
{  
    private $IdEmpresa;

	public function __construct(){
        //$this->middleware('auth', ['except' => ['Index,datatableJuguete,datatableListJuguete,postStore,postFormJuguete']]);
         $this->middleware(['auth:web' || 'auth:api']); 
    }
    public function Index($IdEmpresa)
    {
        if(Session::get("PRIVILEGIOS") == null){
            Session::forget('PRIVILEGIOS');
            return redirect::to('/');
        }
        $this->IdEmpresa = $IdEmpresa;
        return view('Empleado.index')->with(['IdEmpresa'=>$IdEmpresa]);
    }

    public function Masivoempleado(Request $request){
        $titulo = "masivo Empelado";
        $datos =  new EmpleadoModel();
        $datos['IdEmpresa'] = $request->get("empresa");
        $view = view('Empleado.MasivoEmpleado')->with(['titulo' => $titulo,'datos'=>$datos]);

    	  if($request->ajax()){
            return $view->renderSections()['content_modal'];
        }else{
            return $view;
        }  
        //return view('Empleado.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatableListEmpleado(Request $request){
        // Datos de DATATABLE
        $search = $request->get("search");
        $order = $request->get("order");
        $sortColumnIndex = $order[0]['column'];
        $sortColumnDir = $order[0]['dir'];
        $length = $request->get('length');
        $start = $request->get('start');
        $columna = $request->get('columns');
        $orderBy = $columna[$sortColumnIndex]['data'];
        
        $result = EmpleadoModel::join('TipoDocumento','TipoDocumento.Id','=','Empleado.IdTipoDocumento')
         ->select(
         	'Empleado.ID',
         	'Empleado.IdUsuario',
			'Empleado.IdEmpresa',
			'Empleado.Nombre',
			'Empleado.Apellido',
			'Empleado.IdTipoDocumento',
			'Empleado.NumeroDocumento',
			'Empleado.FechaNacimiento',
			'Empleado.Estado',
			'TipoDocumento.Nombre')->where('Empleado.IdEmpresa',$request->get("empresa"));
                                    //->orderBy("Idresult", "desc");//

        $result  = $result->orderBy($orderBy, $sortColumnDir);  
      
        $totalRegistros = $result->count();
        //BUSCAR            
            if($search['value'] != null){
                $result = $result->whereRaw(
                        "(ID LIKE '%".$search["value"]."%' OR ". 
                         "Nombre LIKE '%". $search['value'] . "%' OR " .
                         "Apellido LIKE '%". $search['value'] . "%' OR " .
                         "NumeroDocumento LIKE '%". $search['value'] . "%' OR " .
                         "FechaNacimiento LIKE '%". $search['value'] . "%' OR " .
                         "TipoDocumento.Nombre LIKE '%". $search['value']. "%')");
            }
        
        $parcialRegistros = $result->count();
        $result = $result->skip($start)->take($length);

        $data = ['length'=> $length,
                'start' => $start,
                'buscar' => $search['value'],
                'draw' => $request->get('draw'),
                'last_query' => $result->toSql(),
                'recordsTotal' =>$totalRegistros,
                'orderBy'=>$orderBy,
                'recordsFiltered' =>$parcialRegistros,
                'data' =>$result->get()];

        return response()->json($data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {
        try {
            $Id = $request->input('ID');
            $data = $request->all();
            $datos = $Id == "" ? new EmpleadoModel() : EmpleadoModel::find($Id);

             if($Id != ""){
	        	$datosusu = UsuariosModel::find($datos['IdUsuario']);
	        	$datosusu['Correo'] = $request->input('Login');
                $datosusu->save();
	        }else{
		 		$datosusu = new UsuariosModel();  
				$datosusu['Contrasena'] = $request->input('NumeroDocumento');
                $datosusu['IdTipoUsuario'] = 3;
                $datosusu['Confirmado'] = 0;
                $datosusu['CodigoConf'] = "";
                $datosusu['Correo'] = $request->input('Login');
                $datosusu->save();
		 	}

            $datos->fill($data);

            if($Id == ""){ $datos['IdUsuario'] = $datosusu->ID;}
         	$datos['estado'] = 1;
            $datos->save();
    
        } catch (Exception $e) {
            return response([
                    "mensaje" => "Error al guardar, por favor intenta de nuevo o comunícate con el administrador.",
                    "error" => $e->getMessage()
                ]);
        }

        $retorno = [
                "success" => true,
                "mensaje" => "Datos guardados correctamente",
                //"request" => $request->all(),
                "result" => $datos
            ];
		return response()->json($retorno);
        //return view('Empleado.index');
    }

    public function postFormempleado(Request $request)
    {
        $titulo = "Empelado";
        $ID = $request->input('IdJuguete');
        $datos = $ID == "" ? new EmpleadoModel() : EmpleadoModel::find($ID);
        if($datos != null){
        	$datosusu = UsuariosModel::find($datos['IdUsuario']);
			$datos['Correo'] = $datosusu['Correo'];	
        }
        $tipodoc = [null=>'Seleccione...'];
        $tipodoc = TipoDocumento_Model::orderBy('ID','asc')->pluck('Nombre','Id');
        $view = view('Empleado.formEmpleado')->with(['datos' => $datos, 'titulo' => $titulo,'tipodoc'=>$tipodoc]);

        if($request->ajax()){
            return $view->renderSections()['content_modal'];
        }else{
            return $view;
        }       
    }


    public function cambiaEstado(Request $request)
    {
        try {
            
            $Id = $request->input('Id');
            $estado = $request->input('estado');
            $datos = EmpleadoModel::find($Id);
            $datos['estado'] = $estado;
            $data = $request->all();
            $datos->fill($data);
            $datos->save();
    
        } catch (Exception $e) {
            return response([
                    "mensaje" => "Error al guardar, por favor intenta de nuevo o comunícate con el administrador.",
                    "error" => $e->getMessage()
                ]);
        }
        
        return response([
                "success" => true,
                "mensaje" => "Datos guardados correctamente",
                //"request" => $request->all(),
                "datos" => $datos
            ]);
    }


    public function GuardarTxt(Request $request){
    	try{

	            $data = $request->all();
		        $Id = $request->input('Id');

		        $file = $request->file('file');
		        $allowedFiles = array('txt');
		        $path = public_path().'/uploads/Masivo/empleado/'.$Id.'/'; 

	            if($file != null ){
	                $archivo =  str_replace(" ", "_", $file->getClientOriginalName());
	                $extension = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
	                if(in_array($extension,$allowedFiles)){                    
	                    if(!file_exists($path)){
	                      mkdir($path,0777,true);
	                      chmod($path, 0777); 
	                    }               	    
					}

                	$fileName = str_replace(" ", "_", $file->getClientOriginalName());
                    $file->move($path, 'dato_'.$Id.'.'.$extension);   
                    $leerarchivo = explode("\n",File::get($path. '/dato_'.$Id.'.'.$extension));

                    	$result_texto = '';
                   // var_dump($leerarchivo);
                    foreach ($leerarchivo as $key=>$line){
                    	$datosLinea = explode(',', $line);
                    	//echo count($datosLinea);
                    	 $datos =  new EmpleadoModel();
                    	 $datosusu = new UsuariosModel();
                    	if(count($datosLinea) > 0  && count($datosLinea) == 6){
                    		if(is_string($datosLinea[0])){
				            	$datos['Nombre'] = $datosLinea[0];
                    			if(is_string($datosLinea[1])){
				            		$datos['Apellido'] = $datosLinea[1];
		                    		if(is_string($datosLinea[2])){	
		                    			$id_codigo = TipoDocumento_Model::where('Codigo',$datosLinea[2])->select('ID')->first();
				            			$datos['IdTipoDocumento'] = ($id_codigo['ID'] != null)?$id_codigo['ID']:1;
		                    			if(is_string($datosLinea[3])){
				            				$datos['NumeroDocumento'] = $datosLinea[3];
				                    		if($this->validateDate($datosLinea[4])){
				            					$datos['FechaNacimiento'] = $datosLinea[4];
						                    		if( $this->email($datosLinea[5])){
				            							$datosusu['Correo'] = $datosLinea[5];
						                    		}else{
                    									$result_texto .= '| Email no valido, linea:'.$key.' |';
						                    		}
				                    		}else{
                								$result_texto .= '| FechaNacimiento no valido, linea:'.$key.' |';
				                    		}
			                    		}else{
			                    			$result_texto .= '| NumeroDocumento no valido, linea:'.$key.' |';
			                    		}
		                    		}else{
		                    			$result_texto .= '| IdTipoDocumento no valido, linea:'.$key.' |';
		                    		}
                    			}else{
                    				$result_texto .= '| Apellido no valido, linea:'.$key.' |';
	                    		}
                    		}else{
                    			$result_texto .= '| Nombre no valido, linea:'.$key.' |';
                    		}
                    		if($result_texto == ''){
		            			//$datosusu['Login'] = $datos['NumeroDocumento'];
					            $datosusu['Contrasena'] = $datos['NumeroDocumento'];
					            $datosusu['Confirmado'] = 0;
					            $datosusu['CodigoConf'] = "";
                                $datosusu['IdTipoUsuario'] = 3;
					            $datosusu->save();
					            $datos['IdUsuario'] = $datosusu->ID;

					            $datos['IdEmpresa'] = $request->input('IdEmpresa');
					         	//$datos['IdUsuario'] = 1;
					            $datos->save();
				            	//var_dump($datos);
				        	}
                    	}else{
							$result_texto .= 'Error  al guardar. Cadena de texto no conside, linea: '.$key ;
                    	}
					}

					if($result_texto != ''){
						return response()->json([
				                'mensaje'=>$result_texto,    
				                'error' => 'error'
				            ]);
					}
                }else{
                    return response()->json([
                    'mensaje'=>"Error al guardar. Extensión no válida."        
                    
                    ]);
                }
         	return response()->json([
               'mensaje'=> "Datos guardados Correctamente", 
               'ImgJuguete_ID' => $Id,
               'success' => 'success'
             ]);

        }catch (Exception $e) {
            return response()->json([
                'mensaje'=>"Error  al guardar. Por favor intenta de nuevo.",         
                'error' => $e->getMessage()
            ]);
        }
    }

    function email($str){
	  return (false !== strpos($str, "@") && false !== strpos($str, "."));
	}

	function validateDate($date, $format = 'YYYY-MM-DD')
	{
		try{
			\DateTime::createFromFormat("Y-m-d", $date);
			return true;
		}catch(Exception $e) {
			return false;
		}
	    // $d = \DateTime::createFromFormat($format, $date);
	    // return $d && $d->format($format) == $date;
	}

}
