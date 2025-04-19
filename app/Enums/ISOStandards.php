<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasLabel as LabelInterface;
use UnitEnum;

enum ISOStandards: int implements HasLabel
{
    case     iso_9001   = 1;
    case     iso_3834   = 2;
    case     iso_3834_2 = 3;
    case     iso_3834_3 = 4;
    case     iso_3834_4 = 5;
    case     iso_14001  = 6;
    case     iso_45001  = 7;
    case     iso_22000  = 8;
    case     iso_50001  = 9;


    public function getLabel(): ?string
    {
        return match ($this) {
            self::iso_9001   => 'ISO 9001',
            self::iso_3834   => 'ISO 3834',
            self::iso_3834_2 => 'ISO 3834-2',
            self::iso_3834_3 => 'ISO 3834-3',
            self::iso_3834_4 => 'ISO 3834-4',
            self::iso_14001  => 'ISO 14001',
            self::iso_45001  => 'ISO 45001',
            self::iso_22000  => 'ISO 22000',
            self::iso_50001  => 'ISO 50001',
        };
    }

    public static function getOptionsOrder(): array
    {
        return [
            self::iso_9001->value   => self::iso_9001->getLabel(),
            self::iso_3834->value   => self::iso_3834->getLabel(),
            self::iso_14001->value  => self::iso_14001->getLabel(),
            self::iso_3834_2->value => self::iso_3834_2->getLabel(),
            self::iso_45001->value  => self::iso_45001->getLabel(),
            self::iso_3834_3->value => self::iso_3834_3->getLabel(),
            self::iso_22000->value  => self::iso_22000->getLabel(),
            self::iso_3834_4->value => self::iso_3834_4->getLabel(),
            self::iso_50001->value  => self::iso_50001->getLabel(),
        ];
    }
}
