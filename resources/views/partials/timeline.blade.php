@foreach ($entries as $entry)
  <div class="qualification__data">
    @if ($loop->odd)
      <div>@include('partials.timeline-body', ['entry' => $entry])</div>
      <div>
        <span class="qualification__rounder"></span>
        @unless ($loop->last)<span class="qualification__line"></span>@endunless
      </div>
    @else
      <div></div>
      <div>
        <span class="qualification__rounder"></span>
        @unless ($loop->last)<span class="qualification__line"></span>@endunless
      </div>
      <div>@include('partials.timeline-body', ['entry' => $entry])</div>
    @endif
  </div>
@endforeach