<?php

namespace Jugueteria\Http\Controllers;

use Illuminate\Http\Request;
use Jugueteria\model\Juguete_model;
use Jugueteria\model\rel_juguete_img;
use File;

class GaleriaImgController extends Controller
{
    public function getGaleriaImg(Request $request)
    {
        $jugueteID = $request->input('Id');
        $img = rel_juguete_img::join('juguete','juguete.ID','=','jugueteimg.IdJuguete')
         ->select('jugueteimg.*')->where('jugueteimg.IdJuguete','=',$jugueteID)->get();
        $juguete = $jugueteID == "" ? new Juguete_model() : Juguete_model::find($jugueteID);
        $countimg = $img->count();
           return view('Galeria.index') ->with([
            'juguete'=>$juguete,'img'=>$img ,'countimg'=>$countimg]);
    }
    
    public function GuardarImg(Request $request){
    	try{

	            $data = $request->all();
		        $jugueteID = $request->input('Id');
		        $Idimg = $request->input('idJugueteImg');

				$juguete = Juguete_model::find($jugueteID);
	            $img = $Idimg == "" ? new rel_juguete_img() : rel_juguete_img::find($Idimg);

		        $file = $request->file('file');
		        $allowedFiles = array('jpeg', 'jpg', 'png');
		        $path = public_path().'/uploads/ImgJuguete/'.$jugueteID.'/'; 

	 			if(($img['idJugueteImg'] != "" || $img['idJugueteImg'] != null)) {
	                $filename = public_path().'/uploads/ImgJuguete/'.$juguete['ID'].'/'.$juguete['idJugueteImg'];
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
                    $file->move($path, 'jugueteimg'.$img['idJugueteImg'].'.'.$extension);             
		            $juguete['Imagenes'] = 'jugueteimg'.$img['idJugueteImg'].'.'.$extension;
            		$juguete['estado'] = 1;
		            $juguete->fill($data);
		            $juguete->save();

					$img['Imagen']= 'jugueteimg'.$img['idJugueteImg'].'.'.$extension;
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
        $img = rel_juguete_img::join('juguete','juguete.IdJuguete','=','rel_juguete_img.IdJuguete')
         ->select('rel_juguete_img.*')->where('rel_juguete_img.IdJuguete','=',$jugueteID)->get();
       

        $view = view('Galeria.contendorImg')->with(['img'=>$img]);
        return $view;
    }
    
}
