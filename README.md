kohana-download
===============

Module for the Kohana, which allows you to download files from the server using the PHP, Apache or Nginx.

Example:
-----------

```php
Download::factory()
	->setDirectory(DOCROOT."downloads")
	->setFileName("file.txt")
	->setFileRealName("file.txt")
	->setContentType('text/plain')
	->execute();
```
