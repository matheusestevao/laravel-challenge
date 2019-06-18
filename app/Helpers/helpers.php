<?php

function dateSysDB($dateTime)
{

    $replaceDate = explode(" ", $dateTime);
    
    $date = date('Y-m-d', strtotime($replaceDate[0]));
    
    if ($replaceDate[2] === 'AM') {

        $hour = $replaceDate[1];

    } else {

        $clock = explode(":", $replaceDate[1]);

        switch ($clock[0]) {
            case '1':
                $newClock = "13";
                break;
            
            case '2':
                $newClock = "14";
                break;
        
            case '3':
                $newClock = "15";
                break;
            
            case '4':
                $newClock = "16";
                break;
            
            case '5':
                $newClock = "17";
                break;
            
            case '6':
                $newClock = "18";
                break;
        
            case '7':
                $newClock = "19";
                break;
            
            case '8':
                $newClock = "20";
                break;

            case '9':
                $newClock = "21";    
                break;
        
            case '10':
                $newClock = "22";
                break;
            
            case '11':
                $newClock = "23";
                break;

            default:
                break;
        }

        $hour = $newClock.":".$clock[1];

    }

    $dateHour = $date.' '.$hour;

    return $dateHour;

}

function dateDBSys($dateTime)
{

    $replaceDate = explode(" ", $dateTime);
    
    $date  = date('m-d-Y', strtotime($replaceDate[0]));
    $clock = explode(":", $replaceDate[1]);
    
    if ($clock[0] <= 12) {

        $hour = $clock[0].':'.$clock[1]. ' AM';

    } else {

        switch ($clock[0]) {
            case '13':
                $newClock = "13";
                break;
            
            case '14':
                $newClock = "2";
                break;
        
            case '15':
                $newClock = "3";
                break;
            
            case '16':
                $newClock = "4";
                break;
            
            case '17':
                $newClock = "5";
                break;
            
            case '18':
                $newClock = "6";
                break;
        
            case '19':
                $newClock = "7";
                break;
            
            case '20':
                $newClock = "8";
                break;

            case '21':
                $newClock = "9";    
                break;
        
            case '22':
                $newClock = "10";
                break;
            
            case '23':
                $newClock = "11";
                break;

            default:
                break;
        }

        $hour = $newClock.":".$clock[1].' PM';

    }

    $dateHour = $date.' '.$hour;

    return $dateHour;

}