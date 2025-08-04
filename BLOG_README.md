# Блог для Пет-Проєктів

Цей блог дозволяє вам публікувати та керувати постами про ваші пет-проєкти з використанням Laravel, Vue.js, Inertia.js та Tailwind CSS.

## Функціональність

### Для користувачів:
- ✅ Перегляд всіх опублікованих постів
- ✅ Детальний перегляд окремого посту
- ✅ Адаптивний дизайн для всіх пристроїв
- ✅ Пагінація для великої кількості постів

### Для адміністраторів (авторизованих користувачів):
- ✅ Створення нових постів
- ✅ Завантаження зображень
- ✅ Редагування існуючих постів
- ✅ Видалення постів
- ✅ Попередній перегляд зображень

## Структура проєкту

### Backend (Laravel):
- **Модель**: `app/Models/BlogPost.php`
- **Контролер**: `app/Http/Controllers/BlogController.php`
- **Міграція**: `database/migrations/2025_08_03_094403_create_blog_posts_table.php`
- **Маршрути**: `routes/web.php`

### Frontend (Vue.js + Inertia):
- **Головна сторінка**: `resources/js/Pages/Blog/Index.vue`
- **Детальний перегляд**: `resources/js/Pages/Blog/Show.vue`
- **Створення посту**: `resources/js/Pages/Blog/Create.vue`
- **Редагування посту**: `resources/js/Pages/Blog/Edit.vue`

## Встановлення та налаштування

### 1. Запуск міграцій
```bash
php artisan migrate
```

### 2. Створення символічного посилання для зберігання
```bash
php artisan storage:link
```

### 3. Збірка фронтенду
```bash
npm run build
```

## Використання

### Публічні сторінки:
- `/blog` - головна сторінка блогу
- `/blog/{slug}` - детальний перегляд посту

### Адміністративні сторінки (потребують авторизації):
- `/admin/blog/create` - створення нового посту
- `/admin/blog/{id}/edit` - редагування посту

## Особливості

### Зображення:
- Підтримуються формати: JPEG, PNG, JPG, GIF
- Максимальний розмір: 2MB
- Зберігаються в `storage/app/public/blog-images/`
- Автоматичне видалення старих зображень при оновленні

### Валідація:
- Заголовок: обов'язковий, максимум 255 символів
- Зміст: обов'язковий
- Зображення: необов'язкове, максимум 2MB

### Безпека:
- Всі адміністративні дії потребують авторизації
- Автоматичне створення slug з заголовка
- Захист від XSS через Inertia.js

## Технології

- **Backend**: Laravel 11
- **Frontend**: Vue.js 3 + Inertia.js
- **Стилі**: Tailwind CSS
- **База даних**: MySQL
- **Зберігання файлів**: Laravel Storage

## Структура бази даних

```sql
CREATE TABLE blog_posts (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image_path VARCHAR(255) NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    published_at TIMESTAMP NULL,
    user_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    deleted_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

## Наступні покращення

- [ ] Додати категорії для постів
- [ ] Додати теги
- [ ] Додати коментарі
- [ ] Додати пошук по постах
- [ ] Додати RSS feed
- [ ] Додати SEO оптимізацію
- [ ] Додати редактор Markdown
- [ ] Додати можливість чернеток
- [ ] Додати статистику переглядів 