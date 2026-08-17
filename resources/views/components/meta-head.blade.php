<title>{{ $meta->title }}</title>

@if ($meta->description)
    <meta name="description" content="{{ $meta->description }}">
@endif

@if ($meta->robots)
    <meta name="robots" content="{{ $meta->robots }}">
@endif

@if ($meta->canonicalUrl)
    <link rel="canonical" href="{{ $meta->canonicalUrl }}">
@endif

<meta property="og:title" content="{{ $meta->title }}">
<meta property="og:description" content="{{ $meta->description }}">
<meta property="og:type" content="{{ $meta->ogType }}">
<meta property="og:url" content="{{ $meta->url }}">
<meta property="og:site_name" content="{{ $meta->siteName }}">

@if ($meta->image)
    <meta property="og:image" content="{{ $meta->image }}">
@endif

<meta name="twitter:card" content="{{ $meta->twitterCard }}">
<meta name="twitter:title" content="{{ $meta->title }}">
<meta name="twitter:description" content="{{ $meta->description }}">

@if ($meta->image)
    <meta name="twitter:image" content="{{ $meta->image }}">
@endif