<div class="container py-5">
    <div>
        @if($profil)
        {!! $profil->text !!}
    @else
        <p>Profil belum tersedia.</p>
    @endif
    </div>
</div>
