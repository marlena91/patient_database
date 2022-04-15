<?php

namespace App\Services;

class PeselValidate
{
    protected $pesel, $birthday, $year, $month, $day, $century, $birthdate;
    protected $peselIsValid = false;


    public function __construct(string $pesel, string $birthday)
    {
        $this->pesel = $pesel;
        $this->birthday = $birthday;
        $this->year = substr($pesel, 0, 2);
        $this->month = substr($pesel, 2, 2);
        $this->day = substr($pesel, 4, 2);
        $this->century = $this->getCentury();
        $this->birthdate = date_create($this->century . $this->year . '-' . $this->month . '-' . $this->day);
    }

    public function validate()
    {

        // $this->peselIsValid = ($this->checkIfElevenNumbers()
        //     && $this->compireWithBirthday() && $this->officialValidation());
        return $this->compireWithBirthday();

        // if ($this->peselIsValid) {
        //     return true;
        // } else return false;
    }

    protected function checkIfElevenNumbers(): bool
    {
        if (!preg_match('/^[0-9]{11}$/', $this->pesel)) {
            return false;
        }

        return true;
    }


    protected function compireWithBirthday()
    {
        return $this->birthdate;
    }


    protected function officialValidation(): bool
    {
        $weight = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3];
        $sum = 0;

        foreach ($weight as $index => $value) {
            $sum += $value * $this->pesel[$index];
        }

        $checkNumber = 10 - $sum % 10;
        $checkSum = ($checkNumber == 10) ? 0 : $checkNumber;

        if (!$checkSum == $this->pesel[10]) {
            return false;
        }

        return true;
    }

    protected function getCentury(): string
    {
        $allCorrectMonths = [
            18 => ['81', '82', '83', '84', '85', '86', '87', '88', '89', '90', '91', '92'],
            19 => ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'],
            20 => ['21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32'],
            21 => ['41', '42', '43', '44', '45', '46', '47', '48', '49', '50', '51', '52'],
            22 => ['61', '62', '63', '64', '65', '66', '67', '68', '69', '70', '71', '72'],
        ];

        foreach ($allCorrectMonths as $century => $correctMonths) {
            if (false !== $key = array_search($this->month, $correctMonths)) {
                $this->month = sprintf('%02d', ++$key);
                return $century;
            }
        }
    }


    // public function validation($request)
    // {
    //     $pesel = str_split($request->pesel);

    //     if (preg_match($reg, $request->pesel)) {

    //         $arrWeight = array(1, 3, 7, 9, 1, 3, 7, 9, 1, 3); // Array with weights 
    //         $intSum = 0;
    //         for ($i = 0; $i < 10; $i++) {
    //             $intSum += $arrWeight[$i] * $pesel[$i]; // Multiply each digit of the pesel by the appropriate weight and sum up
    //         }
    //         $int = 10 - $intSum % 10; // Calculate the check digit and compare with the last digit
    //         $intControlNr = ($int == 10) ? 0 : $int; // Check if the same checksum is in the sequence
    //         if ($intControlNr == $pesel[10]) {


    //             // Take day and month
    //             $month = substr($request->pesel, 2, 2);
    //             $day = substr($request->pesel, 4, 2);

    //             // Create array with permitted months
    //             $arrAddToMonth = array(80, 0, 20, 40, 60);
    //             $arrMonthBase = range(1, 12);
    //             foreach ($arrAddToMonth as $monthAdditional) {
    //                 foreach ($arrMonthBase as $monthBase) {
    //                     $arrMonth[] = $monthAdditional + $monthBase;
    //                 }
    //             }

    //             // Check month 
    //             if (in_array($month, $arrMonth)) {

    //                 // Set a century
    //                 if (substr($month, 0, 1) == '0' || substr($month, 0, 1) == '1') $century = 1900;
    //                 if (substr($month, 0, 1) == '8' || substr($month, 0, 1) == '9') $century = 1800;
    //                 if (substr($month, 0, 1) == '2' || substr($month, 0, 1) == '3') $century = 2000;
    //                 if (substr($month, 0, 1) == '5' || substr($month, 0, 1) == '4') $century = 2100;
    //                 if (substr($month, 0, 1) == '6' || substr($month, 0, 1) == '7') $century = 2200;
    //                 if ($century == '2000') $month = $month - 20;
    //                 if ($century == '1800') $month = $month - 80;
    //                 if ($century == '2100') $month = $month - 40;
    //                 if ($century == '2200') $month = $month - 60;

    //                 // Finally year
    //                 $year = $century + substr($request->pesel, 0, 2);

    //                 // Verification if birthday from pesel and patient birthday are equal
    //                 if (((substr($request->birthday, 0, 4)) == $year)
    //                     && ((substr($request->birthday, 5, 2)) == $month)
    //                     && ((substr($request->birthday, 8, 2)) == $day)
    //                 ) {


    //                     return true;
    //                 }
    //             }
    //         }


    //         return false;
    //     }
    // }


}
