<?php
function calcularMedia($n1, $n2){
    return ($n1 + $n2)/2;
}

function calcularFrequencia($faltas){
    $total = 100;
    return (($total - $faltas)/$total)*100;
}

function situacao($media, $freq){
    return ($media >= 7 && $freq >= 75) ? "Aprovado" : "Reprovado";
}
