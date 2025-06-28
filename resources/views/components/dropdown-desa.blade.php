@props([
    'id' => 'nama_desa',
    'label' => 'Nama Desa',
    'selected' => '',
    'isDispensasi' => false,
    'required' => false,
])

@php
    $listDesa = [
        'sungai_ramania' => 'Sungai Ramania',
        'tanipah' => 'Tanipah',
        'terantang' => 'Terantang',
        'tatah_alayung' => 'Tatah Alayung',
        'tabing_rimbah' => 'Tabing Rimbah',
        'antasan_segera' => 'Antasan Segera',
        'bangkit_baru' => 'Bangkit Baru',
        'puntik_luar' => 'Puntik Luar',
        'puntik_tengah' => 'Puntik Tengah',
        'puntik_dalam' => 'Puntik Dalam',
        'pantai_hambawang' => 'Pantai Hambawang',
        'karang_indah' => 'Karang Indah',
        'karang_bunga' => 'Karang Bunga',
        'lokrawa' => 'Lokrawa',
    ];
@endphp

<div class="mb-3 {{ $isDispensasi ? '' : 'col-md-6' }}">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <select class="form-select @error($id) is-invalid @enderror" id="{{ $id }}" name="{{ $id }}"
        {{ $required ? 'required' : '' }}>
        <option value="" disabled {{ old($id, $selected) == '' ? 'selected' : '' }}>-- Pilih Desa --</option>
        @foreach ($listDesa as $value => $text)
            <option value="{{ $value }}" {{ old($id, $selected) == $value ? 'selected' : '' }}>{{ $text }}
            </option>
        @endforeach
        @if ($isDispensasi)

            {{-- ✅ Tambahkan jika value bukan dari list --}}
            @if (!array_key_exists(old($id, $selected), $listDesa) && old($id, $selected))
                <option value="{{ old($id, $selected) }}" selected>
                    {{ ucwords(str_replace('_', ' ', old($id, $selected))) }} (luar desa)
                </option>
            @endif
            <option value="lainnya" {{ old($id, $selected) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
            {{-- ✅ added --}}
        @endif
    </select>
    @if ($isDispensasi)
        {{-- ✅ Input tambahan jika pilih "Lainnya" --}}
        <div id="{{ $id }}_lainnya_input" style="display: none;" class="mt-2">
            <input type="text" name="{{ $id }}_lainnya" class="form-control"
                placeholder="Masukkan desa lainnya" value="{{ old($id . '_lainnya') }}">
        </div>
    @endif
    @error($id)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

@if ($isDispensasi)
    {{-- ✅ Script toggle input --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const select = document.getElementById("{{ $id }}");
            const inputLainnya = document.getElementById("{{ $id }}_lainnya_input");
            console.log('Input lainnya:', inputLainnya);

            function toggleLainnyaInput() {
                if (select.value === 'lainnya') {
                    inputLainnya.style.display = 'block';
                } else {
                    inputLainnya.style.display = 'none';
                }
            }

            select.addEventListener('change', toggleLainnyaInput);
            toggleLainnyaInput(); // Jalankan di awal
        });
    </script>
@endif
