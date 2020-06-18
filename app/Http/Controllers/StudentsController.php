<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students=  Student::all(); // eloquent
        return view('students/index', ['students' => $students]);
        //
    }

    /**
     * Show the form for creating a new resource. // untuk munculin form
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        return view('students/create');
    }

    /**
     * Store a newly created resource in storage. // untuk nyimpen
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       /* Cara Pertama
        // $student->nama itu yang ada dalam tabel
        // $request-> nama itu yang kita isi di form

        $student = new Student;
        $student->nama = $request->nama; 
        $student->nim = $request->nim;
        $student->email = $request->email;
        $student->jurusan = $request->jurusan;

        $student ->save(); // simpan $student ke database

        */
        
        /* cara kedua (harus buka modelnya untuk security)
        Student::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'jurusan' => $request->jurusan
            ]);
        */
        
        

        // untuk security (validate)
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|size:5', // harus 5 digit
            'email' => 'required',
            'jurusan' => 'required'
        ]);
        
        // cara kedua versi pendek (apabila pada model menggunakan fillable)
        Student::create($request->all());
            
        return redirect('/students')->with('status','Data Berhasil ditambahkan'); // with untuk menampilkan flash messsage
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view('students/show', ['student' => $student]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('students/edit', ['student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        // Request =data baru
        // Student = data lama

        $request->validate([
            'nama' => 'required',
            'nim' => 'required|size:5', // harus 5 digit
            'email' => 'required',
            'jurusan' => 'required'
        ]);

        Student::where('id', $student->id)
            ->update([
                'nama' => $request->nama,
                'nim' => $request->nim,
                'email' => $request->email,
                'jurusan'=>$request->jurusan
            ]);
            return redirect('/students')->with('status','Data Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        Student::destroy($student->id);
        return redirect('/students')->with('status','Data Berhasil dihapus');
        //
    }
}
