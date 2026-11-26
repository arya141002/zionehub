@php
    $icons = [
        'github' => 'uil-github-alt', 'linkedin' => 'uil-linkedin-alt',
        'instagram' => 'uil-instagram', 'twitter' => 'uil-twitter-alt',
        'youtube' => 'uil-youtube', 'whatsapp' => 'uil-whatsapp',
        'email' => 'uil-envelope', 'website' => 'uil-globe',
    ];
@endphp
<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $post->title }} — {{ $site->site_name }}</title>
    <meta name="description" content="{{ $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 160) }}" />
    @if ($site->favicon)
      <link rel="icon" href="{{ \Illuminate\Support\Facades\Storage::url($site->favicon) }}" />
    @endif
    <link rel="stylesheet" href="{{ asset('assets/newcss.css') }}" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" />
    <style>
      .article-detail { max-width: 768px; margin: 0 auto; padding-top: 2rem; }
      .article-detail__back { margin-bottom: 1.5rem; display: inline-flex; align-items: center; gap: 0.35rem; color: var(--first-color); font-weight: var(--font-medium); }
      .article-detail__meta { display: flex; flex-wrap: wrap; align-items: center; gap: 1rem; font-size: var(--small-font-size); color: var(--text-color-light); margin-bottom: 1rem; }
      .article-detail__title { font-size: var(--h1-font-size); line-height: 1.3; margin-bottom: 1.5rem; }
      .article-detail__thumb { width: 100%; max-height: 400px; object-fit: cover; border-radius: 0.75rem; margin-bottom: 2rem; }
      .article-detail__content { line-height: 1.85; color: var(--text-color); }
      .article-detail__content p { margin-bottom: 1.25rem; }
      .article-detail__content ul, .article-detail__content ol { margin: 0 0 1.25rem 1.5rem; list-style: disc; }
      .article-detail__content li { margin-bottom: 0.5rem; }
      .article-detail__tags { display: flex; flex-wrap: wrap; gap: 0.5rem; margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid var(--input-color); }
      .article-detail__tag { font-size: var(--smaller-font-size); background: var(--input-color); color: var(--title-color); padding: 0.25rem 0.75rem; border-radius: 999px; }
    </style>
  </head>
  <body>
    <header class="header" id="header">
      <nav class="nav container">
        <a href="{{ route('landing') }}" class="nav__logo">{{ $site->site_name }}</a>
        <div class="nav__btns">
          <i class="uil uil-moon change-theme" id="theme-button"></i>
        </div>
      </nav>
    </header>

    <main class="main">
      <section class="section">
        <div class="container article-detail">
          <a href="{{ route('landing') }}#blog" class="article-detail__back">
            <i class="uil uil-arrow-left"></i> Kembali ke Beranda
          </a>

          <div class="article-detail__meta">
            @if ($post->category)
              <span class="blog__category">{{ $post->category->name }}</span>
            @endif
            <span><i class="uil uil-calendar-alt"></i> {{ $post->published_at->format('d M Y') }}</span>
            @if ($post->reading_time)
              <span><i class="uil uil-clock"></i> {{ $post->reading_time }} menit baca</span>
            @endif
          </div>

          <h1 class="article-detail__title">{{ $post->title }}</h1>

          @if ($post->thumbnail)
            <img src="{{ \Illuminate\Support\Facades\Storage::url($post->thumbnail) }}" alt="{{ $post->title }}" class="article-detail__thumb" />
          @endif

          <div class="article-detail__content">
            {!! $post->content !!}
          </div>

          @if (!empty($post->tags))
            <div class="article-detail__tags">
              @foreach ($post->tags as $tag)
                <span class="article-detail__tag">#{{ $tag }}</span>
              @endforeach
            </div>
          @endif
        </div>
      </section>
    </main>

    <footer class="footer">
      <div class="footer__bg">
        <div class="footer__container container grid">
          <div>
            <h1 class="footer__title">{{ $site->site_name }}</h1>
            <span class="footer__subtitle">{{ $profile?->headline }}</span>
          </div>
          <ul class="footer__links">
            <li><a href="{{ route('landing') }}#about" class="footer__link">About</a></li>
            <li><a href="{{ route('landing') }}#portfolio" class="footer__link">Projects</a></li>
            <li><a href="{{ route('landing') }}#blog" class="footer__link">Blog</a></li>
          </ul>
          <div class="footer__socials">
            @foreach ($socialLinks as $link)
              <a href="{{ $link->url }}" target="_blank" rel="noopener" class="footer__social">
                <i class="uil {{ $icons[$link->platform] ?? 'uil-link' }}"></i>
              </a>
            @endforeach
          </div>
        </div>
        <p class="footer__copy">
          {{ $site->footer_text ?: '© '.date('Y').' '.$site->site_name.'. All rights reserved.' }}
        </p>
      </div>
    </footer>

    <script src="{{ asset('assets/ptj.js') }}"></script>
  </body>
</html>
