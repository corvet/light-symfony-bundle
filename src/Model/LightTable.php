<?php

declare(strict_types=1);

namespace Corvet\LightSymfonyBundle\Model;

final class LightTable
{
    /**
     * @param array<string, string> $headers Ключ — назва властивості сутності, значення — заголовок стовпця (напр. ['number' => '№', 'createdAt' => 'Дата'])
     * @param array<int, array<string, array{value: mixed, meta: array}>> $rows Масив рядків, де кожен рядок — це масив комірок із їхнім значенням та метаданими
     * @param array $options Додаткові опції для всієї таблиці (наприклад, CSS-класи, ліміти, пагінація)
     */
    public function __construct(
        private array $headers,
        private array $rows,
        private array $options = []
    ) {}

    /**
     * Повертає заголовки таблиці для рендерингу <thead>
     * @return array<string, string>
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Повертає масив рядків для рендерингу <tbody>
     * @return array
     */
    public function getRows(): array
    {
        return $this->rows;
    }

    /**
     * Повертає глобальні налаштування таблиці
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * Перевіряє, чи є в таблиці взагалі дані (корисно для виведення повідомлення "Нічого не знайдено")
     */
    public function isEmpty(): bool
    {
        return empty($this->rows);
    }
}
