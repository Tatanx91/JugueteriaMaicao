<?php

namespace Jugueteria\Http\Controllers;

use Illuminate\Http\Request;
use Jugueteria\model\Juguete_model;
use Jugueteria\model\rel_juguete_img;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use File;

class GaleriaImgController extends Controller
{
    public function getGaleriaImg(Request $request)
    {
        if(Session::get("PRIVILEGIOS") == null){
            Session::forget('PRIVILEGIOS');
            return redirect::to('/');
        }
        $jugueteID = $request->input('Id');
        $img = rel_juguete_img::join('juguete','juguete.ID','=','jugueteimg.IdJuguete')
         ->select('jugueteimg.*')->where('jugueteimg.IdJuguete','=',$jugueteID)->where('JugueteImg.estado','=',1)->get();
        $juguete = $jugueteID == "" ? new Juguete_model() : Juguete_model::find($jugueteID);
        $juguete['IdJuguete']=$jugueteID;
        $countimg = $img->count();
           return view('Galeria.index') ->with([
            'juguete'=>$juguete,'img'=>$img ,'countimg'=>$countimg]);
    }
    
    public function GuardarImg(Request $request){
    	try{

	            $data = $request->all();
		        $jugueteID = $request->input('Id');
		        $Idimg = $request->input('ID');

	            $img = $Idimg == "" ? new rel_juguete_img() : rel_juguete_img::find($Idimg);

		        $file = $request->file('file');
		        $allowedFiles = array('jpeg', 'jpg', 'png');
		        $path = public_path().'/uploads/ImgJuguete/'.$jugueteID.'/'; 

	 			if(($img['ID'] != "" || $img['ID'] != null)) {
	                $filename = public_path().'/uploads/ImgJuguete/'.$jugueteID.'/'.$img['ID'];
	                File::delete($filename);
	            }

	            if( $file != null ){
	                $archivo =  str_replace(" ", "_", $file->getClientOriginalName());
	                $extension = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
	                if(in_array($extension,$allowedFiles)){                    
	                    if(!file_exists($path)){
	                      mkdir($path,0777,true);
	                      chmod($path, 0777); 
	                    }               	    
					if($Idimg == ''){
						$img['IdJuguete']= $jugueteID;
					}
					$img['ruta']='uploads/ImgJuguete/'.$jugueteID.'/';
					$img['Extension']= $extension;
					$img['estado']= 1;

		            $img->fill($data);
		            $img->save();
                	$fileName = str_replace(" ", "_", $file->getClientOriginalName());
                    $file->move($path, 'Jugueteimg'.$img['ID'].'.'.$extension);             
		            

					$img['Imagen']= 'Jugueteimg'.$img['ID'].'.'.$extension;
					$img->fill($data);
		            $img->save();
                }else{
                    return response()->json([
                    'mensaje'=>"Error al guardar. Extensión no válida."        
                    
                    ]);
                }
            }
         	return response()->json([
               'mensaje'=> "Datos guardados Correctamente", 
               'ImgJuguete_ID' => $jugueteID,
               'success' => 'success'
             ]);

        }catch (Exception $e) {
            return response()->json([
                'mensaje'=>"Error  al guardar. Por favor intenta de nuevo.",         
                'error' => $e->getMessage()
            ]);
        }
    }

    public function CargarContenedorImg(Request $request)
    {
        $jugueteID = $request->input('IdJuguete');
        $img = rel_juguete_img::join('Juguete','Juguete.ID','=','JugueteImg.IdJuguete')
         ->select('JugueteImg.*')->where('JugueteImg.IdJuguete','=',$jugueteID)->where('JugueteImg.estado','=',1)->get();
       

        $view = view('Galeria.contendorImg')->with(['img'=>$img]);
        return $view;
    }
 

    public function EliminaRegistro(Request $request)
    {
        try {
            
            $ID = $request->input('ID');
            $estado = $request->input('estado');
            $juguete = rel_juguete_img::find($ID);
            $juguete['estado'] = 0;
            $data = $request->all();
            $juguete->fill($data);
            $juguete->save();
    
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
                "juguete" => $juguete
            ]);
    }   
    
}
