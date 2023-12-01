<?php

namespace App\Http\Controllers\frontend;

use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; 

class KeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = new Client();
        $url = "http://localhost:8000/api/keluarga";
        $response = $client->request('Get',$url);
        // dd($response);
        $content= $response->getBody()->getContents();
        //merubah json menjadi array
        $contentArray = json_decode($content,true);
        // print_r($contentArray);
        $data =$contentArray['data'];
        // print_r($data);
        return view('keluarga.index',['data'=>$data,'dataOrangTua' => $this->getOrangTua() ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nama = $request->nama;
        $jenis_kelamin = $request->jenis_kelamin;
        $id_individu_orangtua = $request->id_individu_orangtua;
        $hubungan = $request->hubungan;
        
        $parameter = [
            'nama' => $nama,
            'jenis_kelamin' => $jenis_kelamin,
            'id_individu_orangtua' =>$id_individu_orangtua,
            'hubungan' =>$hubungan,
        ];

        $client = new Client();
        $url = "http://localhost:8000/api/keluarga";
        $response = $client->request('POST',$url,[
            'headers' => ['Content-type'=>'application/json'],
            'body' => json_encode($parameter)
        ]);

        
        $content= $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        if($contentArray['status']!= true){
            $error =$contentArray['data'];
            return redirect()->to('keluarga')->withErrors($error)->withInput();
        }else{
            return redirect()->to('keluarga')->with('success','Data berhasil disimpan');
        }
        
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = new Client();
        $url = "http://localhost:8000/api/keluarga/$id";
        $response = $client->request('GET', $url); // Perhatikan: 'GET' menggunakan huruf besar
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        
        if(isset($contentArray['status']) && $contentArray['status'] == true && isset($contentArray['data']) && is_array($contentArray['data'])) {
            $data = $contentArray['data'];
            return view('keluarga.index', ['data' => $data,'dataOrangTua' => $this->getOrangTua() ]);
        } else {
            $error = isset($contentArray['message']) ? $contentArray['message'] : "Tidak dapat mengambil data keluarga";
            return redirect()->to('keluarga')->withErrors($error);
        }
        // var_dump($data);
        
    }

    private function getOrangTua()
    {
        $client = new Client();
        $url = "http://localhost:8000/api/keluarga";
        $response = $client->request('Get',$url);
        // dd($response);
        $content= $response->getBody()->getContents();
        //merubah json menjadi array
        $contentArray = json_decode($content,true);
        // print_r($contentArray);
        $data =$contentArray['data'];
        // print_r($data);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $nama = $request->nama;
        $jenis_kelamin = $request->jenis_kelamin;
        $id_individu_orangtua = $request->id_individu_orangtua;
        $hubungan = $request->hubungan;
        
        $parameter = [
            'nama' => $nama,
            'jenis_kelamin' => $jenis_kelamin,
            'id_individu_orangtua' =>$id_individu_orangtua,
            'hubungan' =>$hubungan,
        ];

        $client = new Client();
        $url = "http://localhost:8000/api/keluarga/$id";
        $response = $client->request('PUT',$url,[
            'headers' => ['Content-type'=>'application/json'],
            'body' => json_encode($parameter)
        ]);

        
        $content= $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        if($contentArray['status']!= true){
            $error =$contentArray['data'];
            return redirect()->to('keluarga')->withErrors($error)->withInput();
        }else{
            return redirect()->to('keluarga')->with('success','Data berhasil diupdate');
        }
        
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = new Client();
        $url = "http://localhost:8000/api/keluarga/$id";
        $response = $client->request('DELETE',$url);
        $content= $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        if($contentArray['status']!= true){
            $error =$contentArray['data'];
            return redirect()->to('keluarga')->withErrors($error)->withInput();
        }else{
            return redirect()->to('keluarga')->with('success','Data berhasil dihapus');
        }
    }
    public function getFamilyTreeData() {
        
        $response = Http::get('http://localhost:8000/api/tree'); // Sesuaikan URL dengan endpoint yang benar
        return view('keluarga.tree', ['familyTreeData' => $response->json()]);
    }
}
