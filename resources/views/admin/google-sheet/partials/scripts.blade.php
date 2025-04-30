{{-- resources/views/tires/partials/scripts.blade.php --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('tire-form');
        if (!form) return;

        // Auto-update tire size
        function updateTireSize() {
            const width = form.querySelector('[name="largeur"]').value;
            const height = form.querySelector('[name="hauteur"]').value;
            const diameter = form.querySelector('[name="diametre"]').value;

            if (width && height && diameter) {
                const size = `${width}/${height}R${diameter}`;
                const displayInput = form.querySelector('.tire-size-display');
                if (displayInput) displayInput.value = size;
            }
        }

        // Trigger tire size update on input
        ['largeur', 'hauteur', 'diametre'].forEach(name => {
            const input = form.querySelector(`[name="${name}"]`);
            if (input) {
                input.addEventListener('input', updateTireSize);
            }
        });

        // Validate on submit
        form.addEventListener('submit', function(e) {
            // const dotInput = form.querySelector('[name="dot"]');
            const pro = parseFloat(form.querySelector('[name="prix_pro"]').value);
            const retail = parseFloat(form.querySelector('[name="prix"]').value);
            let isValid = true;

            // Improved DOT validation (more flexible)
            // if (dotInput && dotInput.value) {
            //     // Allows: 
            //     // - 3-4 character plant codes 
            //     // - 2-4 digit date codes
            //     // - Optional spaces
            //     if (!/^DOT\s?[A-Z0-9]{3,4}\s?[A-Z0-9]{2,4}$/i.test(dotInput.value)) {
            //         e.preventDefault();
            //         alert('Please enter a valid DOT code (e.g., DOT ABCD 1234 or DOT AB 23)');
            //         dotInput.focus();
            //         isValid = false;
            //     }
            // }

            // Price validation
            if (isValid && !isNaN(pro) && !isNaN(retail) && pro >= retail) {
                e.preventDefault();
                alert('Professional price must be lower than retail price.');
                isValid = false;
            }

            // Optional: Add visual feedback for errors
            if (!isValid) {
                document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove(
                    'is-invalid'));
                if (dotInput && dotInput.value && !/^DOT\s?[A-Z0-9]{3,4}\s?[A-Z0-9]{2,4}$/i.test(
                        dotInput.value)) {
                    dotInput.classList.add('is-invalid');
                }
                if (!isNaN(pro) && !isNaN(retail) && pro >= retail) {
                    form.querySelector('[name="prix_pro"]').classList.add('is-invalid');
                    form.querySelector('[name="prix"]').classList.add('is-invalid');
                }
            }
        });

        // Set tire size on page load
        updateTireSize();
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('add-discount').addEventListener('click', function() {
            let index = document.querySelectorAll('.discount-row').length;
            let html = `
        <div class="row border p-2 mb-2 discount-row">
            <div class="col-md-3">
                <label>Min Quantity</label>
                <input type="number" name="discounts[${index}][min_quantity]" class="form-control">
            </div>
            <div class="col-md-3">
                <label>Discount %</label>
                <input type="number" step="0.01" name="discounts[${index}][discount_percent]" class="form-control">
            </div>
            <div class="col-md-3">
                <label>Type</label>
                <select name="discounts[${index}][type]" class="form-control">
                    <option value="general">General</option>
                    <option value="seasonal">Seasonal</option>
                </select>
            </div>
            <div class="col-md-3">
                <label>Season (optional)</label>
                <input type="text" name="discounts[${index}][season]" class="form-control">
            </div>
            <div class="col-md-3">
                <label>Start Date</label>
                <input type="date" name="discounts[${index}][start_date]" class="form-control">
            </div>
            <div class="col-md-3">
                <label>End Date</label>
                <input type="date" name="discounts[${index}][end_date]" class="form-control">
            </div>
        </div>`;
            document.getElementById('discount-container').insertAdjacentHTML('beforeend', html);
        });

    });
</script>
