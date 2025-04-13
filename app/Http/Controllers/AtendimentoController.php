<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AtendimentoController extends Controller
{
    public function index(){

        return view('atendimento.index');
}
    public function create(){

        return view('atendimento.create');
    }

    public function show(){
        return view('atendimeto.show');
    }

    public function edit(){
        return view('atendimento.edit');
    }

    public function destroy(){
        return view('atendimento.destroy');
    }

    public function update(){
        return view('atendimento.update');
    }




}