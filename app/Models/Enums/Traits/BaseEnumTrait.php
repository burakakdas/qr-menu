<?php

namespace App\Models\Enums\Traits;

trait BaseEnumTrait
{
    public static function getValues(): array
    {
        foreach (self::cases() as $case) {
            $values[] = $case->value;
        }

        return $values;
    }

    public static function getValuesExceptByArrayValue(array $exceptedValues): array
    {
        $values = [];
        foreach (self::cases() as $case) {
            if (! in_array($case, $exceptedValues)) {
                $values[] = $case->value;
            }
        }

        return $values;
    }

    public static function getCaseValueAndLabels(): array
    {
        foreach (self::cases() as $case) {
            $values[$case->value] = $case->getLabel();
        }

        return $values;
    }

    public static function getCaseValueAndLabelsExceptByArrayValue(array $exceptedValues): array
    {
        $values = [];
        foreach (self::cases() as $case) {
            if (! in_array($case->value, $exceptedValues)) {
                $values[$case->value] = $case->getLabel();
            }
        }

        return $values;
    }
}
