<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class azsController extends Controller
{
    const PALABRAS_ESPECIALES = [
        'tobir',
        'miguel',
        'otherion',
        'muzhar',
        'aydahar'
    ];

    public function index(Request $request)
    {
        $words = explode(" ", $request->input('texto'));

        $texto = "";
        foreach ( $words as $word) {
            $texto .= " ". $this->traslateWord($word);
        }

        return view('translate', compact('texto'));

    }

    private function traslateWord($text) {

        if ($this->isSpecialWord($text)) {
            return $text;
        }

        $entradaOriginal = $text;
        $vocales =    ['A', 'E', 'I', 'O', 'U', 'Y'];
        $newVocales = ['E', 'I', 'O', 'A', 'U', 'Y'];

//        $consonantes =    ['B','C','D','F','G','H','J','K','L','M','N','P','Q','R','S','T','V','W','X','Y','Z'];
//        $newConsonantes = ['V','B','J','R','N','C','F','G','Z','X','H','Y','D','T','P','W','M','Q','S','L','K'];
        $consonantes =    ['B','C','D','F','G','H','J','K','L','M','N','P','Q','R','S','T','V','W','X','Z'];
        $newConsonantes = ['N','B','J','D','V','C','F','G','L','X','M','H','T','R','S','Z','Q','W','P','K'];

        // exceptiones

        $entrada = $entradaOriginal;

        $arrayEntrada = str_split($entrada);

        $palabraFinal = "";
        foreach ($arrayEntrada as $indice => $letra) {
            if (in_array(strtoupper($letra), $vocales)) {
                //es vocal
                $esMinuscula = !in_array($letra, $vocales);
                $posicion  = array_search(strtoupper($letra), $vocales);
                if ($esMinuscula) {
                    $palabraFinal .= strtolower($newVocales[$posicion]);
                } else {
                    $palabraFinal .= $newVocales[$posicion];
                }
            } elseif (in_array(strtoupper($letra), $consonantes)) {
                //es consonante
                $esMinuscula = !in_array($letra, $consonantes);
                $posicion  = array_search(strtoupper($letra), $consonantes);
                if ($esMinuscula) {
                    $palabraFinal .= strtolower($newConsonantes[$posicion]);
                } else {
                    $palabraFinal .= $newConsonantes[$posicion];
                }
            } else {
                //caracteres especiales
                $palabraFinal .= $letra;
            }
        }

        return $palabraFinal;
    }


    private function isSpecialWord($word)
    {
        return in_array(strtolower($word), self::PALABRAS_ESPECIALES);
    }
}
