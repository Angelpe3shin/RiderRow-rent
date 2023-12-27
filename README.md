# RiderRent

## Шаги по работе с ларавел и базой:

1) **Создаем модель:**
```php artisan make:model <Название модели>```

2) **Добавить поля в модель:**

```php
class Address extends Model {
    use HasFactory;

    protected $table = 'Address';

    protected $fillable = [
        'countryId',
        'street',
        'houseNumber',
        'zipCode',
        'city',
    ];

    protected $casts = [
        'countryId' => 'integer',
    ];

    // Определение отношения к таблице Country
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'countryId');
    }

    // Добавление временных меток
    public $timestamps = true;
}
```

3) Создать Seeder для наполнения таблицы:
```php artisan make:seeder AddressSeeder```

5) Заполнить Seeder тестовыми данными, пример для Адреса:
```php
class AddressSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $byCountryId = Country::where('name', 'Belarus')->value('id');

        Address::create([
            'countryId' => $byCountryId,
            'street' => 'Сурганова',
            'houseNumber' => 52,
            'zipCode' => 220000,
            'city' => 'Минск'
        ]);
        
    }
}
```

7) Создать миграцию на создание таблицы:
```php artisan make:migration create_address_table```

8) Заполнить миграцию необходимыми полями. Смотри внимательно на то, что в функции run, там можно добавить больше стран, пример только для Беларуси. Важно, что таблица стран уже должна существовать и быть заполнена, если попытаемся вызвать AddressSeeder ***:
```php
class AddressSeeder extends Seeder {

    public function run(): void {
        $byCountryId = Country::where('name', 'Belarus')->value('id');

        Address::create([
            'countryId' => $byCountryId,
            'street' => 'Сурганова',
            'houseNumber' => 52,
            'zipCode' => 220000,
            'city' => 'Минск'
        ]);
        
    }
}
```

7) Чтобы заполнить базу, вызываем Seeder ***:
``` php artisan db:seed --class=AddressSeeder```
