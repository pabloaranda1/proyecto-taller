<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('pages/inicio', ['title' => 'Inicio']);
    }

    public function contacto()
    {
        return view('pages/contacto', ['title' => 'Contacto']);
    }

    public function quienesSomos()
    {
        return view('pages/quienes-somos', ['title' => 'Quiénes Somos']);
    }

    public function comercio()
    {
        return view('pages/comercio', ['title' => 'Comercialización']);
    }

    public function terminos()
    {
        return view('pages/terminos', ['title' => 'Términos y Usos']);
    }

    public function invierno()
    {
        return view('pages/catalogo-invierno');
    }

    public function verano()
    {
        return view('pages/catalogo-verano');
    }
}
