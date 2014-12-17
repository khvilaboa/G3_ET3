<?php
//******************************************************************
// function idioma
// Created by : J. Rodeiro
// Date: 2/11/2011
// Read from a file de language texts for a page
// Parameters:
// $codpag : code of page to translate
// $idioma : code of language to use (ESPANHOL, ENGLISH)
// returns an array with all texts of the page in $idioma language
//******************************************************************
function idioma($codpag, $idioma)
{
// initialize the lang array
    $lang = array();
// define the name of file of language
    $fichero = $idioma.".LANG";
// open file in read mode
    $FileLang = fopen(dirname(__FILE__)."/".$fichero,"r");
// initialize $finish var for detect that language is totally obtained before eof file
    $finish = false;
// read the first line of file
    $line = fgets($FileLang);
// until eof or language obtained
// while doesnt find end of file or flag $finish be true
    while (!feof($FileLang) && !$finish )
    {
    // if the six firts characters are CodPag and the CodPag value be correct
        if ((substr($line,0,6)=="CodPag") && (substr($line,6)==$codpag))
        {
           
            $line = fgets($FileLang);
                $line = trim($line);
                // while doesnt find end of file or other CodTexto
            while (!feof($FileLang) && (substr($line,0,8)=="CodTexto"))
                {
                
                    // store de number of codtext 
                $codtext = substr($line, 8);
                
                $endcodetextlang = false;
                $text = "";
                    While ( !feof($FileLang) && !$endcodetextlang)
                    {
                // read all lines of codtext of language
                    // initialization of $endcodetextlang to false, will take true value when doesn't find
                    // more CodText for this page lang
                    // read the value of language for the codtext
                $line = fgets($FileLang);
                
                while (!feof($FileLang) && (!$endcodetextlang))
                    {
                    
                    if (!(substr($line,0,3)=="Cod") && !(substr($line,0,1)=="#") && !feof($FileLang))
                    {
                    // delete special characters of the line
                    $line = trim($line);
                    $text .= $line;
                    $line = fgets($FileLang);
                    
                    }
                    else
                    $endcodetextlang = true;
                }
                    // puts the text language in $codtext position of the array
                }
                
                $lang[intval($codtext)] = $text;
            // read for next codtext or end of codtext
            // read for next line of the same codtext of find other codtext, codpag of eof
                
            //$line = fgets($FileLang);
            }
            // all information of language for this codpage has been obtained
            // $finish = true;
            
            $finish = true;
        }
        else
        {
            $line = fgets($FileLang);
        }
    }
    return $lang;
}
?>
