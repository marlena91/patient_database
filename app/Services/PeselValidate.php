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
        $this->birthdate = $this->century . $this->year . '-' . $this->month . '-' . $this->day;
    }

    public function validate(): bool
    {

         $this->peselIsValid = ($this->checkIfElevenNumbers()
             && $this->compireWithBirthday() && $this->officialValidation());

         if ($this->peselIsValid) {
             return true;
         } else return false;
    }

    protected function checkIfElevenNumbers(): bool
    {
        if (!preg_match('/^[0-9]{11}$/', $this->pesel)) {
            return false;
        }

        return true;
    }


    protected function compireWithBirthday(): bool
    {
        if($this->birthdate === $this->birthday){
            return true;
        } else return false;
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



}
