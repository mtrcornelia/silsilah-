<?php

namespace App\Http\Controllers;
use App\Models\Keluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class KeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Keluarga::orderBy('id','asc')->get();
         return response()->json([
            'status' => true,
            'message' => 'Data Ditemukan',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataKeluarga = new Keluarga;
        $rules =[
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'id_individu_orangtua' =>'nullable',
            'hubungan' =>'nullable'
           
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Data Ditemukan',
                'data' =>$validator->errors()
            ]);

        }
        
        $dataKeluarga->nama=$request->nama;
        $dataKeluarga->jenis_kelamin=$request->jenis_kelamin;
        $dataKeluarga->id_individu_orangtua=$request->id_individu_orangtua;
        $dataKeluarga->hubungan=$request->hubungan;
        $post =$dataKeluarga->save();

        return response()->json([
            'status' => true,
            'message' => ' data berhasil disimpan',
            
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Keluarga::find($id);
        if ($data){
            return response()->json([
                'status' => true,
                'message' => 'Data Ditemukan',
                'data' => $data
            ], 200);
        } else{
            return response()->json([
                'status' => false,
                'message' => 'Data Ditemukan'
                
            ]);
               
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataKeluarga =  Keluarga::find($id);
        if(empty($dataKeluarga)){
           return response()->json([
                'status' => false,
                'message' => 'data tidak ada'
            ], 404);
        }
        $rules =[
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'id_individu_orangtua' =>'nullable',
            'hubungan' =>'nullable'
           
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'gagal update data',
                'data' =>$validator->errors()
            ]);

        }
        
        $dataKeluarga->nama=$request->nama;
        $dataKeluarga->jenis_kelamin=$request->jenis_kelamin;
        $dataKeluarga->id_individu_orangtua=$request->id_individu_orangtua;
        $dataKeluarga->hubungan=$request->hubungan;
        $post =$dataKeluarga->save();

        return response()->json([
            'status' => true,
            'message' => ' data berhasil diupdate',
            
        ]);

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataKeluarga =  Keluarga::find($id);
        if(empty($dataKeluarga)){
           return response()->json([
                'status' => false,
                'message' => 'data tidak ada'
            ], 404);
        }
        
        $post =$dataKeluarga->delete();

        return response()->json([
            'status' => true,
            'message' => ' data berhasil dihapus',
            
        ]);

    }
    public function getFamilyTreeData() {
        $familyMembers = Keluarga::select('id', 
            'nama as name', 
            DB::raw('case when jenis_kelamin = \'laki-laki\' then \'male\' else \'female\' end as gender'), 
            'id_individu_orangtua as fid')
        ->get();
        return response()->json($familyMembers);
    }
}
