<!-- Primary Meta Tags -->
<title>{{ $seo->page->name }}</title>
<meta name="title" content="{{ $seo->meta_title }}">
<meta name="description" content="{{ $seo->meta_description }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="{{ $seo->website }}">
<meta property="og:url" content="{{ $seo->og_url }}">
<meta property="og:title" content="{{ $seo->og_title }}">
<meta property="og:description" content="{{ $seo->og_description }}">
<meta property="og:image" content="{{ asset('storage/seo/'.$seo->og_image)  }}">

<!-- Twitter -->
<meta property="twitter:card" content="{{ $seo->twitter_card }}">
<meta property="twitter:url" content="https://metatags.io/">
<meta property="twitter:title" content="{{ $seo->twitter_title }}">
<meta property="twitter:description" content="{{ $seo->twitter_description }}">
<meta property="twitter:image" content="{{ asset('storage/seo/'.$seo->twitter_image)  }}">
