<?php

namespace App\Services;

class PeselValidate
{
    public function validation($request)
    {
        $pesel = str_split($request->pesel);

        $reg = '/^[0-9]{11}$/';
        if (preg_match($reg, $request->pesel)) {

            $arrWeight = array(1, 3, 7, 9, 1, 3, 7, 9, 1, 3); // Array with weights 
            $intSum = 0;
            for ($i = 0; $i < 10; $i++) {
                $intSum += $arrWeight[$i] * $pesel[$i]; // Multiply each digit of the pesel by the appropriate weight and sum up
            }
            $int = 10 - $intSum % 10; // Calculate the check digit and compare with the last digit
            $intControlNr = ($int == 10) ? 0 : $int; // Check if the same checksum is in the sequence
            if ($intControlNr == $pesel[10]) {


                // Take day and month
                $month = substr($request->pesel, 2, 2);
                $day = substr($request->pesel, 4, 2);

                // Create array with permitted months
                $arrAddToMonth = array(80, 0, 20, 40, 60);
                $arrMonthBase = range(1, 12);
                foreach ($arrAddToMonth as $monthAdditional) {
                    foreach ($arrMonthBase as $monthBase) {
                        $arrMonth[] = $monthAdditional + $monthBase;
                    }
                }

                // Check month 
                if (in_array($month, $arrMonth)) {

                    // Set a century
                    if (substr($month, 0, 1) == '0' || substr($month, 0, 1) == '1') $century = 1900;
                    if (substr($month, 0, 1) == '8' || substr($month, 0, 1) == '9') $century = 1800;
                    if (substr($month, 0, 1) == '2' || substr($month, 0, 1) == '3') $century = 2000;
                    if (substr($month, 0, 1) == '5' || substr($month, 0, 1) == '4') $century = 2100;
                    if (substr($month, 0, 1) == '6' || substr($month, 0, 1) == '7') $century = 2200;
                    if ($century == '2000') $month = $month - 20;
                    if ($century == '1800') $month = $month - 80;
                    if ($century == '2100') $month = $month - 40;
                    if ($century == '2200') $month = $month - 60;

                    // Finally year
                    $year = $century + substr($request->pesel, 0, 2);

                    // Verification if birthday from pesel and patient birthday are equal
                    if (((substr($request->birthday, 0, 4)) == $year)
                        && ((substr($request->birthday, 5, 2)) == $month)
                        && ((substr($request->birthday, 8, 2)) == $day)
                    ) {


                        return true;
                    }
                }
            }


            return false;
        }
    }
}
