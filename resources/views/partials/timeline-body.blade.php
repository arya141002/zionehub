<h3 class="qualification__title">{{ $entry['title'] }}</h3>
<span class="qualification__subtitle">{{ $entry['subtitle'] }}</span>
<div class="qualification__calender">
  <i class="uil uil-calendar-alt"></i> {{ $entry['period'] }}
</div>

@if (count($entry['details']))
  <span class="button button--flex button--small button--link services__button">
    View More <i class="uil uil-arrow-right button__icon"></i>
  </span>
  <div class="services__modal">
    <div class="services__modal-content">
      <h4 class="services__modal-title">{{ $entry['title'] }}</h4>
      <i class="uil uil-times services__modal-close"></i>
      <ul class="services__modal-services grid">
        @foreach ($entry['details'] as $detail)
          <li class="services__modal-service">
            <i class="uil uil-check-circle services__modal-icon"></i>
            <p>{{ $detail }}</p>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
@endif