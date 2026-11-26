@php
    $icons = [
        'github' => 'uil-github-alt', 'linkedin' => 'uil-linkedin-alt',
        'instagram' => 'uil-instagram', 'twitter' => 'uil-twitter-alt',
        'youtube' => 'uil-youtube', 'whatsapp' => 'uil-whatsapp',
        'email' => 'uil-envelope', 'website' => 'uil-globe',
    ];

    $categoryLabels = [
        'backend' => 'Backend', 'frontend' => 'Frontend', 'database' => 'Database',
        'tools' => 'Tools & DevOps', 'other' => 'Lainnya',
    ];

    $period = fn ($s, $e, $fmt = 'Y') => $s->format($fmt).' - '.($e?->format($fmt) ?? 'Sekarang');
    $lines  = fn ($text) => array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) $text))));

    $educationEntries = $educations->map(fn ($e) => [
        'title'    => $e->degree ?: 'Pendidikan',
        'subtitle' => $e->institution.($e->field_of_study ? ' · '.$e->field_of_study : ''),
        'period'   => $period($e->start_date, $e->end_date),
        'details'  => array_merge($e->gpa ? ['IPK: '.$e->gpa] : [], $lines($e->description)),
    ]);

    $experienceEntries = $experiences->map(fn ($x) => [
        'title'    => $x->position,
        'subtitle' => $x->company,
        'period'   => $period($x->start_date, $x->end_date, 'M Y'),
        'details'  => array_merge(
            [ucfirst($x->type)],
            $x->location ? [$x->location] : [],
            $x->tech_stack ? ['Tech: '.implode(', ', $x->tech_stack)] : [],
            $lines($x->description),
        ),
    ]);
@endphp
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $site->meta_title ?: $site->site_name }}</title>
    <meta name="description" content="{{ $site->meta_description }}" />
    @if ($site->favicon)
    <link rel="icon" href="{{ asset('storage/'.$site->favicon) }}" />
    @endif
    <link rel="stylesheet" href="{{ asset('assets/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/newcss.css') }}" />
    <link
      rel="stylesheet"
      href="https://unicons.iconscout.com/release/v4.0.8/css/line.css"
    />
  </head>

  <body oncontextmenu="return false">
    <header class="header" id="header">
      <nav class="nav container">
        <a href="#home" class="nav__logo">{{ $site->site_name ?: 'zione.dev' }}</a>
        <div class="nav__menu" id="nav-menu">
          <ul class="nav__list grid">
            <li class="nav__item">
              <a href="#home" class="nav__link active-link">
                <i class="uil uil-estate nav__icon"></i>Home
              </a>
            </li>
            <li class="nav__item">
              <a href="#about" class="nav__link">
                <i class="uil uil-user nav__icon"></i>About
              </a>
            </li>
            <li class="nav__item">
              <a href="#skills" class="nav__link">
                <i class="uil uil-file-alt nav__icon"></i>Skills
              </a>
            </li>
            <li class="nav__item">
              <a href="#qualification" class="nav__link">
                <i class="uil uil-briefcase-alt nav__icon"></i>Qualification
              </a>
            </li>
            <li class="nav__item">
              <a href="#portfolio" class="nav__link">
                <i class="uil uil-scenery nav__icon"></i>Projects
              </a>
            </li>
            <li class="nav__item">
              <a href="#contact" class="nav__link">
                <i class="uil uil-message nav__icon"></i>Contact-Me
              </a>
            </li>
            @if ($certificates->isNotEmpty())
            <li class="nav__item">
            <a href="#certificates" class="nav__link">
                <i class="uil uil-award nav__icon"></i>Certificates
            </a>
            </li>
            @endif

            <li class="nav__item">
            <a href="#blog" class="nav__link">
                <i class="uil uil-newspaper nav__icon"></i>Blog
            </a>
            </li>
          </ul>
          <i class="uil uil-times nav__close" id="nav-close"></i>
        </div>
        <div class="nav__btns">
          <!-- Theme change button -->
          <i class="uil uil-moon change-theme" id="theme-button"></i>

          <div class="nav__toggle" id="nav-toggle">
            <i class="uil uil-apps"></i>
          </div>
        </div>
      </nav>
    </header>
    <!-- main-->

    <main class="main">
      <!--========================= Home =====================-->

      <section class="home section" id="home">
        <div class="home__container container grid">
          <div class="home__content grid">
            <div class="home__social">
                @foreach ($socialLinks as $link)
                    <a href="{{ $link->url }}" target="_blank" rel="noopener"
                    class="home__social-icon" aria-label="{{ ucfirst($link->platform) }}">
                    <i class="uil {{ $icons[$link->platform] ?? 'uil-link' }} home__icon"></i>
                    </a>
                @endforeach
            </div>
            <div class="home__img">
              <svg
                class="home__blob"
                viewBox="0 0 200 187"
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
              >
                <mask id="mask0" mask-type="alpha">
                  <path
                    d="M190.312 36.4879C206.582 62.1187 201.309 102.826 182.328 134.186C163.346 165.547 
                      130.807 187.559 100.226 186.353C69.6454 185.297 41.0228 161.023 21.7403 129.362C2.45775 
                      97.8511 -7.48481 59.1033 6.67581 34.5279C20.9871 10.1032 59.7028 -0.149132 97.9666 
                      0.00163737C136.23 0.303176 174.193 10.857 190.312 36.4879Z"
                  />
                </mask>
                <g mask="url(#mask0)">
                  <path
                    d="M190.312 36.4879C206.582 62.1187 201.309 102.826 182.328 134.186C163.346 
                      165.547 130.807 187.559 100.226 186.353C69.6454 185.297 41.0228 161.023 21.7403 
                      129.362C2.45775 97.8511 -7.48481 59.1033 6.67581 34.5279C20.9871 10.1032 59.7028 
                     -0.149132 97.9666 0.00163737C136.23 0.303176 174.193 10.857 190.312 36.4879Z"
                  />
                  <image class="home__blob-img" x="-79" y="-46" xlink:href="{{ $profile?->photo ? asset('storage/'.$profile->photo) : asset('assets/img/Pro.jpg') }}" />
                </g>
              </svg>
            </div>
            <div class="home__data">
                <h1 class="home__title">Hi, I'm {{ $profile?->name }}</h1>
                <h3 class="home__subtitle">{{ $profile?->headline }}</h3>
                <p class="home__description">{{ $profile?->tagline }}</p>
                <a href="#contact" class="button button--flex">
                    Contact me<i class="uil uil-message button__icon"></i>
                </a>
            </div>
          </div>

          <div class="home__scroll">
            <a href="#about" class="home__scroll-button button--flex">
              <i class="uil uil-mouse-alt home__scroll-mouse"></i>
              <span class="home__scroll-name">Scroll down</span>
              <i class="uil uil-arrow-down home__scroll-arrow"></i>
            </a>
          </div>
        </div>
      </section>

      <!--======================= About========================-->

      <section class="about section" id="about">
        <h2 class="section__title">About Me</h2>
        <span class="section__subtitle">My introduction</span>

        <div class="about__container container grid">
            @if ($profile?->photo)
                <img src="{{ asset('storage/'.$profile->photo) }}" alt="{{ $profile->name }}" class="about__img" />
            @endif

            <div class="about__data">
                <div class="about__description">{!! $profile?->about !!}</div>

                @if ($profile?->cv_file)
                <div class="about__buttons">
                    <a download href="{{ asset('storage/'.$profile->cv_file) }}" class="button button--flex">
                    Download CV <i class="uil uil-download-alt button__icon"></i>
                    </a>
                </div>
                @endif
            </div>
        </div>
      </section>

      <!--===================== SKILLS =====================-->

      <section class="skills section" id="skills">
        <h2 class="section__title">Skills</h2>
        <span class="section__subtitle">My technical level</span>

        <div class="skills__container container grid">
            @php $i = 0; @endphp
            @foreach ($skills->split(2) as $column)
                <div>
                @foreach ($column as $category => $items)
                    <div class="skills__content {{ $i++ === 0 ? 'skills__open' : 'skills__close' }}">
                    <div class="skills__header">
                        <i class="uil uil-brackets-curly skills__icon"></i>
                        <div>
                        <h1 class="skills__title">{{ $categoryLabels[$category] ?? ucfirst($category) }}</h1>
                        </div>
                        <i class="uil uil-angle-down skills__arrow"></i>
                    </div>

                    <div class="skills__list grid">
                        @foreach ($items as $skill)
                        <div class="skills__data">
                            <div class="skills__titles">
                            <h3 class="skills__name">{{ $skill->name }}</h3>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    </div>
                @endforeach
                </div>
            @endforeach
        </div>
      </section>

      <!--==================== Qualifications ==================-->

      <section class="qualification__section service__section" id="qualification">
        <h2 class="section__title">Qualification</h2>
        <span class="section__subtitle">My personal journey</span>

        <div class="qualification__container container grid services__container">

            <div class="qualification__tabs">
                <div class="qualification__button button--flex qualification__active">
                <i class="uil uil-graduation-cap qualification__icon"></i> Education
                </div>
            </div>
            <div class="qualification__sections">
                <div class="qualification__content services__content" id="education">
                @include('partials.timeline', ['entries' => $educationEntries])
                </div>
            </div>

            @if ($experienceEntries->isNotEmpty())
                <div class="qualification__tabs">
                <div class="qualification__button button--flex qualification__active">
                    <i class="uil uil-briefcase-alt qualification__icon"></i> Experience
                </div>
                </div>
                <div class="qualification__sections">
                <div class="qualification__content services__content" id="work">
                    @include('partials.timeline', ['entries' => $experienceEntries])
                </div>
                </div>
            @endif

            </div>
      </section>

      <!--=================== Portfolio ===================-->
      <section class="portfolio section" id="portfolio">
        <h2 class="section__title">Projects</h2>
        <span class="section__subtitle">Most recent work</span>

        @if ($projects->isNotEmpty())
            <div class="portfolio__container container swiper-container">
                <div class="swiper-wrapper">
                @foreach ($projects as $project)
                    <div class="portfolio__content grid swiper-slide">
                    @if ($project->thumbnail)
                        <img src="{{ asset('storage/'.$project->thumbnail) }}" alt="{{ $project->title }}" class="portfolio__img" />
                    @endif

                    <div class="portfolio__data">
                        <h3 class="portfolio__title">{{ $project->title }}</h3>
                        <p class="portfolio__description">
                        {{ $project->summary ?: \Illuminate\Support\Str::limit(strip_tags($project->description), 300) }}
                        </p>
                        @if ($project->repo_url)
                        <a href="{{ $project->repo_url }}" target="_blank" rel="noopener" class="button button--flex button--small portfolio__button">
                            GitHub Repository <i class="uil uil-external-link-alt button__icon"></i>
                        </a>
                        @endif
                        @if ($project->demo_url)
                        <a href="{{ $project->demo_url }}" target="_blank" rel="noopener" class="button button--flex button--small portfolio__button">
                            See Live <i class="uil uil-external-link-alt button__icon"></i>
                        </a>
                        @endif
                    </div>
                    </div>
                @endforeach
                </div>

                <div class="swiper-button-next"><i class="uil uil-angle-right-b swiper-portfolio-icon"></i></div>
                <div class="swiper-button-prev"><i class="uil uil-angle-left-b swiper-portfolio-icon"></i></div>
                <div class="swiper-pagination"></div>
            </div>
            </section>
        @endif
      </section>

      <!--=================== Certificates ===================-->
        @if ($certificates->isNotEmpty())
        <section class="certificates section" id="certificates">
            <h2 class="section__title">Certificates</h2>
            <span class="section__subtitle">Certifications & achievements</span>

            <div class="certificates__container container grid">
                @foreach ($certificates as $cert)
                <div class="certificates__card">
                    @if ($cert->image)
                    <img
                        src="{{ asset('storage/'.$cert->image) }}"
                        alt="{{ $cert->title }}"
                        class="certificates__img"
                    />
                    @endif

                    <div class="certificates__data">
                    <span class="certificates__issuer">
                        <i class="uil uil-award"></i> {{ $cert->issuer }}
                    </span>
                    <h3 class="certificates__title">{{ $cert->title }}</h3>

                    @if ($cert->issued_at)
                        <span class="certificates__date">
                        <i class="uil uil-calendar-alt"></i>
                        {{ \Illuminate\Support\Carbon::parse($cert->issued_at)->format('M Y') }}
                        </span>
                    @endif

                    @if ($cert->credential_url)
                        <div class="certificates__footer">
                        <a
                            href="{{ $cert->credential_url }}"
                            target="_blank"
                            rel="noopener"
                            class="button button--flex button--small button--link"
                        >
                            Lihat Kredensial <i class="uil uil-external-link-alt button__icon"></i>
                        </a>
                        </div>
                    @endif
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        <!--=================== Blog / Articles ===================-->
        <section class="blog section" id="blog">
            <h2 class="section__title">Blog & Articles</h2>
            <span class="section__subtitle">Latest writings & technical notes</span>

            @if ($articles->isNotEmpty())
                <div class="blog__container container grid">
                @foreach ($articles as $article)
                    <article class="blog__card">
                    @if ($article->thumbnail)
                        <img
                        src="{{ asset('storage/'.$article->thumbnail) }}"
                        alt="{{ $article->title }}"
                        class="blog__img"
                        />
                    @endif

                    <div class="blog__data">
                        <div class="blog__meta">
                        @if ($article->category)
                            <span class="blog__category">{{ $article->category->name }}</span>
                        @endif
                        @if ($article->published_at)
                            <span class="blog__date">
                            <i class="uil uil-calendar-alt"></i>
                            {{ \Illuminate\Support\Carbon::parse($article->published_at)->format('d M Y') }}
                            </span>
                        @endif
                        </div>

                        <h3 class="blog__title">{{ $article->title }}</h3>
                        <p class="blog__description">
                        {{ $article->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($article->content), 140) }}
                        </p>

                        <a
                        href="{{ route('blog.show', $article->slug) }}"
                        class="button button--flex button--small button--link"
                        >
                        Baca Selengkapnya <i class="uil uil-arrow-right button__icon"></i>
                        </a>
                    </div>
                    </article>
                @endforeach
                </div>
            @else
                <p class="section__subtitle">Belum ada artikel yang dipublikasikan.</p>
            @endif
        </section>

      <!--===================== Contact Me =====================-->
      <section class="contact section" id="contact">
        <h2 class="section__title">Contact Me</h2>
        <span class="section__subtitle">Get in touch</span>

        <div class="contact__container container grid">
          <div>
            @if ($profile?->phone)
                <div class="contact__information">
                    <i class="uil uil-calling contact__icon"></i>
                    <div>
                    <h3 class="contact__title">Phone</h3>
                    <span class="contact__subtitle"><a href="tel:{{ $profile->phone }}">{{ $profile->phone }}</a></span>
                    </div>
                </div>
                @endif

                @if ($profile?->email)
                <div class="contact__information">
                    <i class="uil uil-envelope-minus contact__icon"></i>
                    <div>
                    <h3 class="contact__title">Email</h3>
                    <span class="contact__subtitle">{{ $profile->email }}</span>
                    </div>
                </div>
                @endif

                @if ($profile?->location)
                <div class="contact__information">
                    <i class="uil uil-map-marker contact__icon"></i>
                    <div>
                    <h3 class="contact__title">Location</h3>
                    <span class="contact__subtitle">{{ $profile->location }}</span>
                    </div>
                </div>
                @endif
          </div>

          <form action="{{ route('contact.store') }}" method="POST" class="contact__form grid">
            @csrf

            @if (session('success'))
                <p class="contact__subtitle">{{ session('success') }}</p>
            @endif
            @if ($errors->any())
                <p class="contact__subtitle">{{ $errors->first() }}</p>
            @endif

            <div class="contact__inputs grid">
                <div class="contact__content">
                <label for="c-name" class="content__label">Name</label>
                <input id="c-name" type="text" name="name" value="{{ old('name') }}" class="contact__input" required />
                </div>
                <div class="contact__content">
                <label for="c-email" class="content__label">Email</label>
                <input id="c-email" type="email" name="email" value="{{ old('email') }}" class="contact__input" required />
                </div>
            </div>

            <div class="contact__content">
                <label for="c-subject" class="content__label">Subject</label>
                <input id="c-subject" type="text" name="subject" value="{{ old('subject') }}" class="contact__input" />
            </div>

            <div class="contact__content">
                <label for="c-message" class="content__label">Message</label>
                <textarea id="c-message" name="message" rows="7" class="contact__input" required>{{ old('message') }}</textarea>
            </div>

            {{-- honeypot --}}
            <input type="text" name="website" style="display:none" tabindex="-1" autocomplete="off">

            <div>
                <button type="submit" class="button button--flex"
                    style="border:0;cursor:pointer;font-family:inherit;font-size:inherit">
                    Send Message <i class="uil uil-message button__icon"></i>
                </button>
            </div>
            </form>
        </div>
      </section>
    </main>

    <!--================== Footer ===============-->
    <footer class="footer">
        <div class="footer__bg">
            <div class="footer__container container grid">

            <div>
                <h1 class="footer__title">{{ $site->site_name }}</h1>
                <span class="footer__subtitle">{{ $profile?->headline }}</span>
            </div>

            <ul class="footer__links"> 
                <li><a href="#qualification" class="footer__link">Qualification</a></li>
                @if ($projects->isNotEmpty())
                <li><a href="#portfolio" class="footer__link">Projects</a></li>
                @endif
                @if ($certificates->isNotEmpty())
                <li><a href="#certificates" class="footer__link">Certificates</a></li>
                @endif
                <li><a href="#blog" class="footer__link">Blog</a></li>
                <li><a href="#contact" class="footer__link">Contact</a></li>
            </ul>

            <div class="footer__socials">
                @foreach ($socialLinks as $link)
                <a href="{{ $link->url }}" target="_blank" rel="noopener"
                    class="footer__social" aria-label="{{ ucfirst($link->platform) }}">
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

    <!--================== SCROLL TOP ==================-->
    <a href="#" class="scrollup" id="scroll-up">
      <i class="uil uil-arrow-up scrollup__icon"></i>
    </a>

    <script type="text/javascript" src="{{ asset('assets/swiper-bundle.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/2205d59d52.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/ptj.js') }}"></script>
  </body>
</html>
