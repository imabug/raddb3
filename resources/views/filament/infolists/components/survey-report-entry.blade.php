<x-dynamic-component
    :component="$getEntryWrapperView()"
    :entry="$entry"
>
    <div {{ $getExtraAttributeBag() }}>
        @if ($record->hasMedia('survey_reports'))
        <x-filament::icon-button
            icon="heroicon-o-document"
            tag="a"
            href="{{ $record->getFirstMediaUrl('survey_reports') }}"
         />            
        @endif
    </div>
</x-dynamic-component>
