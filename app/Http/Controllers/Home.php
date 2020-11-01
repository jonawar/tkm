<?php

namespace App\Http\Controllers;

use App\Mhome;
use App\Msoal;
use App\Musertest;
use App\Musertestjawab;
use App\Musertype;
use Illuminate\Http\Request;
use DB;

class Home extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'nama' => null
        );
        return view('page/registrasi', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => 'Isi sesuai petunjuk',
            'numeric' => 'attribute wajib dengan nomor atau angka',
            'email' => 'attribute wajib menggunakan format email'
        ];

        $request->validate([
            'nama'=>'required',
            'email'=>'required|email',
            'license' => 'required',
            'password' => 'required'
        ], $messages);

        $user = Musertest::where('license', $request->license)
                ->where('email', $request->email)
                ->first();
        
        if($user){
            $data = $request->all();
            $data['jawaban'] = Musertestjawab::selectRaw('sum(point) as total, nama_kategori')
            ->where('id_user', $user->id)
            ->join('soal','soal.nomor','=','id_soal')
            ->join('kategori_soal','kategori_soal.id','=','soal.category')
            ->groupBy(DB::raw('nama_kategori'))
            ->orderBy('total','desc')
            ->limit(3)
            ->get();

            $deskripsi = [];
            foreach($data['jawaban'] as $key => $val){
                $type = Musertype::where('type',strtoupper($val->nama_kategori))->first();
                array_push($deskripsi, $type);
            }

            $data['deskripsi'] = $deskripsi;

            return view('page/postest', $data);
        }

        $checkLicense = $this->checkLicense($request);
        if(!$checkLicense){
            $registerLicense = $this->registerLicense($request);
            if(!$registerLicense){
                return redirect()->back()->withErrors('Lisensi tidak terdaftar.');
            }
        }

        $soal = Msoal::where('status', 1)->get();
        
        $data = array(
            'nama' => $request->nama,
            'email' => $request->email,
            'license' => $request->license,
            'soal' => $soal
        );

        return view('page/test', $data); 
    }

    public function registerLicense($request){
        $json = array(
            'string' => $request->nama,
            'user_email' => $request->email,
            'license' => $request->license,
            'user_pass' => $request->password
        );
        $url = env('REGISTER_URL').'/sejoli-license';

        //check license
        $ch  = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $data = curl_exec($ch);
        curl_close($ch);
        $jsonResponse = json_decode($data);
        return $jsonResponse->valid;
    }

    public function checkLicense($request){
        $json = array(
            'string' => $request->nama,
            'host' => $request->email,
            'license' => $request->license
        );
        $url = env('REGISTER_URL').'/sejoli-validate-license'.'?license='.$request->license.'&host='.$request->nama.'&string='.$request->nama;

        //check license
        $ch  = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $data = curl_exec($ch);
        curl_close($ch);
        $jsonResponse = json_decode($data);
        return $jsonResponse->valid ?? false;
    }

    // postest

    public function postest(Request $request){
        $data = $request->all();

        $paramUser = [
            'nama' => $data['nama'],
            'email' => $data['email'],
            'license' => $data['license']
        ];

        $user = Musertest::create($paramUser);
        $id = $user->id;

        foreach($data['jawaban'] as $key => $val){
            $soal = Msoal::where('nomor', $key)->first();

            $dataJawaban = [
                'id_user' => $id,
                'id_soal' => $key,
                'category' => $soal->category,
                'point' => $val,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            Musertestjawab::create($dataJawaban);
        }

        $data['jawaban'] = Musertestjawab::selectRaw('sum(point) as total, nama_kategori')
                        ->where('id_user', $id)
                        ->join('soal','soal.nomor','=','id_soal')
                        ->join('kategori_soal','kategori_soal.id','=','soal.category')
                        ->groupBy(DB::raw('nama_kategori'))
                        ->orderBy('total','desc')
                        ->limit(3)
                        ->get();

        $deskripsi = [];
        foreach($data['jawaban'] as $key => $val){
            $type = Musertype::where('type',strtoupper($val->nama_kategori))->first();
            array_push($deskripsi, $type);
        }
        $data['deskripsi'] = $deskripsi;

        return view('page/postest', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mhome  $mhome
     * @return \Illuminate\Http\Response
     */
}
