<html>
@component('mail::table')
    | title         | label         | value    |
    | ------------- |:-------------:| --------:|
    @foreach ($parsed_data as $item)
    | {{$item['title']}} | {{$item['label']}}| {{$item['value']}}|
    @endforeach
@endcomponent
</html>
