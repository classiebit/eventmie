<?php

if (! function_exists('sanitize_html')) {
    /**
     * Allow a small HTML subset for rich-text fields and strip script vectors.
     */
    function sanitize_html($html = '')
    {
        if ($html === null || $html === '') {
            return '';
        }

        $html = (string) $html;

        if (! class_exists('DOMDocument')) {
            return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        }

        $allowed = [
            'p' => [],
            'br' => [],
            'strong' => [],
            'b' => [],
            'em' => [],
            'i' => [],
            'u' => [],
            'ul' => [],
            'ol' => [],
            'li' => [],
            'h1' => [],
            'h2' => [],
            'h3' => [],
            'h4' => [],
            'h5' => [],
            'h6' => [],
            'blockquote' => [],
            'span' => [],
            'div' => [],
            'table' => [],
            'thead' => [],
            'tbody' => [],
            'tr' => [],
            'th' => [],
            'td' => [],
            'hr' => [],
            'figure' => [],
            'figcaption' => [],
            'sub' => [],
            'sup' => [],
            'pre' => [],
            'code' => [],
            'a' => ['href', 'title', 'target', 'rel'],
            'img' => ['src', 'alt', 'width', 'height'],
        ];

        $wrapper = '<div id="em-sanitize-root">'.$html.'</div>';
        $dom = new DOMDocument;
        $dom->encoding = 'UTF-8';
        libxml_use_internal_errors(true);
        $loaded = $dom->loadHTML('<?xml encoding="UTF-8">'.$wrapper, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        if (! $loaded) {
            return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        }

        $root = $dom->getElementById('em-sanitize-root');
        if (! $root) {
            return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        }

        sanitize_html_node($root, $allowed);

        $out = '';
        foreach ($root->childNodes as $child) {
            $out .= $dom->saveHTML($child);
        }

        return $out;
    }
}

if (! function_exists('sanitize_html_node')) {
    function sanitize_html_node(DOMNode $node, array $allowed)
    {
        $remove = [];

        foreach ($node->childNodes as $child) {
            if ($child instanceof DOMElement) {
                $tag = strtolower($child->tagName);
                if (! isset($allowed[$tag])) {
                    sanitize_html_node($child, $allowed);
                    $remove[] = $child;

                    continue;
                }

                $keep = $allowed[$tag];
                $attrs = [];
                if ($child->hasAttributes()) {
                    foreach ($child->attributes as $attr) {
                        $attrs[] = $attr->nodeName;
                    }
                }

                foreach ($attrs as $name) {
                    $lname = strtolower($name);
                    if (! in_array($lname, $keep, true) || strpos($lname, 'on') === 0) {
                        $child->removeAttribute($name);

                        continue;
                    }

                    $value = trim($child->getAttribute($name));
                    if ($lname === 'href' && ! sanitize_html_url($value, ['http', 'https', 'mailto', 'tel'])) {
                        $child->removeAttribute($name);
                    } elseif ($lname === 'src') {
                        if (! sanitize_html_url($value, ['http', 'https']) || preg_match('/\.svg(\?|#|$)/i', $value)) {
                            $child->removeAttribute($name);
                        }
                    } elseif ($lname === 'target' && strtolower($value) !== '_blank') {
                        $child->removeAttribute($name);
                    }
                }

                if ($tag === 'a' && strtolower($child->getAttribute('target')) === '_blank') {
                    $child->setAttribute('rel', 'noopener noreferrer');
                }

                sanitize_html_node($child, $allowed);
            } elseif ($child instanceof DOMComment) {
                $remove[] = $child;
            }
        }

        foreach ($remove as $dead) {
            while ($dead->firstChild) {
                $dead->parentNode->insertBefore($dead->firstChild, $dead);
            }
            $dead->parentNode->removeChild($dead);
        }
    }
}

if (! function_exists('sanitize_html_url')) {
    function sanitize_html_url($url, array $schemes)
    {
        if ($url === '') {
            return false;
        }

        if ($url[0] === '#') {
            return strpos($url, ':') === false && stripos($url, 'javascript') === false;
        }

        if ($url[0] === '/') {
            if ($url === '/') {
                return true;
            }

            return $url[1] !== '/' && strpos($url, ':') === false && stripos($url, 'javascript') === false;
        }

        $parts = parse_url($url);
        if ($parts === false || empty($parts['scheme'])) {
            return false;
        }

        $scheme = strtolower($parts['scheme']);
        if (! in_array($scheme, $schemes, true)) {
            return false;
        }

        if ($scheme === 'https' || $scheme === 'http') {
            return ! empty($parts['host']);
        }

        return true;
    }
}
