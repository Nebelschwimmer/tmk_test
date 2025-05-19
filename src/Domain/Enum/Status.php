<?php

namespace App\Domain\Enum;

use Symfony\Contracts\Translation\TranslatableInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
enum Status: int implements TranslatableInterface
{
    case DRAFT = 0;
    case ACTIVE = 1;
    case ARCHIVED = 2;

    public function trans(TranslatorInterface $translator, ?string $locale = null): string
    {
        return match ($this) {
            self::DRAFT => $translator->trans('draft', locale: $locale, domain: 'status'),
            self::ACTIVE => $translator->trans('active', locale: $locale, domain: 'status'),
            self::ARCHIVED => $translator->trans('archived', locale: $locale, domain: 'status'),
        };
    }

    public static function list(TranslatorInterface $translator, ?string $locale = null): array
    {
        return array_map(function (Status $case) use ($translator, $locale) {
            return [
                'name' => $translator ? $case->trans($translator, $locale) : $case->name,
                'value' => $case->value,
            ];
        }, self::cases());
    }

    public static function getRandom(): Status
    {
        $cases = self::cases();
        return $cases[array_rand($cases)];
    }

}