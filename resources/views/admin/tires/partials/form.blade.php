{{-- // resources/views/tires/partials/form.blade.php --}}
<div class="row">
    {{-- Article Number --}}
    <div class="col-md-6">
        <div class="mb-3">
            <label>Article Number (nr article)</label>
            <input type="text" name="nr_article" class="form-control"
                value="{{ old('nr_article', $tire->nr_article ?? '') }}" required>
            @if ($errors->has('nr_article'))
                <span class="text-danger">{{ $errors->first('nr_article') }}</span>
            @endif
        </div>
    </div>

    {{-- Brand (marque) --}}
    <div class="col-md-6">
        <div class="mb-3">
            <label>Brand (marque)</label>
            <input type="text" name="marque" class="form-control" value="{{ old('marque', $tire->marque ?? '') }}"
                required>
            @if ($errors->has('marque'))
                <span class="text-danger">{{ $errors->first('marque') }}</span>
            @endif
        </div>
    </div>

    {{-- Size Components --}}
    <div class="col-md-4">
        <div class="mb-3">
            <label>Width - Largeur (mm)</label>
            <input type="number" name="largeur" class="form-control size-input"
                value="{{ old('largeur', $tire->largeur ?? '') }}" required>
            @if ($errors->has('largeur'))
                <span class="text-danger">{{ $errors->first('largeur') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label>Height - Hauteur (%)</label>
            <input type="number" name="hauteur" class="form-control size-input"
                value="{{ old('hauteur', $tire->hauteur ?? '') }}" required>
            @if ($errors->has('hauteur'))
                <span class="text-danger">{{ $errors->first('hauteur') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label>Diameter - Diamétre (inches)</label>
            <input type="number" name="diametre" class="form-control size-input"
                value="{{ old('diametre', $tire->diametre ?? '') }}" required>
            @if ($errors->has('diametre'))
                <span class="text-danger">{{ $errors->first('diametre') }}</span>
            @endif
        </div>
    </div>
    <div class="mb-3">
        <label for="type">Tire Type</label>
        <select name="type" id="type" class="form-control">
            <option value="">Select Type</option>
            <option value="radial" {{ old('type', $tire->type ?? '') == 'radial' ? 'selected' : '' }}>Radial</option>
            <option value="bias" {{ old('type', $tire->type ?? '') == 'bias' ? 'selected' : '' }}>Bias</option>
        </select>
    </div>
    

    {{-- Speed Rating --}}
    <div class="col-md-6">
        <div class="mb-3">
            <label>Speed Rating (vitesse)</label>
            <!-- For speed rating, consider making it a select -->
            <select name="vitesse" class="form-control" required>
                <option value="">-- Select Speed Rating --</option>
                <option value="H" {{ old('vitesse', $tire->vitesse ?? '') == 'H' ? 'selected' : '' }}>H (210 km/h)
                </option>
                <option value="V" {{ old('vitesse', $tire->vitesse ?? '') == 'V' ? 'selected' : '' }}>V (240 km/h)
                </option>
                <!-- Add other speed ratings -->
            </select>
            @if ($errors->has('vitesse'))
                <span class="text-danger">{{ $errors->first('vitesse') }}</span>
            @endif
        </div>
    </div>

    {{-- Season --}}
    <div class="col-md-6">
        <div class="mb-3">
            <label>Season (saison)</label>
            <select name="saison" class="form-control" required>
                <option value="" disabled selected>-- Select Season --</option>
                <option value="Summer" {{ old('saison', $tire->saison ?? '') == 'Summer' ? 'selected' : '' }}>Summer
                </option>
                <option value="Winter" {{ old('saison', $tire->saison ?? '') == 'Winter' ? 'selected' : '' }}>Winter
                </option>
                <option value="All-Season" {{ old('saison', $tire->saison ?? '') == 'All-Season' ? 'selected' : '' }}>
                    All Season</option>
            </select>
            @if ($errors->has('saison'))
                <span class="text-danger">{{ $errors->first('saison') }}</span>
            @endif
        </div>
    </div>

    {{-- Tread Pattern --}}
    <div class="col-md-6">
        <div class="mb-3">
            <label>Tread Pattern (profile)</label>
            <input type="text" name="profile" class="form-control"
                value="{{ old('profile', $tire->profile ?? '') }}">
            @if ($errors->has('profile'))
                <span class="text-danger">{{ $errors->first('profile') }}</span>
            @endif
        </div>
    </div>

    {{-- Batch/Lot --}}
    <div class="col-md-6">
        <div class="mb-3">
            <label>Batch/Lot Number (lot)</label>
            <input type="text" name="lot" class="form-control" value="{{ old('lot', $tire->lot ?? '') }}">
            @if ($errors->has('lot'))
                <span class="text-danger">{{ $errors->first('lot') }}</span>
            @endif
        </div>
    </div>

    {{-- Tread Depth --}}
    <div class="col-md-6">
        <div class="mb-3">
            <label>Tread Depth (mm)</label>
            <input type="number" step="0.1" name="mm" class="form-control"
                value="{{ old('mm', $tire->mm ?? '') }}">
            @if ($errors->has('mm'))
                <span class="text-danger">{{ $errors->first('mm') }}</span>
            @endif
        </div>
    </div>

    {{-- DOT Code --}}
    <div class="col-md-6">
        <div class="mb-3">
            <label>DOT Code</label>
            <input type="text" name="dot" class="form-control" value="{{ old('dot', $tire->dot ?? '') }}">
            @if ($errors->has('dot'))
                <span class="text-danger">{{ $errors->first('dot') }}</span>
            @endif
        </div>
    </div>

    {{-- Run-Flat --}}
    <div class="col-md-6">
        <div class="mb-3">
            <label>Run-Flat Tire? (rft)</label>
            <select name="rft" class="form-control">
                <option value="0" {{ old('rft', $tire->rft ?? 0) == 0 ? 'selected' : '' }}>No</option>
                <option value="1" {{ old('rft', $tire->rft ?? 0) == 1 ? 'selected' : '' }}>Yes</option>
            </select>
            @if ($errors->has('rft'))
                <span class="text-danger">{{ $errors->first('rft') }}</span>
            @endif
        </div>
    </div>

    {{-- Quantity --}}
    <div class="col-md-6">
        <div class="mb-3">
            <label>Quantity (quantité)</label>
            <input type="number" name="quantite" class="form-control"
                value="{{ old('quantite', $tire->quantite ?? 0) }}" required>
            @if ($errors->has('quantite'))
                <span class="text-danger">{{ $errors->first('quantite') }}</span>
            @endif
        </div>
        <div class="mb-3">
            <label for="low_stock_threshold">Low Stock Threshold</label>
            <input type="number" name="low_stock_threshold" class="form-control"
                   value="{{ old('low_stock_threshold', $tire->low_stock_threshold ?? 5) }}" min="0">
        </div>
        
    </div>
    

    {{-- Professional Price --}}
    <div class="col-md-6">
        <div class="mb-3">
            <label>Professional Price (prix pro) (€)</label>
            <input type="number" step="0.01" name="prix_pro" class="form-control"
                value="{{ old('prix_pro', $tire->prix_pro ?? 0) }}" required>
            @if ($errors->has('prix_pro'))
                <span class="text-danger">{{ $errors->first('prix_pro') }}</span>
            @endif
        </div>
    </div>

    {{-- Retail Price --}}
    <div class="col-md-6">
        <div class="mb-3">
            <label>Retail Price (prix) (€)</label>
            <input type="number" step="0.01" name="prix" class="form-control"
                value="{{ old('prix', $tire->prix ?? 0) }}" required>
            @if ($errors->has('prix'))
                <span class="text-danger">{{ $errors->first('prix') }}</span>
            @endif
        </div>
    </div>

    {{-- Condition --}}
    <div class="col-md-6">
        <div class="mb-3">
            <label>Condition (état)</label>
            <select name="etat" class="form-control" required>
                <option value="New" {{ old('etat', $tire->etat ?? '') == 'New' ? 'selected' : '' }}>New</option>
                <option value="Used" {{ old('etat', $tire->etat ?? '') == 'Used' ? 'selected' : '' }}>Used</option>
                <option value="Refurbished" {{ old('etat', $tire->etat ?? '') == 'Refurbished' ? 'selected' : '' }}>
                    Refurbished</option>
            </select>
            @if ($errors->has('etat'))
                <span class="text-danger">{{ $errors->first('etat') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            <label class="form-label">Calculated Tire Size</label>
            <div class="input-group">
                <input type="text" class="form-control tire-size-display bg-light font-monospace fw-bold"
                    value="{{ isset($tire) ? sprintf('%s/%sR%s', $tire->largeur, $tire->hauteur, $tire->diametre) : '' }}"
                    readonly id="calculated-tire-size">
                <button class="btn btn-outline-secondary copy-btn" type="button" title="Copy to clipboard">
                    <i class="far fa-copy"></i>
                </button>
            </div>
            <small class="text-muted">Format: Width/HeightRDiameter (e.g., 205/55R16)</small>
        </div>
    </div>
    
    <hr>
    <h5 class="mt-4">Discounts</h5>
    
    <div id="discount-container">
        @if(isset($tire) && $tire->discounts)
            @foreach($tire->discounts as $index => $discount)
                <div class="row border p-2 mb-2 discount-row">
                    <div class="col-md-3">
                        <label>Min Quantity</label>
                        <input type="number" name="discounts[{{ $index }}][min_quantity]" class="form-control"
                            value="{{ old("discounts.$index.min_quantity", $discount->min_quantity) }}">
                    </div>
                    <div class="col-md-3">
                        <label>Discount %</label>
                        <input type="number" step="0.01" name="discounts[{{ $index }}][discount_percent]" class="form-control"
                            value="{{ old("discounts.$index.discount_percent", $discount->discount_percent) }}">
                    </div>
                    <div class="col-md-3">
                        <label>Type</label>
                        <select name="discounts[{{ $index }}][type]" class="form-control">
                            <option value="general" {{ $discount->type == 'general' ? 'selected' : '' }}>General</option>
                            <option value="seasonal" {{ $discount->type == 'seasonal' ? 'selected' : '' }}>Seasonal</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Season (if seasonal)</label>
                        <input type="text" name="discounts[{{ $index }}][season]" class="form-control"
                            value="{{ old("discounts.$index.season", $discount->season) }}">
                    </div>
                    <div class="col-md-3">
                        <label>Start Date</label>
                        <input type="date" name="discounts[{{ $index }}][start_date]" class="form-control"
                            value="{{ old("discounts.$index.start_date", $discount->start_date?->toDateString()) }}">
                    </div>
                    <div class="col-md-3">
                        <label>End Date</label>
                        <input type="date" name="discounts[{{ $index }}][end_date]" class="form-control"
                            value="{{ old("discounts.$index.end_date", $discount->end_date?->toDateString()) }}">
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    
    <button type="button" id="add-discount" class="btn btn-outline-primary btn-sm">+ Add Discount</button>
    

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
             console.log('aaaaaaaaaaaaaaaaaa');
             
                // Get all relevant elements
                const widthInput = document.querySelector('[name="largeur"]');
                const heightInput = document.querySelector('[name="hauteur"]');
                const diameterInput = document.querySelector('[name="diametre"]');
                const sizeDisplay = document.querySelector('.tire-size-display');
                const copyBtn = document.querySelector('.copy-btn');

                // Function to update tire size display
                function updateTireSize() {
                    if (widthInput && heightInput && diameterInput && sizeDisplay) {
                        const width = widthInput.value;
                        const height = heightInput.value;
                        const diameter = diameterInput.value;

                        if (width && height && diameter) {
                            sizeDisplay.value = `${width}/${height}R${diameter}`;
                        } else {
                            sizeDisplay.value = '';
                        }
                    }
                }

                // Add event listeners to dimension inputs
                [widthInput, heightInput, diameterInput].forEach(input => {
                    if (input) {
                        input.addEventListener('input', updateTireSize);
                        input.addEventListener('change', updateTireSize);
                    }
                });

                // Copy to clipboard functionality
                if (copyBtn && sizeDisplay) {
                    copyBtn.addEventListener('click', function() {
                        if (sizeDisplay.value) {
                            navigator.clipboard.writeText(sizeDisplay.value)
                                .then(() => {
                                    const icon = this.querySelector('i');
                                    icon.classList.remove('fa-copy');
                                    icon.classList.add('fa-check');

                                    setTimeout(() => {
                                        icon.classList.remove('fa-check');
                                        icon.classList.add('fa-copy');
                                    }, 2000);
                                });
                        }
                    });
                }

                // Initialize on load
                updateTireSize();
            });
        </script>
    @endpush
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
               console.log('a');
            });
        </script>
    @endpush
</div>
