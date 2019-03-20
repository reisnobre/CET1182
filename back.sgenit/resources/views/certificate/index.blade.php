@extends('layouts.app')

@section('title')

@endsection

@section('style')
  <style media="screen">
  </style>
@endsection
<pre>
  {{ $inscription }}
</pre>
@section('content')
  @php
    \Carbon\Carbon::setLocale('pt_BR');
    use \Carbon\Carbon;
    $event_start = Carbon::parse($inscription->event->event_start);
    $event_end = Carbon::parse($inscription->event->event_end);
  @endphp
  Certificamos que {{ $inscription->name }} participou do evento {{ $inscription->event->title }} como {{ $inscription->genre->description }},
  @if ($inscription->event->sponsor !== null)
  , com financiamento da {{ $inscription->event->sponsor }},
  @endif
  @if ($inscription->event->edital)
    edital {{ $inscription->event->edital }}
  @endif
  realizado na {{ $inscription->event->location }}, realizado no período de {{ $event_start->day }} à {{ $event_end->day }} de {{ $event_end->format('F')}} de {{ $event_end->year }} obtendo a carga horária total  pela parcitipação como {{ $inscription->genre->description }}.
@endsection
