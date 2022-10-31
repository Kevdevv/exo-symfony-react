<?php

namespace App\Service;

class DateCalculate
{
    public function getAge($birthDate): int
    {
        $userBirthDate = date_format($birthDate, "Y-m-d");
        $today = date("Y-m-d");
        $diff = date_diff($birthDate, date_create($today));
        return $diff->format("%y");
        
    }

    public function setAge($Users = [])
    {
        foreach ($Users as $user) {
            $birthDate = $user->getBirthDate();
            if ($birthDate != null) {
                $age = $this->getAge($birthDate);
                $user->setAge($age);
            }
        }
    }

    
}

