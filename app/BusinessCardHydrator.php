<?php

class BusinessCardHydrator
{
    protected ?ReflectionClass $reflector = null;

    const STRING_TO_DATE_METHOD_NAME = "stringToDateTime";
    const STRATEGIES = [
        CREATED_AT_FIELD => self::STRING_TO_DATE_METHOD_NAME,
    ];

    public function __construct()
    {
        foreach (self::STRATEGIES as $strategyName => $strategyMethodName) {
            if ($strategyName === CREATED_AT_FIELD) {
                $this->{$strategyMethodName} = function (string $value) use ($strategyMethodName): DateTime {
                    return new DateTime($value);
                };
            }
        }
        $this->reflector = new ReflectionClass(new BusinessCard());
    }

    public function hydrate(array $data, BusinessCard $model): BusinessCard
    {
        foreach ($data as $fieldName => $fieldValue) {
            if ($this->hasStrategy($fieldName)) {
                $fieldValue = $this->${self::STRATEGIES[$fieldName]}($fieldValue);
            }

            $methodName = 'set' . ucfirst($fieldName);
            if ($this->reflector->hasMethod($methodName)) {
                $model->{$methodName}($fieldValue);
            }
        }

        return $model;
    }

    public function hasStrategy(string $name): bool
    {
        return array_key_exists($name, self::STRATEGIES) && method_exists(self::class, self::STRATEGIES[$name]);
    }
}