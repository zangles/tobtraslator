<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class azsController extends Controller
{
    const PALABRAS_ESPECIALES = [
        'Tobir',
        'Miguel',
        'Otherion',
        'Muzhar',
        'aydahar'
    ];

    CONST PALABRAS_ESPECIALES_2 = [
        '**************',
        '^^^^^^^^^^^^^^',
        '$$$$$$$$$$$$$$',
        '##############',
        '@@@@@@@@@@@@@@'
    ];

    public function index(Request $request)
    {
        $texto = $this->traslate($request->input('texto'));
        return view('translate', compact('texto'));

    }

    //fasdfasdfasdfas
    private function traslate($text) {

        $entradaOriginal = $text;
        $vocales =    ['A', 'E', 'I', 'O', 'U', 'Y'];
        $newVocales = ['E', 'I', 'O', 'A', 'U', 'Y'];

//        $consonantes =    ['B','C','D','F','G','H','J','K','L','M','N','P','Q','R','S','T','V','W','X','Y','Z'];
//        $newConsonantes = ['V','B','J','R','N','C','F','G','Z','X','H','Y','D','T','P','W','M','Q','S','L','K'];
        $consonantes =    ['B','C','D','F','G','H','J','K','L','M','N','P','Q','R','S','T','V','W','X','Z'];
        $newConsonantes = ['N','B','J','D','V','C','F','G','L','X','M','H','T','R','S','Z','Q','W','P','K'];

        // exceptiones

        $entrada = $this->convertSpecialWords($entradaOriginal);

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

        $palabraFinal = $this->decodeSpecialWords($palabraFinal);

        return $palabraFinal;
    }


    private function convertSpecialWords($texto)
    {
        $textoConvertido = $texto;
        foreach (self::PALABRAS_ESPECIALES as $indice => $palabra) {
            if (strpos($texto, $palabra) !== false) {
                $textoConvertido = str_replace($palabra, self::PALABRAS_ESPECIALES_2[$indice], $textoConvertido);
            }
        }

        return $textoConvertido;
    }

    private function decodeSpecialWords($texto)
    {
        $textoConvertido = $texto;
        foreach (self::PALABRAS_ESPECIALES_2 as $indice => $palabra) {
            if (strpos($texto, $palabra) !== false) {
                $textoConvertido = str_replace($palabra, self::PALABRAS_ESPECIALES[$indice], $textoConvertido);
            }
        }

        return $textoConvertido;
    }
}
