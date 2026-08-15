<?php

namespace Classiebit\Eventmie\Support;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SecureUpload
{
    /**
     * Extensions that must never be stored, even if MIME sniffing looks safe.
     */
    public const BLOCKED_EXTENSIONS = [
        'php', 'php3', 'php4', 'php5', 'php7', 'php8', 'phtml', 'pht', 'phar', 'phps',
        'cgi', 'pl', 'py', 'rb', 'asp', 'aspx', 'jsp', 'shtml', 'sh', 'bash',
        'htaccess', 'htpasswd', 'ini', 'svg', 'js', 'htm', 'html', 'exe', 'bat', 'cmd',
    ];

    /**
     * Safe MIME types mapped to the extension we will actually store.
     * Client-supplied extensions are never trusted (CVE-2024-55417).
     */
    public const MIME_EXTENSIONS = [
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
        'image/gif'  => 'gif',
        'image/bmp'  => 'bmp',
        'image/webp' => 'webp',
        'video/mp4'  => 'mp4',
        'video/webm' => 'webm',
        'application/pdf' => 'pdf',
    ];

    public static function blockedExtensions(): array
    {
        return self::BLOCKED_EXTENSIONS;
    }

    public static function allowedMimes(): array
    {
        $configured = config('voyager.media.allowed_mimetypes', []);

        if (!is_array($configured) || empty($configured) || $configured === ['*'] || $configured === '*') {
            return array_keys(self::MIME_EXTENSIONS);
        }

        $allowed = [];
        foreach ($configured as $mime) {
            if (isset(self::MIME_EXTENSIONS[$mime])) {
                $allowed[] = $mime;
            }
        }

        return !empty($allowed) ? $allowed : array_keys(self::MIME_EXTENSIONS);
    }

    public static function extensionForMime(string $mime): ?string
    {
        return self::MIME_EXTENSIONS[$mime] ?? null;
    }

    /**
     * Keep a storage-relative path inside the disk. Rejects traversal (CVE-2024-55415).
     */
    public static function sanitizePath($path): string
    {
        if (is_array($path)) {
            $path = implode('/', $path);
        }

        $path = str_replace('\\', '/', (string) $path);
        $path = str_replace("\0", '', $path);
        $path = urldecode($path);

        $parts = [];
        foreach (explode('/', $path) as $part) {
            $part = trim($part);
            if ($part === '' || $part === '.' || $part === ':') {
                continue;
            }
            if ($part === '..') {
                throw new Exception('Invalid path');
            }
            if (preg_match('/^[a-zA-Z]:$/', $part)) {
                throw new Exception('Invalid path');
            }
            $parts[] = $part;
        }

        return implode('/', $parts);
    }

    public static function sanitizeFilename($name): string
    {
        $name = str_replace(["\0", '\\', '/'], '', (string) $name);
        $name = basename(str_replace('..', '', $name));
        $name = preg_replace('/[^a-zA-Z0-9._-]/', '_', $name);

        return $name ?: 'file';
    }

    public static function isDangerousFilename($name): bool
    {
        $name = strtolower((string) $name);
        $name = str_replace('\\', '/', $name);
        $base = basename($name);

        if ($base === '.htaccess' || $base === '.htpasswd' || $base === '.user.ini') {
            return true;
        }

        $extension = strtolower(pathinfo($base, PATHINFO_EXTENSION));

        if (in_array($extension, self::BLOCKED_EXTENSIONS, true)) {
            return true;
        }

        // file.php.jpg still has a php segment
        foreach (self::BLOCKED_EXTENSIONS as $blocked) {
            if (Str::contains($base, '.'.$blocked.'.')) {
                return true;
            }
        }

        return false;
    }

    public static function assertSafeUploadedFile(UploadedFile $file): string
    {
        if (!$file->isValid()) {
            throw new Exception('Invalid upload');
        }

        $original = $file->getClientOriginalName();
        if (self::isDangerousFilename($original)) {
            throw new Exception('File type is not allowed');
        }

        $clientExt = strtolower($file->getClientOriginalExtension());
        if (in_array($clientExt, self::BLOCKED_EXTENSIONS, true)) {
            throw new Exception('File type is not allowed');
        }

        $mime = $file->getMimeType();
        $allowed = self::allowedMimes();

        if (!in_array($mime, $allowed, true)) {
            throw new Exception(__('voyager::generic.mimetype_not_allowed'));
        }

        $safeExt = self::extensionForMime($mime);
        if (!$safeExt) {
            throw new Exception('File type is not allowed');
        }

        return $safeExt;
    }

    public static function randomFilename(string $extension): string
    {
        return time().Str::random(12).'.'.$extension;
    }

    public static function isSafeDataImage(string $value): bool
    {
        return (bool) preg_match('#^data:image/(jpeg|jpg|png|gif|webp);base64,#i', $value);
    }

    public static function decodeDataImage(string $value): ?string
    {
        if (!self::isSafeDataImage($value)) {
            return null;
        }

        $encoded = preg_replace('#^data:image/\w+;base64,#i', '', $value);
        $encoded = str_replace(' ', '+', $encoded);
        $decoded = base64_decode($encoded, true);

        return $decoded === false ? null : $decoded;
    }

    /**
     * Replace a user upload with a randomly named file whose extension
     * comes from the sniffed MIME type. Images are re-encoded so polyglot
     * PHP/HTML payloads cannot survive.
     */
    public static function normalizeUploadedFile(UploadedFile $file): UploadedFile
    {
        $ext = self::assertSafeUploadedFile($file);
        $filename = self::randomFilename($ext);
        $mime = $file->getMimeType();

        if (strpos((string) $mime, 'image/') === 0) {
            $tmp = tempnam(sys_get_temp_dir(), 'emup');
            $tmpPath = $tmp.'.'.$ext;
            @rename($tmp, $tmpPath);

            $encoded = Image::make($file->getRealPath())
                ->orientate()
                ->encode($ext === 'jpg' ? 'jpg' : $ext, 90);
            $encoded->save($tmpPath);

            return new UploadedFile($tmpPath, $filename, $mime, UPLOAD_ERR_OK, true);
        }

        return new UploadedFile($file->getRealPath(), $filename, $mime, $file->getError(), true);
    }

    public static function normalizeFileTree($file)
    {
        if (is_array($file)) {
            $out = [];
            foreach ($file as $key => $item) {
                $out[$key] = self::normalizeFileTree($item);
            }
            return $out;
        }

        if ($file instanceof UploadedFile) {
            return self::normalizeUploadedFile($file);
        }

        return $file;
    }

    /**
     * Confirm a resolved path stays inside a disk root (blocks ../../../public/index.php).
     */
    public static function assertInsideDirectory($root, $target)
    {
        $root = self::normalizeAbsolutePath((string) $root);
        $target = self::normalizeAbsolutePath((string) $target);

        if ($root === '' || $target === '') {
            throw new Exception('Invalid path');
        }

        $root = rtrim($root, DIRECTORY_SEPARATOR);
        if ($target !== $root && strpos($target, $root.DIRECTORY_SEPARATOR) !== 0) {
            throw new Exception('Invalid path');
        }
    }

    public static function normalizeAbsolutePath($path)
    {
        $path = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, (string) $path);
        $isAbsolute = strlen($path) > 0 && ($path[0] === DIRECTORY_SEPARATOR || preg_match('/^[A-Za-z]:\\\\/', $path));

        $parts = [];
        foreach (explode(DIRECTORY_SEPARATOR, $path) as $i => $part) {
            if ($part === '' || $part === '.') {
                if ($i === 0 && $isAbsolute) {
                    $parts[] = '';
                }
                continue;
            }
            if ($part === '..') {
                array_pop($parts);
                continue;
            }
            $parts[] = $part;
        }

        $normalized = implode(DIRECTORY_SEPARATOR, $parts);
        if ($isAbsolute && strpos($normalized, DIRECTORY_SEPARATOR) !== 0 && !preg_match('/^[A-Za-z]:/', $normalized)) {
            $normalized = DIRECTORY_SEPARATOR.$normalized;
        }

        return $normalized;
    }

    public static function uploadHtaccess(): string
    {
        return <<<'HTACCESS'
# Eventmie: do not execute scripts in uploaded files
<IfModule mod_authz_core.c>
    <FilesMatch "\.(?i:php[0-9]?|phtml|pht|phar|cgi|pl|py|jsp|asp|aspx|sh|shtml)$">
        Require all denied
    </FilesMatch>
</IfModule>
<IfModule !mod_authz_core.c>
    <FilesMatch "\.(?i:php[0-9]?|phtml|pht|phar|cgi|pl|py|jsp|asp|aspx|sh|shtml)$">
        Order allow,deny
        Deny from all
    </FilesMatch>
</IfModule>
<IfModule mod_php.c>
    php_flag engine off
</IfModule>
<IfModule mod_php7.c>
    php_flag engine off
</IfModule>
<IfModule mod_php8.c>
    php_flag engine off
</IfModule>
HTACCESS;
    }

    public static function publicPhpDenyRules(): string
    {
        return <<<'HTACCESS'
# Eventmie: deny extra PHP (only index.php may run)
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !index\.php$
    RewriteRule \.(?i:php[0-9]?|phtml|pht|phar)$ - [F,L]
</IfModule>
<IfModule mod_authz_core.c>
    <FilesMatch "\.(?i:php[0-9]?|phtml|pht|phar)$">
        Require all denied
    </FilesMatch>
    <Files "index.php">
        Require all granted
    </Files>
</IfModule>

HTACCESS;
    }

    /**
     * Apache + PHP-FPM hardening for upload dirs and public/index.php.
     */
    public static function protectUploadDirectories()
    {
        $storagePublic = storage_path('app/public');
        if (is_dir($storagePublic)) {
            @file_put_contents($storagePublic.DIRECTORY_SEPARATOR.'.htaccess', self::uploadHtaccess());
            @file_put_contents($storagePublic.DIRECTORY_SEPARATOR.'.user.ini', "engine = Off\n");
        }

        $publicHtaccess = public_path('.htaccess');
        $existing = is_file($publicHtaccess) ? (string) file_get_contents($publicHtaccess) : '';
        if (strpos($existing, 'Eventmie: deny extra PHP') === false) {
            @file_put_contents($publicHtaccess, self::publicPhpDenyRules().$existing);
        }
    }

    /**
     * Copy static assets into public/ without ever replacing the front controller.
     */
    public static function copyPublicAssets($from, $to)
    {
        if (!is_dir($from)) {
            return;
        }

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($from, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
        );

        $to = rtrim($to, '/\\');
        $protected = ['index.php', '.htaccess', 'web.config', 'robots.txt'];

        foreach ($iterator as $item) {
            $relative = ltrim(str_replace($from, '', $item->getPathname()), '/\\');
            $target = $to.DIRECTORY_SEPARATOR.$relative;
            $base = strtolower($item->getFilename());

            if (in_array($base, $protected, true) || self::isDangerousFilename($item->getFilename())) {
                continue;
            }

            if ($item->isDir()) {
                if (!is_dir($target)) {
                    @mkdir($target, 0755, true);
                }
                continue;
            }

            $dir = dirname($target);
            if (!is_dir($dir)) {
                @mkdir($dir, 0755, true);
            }
            @copy($item->getPathname(), $target);
        }
    }
}
