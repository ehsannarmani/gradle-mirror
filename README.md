## Gradle Mirror By PHP

<hr/>

#### This mirror developed to download gradle dependencies without network interference and sanctions

## Usage:

Easily just put the mirror url as maven in `settings.gradle` file and re-sync project:

```kotlin
pluginManagement {
    repositories {
        maven("https://mirror-url")
    }
}
dependencyResolutionManagement {
    ...
    repositories {
        maven("https://mirror-url")
    }
}
```

### Repository Filtering
By default, `google`,`central` and `jitpack` mavens will mirrored, to mirror just specific repositories, put the key of repositories in the mirror url like this:
```kotlin
maven("https://mirror-url/jitpack")
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
To self-host mirror in your own server, just start php server and the server ip or connected domain to ip will be your mirror url.
> [!NOTE]
> Mirror url will be address of source root in your server, for example if you clone source in the mirror folder, the url will be: `https://your-domain.com/mirror`

