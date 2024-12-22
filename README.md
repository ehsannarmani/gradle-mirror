## Gradle Mirror By PHP

#### This mirror developed to download gradle dependencies without network interference and sanctions

### Usage:

Easily just put the mirror url as maven in `settings.gradle` file and re-sync project:

```kotlin
pluginManagement {
    repositories {
        maven("https://en-mirror.ir")
    }
}
dependencyResolutionManagement {
    ...
    repositories {
        maven("https://en-mirror.ir")
    }
}
```
> [!NOTE]
> Clone of mirror is lunched at `en-mirror.ir` and contains `google`,`central` and `jitpack` mavens.
### Repository Filtering
By default, all of repositories will get mirrored, to mirror just specific repository, put the key of repository in the mirror url like this:
```kotlin
maven("https://en-mirror.ir/jitpack")
```

### Code Document:
Config your mirror `config.php`:
```php
$config = [
  'cache_folder'=>'cache',
  'cache_dependencies'=>true,
  'repositories'=> [
      "google"=>"https://dl.google.com/dl/android/maven2",
      "central"=>"https://repo.maven.apache.org/maven2",
      "jitpack"=>"https://jitpack.io"
  ]
]
```
`cache_dependencies`: This mirror have a feature to cache dependencies in server, so if you want to enable/disable that you need to change `cache_dependencies` property in config array.<br/>
`cache_folder`: You can specify the cache folder name with this property.<br/>
`repositories`: You can put or remove repositories which you want to get mirrored here (keys are optional and will be used for repository filtering in mirror url)

### Code Usage:
To self-host mirror in your own server, just start php server and the source path in public_html will be your mirror url.
> [!NOTE]
> Mirror url will be address of source root in your server, for example if you clone source in the x folder, the url will be: `https://your-domain.com/x`

<br/>
<hr/>

#### این میرور جهت دانلود دیپندنسی ها و وابستگی های گریدل بدون تداخلات اینترنتی و تحریم ها توسعه داده شده است.

### نحوه استفاده:

به سادگی تنها آدرس میرور خودتان را در فایل `settings.gradle` به عنوان maven اضافه کنید:

```kotlin
pluginManagement {
    repositories {
        maven("https://en-mirror.ir")
    }
}
dependencyResolutionManagement {
    ...
    repositories {
        maven("https://en-mirror.ir")
    }
}
```

### فیلترکردن مخزن ها
این میرور بصورت پیشفرض تمامی مخزن های قرارداده شده در فایل کانفیگ را شامل خواهد شد، برای میرور کردن فقط یک مخزن خاص کافی است کلید آن را در انتهای آدرس میرور قرار دهید:
```kotlin
maven("https://en-mirror.ir/jitpack")
```

### توضیحات کد:
جهت کانفیگ میرور از طریق فایل `config.php` اقدام کنید:
```php
$config = [
  'cache_folder'=>'cache',
  'cache_dependencies'=>true,
  'repositories'=> [
      "google"=>"https://dl.google.com/dl/android/maven2",
      "central"=>"https://repo.maven.apache.org/maven2",
      "jitpack"=>"https://jitpack.io"
  ]
]
```
`cache_dependencies`: این میرور امکان کش کردن دیپندنسی هارا دارد، برای تعیین آن این مقدار را تغییر دهید.<br/>
`cache_folder`: با این مقدار میتوانید پوشه کش دیپدنسی هارا تعیین کنید<br/>
`repositories`: در این پراپرتی مخازنی که میخواهید میرور شوند را بگذارید یا اگر قصد میرور مخزنی رو ندارید از اینجا حذف کنید. (کلید ها دلخواه هستند و در فیلتر کردن میرور مخزن ها استفاده میشوند)

### استفاده از سورس کد:
برای اجرای این میرور در سرور شخصی خودتان یک php server استارت کنید و سورس کد را داخل مسیر public_html قرار دهید، آیپی سرور یا دامنه متصل شده به آن، آدرس میرور شما خواهد بود.
> [!NOTE]
> آدرس میرور، آدرس مسیر روت سورس کد در سرور شما خواهد بود، برای مثال اگر سورس کد را داخل پوشه x قرار دهید، آدرس میرور `https://your-domain.com/x` خواهد بود.

